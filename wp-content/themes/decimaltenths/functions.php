<?php
/**
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 */

/** Show featured image in Admin area */
require_once( 'library/admin-featured-image.php' );

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );
require_once( 'library/primary-navigation.php' );

/** Custom Gutenberg Colors */
require_once( 'library/colour-palette.php' );

/* Sidebars and widgets */
require_once( 'library/widget-areas.php' );

/** ACF Blocks */
// require_once( 'library/acf-blocks.php' );

/* Custom pagination */
// require_once( 'library/pagination.php' );

/** WooCommerce */
require_once( 'library/woocommerce.php' );
