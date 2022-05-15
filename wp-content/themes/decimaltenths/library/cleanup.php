<?php
/**
 * Clean up WordPress defaults
 *
 */

if ( ! function_exists( 'octopress_start_cleanup' ) ) :
	function octopress_start_cleanup() {

		/* Launching operation cleanup. */
		add_action( 'init', 'octopress_cleanup_head' );

		/* Remove WP version from RSS. */
		add_filter( 'the_generator', 'octopress_remove_rss_version' );

		/* Remove pesky injected css for recent comments widget. */
		// add_filter( 'wp_head', 'octopress_remove_wp_widget_recent_comments_style', 1 );

		/* Clean up comment styles in the head. */
		// add_action( 'wp_head', 'octopress_remove_recent_comments_style', 1 );
	}
	add_action( 'after_setup_theme', 'octopress_start_cleanup' );
endif;

/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'octopress_cleanup_head' ) ) :
	function octopress_cleanup_head() {

		/*
		 * Remove "Really Simple Discovery (RSD)" link tag?
		 * XML-RPC clients use this discover method. If you do not know what this is and don't use service integrations such as Flickr on your WordPress website, you can remove it.
		*/
		remove_action( 'wp_head', 'rsd_link' );

		/*
		 * Remove "Windows Live Writer" link tag?
		 * If you do not use Windows Live Writer to edit your blog contents, then it's safe to remove this.
		*/
		remove_action( 'wp_head', 'wlwmanifest_link' );

		/*
		 * Remove "REST API" link tag?
		 * Are you accessing your content through endpoints (e.g. https://yourwebsite.com/wp-json/, https://yourwebsite.com/wp-json/wp/v2/posts/1 - 1 in this example is the POST ID)? If not, you can remove this.
		*/
		remove_action('wp_head', 'rest_output_link_wp_head');
		/* Removes the following printed within "Response headers": */
		/* <https://yourwebsite.com/wp-json/>; rel="https://api.w.org/" */
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );

		/*
		 * Remove Pages/Posts "Shortlink" tag?
		 * Are you using SEO friendly URLs and do not need the default WordPress shortlink? You can just remove this as it bulks out the head section of your website.
		*/
		remove_action('wp_head', 'wp_shortlink_wp_head');
		/* link: <https://yourdomainname.com/wp-json/>; rel="https://api.w.org/", <https://yourdomainname.com/?p=[post_id_here]>; rel=shortlink */
		remove_action('template_redirect', 'wp_shortlink_header', 11);

		/*
		 * Remove "Post's Relational Links" tag?
		 * This removes relational links for the posts adjacent to the current post for single post pages.
		*/
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

		/*
		 * Remove "Post's Relational Links" tag?
		 * This removes relational links for the posts adjacent to the current post for single post pages.
		*/
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

		/* 
		 * Remove "WordPress version" meta tag? 
		 * This is good for security purposes as well, since it hides the WordPress version you're using (in case of hacking attempts).
		*/
		remove_action('wp_head', 'wp_generator');
		/* also hide it from RSS */
		add_filter('the_generator', '__return_false');

		/*
		 * Remove Main RSS Feed Link?
		 * If you do not use WordPress for blogging purposes at all, and it doesn't have any blog posts (apart from the main pages that you added), then you can remove the main feed link. 
		 * It will also remove feeds for the following pages: categories, tags, custom taxonomies & search results. 
		 * Note that it will not remove comments RSS feeds which can be removed using the setting below. Some websites might have blog posts and would keep the main RSS feeds enabled, while removing the comments RSS feeds if they don't use the comments functionality.
		*/
		// add_filter('feed_links_show_posts_feed', '__return_false');
		// remove_action('wp_head', 'feed_links_extra', 3);

		/*
		 * Remove Comment RSS Feed Link?
		 * If you do not use the comments functionality on your posts or do not use WordPress for blogging purposes at all, then you can remove the comments feed link.
		*/
		add_filter('feed_links_show_comments_feed', '__return_false');

		/* Emoji detection script. */
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

		/* Emoji styles. */
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
endif;
