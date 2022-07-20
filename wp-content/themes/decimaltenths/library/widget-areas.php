<?php
/**
 * Register widget areas
 *
 */

if ( ! function_exists( 'octopress_sidebar_widgets' ) ) :
	function octopress_sidebar_widgets() {
		register_sidebar(
			array(
				'id'            => 'sidebar-widgets',
				'name'          => __( 'Shop widgets', 'decimaltenths' ),
				'description'   => __( 'Drag widgets here.', 'decimaltenths' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget--title">',
				'after_title'   => '</h3>',
			)
		);

		// register_sidebar(
		// 	array(
		// 		'id'            => 'blog-widgets',
		// 		'name'          => __( 'Blog widgets', 'decimaltenths' ),
		// 		'description'   => __( 'Drag widgets here.', 'decimaltenths' ),
		// 		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		// 		'after_widget'  => '</section>',
		// 		'before_title'  => '<h3 class="widget--title">',
		// 		'after_title'   => '</h3>',
		// 	)
		// );
	}

	add_action( 'widgets_init', 'octopress_sidebar_widgets' );
endif;
