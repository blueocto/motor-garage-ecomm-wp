/* Start custom jQuery... */
jQuery(document).ready(function ($) {

	$.ajaxSetup({ cache: false });

	function secondNavMove(){
		if ($(window).width() < 1024) {
			console.log("Move");
			$(".secondary-nav").insertAfter(".primary-menu-container");
		} else {
			$(".secondary-nav").insertAfter("header.header");
		}
	}
	secondNavMove();
	$(window).resize(function(){
		secondNavMove();
	});
	
    // wrap a container around the Title and Description on a Taxonomy/shop category page
    $( ".woocommerce-products-header .page-title, .woocommerce-products-header .term-description, .woocommerce-products-header .page-description" ).wrapAll( "<div class='taxonomy-head-wrap'/>" );

    // wrap a container around the single product entry-summary and tabs
    $(".entry-summary, .woocommerce-tabs").wrapAll('<div class="single-product-description"></div>');

	function carSearch(selectedOption, addOptions, blankOptionName) {
		$(addOptions).empty().append("<option value=\"\">--"+blankOptionName+"--</option>");
		$.ajax({
            type: "GET",
            url: "/car-models/models.json",
            dataType: "json",
            beforeSend: function() {
            },
            success: function(json){
				$.each(json, function(i,item){
					if(selectedOption == item.parent){
						$(addOptions).append("<option data-catid=\""+item.id+"\" value=\""+item.slug+"\">"+item.name+"</option>");
					}
				});
            },
            complete: function(){

            },
            error: function() {
                console.log("An error occurred while processing JSON file.");
            }
        });
	}

	$(".manufacturer").change(function(){
		var selectedCatID = $(this).find(':selected').data('catid');
		carSearch(selectedCatID, "select.model", "Model");
	});
	$(".model").change(function(){
		var selectedCatID = $(this).find(':selected').data('catid');
		carSearch(selectedCatID, "select.chassis", "Chassis");
	});


    setTimeout(function () {
		if ($(".hero_image_carousel").length) {
			$(".hero_image_carousel").slick({
				mobileFirst: true,
				lazyLoad: "progressive",
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				autoplay: true,
				autoplaySpeed: 5000
			});
		}
	}, 100);
	
	if ($(".new_in_carousel").length) {
		$(".new_in_carousel").slick({
			mobileFirst: true,
			lazyLoad: "progressive",
			infinite: true,
			slidesToShow: 2,
			slidesToScroll: 2,
            prevArrow: $('.prev-new'),
            nextArrow: $('.next-new'),
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						infinite: true,
						slidesToShow: 6,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 2,
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
			slidesToShow: 2,
			slidesToScroll: 2,
            prevArrow: $('.prev-popular'),
            nextArrow: $('.next-popular'),
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						infinite: true,
						slidesToShow: 6,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 2,
					},
				},
			],
		});
	}

	$(".woocommerce-tabs").prependTo(".single-product .woo-container .related.products");

	$("#order_review_heading").prependTo("#order_review");

});
