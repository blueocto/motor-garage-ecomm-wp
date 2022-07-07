<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */

register_nav_menus(
	array(
		'primary-nav'  => esc_html__( 'Primary Navigation', 'decimaltenths' ),
		'shop-by-car' => esc_html__( 'Shop By Car', 'decimaltenths' ),
		'shop-by-part' => esc_html__( 'Shop By Part', 'decimaltenths' ),
		'footer-nav' => esc_html__( 'Footer Navigation', 'decimaltenths' ),
	)
);


/**
 * Primary navigation
 */
if ( ! function_exists( 'octopress_primary_nav' ) ) {
	function octopress_primary_nav() {
		wp_nav_menu(
			array(
				'theme_location'  => 'primary-nav',
				'menu_class'      => 'menu primary--menu',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}

/**
 * Shop By Car navigation
 */
if ( ! function_exists( 'octopress_shopbycar_nav' ) ) {
	function octopress_shopbycar_nav() {
		wp_nav_menu(
			array(
				'theme_location'  => 'shop-by-car',
				'menu_class'      => 'sub-menu',
				'container'       => false,
				// 'container_class' => false,
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}

/**
 * Shop By Part navigation
 */
if ( ! function_exists( 'octopress_shopbypart_nav' ) ) {
	function octopress_shopbypart_nav() {
		wp_nav_menu(
			array(
				'theme_location'  => 'shop-by-part',
				'menu_class'      => 'sub-menu',
				'container'       => false,
				// 'container_class' => false,
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}

/**
 * Footer navigation
 */
// if ( ! function_exists( 'octopress_footer_nav' ) ) {
// 	function octopress_footer_nav() {
// 		wp_nav_menu(
// 			array(
// 				'theme_location'  => 'footer-nav',
// 				'menu_class'      => 'menu-wrapper menu footer--menu',
// 				'container_class' => 'footer-menu-container',
// 				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
// 				'fallback_cb'     => false,
// 			)
// 		);
// 	}
// }
