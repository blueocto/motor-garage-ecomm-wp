<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 */

if ( ! function_exists( 'octopress_theme_support' ) ) :
	function octopress_theme_support() {
		
		/* Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
		* https://codex.wordpress.org/Content_Width
		*/
		if ( ! isset( $content_width ) ) {
			$content_width = 1348; // matches that of row in _settings.scss
		}

		/* Switch default core markup for search form, comment form, and comments to output valid HTML5 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/* Add menu support */
		add_theme_support( 'menus' );

		/* Let WordPress manage the document title */
		add_theme_support( 'title-tag' );

		/* Add post thumbnail support
		* http://codex.wordpress.org/Post_Thumbnails 
		*/
		add_theme_support( 'post-thumbnails' );

		// add_image_size( 'blueocto-responsive-300', 300, 300, false ); // width, height, hard crop mode
		// add_image_size( 'blueocto-responsive-768', 768, 768, false ); // width, height, hard crop mode
		// add_image_size( 'blueocto-responsive-1200', 1200, 1200, false ); // width, height, hard crop mode

		/* This feature enables Automatic Feed Links for post and comment in the head. */
		add_theme_support( 'automatic-feed-links' );

		/* Allow for full screen width selection within Gutenberg */
		add_theme_support( 'align-wide' );

		/* Required for Yoast plugin */
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/* Remove the prefix from archive titles */
		add_filter( 'get_the_archive_title_prefix', '__return_false' );

		/* Add "Reusable Blocks" to admin menu */
		function linked_url() {
			add_menu_page( 'linked_url', 'Reusable Blocks', 'read', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
		}
		add_action( 'admin_menu', 'linked_url' );

		/* Excerpt length */
		function mytheme_custom_excerpt_length( $length ) {
			return 17;
		}
		add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );	
		
		// Replace the default ellipsis
		function wpdocs_excerpt_more( $more ) {
			return '...';
		}
		add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

	}

	add_action( 'after_setup_theme', 'octopress_theme_support' );
endif;
