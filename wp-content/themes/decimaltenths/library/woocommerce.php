<?php

/**
* Declare WooCommerce support
*/
function woocommerce_support() {

	/* In versions 3.3+, the gallery is off by default for WooCommerce compatible themes unless they declare support for it (below) */
	add_theme_support( 'wc-product-gallery-zoom' ); //jQuery Zoom
	add_theme_support( 'wc-product-gallery-lightbox' ); //Photoswipe
	add_theme_support( 'wc-product-gallery-slider' ); //Flexslider

	add_theme_support( 
		'woocommerce', array(
			/**
			* Ref: https://docs.woocommerce.com/document/image-sizes-theme-developers/ 
			*/

			/* 'thumbnails' for archive pages
			* also known as 'woocommerce_thumbnail' or 'shop_catalog'
			*/
			'thumbnail_image_width' => 307, 
			
			/** 
			* change the size of thumbnails on single product, as cannot be set in Admin
			* also known as 'woocommerce_gallery_thumbnail' or 'shop_thumbnail'
			*/
			'gallery_thumbnail_image_width' => 123, 
			
			/**
			* full size image
			* also known as 'woocommerce_single' or 'shop_single'
			*/
			'single_image_width' => 700,
		)
	);
	update_option( 'woocommerce_thumbnail_cropping', 'uncropped' ); 
}
add_action( 'after_setup_theme', 'woocommerce_support' );


/**
* Wrap img elements, with picture element
*/
// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/* WooCommerce Loop Product Thumbs */
// if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
//     function woocommerce_template_loop_product_thumbnail() {
//         echo "<picture class='picture'>";
//         echo woocommerce_get_product_thumbnail();
//         echo "</picture>";
//     }
// }


/* Display WooCommerce product category description on all category archive pages */
function my_theme_woocommerce_taxonomy_archive_description() {
    if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) != 0 ) {
        $description = wc_format_content( term_description() );
        if ( $description ) {
        	echo '<div class="term-description"><p>';
            echo $description;
            echo '</p></div>';
        }
    }
}
add_action( 'woocommerce_archive_description', 'my_theme_woocommerce_taxonomy_archive_description');


/**
* Unhook the WooCommerce wrappers
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); 
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); 
/* Hook in your own functions to display the wrappers your theme requires */
add_action('woocommerce_before_main_content', 'change_woo_wrapper_start', 10); 
add_action('woocommerce_after_main_content', 'change_woo_wrapper_end', 10);
function change_woo_wrapper_start() {
	echo '<section class="woo-container">';
}
function change_woo_wrapper_end() {
	echo '</section>';
}

/**
 * Display category image on category archive
 * Ref: @link https://docs.woocommerce.com/document/woocommerce-display-category-image-on-category-archive/
 */
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 10 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
		$srcset = wp_get_attachment_image_srcset( $thumbnail_id, 'large', array( 'loading' => 'lazy') );
	    if ( $image ) {
		    echo '<picture class="woo-picture"><img src="' . $image . '" srcset="' . $srcset . '" alt="' . $cat->name . '" loading="lazy" /></picture>';
		}
	}
}


// ===============================================================
// Layout (so you dont need to copy templates from Woo)
// ===============================================================

/**
* Move the location of the sidebar
*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action( 'woocommerce_after_shop_loop', 'woocommerce_get_sidebar', 8);

/**
* Move the location of the product meta
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_after_single_product_summary', 'custom_woocommerce_template_single_meta', 8);
function custom_woocommerce_template_single_meta() {
	get_template_part( 'template-parts/content-single-meta' );
}

/**
* Move the location of the related products
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 8);


/**
* Move the location of the upsells products
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 8);


// ===============================================================
// Disable All WooCommerce Styles and Scripts Except Shop Pages
// ===============================================================

function dequeue_woocommerce_styles_scripts() {
	/* first check that WC exists to prevent fatal errors */
	if ( function_exists( 'is_woocommerce' ) ) {
		/* unless a Shop-related page, remove from the rest of pages */
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_product() ) {
			# Styles
				wp_deregister_style( 'woocommerce-layout' );
				wp_deregister_style( 'woocommerce-smallscreen' );
				wp_deregister_style( 'woocommerce-general' );
				wp_deregister_style( 'woocommerce-tabs-to-accordion-css' );

			# Scripts
				wp_deregister_script( 'wc-settings' );
				wp_deregister_script( 'easy-responsive-tabs-js' );

		} elseif ( is_product_category() || is_shop() ) {
			# Styles
				wp_deregister_style( 'woocommerce-layout' );
				wp_deregister_style( 'woocommerce-smallscreen' );
				wp_deregister_style( 'woocommerce-general' );
				wp_deregister_style( 'sby_styles' );
				wp_deregister_style( 'wc-blocks-vendors-style' );
				wp_deregister_style( 'woocommerce-tabs-to-accordion-css' );

			# Scripts
				wp_deregister_script( 'wc-settings' );
				wp_deregister_script( 'easy-responsive-tabs-js' );

		} elseif ( is_product() ) {
			# Styles
				wp_deregister_style( 'woocommerce-layout' );
				wp_deregister_style( 'woocommerce-smallscreen' );
				wp_deregister_style( 'woocommerce-general' );
				wp_deregister_style( 'sby_styles' );
				wp_deregister_style( 'wc-blocks-vendors-style' );
				//wp_deregister_style( 'dashicons' );
			
			# Scripts
				wp_deregister_script( 'wc-settings' );

		} elseif ( is_account_page() ) {
			# Styles
				// wp_deregister_style( 'woo-variation-swatches-tooltip' );

			# Scripts
				wp_deregister_script( 'wc-settings' );
				// wp_deregister_script( 'easy-responsive-tabs-js' );

		} else {
			/* Load everything required.. except */
			# Styles
				wp_deregister_style( 'woocommerce-tabs-to-accordion-css' );
				wp_deregister_style( 'woocommerce-layout' );
				wp_deregister_style( 'woocommerce-general' );
				wp_deregister_style( 'woocommerce-smallscreen' );
				wp_deregister_style( 'sby_styles' );
				wp_deregister_style( 'wc-blocks-vendors-style' );
				//wp_deregister_style( 'dashicons' );
			# Scripts
				wp_deregister_script( 'easy-responsive-tabs-js' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99 );
