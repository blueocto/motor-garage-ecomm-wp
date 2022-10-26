/* Start custom jQuery... */
jQuery(document).ready(function ($) {

	$.ajaxSetup({ cache: false });
	
    // wrap a container around the Title and Description on a Taxonomy/shop category page
    $( ".woocommerce-products-header .page-title, .woocommerce-products-header .term-description, .woocommerce-products-header .page-description" ).wrapAll( "<div class='taxonomy-head-wrap'/>" );

    // wrap a container around the single product entry-summary and tabs
    $(".entry-summary, .woocommerce-tabs").wrapAll('<div class="single-product-description"></div>');

	$(".manufacturer").change(function(){
		var selectedCatID = $(this).find(':selected').data('catid');
		$("select.model").empty().append("<option value=\"\">--Model--</option>");
		$.ajax({
            type: "GET",
            url: "/car-models/models.json",
            dataType: "json",
            beforeSend: function() {
            },
            success: function(json){
				$.each(json, function(i,item){
					if(selectedCatID == item.parent){
						$("select.model").append("<option value=\""+item.slug+"\">"+item.name+"</option>");
					}
				});
            },
            complete: function(){

            },
            error: function() {
                console.log("An error occurred while processing JSON file.");
            }
        });
	});

	var currentSearchModel = $(".model_search").val();
	$("#woof_tax_select_product_cat > option").each(function() {
		if(this.value == currentSearchModel){
			$(this).attr("selected", "selected");
		} else {
			$(this).attr("disabled", "disabled");
		}
	});

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
					breakpoint: 1200,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 640,
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
					breakpoint: 1200,
					settings: {
						infinite: true,
						slidesToShow: 4,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 1024,
					settings: {
						infinite: true,
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 640,
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
