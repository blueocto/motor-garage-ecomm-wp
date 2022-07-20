/* Start custom jQuery... */
jQuery(document).ready(function ($) {
	
    // wrap a container around the Title and Description on a Taxonomy/shop category page
    $( ".woocommerce-products-header .page-title, .woocommerce-products-header .term-description" ).wrapAll( "<div class='taxonomy-head-wrap'/>" );

});
