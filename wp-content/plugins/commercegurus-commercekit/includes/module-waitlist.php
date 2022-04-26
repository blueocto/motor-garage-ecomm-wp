<?php
/**
 *
 * Waitlist module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Ajax save waitlist
 */
function commercekit_ajax_save_waitlist() {
	global $wpdb;
	$commercekit_options = get_option( 'commercekit', array() );

	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on submitting for waiting list.', 'commercegurus-commercekit' );

	$table  = $wpdb->prefix . 'commercekit_waitlist';
	$nonce  = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$email  = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$pid    = isset( $_POST['product_id'] ) ? sanitize_text_field( wp_unslash( $_POST['product_id'] ) ) : 0;
	$data   = array(
		'email'      => $email,
		'product_id' => $pid,
		'created'    => time(),
	);
	$format = array( '%s', '%d', '%d' );
	if ( $email && $pid ) {
		$wpdb->insert( $table, $data, $format ); // db call ok; no-cache ok.
		$ajax['status']  = 1;
		$ajax['message'] = isset( $commercekit_options['ajs_success_text'] ) && ! empty( $commercekit_options['ajs_success_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_success_text'] ) ) : esc_html__( 'You have been added to the waiting list for this product!', 'commercegurus-commercekit' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_save_waitlist', 'commercekit_ajax_save_waitlist' );
add_action( 'wp_ajax_nopriv_commercekit_save_waitlist', 'commercekit_ajax_save_waitlist' );

/**
 * Waitlist form
 */
function commercekit_waitlist_form() {
	global $post;
	$commercekit_options = get_option( 'commercekit', array() );
	$enable_wishlist     = isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 1 : 0;
	if ( ! $enable_wishlist ) {
		return;
	}
	if ( 'product' === get_post_type( $post->ID ) && is_product() ) {
		$product = wc_get_product( $post->ID );
		if ( ! $product ) {
			return;
		}
		add_filter( 'woocommerce_get_stock_html', 'commercekit_waitlist_output_form', 30, 2 );
	}
}
add_action( 'woocommerce_before_single_product', 'commercekit_waitlist_form' );
add_action( 'woocommerce_after_single_product', 'commercekit_waitlist_output_form_script' );

/**
 * Waitlist output form
 *
 * @param string $html of output.
 * @param object $product of output.
 */
function commercekit_waitlist_output_form( $html, $product ) {
	global $can_show_waitlist_form;
	$commercekit_options = get_option( 'commercekit', array() );

	$intro   = isset( $commercekit_options['wtl_intro'] ) && ! empty( $commercekit_options['wtl_intro'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_intro'] ) ) : esc_html__( 'Notify me when the item is back in stock.', 'commercegurus-commercekit' );
	$pholder = isset( $commercekit_options['wtl_email_text'] ) && ! empty( $commercekit_options['wtl_email_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_email_text'] ) ) : esc_html__( 'Enter your email address...', 'commercegurus-commercekit' );
	$blabel  = isset( $commercekit_options['wtl_button_text'] ) && ! empty( $commercekit_options['wtl_button_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_button_text'] ) ) : esc_html__( 'Join waiting list', 'commercegurus-commercekit' );
	$alabel  = isset( $commercekit_options['wtl_consent_text'] ) && ! empty( $commercekit_options['wtl_consent_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_consent_text'] ) ) : esc_html__( 'I consent to being contacted by the store owner', 'commercegurus-commercekit' );

	if ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() ) {
		$can_show_waitlist_form = true;

		$whtml = '
<div class="commercekit-waitlist">
	<p>' . $intro . '</p>
	<input type="email" id="ckwtl-email" name="ckwtl_email" placeholder="' . $pholder . '" />
	<label><input type="checkbox" id="ckwtl-consent" name="ckwtl_consent" value="1" checked="checked" />&nbsp;&nbsp;' . $alabel . '</label>
	<input type="button" id="ckwtl-button" name="ckwtl_button" value="' . $blabel . '" disabled="disabled" onclick="submitCKITWaitlist();" />
	<input type="hidden" id="ckwtl-pid" name="ckwtl_pid" value="' . $product->get_id() . '" />
</div>';

		$html .= $whtml;
	}

	return $html;
}

/**
 * Waitlist output form script
 */
function commercekit_waitlist_output_form_script() {
	global $can_show_waitlist_form;
	if ( isset( $can_show_waitlist_form ) && true === $can_show_waitlist_form ) {
		?>
<style>
.commercekit-waitlist { margin: 30px 0px; padding: 25px; background-color: #fff; border: 1px solid #eee; box-shadow: 0 3px 15px -5px rgba(0, 0, 0, 0.08); }
.commercekit-waitlist p { font-weight: 600; margin-bottom: 10px; width: 100%; font-size: 16px; }
.commercekit-waitlist p.error { color: #F00; margin-bottom: 0; }
.commercekit-waitlist p.success { color: #009245; margin-bottom: 0; }
.commercekit-waitlist #ckwtl-email { width: 100%; background: #fff; margin-bottom: 10px; }
.commercekit-waitlist #ckwtl-email.error { border: 1px solid #F00; }
.commercekit-waitlist label { width: 100%; margin-bottom: 10px; font-size: 14px; display: block; }
.commercekit-waitlist label.error { color: #F00; }
.commercekit-waitlist label input { transform: scale(1.1); top: 2px; }
.commercekit-waitlist #ckwtl-button { width: 100%; margin-top: 5px; text-align: center; border-radius: 3px; transition: 0.2s all; }
.commercekit-waitlist #ckwtl-button { width: 100%; text-align: center; }
</style>
<script>
function validateCKITWaitlistForm(){
	var email = document.querySelector('#ckwtl-email');
	var consent = document.querySelector('#ckwtl-consent');
	var button = document.querySelector('#ckwtl-button');
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var error = false;
	if( !regex.test(email.value) ){
		email.classList.add('error');
		error = true;
	} else {
		email.classList.remove('error');
	}
	if( !consent.checked ){
		consent.parentNode.classList.add('error');
		error = true;
	} else {
		consent.parentNode.classList.remove('error');
	}
	if( !error ){
		button.removeAttribute('disabled');
	} else {
		button.setAttribute('disabled', 'disabled');
	}
}
function submitCKITWaitlist(){
	var pid = document.querySelector('#ckwtl-pid').value;
	var email = document.querySelector('#ckwtl-email').value;
	var button = document.querySelector('#ckwtl-button');
	var container = document.querySelector('.commercekit-waitlist');
	button.setAttribute('disabled', 'disabled');
	var formData = new FormData();
	formData.append('product_id', pid);
	formData.append('email', email);
	fetch( commercekit_ajs.ajax_url + '?action=commercekit_save_waitlist', {
		method: 'POST',
		body: formData,
	}).then(response => response.json()).then( json => {
		if( json.status == 1 ){
			container.innerHTML = '<p class="success">'+json.message+'</p>';
		} else {
			container.innerHTML = '<p class="error">'+json.message+'</p>';
		}
	});
}
document.addEventListener("DOMContentLoaded", function(){
	document.addEventListener('change', function(e){
		if( e.target && ( e.target.id == 'ckwtl-email' || e.target.id == 'ckwtl-consent' ) ){
			validateCKITWaitlistForm();
		}
	});
});
</script>
		<?php
	}
}
