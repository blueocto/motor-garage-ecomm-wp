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

	// Disable brands that are not relevant for the search of a model
	if($(".brands_array").val()) {
		var brands = $.parseJSON($(".brands_array").val());
		$("#woof_tax_select_pwb-brand > option").each(function() {
			if($.inArray($(this).val(), brands) == -1){
				$(this).attr("disabled", "disabled");
				$(this).css("display", "none");
			}
		});
	}
	if($("input[name=woof_t_pwb-brand]").val()){
		$("#woof_tax_select_pwb-brand > option").each(function() {
			if($(this).attr('disabled')){
				$(this).css("display", "none");
			}
		});
	}

	// Disable vechinle types that do not match search of a model
	if($("input[name=model]").val()) {
		var currentSearchModel = $("input[name=model]").val();
		$("#woof_tax_select_product_cat > option").each(function() {
			if(this.value == currentSearchModel){
				$(this).attr("selected", "selected");
			} else {
				$(this).attr("disabled", "disabled");
				$(this).css("display", "none");
			}
		});
	}
	if($("input[name=woof_t_product_cat]").val()){
		$("#woof_tax_select_product_cat > option").each(function() {
			if($(this).attr('disabled')){
				$(this).css("display", "none");
			}
		});
	}

	// Disable tags that are not relevant for the search of a model
	if($(".tags_array").val()) {
		var tags = $.parseJSON($(".tags_array").val());
		$("#woof_tax_select_product_tag > option").each(function() {
			if($.inArray($(this).val(), tags) == -1){
				$(this).attr("disabled", "disabled");
				$(this).css("display", "none");
			}
		});
	}
	if($("input[name=woof_t_product_tag]").val()){
		$("#woof_tax_select_product_tag > option").each(function() {
			if($(this).attr('disabled')){
				$(this).css("display", "none");
			}
		});
	}

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

	$("#order_review_heading").prependTo("#order_review");

});
