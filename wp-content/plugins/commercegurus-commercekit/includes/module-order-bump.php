<?php
/**
 *
 * Order Bump module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Checkout order bump.
 */
function commercekit_checkout_order_bump() {
	$product_ids = array();
	$categories  = array();
	foreach ( WC()->cart->get_cart() as $item ) {
		$product_ids[] = (int) $item['data']->get_id();
		$terms         = get_the_terms( $item['data']->get_id(), 'product_cat' );
		if ( is_array( $terms ) && count( $terms ) ) {
			foreach ( $terms as $term ) {
				$categories[] = $term->term_id;
			}
		}
	}

	$options = get_option( 'commercekit', array() );
	$obp     = isset( $options['obp'] ) ? $options['obp'] : array();
	$title   = '';
	$btext   = esc_html__( 'Click to add', 'commercegurus-commercekit' );
	$badded  = esc_html__( 'Added!', 'commercegurus-commercekit' );
	$pid     = 0;

	$enable_order_bump = isset( $options['order_bump'] ) && 1 === (int) $options['order_bump'] ? 1 : 0;
	if ( ! $enable_order_bump ) {
		return;
	}

	if ( isset( $obp['pdt']['tt'] ) && count( $obp['pdt']['tt'] ) > 0 ) {
		foreach ( $obp['pdt']['tt'] as $k => $tt ) {
			if ( empty( $tt ) ) {
				continue;
			}
			if ( isset( $obp['pdt']['at'][ $k ] ) && 1 === (int) $obp['pdt']['at'][ $k ] ) {
				$can_display = false;
				$condition   = isset( $obp['pdt']['cnd'][ $k ] ) ? $obp['pdt']['cnd'][ $k ] : 'all';
				$pids        = isset( $obp['pdt']['pids'][ $k ] ) ? explode( ',', $obp['pdt']['pids'][ $k ] ) : array();
				$pid         = isset( $obp['pdt']['id'][ $k ] ) ? (int) $obp['pdt']['id'][ $k ] : 0;
				$btext       = isset( $obp['pdt']['bt'][ $k ] ) ? $obp['pdt']['bt'][ $k ] : 'Click to add';
				$badded      = isset( $obp['pdt']['ba'][ $k ] ) ? $obp['pdt']['ba'][ $k ] : 'Added!';

				if ( 'all' === $condition ) {
					$can_display = true;
				} elseif ( 'products' === $condition ) {
					if ( count( array_intersect( $product_ids, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'non-products' === $condition ) {
					if ( ! count( array_intersect( $product_ids, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'categories' === $condition ) {
					if ( count( array_intersect( $categories, $pids ) ) ) {
						$can_display = true;
					}
				} elseif ( 'non-categories' === $condition ) {
					if ( ! count( array_intersect( $categories, $pids ) ) ) {
						$can_display = true;
					}
				}

				if ( $can_display && $pid && ! in_array( $pid, $product_ids, true ) ) {
					$title      = $tt;
					$product_id = $pid;
					$product    = wc_get_product( $pid );
					if ( $product ) {
						$image = '';
						if ( has_post_thumbnail( $product_id ) ) {
							$image = get_the_post_thumbnail( $product_id, 'thumbnail' );
						} elseif ( $product->is_type( 'variation' ) ) {
							$parent_id = $product->get_parent_id();
							if ( has_post_thumbnail( $parent_id ) ) {
								$image = get_the_post_thumbnail( $parent_id, 'thumbnail' );
							}
						}
						if ( $product->has_child() ) {
							$children_ids = $product->get_children();
							$product_id   = reset( $children_ids );
							if ( in_array( (int) $product_id, $product_ids, true ) ) {
								return;
							}
						}

						?>
<div class="commercekit-order-bump">
	<div class="ckobp-title"><?php echo esc_html( $title ); ?></div>
	<div class="ckobp-wrapper">
	<div class="ckobp-item">
	<div class="ckobp-image"><?php commercekit_module_output( $image ); ?></div>
	<div class="ckobp-product">
		<div class="ckobp-name"><?php echo esc_html( get_the_title( $product_id ) ); ?></div>
		<div class="ckobp-price"><?php commercekit_module_output( $product->get_price_html() ); ?></div>
	</div>
	</div>
	<div class="ckobp-actions">
		<div class="ckobp-button"><button type="button" onclick="commercekitOrderBumpAdd(<?php echo esc_html( $product_id ); ?>, this);"><?php echo esc_html( $btext ); ?></button></div>
		<div class="ckobp-added" style="display:none;"><button type="button"><?php echo esc_html( $badded ); ?></button></div>
	</div>
	</div>
</div>
<style>
.commercekit-order-bump { border: 1px solid #e2e2e2; box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.06); padding: 20px; margin: 25px 0; border-radius: 4px; }
.commercekit-order-bump .ckobp-title { width: 100%; padding-bottom: 15px; font-weight: 600; font-size: 16px; line-height: 1.4; color: #111; }
.commercekit-order-bump .ckobp-wrapper { display: flex; justify-content: space-between; }
.commercekit-order-bump .ckobp-item { display: flex; }
.commercekit-order-bump .ckobp-actions { display: flex; flex-shrink: 0; }
.commercekit-order-bump .ckobp-image { width: 50px; flex-shrink: 0; }
.commercekit-order-bump .ckobp-image img:nth-child(2n) { display: none; }
.commercekit-order-bump .ckobp-product { margin: 0 15px; }
.commercekit-order-bump .ckobp-name { color: #111; font-size: 15px; line-height: 1.4; }
.commercekit-order-bump .ckobp-price { font-size: 14px; }
.commercekit-order-bump .ckobp-price, .commercekit-order-bump .ckobp-price ins { color: #DE9915; }
.commercekit-order-bump .ckobp-price del { margin-right: 5px; color: #999; font-weight: normal; }
.commercekit-order-bump .ckobp-actions button { padding: 6px 12px; font-size: 14px; font-weight: 600; color: #111; border: 1px solid #e2e2e2; background: linear-gradient(180deg, white, #eee 130%) no-repeat; border-radius: 4px; transition: 0.2s all; }
.commercekit-order-bump .ckobp-actions button:hover { border-color: #ccc; }
</style>
<script>
function commercekitOrderBumpAdd(product_id, obj){
	obj.setAttribute('disabled', 'disabled');
	var formData = new FormData();
	formData.append('product_id', product_id);
	fetch( commercekit_ajs.ajax_url + '?action=commercekit_order_bump_add', {
		method: 'POST',
		body: formData,
	}).then(response => response.json()).then( json => {
		obj.removeAttribute('disabled');
		var ucheckout = new Event('update_checkout');
		document.body.dispatchEvent(ucheckout);
	});
}
</script>
						<?php

						break;
					}
				}
			}
		}
	}
}

add_action( 'woocommerce_review_order_before_submit', 'commercekit_checkout_order_bump', 99 );

/**
 * Ajax order bump add.
 */
function commercekit_ajax_order_bump_add() {
	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on adding to cart.', 'commercegurus-commercekit' );

	$nonce       = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$product_id  = isset( $_POST['product_id'] ) ? (int) sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$product_ids = array();
	foreach ( WC()->cart->get_cart() as $item ) {
		$product_ids[] = (int) $item['data']->get_id();
	}
	if ( ! in_array( $product_id, $product_ids, true ) ) {
		$variation_id = 0;
		if ( 'product_variation' === get_post_type( $product_id ) ) {
			$variation_id = $product_id;
			$product_id   = wp_get_post_parent_id( $variation_id );
		}
		if ( WC()->cart->add_to_cart( $product_id, 1, $variation_id ) ) {
			$ajax['status']  = 1;
			$ajax['message'] = esc_html__( 'Sucessfully added to cart.', 'commercegurus-commercekit' );
		}
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_order_bump_add', 'commercekit_ajax_order_bump_add' );
add_action( 'wp_ajax_nopriv_commercekit_order_bump_add', 'commercekit_ajax_order_bump_add' );
