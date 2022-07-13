<?php 
/* Editor Color Palette

	.has-blue-color {
		color:#347ab7;
	}
	.has-blue-background-color {
		background-color:#347ab7;
	}
*/

add_theme_support( 'editor-color-palette', array(
	// array(
	// 	'name'  => __( 'Black', 'textdomain' ),
	// 	'slug'  => 'brand-black',
	// 	'color'	=> '#000000',
	// ),
	array(
		'name'  => __( 'Off Black', 'textdomain' ),
		'slug'  => 'bo-off-black',
		'color'	=> '#212121',
	),
	array(
		'name'  => __( 'Grey 70%', 'textdomain' ),
		'slug'  => 'bo-grey-70',
		'color'	=> '#616161',
	),
	array(
		'name'  => __( 'Grey 50%', 'textdomain' ),
		'slug'  => 'bo-grey-50',
		'color'	=> '#9e9e9e',
	),
	array(
		'name'  => __( 'Grey 30%', 'textdomain' ),
		'slug'  => 'bo-grey-30',
		'color'	=> '#e0e0e0',
	),
	array(
		'name'  => __( 'Off White', 'textdomain' ),
		'slug'  => 'bo-off-white',
		'color'	=> '#f5f5f5',
	),
	array(
		'name'  => __( 'White', 'textdomain' ),
		'slug'  => 'bo-white',
		'color'	=> '#FFFFFF',
	),
	array(
		'name'  => __( 'Brand Green', 'textdomain' ),
		'slug'  => 'brand-green',
		'color'	=> '#43B143',
	),
	array(
		'name'  => __( 'Brand Light Grey', 'textdomain' ),
		'slug'  => 'brand-light-grey',
		'color'	=> '#F2F2F2',
	),
	array(
		'name'  => __( 'Brand Dark Grey', 'textdomain' ),
		'slug'  => 'brand-dark-grey',
		'color'	=> '#282828',
	),
));


/* Editor Gradient Palette 
 * Ref: https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#block-gradient-presets
 *
	.has-vivid-cyan-blue-to-vivid-purple-gradient-background {
		background: linear-gradient(
			135deg,
			rgba( 6, 147, 227, 1 ) 0%,
			rgb( 155, 81, 224 ) 100%
		);
	}
 *
 * @see https://since1979.dev/snippet-011-custom-gutenberg-gradient-colors/
 * @uses add_theme_support() https://developer.wordpress.org/reference/functions/add_theme_support/
 * @uses __() https://developer.wordpress.org/reference/functions/__/
 * @uses array() https://www.php.net/manual/en/function.array.php
*/

// function octopress_theme_gradients() {
// 	add_theme_support( 'editor-gradient-presets', array(
// 		array(
// 			'name'     => esc_attr__( 'Brand Blue to Brand Pink', 'themeLangDomain' ),
// 			'gradient' => 'linear-gradient(270deg, #3573D5 0%, #E21286 100%)',
// 			'slug'     => 'brand-blue-pink'
// 		),
// 	));
// }

/**
 * Hook: after_setup_theme.
 *
 * @uses add_action() https://developer.wordpress.org/reference/functions/add_action/
 * @uses after_setup_theme https://developer.wordpress.org/reference/hooks/after_setup_theme/
 */
// add_action('after_setup_theme', 'octopress_theme_gradients');

