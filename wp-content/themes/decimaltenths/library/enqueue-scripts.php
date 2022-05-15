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

			// wp_enqueue_script( 'theme-nav', get_template_directory_uri() . '/dist/js/' . octopress_asset_path( 'app.js' ), array( '' ), '', true );
			
			// wp_enqueue_script( 'theme-app', get_template_directory_uri() . '/dist/js/' . octopress_asset_path( 'app.js' ), array( 'jquery' ), '', true );

			// wp_enqueue_script( 'theme-menu', get_stylesheet_directory_uri() . '/dist/vendor/' . octopress_asset_path( 'primary-navigation.js' ), '', '', true );


			//*====*//


			// Dequeue Gutenbery styles
			wp_dequeue_style( 'wp-block-library' );

			// Will be loaded inline the header.php
			// wp_enqueue_style( 'theme-critical', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'critical.css' ), array(), '', 'all' );

			// Enqueue our own Gberg styles
			// wp_enqueue_style( 'theme-gberg', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'g-berg.css' ), array(), '', 'all' );

			// Enqueue the main Stylesheet.
			// wp_enqueue_style( 'theme-app', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'app.css' ), array(), '', 'all' );

			if ( is_home() || is_search() || is_category() || is_tax( 'our-work' ) ) {

				// wp_enqueue_style( 'theme-blog', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'blog.css' ), array(), '', 'all' );
			}

			if ( is_singular( 'single-work' ) ) {
				
				// wp_enqueue_style( 'theme-work', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'work.css' ), array(), '', 'all' );

			} elseif ( is_single() ) {

				// wp_enqueue_style( 'theme-single', get_stylesheet_directory_uri() . '/dist/css/' . octopress_asset_path( 'single.css' ), array(), '', 'all' );
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'octopress_scripts' );
endif;


/* Load remaning stylesheets performantly */
// if ( ! function_exists( 'octopress_stylesheet_loader' ) ) :
// 	function octopress_stylesheet_loader($html, $handle, $href, $media) {

// 		$handles = array( 'theme-app' );
// 		if( in_array( $handle, $handles ) ){
// 	        // $html = str_replace('https:', '', $html);   
// 	        $strval = str_replace("rel='stylesheet'", 'rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', $html);
// 	        return str_replace("type='text/css' media='all'", '', $strval);
// 	    }
// 	    return $html;

// 	}
// 	add_filter('style_loader_tag', 'octopress_stylesheet_loader', 10, 4);
// endif;


/* For the admin */
// if ( ! function_exists( 'octopress_admin_styles' ) ) :
// 	function octopress_admin_styles() {
// 		wp_register_style( 'blueocto-admin', get_stylesheet_directory_uri() . '/dist/css/blueocto-admin-styles.css' );
// 		wp_enqueue_style( 'blueocto-admin' );
// 	}
// 	add_action( 'admin_enqueue_scripts', 'octopress_admin_styles' );
// endif;
