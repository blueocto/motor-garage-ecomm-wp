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
		'footer-nav-a' => esc_html__( 'Footer A', 'decimaltenths' ),
		'footer-nav-b' => esc_html__( 'Footer B', 'decimaltenths' ),
		'footer-nav-c' => esc_html__( 'Footer C', 'decimaltenths' ),
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
 * Footer navigation (A)
 */
if ( ! function_exists( 'octopress_footer_nav_a' ) ) {
	function octopress_footer_nav_a() {
		wp_nav_menu(
			array(
				'theme_location'  => 'footer-nav-a',
				'menu_class'      => 'menu-wrapper menu footer--menu',
				'container_class' => 'footer-menu-container',
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}

/**
 * Footer navigation (B)
 */
if ( ! function_exists( 'octopress_footer_nav_b' ) ) {
	function octopress_footer_nav_b() {
		wp_nav_menu(
			array(
				'theme_location'  => 'footer-nav-b',
				'menu_class'      => 'menu-wrapper menu footer--menu',
				'container_class' => 'footer-menu-container',
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}

/**
 * Footer navigation (C)
 */
if ( ! function_exists( 'octopress_footer_nav_c' ) ) {
	function octopress_footer_nav_c() {
		wp_nav_menu(
			array(
				'theme_location'  => 'footer-nav-c',
				'menu_class'      => 'menu-wrapper menu footer--menu',
				'container_class' => 'footer-menu-container',
				'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
	}
}
