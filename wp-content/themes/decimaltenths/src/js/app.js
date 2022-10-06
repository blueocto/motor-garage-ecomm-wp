/* Start custom jQuery... */
jQuery(document).ready(function ($) {
	
    // wrap a container around the Title and Description on a Taxonomy/shop category page
    $( ".woocommerce-products-header .page-title, .woocommerce-products-header .term-description, .woocommerce-products-header .page-description" ).wrapAll( "<div class='taxonomy-head-wrap'/>" );

    // wrap a container around the single product entry-summary and tabs
    $(".entry-summary, .woocommerce-tabs").wrapAll('<div class="single-product-description"></div>');

    if ($(".new_in_carousel").length) {
		$(".new_in_carousel").slick({
			mobileFirst: true,
			lazyLoad: "progressive",
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
            prevArrow: $('.prev-new'),
            nextArrow: $('.next-new'),
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 640,
					settings: {
						infinite: true,
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 480,
					settings: {
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	}

    if ($(".popular_carousel").length) {
		$(".popular_carousel").slick({
			mobileFirst: true,
			lazyLoad: "progressive",
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
            prevArrow: $('.prev-popular'),
            nextArrow: $('.next-popular'),
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 640,
					settings: {
						infinite: true,
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 480,
					settings: {
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	}
});
