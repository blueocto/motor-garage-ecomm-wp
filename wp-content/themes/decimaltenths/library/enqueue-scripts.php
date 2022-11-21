<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 */

/* Check to see if rev-manifest exists for CSS and JS static asset revisioning */
/* https://github.com/sindresorhus/gulp-rev/blob/master/integration.md */

if ( ! function_exists( 'octopress_asset_path' ) ) :
	function octopress_asset_path( $filename ) {
		$filename_split = explode( '.', $filename );
		$dir            = end( $filename_split );
		$manifest_path  = dirname( dirname( __FILE__ ) ) . '/dist/' . $dir . '/rev-manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$manifest = [];
		}

		if ( array_key_exists( $filename, $manifest ) ) {
			return $manifest[ $filename ];
		}
		return $filename;
	}
endif;


if ( ! function_exists( 'octopress_scripts' ) ) :
	function octopress_scripts() {

		global $template;

		if (!is_admin()) {
			/* Function to defer loaded scripts 
			ref: https://jasonyingling.me/fixing-render-blocking-scripts-third-party-sources-wordpress/ */
			function js_async_attr($tag){
				# Do not add defer or async attribute to these scripts
				$scripts_to_exclude = array('jquery.min.js');

				foreach($scripts_to_exclude as $exclude_script){
					if(true == strpos($tag, $exclude_script ) )
					return $tag;    
				}
				# Defer or async all remaining scripts not excluded above
				return str_replace( ' src', ' defer src', $tag );
			}
			add_filter( 'script_loader_tag', 'js_async_attr', 10 ); 
			
			/* We don't need oEmbed */
			wp_deregister_script('wp-embed'); 


			/* Enqueue our Theme scripts */

			wp_enqueue_script( 'theme-menu', get_stylesheet_directory_uri() . '/dist/vendor/' . octopress_asset_path( 'primary-navigation.js' ), '', '', false );

			// Slick carousel the A11y version
			wp_enqueue_script( 'theme-slick', get_stylesheet_directory_uri() . '/dist/vendor/' . octopress_asset_path( 'slick.min.js' ), '', '', true );

			wp_enqueue_script( 'theme-app', get_template_directory_uri() . '/dist/js/' . octopress_asset_path( 'app.js' ), array('jquery'), '', true );


			//*====*//


			// Dequeue Gutenbery styles
			wp_dequeue_style( 'wp-block-library' );

			// Will be loaded inline the header.php
			wp_enqueue_style( 'theme-critical', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'critical.css' ), array(), '', 'all' );

			// Enqueue our own Gberg styles
			wp_enqueue_style( 'theme-gberg', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'g-berg.css' ), array(), '', 'all' );

			// Enqueue the main Stylesheet.
			wp_enqueue_style( 'theme-app', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'app.css' ), array(), '', 'all' );

			if( is_home() ) {
				wp_enqueue_style( 'theme-blog', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'blog.css' ), array(), '', 'all' );
			}

			if ( is_home() || is_search() || is_category() ) {

				wp_enqueue_style( 'theme-blog', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'blog.css' ), array(), '', 'all' );
			}

			if ( is_single() ) {

				// wp_enqueue_style( 'theme-single', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'single.css' ), array(), '', 'all' );
			}

			if ( is_cart() || is_checkout() ) {

				wp_enqueue_style( 'theme-checkout', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'checkout.css' ), array(), '', 'all' );
			}

			if ( is_account_page() ) {
				
				wp_enqueue_style( 'theme-account', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'account.css' ), array(), '', 'all' );
			}

			if ( is_product() ) {

				wp_enqueue_style( 'theme-product', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'product.css' ), array(), '', 'all' );
			}

			if ( is_product_category() || is_shop()  || is_archive() ) {

				wp_enqueue_style( 'theme-category', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'category.css' ), array(), '', 'all' );
			}

			if( basename($template) == "search.php" ) {
				wp_enqueue_style( 'theme-search', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'search.css' ), array(), '', 'all' );
			}

			if(is_404()){
				wp_enqueue_style( 'theme-404', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( '404.css' ), array(), '', 'all' );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'octopress_scripts' );
endif;

/* Load remaning stylesheets performantly */
if ( ! function_exists( 'octopress_stylesheet_loader' ) ) :
	function octopress_stylesheet_loader($html, $handle, $href, $media) {

		$handles = array( 'theme-app', 'theme-gberg', 'theme-blog', 'theme-checkout', 'theme-account', 'theme-product', 'theme-category', 'theme-search', 'theme-404', 'formidable', 'searchandfilter', 'woof', 'woof_step_filter_html_items' );
		if( in_array( $handle, $handles ) ){
	        // $html = str_replace('https:', '', $html);   
	        $strval = str_replace("rel='stylesheet'", 'rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', $html);
	        return str_replace("type='text/css' media='all'", '', $strval);
	    }
	    return $html;

	}
	add_filter('style_loader_tag', 'octopress_stylesheet_loader', 10, 4);
endif;


/* For the admin */
if ( ! function_exists( 'octopress_admin_styles' ) ) :
	function octopress_admin_styles() {
		wp_register_style( 'blueocto-admin', get_stylesheet_directory_uri() . '/dist/css/blueocto-admin-styles.css' );
		wp_enqueue_style( 'blueocto-admin' );
	}
	add_action( 'admin_enqueue_scripts', 'octopress_admin_styles' );
endif;
