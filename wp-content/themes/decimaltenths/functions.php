<?php
/**
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 */

/** ACF */
require_once( 'library/acf.php' );

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
require_once( 'library/pagination.php' );

/** WooCommerce */
require_once( 'library/woocommerce.php' );

function myplugin_register_query_vars( $vars ) {
    $vars[] = 'manufacturer';
    $vars[] = 'model';
    return $vars;
}
add_filter( 'query_vars', 'myplugin_register_query_vars' );

function my_custom_search_template( $template ) {
    $manufacturer = $_GET['manufacturer'] ?? '';
    $model = $_GET['model'] ?? '';
    if ( $manufacturer && $model ) {
        $ct = locate_template('search.php', false, false);
        if ( $ct ) $template = $ct;
    }
    return $template;
}
add_filter('template_include', 'my_custom_search_template');

function search_title($title){
    global $template;
    $manufacturer = $_GET['manufacturer'] ?? '';
    $model = $_GET['model'] ?? '';
    $search = $_GET['s'] ?? '';
    
    if( basename($template) == "search.php" ) {

        if($manufacturer != "" && $model != ""){
            $title = "Search for ".$manufacturer."(".$model.") - Decimal Tenths";
        } else {
            $title = "Search for ".$search." - Decimal Tenths";
        }
    }
    return $title;
}
add_filter( 'wpseo_title', 'search_title', 10, 1);

// Allow SVG uploads
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Move add to cart button before price
add_action( 'woocommerce_single_product_summary', 'moving_add_cart', 1 );
function moving_add_cart() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15 );
}

//Forcibly removes spaces at start of content 
function remove_forced_spaces($content) {     
    $string = htmlentities($content, null, 'utf-8');     
    $content = str_replace("&nbsp;", " ", $string);     
    $content = html_entity_decode($content);     
    return $content; 
} 
add_filter("the_content", "remove_forced_spaces", 9);

// Remove titles from tabs
add_filter( 'woocommerce_product_description_heading', '__return_null' );
add_filter( 'woocommerce_product_brand_heading', '__return_null' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
add_filter( 'woocommerce_product_reviews_heading', '__return_null' );