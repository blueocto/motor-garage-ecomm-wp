<?php
/**
 *
 * Inventory Bar module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Single Product Page - Inventory Bar creation
 *
 * @param  string $display_text of inventory bar.
 */
function commercekit_inventory_number( $display_text ) {
	global $post, $product;
	$commercekit_stock_quantity = $product->get_stock_quantity();
	if ( $commercekit_stock_quantity > 30 && $commercekit_stock_quantity <= 40 ) {
		$commercekit_stock_quantity = 40;
	} elseif ( $commercekit_stock_quantity > 40 && $commercekit_stock_quantity <= 50 ) {
		$commercekit_stock_quantity = 50;
	} elseif ( $commercekit_stock_quantity > 50 && $commercekit_stock_quantity <= 60 ) {
		$commercekit_stock_quantity = 60;
	} elseif ( $commercekit_stock_quantity > 60 && $commercekit_stock_quantity <= 70 ) {
		$commercekit_stock_quantity = 70;
	} elseif ( $commercekit_stock_quantity > 70 && $commercekit_stock_quantity <= 80 ) {
		$commercekit_stock_quantity = 80;
	} elseif ( $commercekit_stock_quantity > 80 && $commercekit_stock_quantity <= 90 ) {
		$commercekit_stock_quantity = 90;
	} elseif ( $commercekit_stock_quantity > 90 && $commercekit_stock_quantity <= 100 ) {
		$commercekit_stock_quantity = 100;
	}

	if ( $commercekit_stock_quantity ) {
		?>
<div class="commercekit-inventory"><span class="title"><?php echo esc_html( sprintf( $display_text, $commercekit_stock_quantity ) ); ?></span><div class="progress-bar full-bar"><span></span></div></div>
<style>
.commercekit-inventory { display: inline-block; width: 45%; margin-bottom: 15px; vertical-align: top; line-height: 1.25; }
.commercekit-inventory span { font-size: 15px; }
.commercekit-inventory .progress-bar { float: none; position: relative; width: 100%; height: 10px; margin-top: 10px; padding: 0; border-radius: 5px; background-color: #e2e2e2; transition: all 0.4s ease; }
.commercekit-inventory .progress-bar span { position: absolute; top: 0; left: auto; width: 28%; height: 100%; border-radius: inherit; background: #f5b64c; transition: width 3s ease; }
.commercekit-inventory .progress-bar.full-bar span { width: 100%; }
@media (max-width: 500px) { .commercekit-inventory { display: block; width: 100%; border: none; } }
</style>
<script>
function isInCKITViewport(element){
	var rect = element.getBoundingClientRect();
	return (
		rect.top >= 0 &&
		rect.left >= 0 &&
		rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
		rect.right <= (window.innerWidth || document.documentElement.clientWidth)
	);
}
function animateInventoryBar(){
	if( isInCKITViewport(document.querySelector('.commercekit-inventory .progress-bar') ) ) {
		var y = setInterval(function() {
			document.querySelector('.commercekit-inventory .progress-bar').classList.remove('full-bar');
		}, 100);
	}
}
document.addEventListener("DOMContentLoaded", function(){
	if( document.querySelector('.commercekit-inventory') ){
		animateInventoryBar();
		window.onresize = animateInventoryBar;
		window.onscroll = animateInventoryBar;
	}
});
</script>
		<?php
	}
}

/**
 * Single Product Page - Display Inventory Bar
 */
function commercekit_display_inventory_counter() {
	global $product;
	$commercekit_inventory_display = false;
	$commercekit_stock_quantity    = $product->get_stock_quantity();
	$commercekit_options           = get_option( 'commercekit', array() );
	if ( isset( $commercekit_options['inventory_display'] ) && 1 === (int) $commercekit_options['inventory_display'] ) {
		$commercekit_inventory_display = true;
	}
	/* translators: %s: stock counter. */
	$display_text = isset( $commercekit_options['inventory_text'] ) && ! empty( $commercekit_options['inventory_text'] ) ? $commercekit_options['inventory_text'] : esc_html__( 'Only %s items left in stock!', 'commercegurus-commercekit' );
	if ( $commercekit_stock_quantity > 30 && $commercekit_stock_quantity <= 100 ) {
		/* translators: %s: stock counter. */
		$display_text = isset( $commercekit_options['inventory_text_30'] ) && ! empty( $commercekit_options['inventory_text_30'] ) ? $commercekit_options['inventory_text_30'] : esc_html__( 'Less than %s items left!', 'commercegurus-commercekit' );
	}
	if ( $commercekit_stock_quantity > 100 ) {
		$display_text = isset( $commercekit_options['inventory_text_100'] ) && ! empty( $commercekit_options['inventory_text_100'] ) ? $commercekit_options['inventory_text_100'] : esc_html__( 'This item is selling fast!', 'commercegurus-commercekit' );
	}

	if ( true === $commercekit_inventory_display ) {
		if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) {
			commercekit_inventory_number( $display_text );
		}
	}
}

add_action( 'woocommerce_single_product_summary', 'commercekit_display_inventory_counter', 40 );
