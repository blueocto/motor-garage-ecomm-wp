/* Start custom jQuery... */
jQuery(document).ready(function ($) {
	
    // wrap a container around the Title and Description on a Taxonomy/shop category page
    $( ".woocommerce-products-header .page-title, .woocommerce-products-header .term-description, .woocommerce-products-header .page-description" ).wrapAll( "<div class='taxonomy-head-wrap'/>" );

    // wrap a container around the single product entry-summary and tabs
    $(".entry-summary, .woocommerce-tabs").wrapAll('<div class="single-product-description"></div>');

});
