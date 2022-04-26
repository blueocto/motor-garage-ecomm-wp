<?php
/**
 *
 * Countdown Timer module
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Display Countdown timer template
 *
 * @param  string $title of countdown timer.
 * @param  string $timer hours, minutes and seconds.
 * @param  string $mode of countdown timer.
 * @param  string $restart of countdown timer when complete.
 * @param  string $session of countdown timer for restart.
 * @param  string $location of countdown timer, either product page or checkout page.
 * @param  string $message of countdown timer for display after complete.
 */
function commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message ) {
	$class     = 'product';
	$day_labal = esc_html__( 'DAYS', 'commercegurus-commercekit' );
	$hrs_labal = esc_html__( 'HRS', 'commercegurus-commercekit' );
	$min_labal = esc_html__( 'MINS', 'commercegurus-commercekit' );
	$sec_labal = esc_html__( 'SECS', 'commercegurus-commercekit' );
	if ( 'product' !== $location ) {
		$class     = 'non-product ' . $location;
		$day_labal = esc_html__( 'days', 'commercegurus-commercekit' );
		$hrs_labal = esc_html__( 'hours', 'commercegurus-commercekit' );
		$min_labal = esc_html__( 'minutes', 'commercegurus-commercekit' );
		$sec_labal = esc_html__( 'seconds', 'commercegurus-commercekit' );
	}

	if ( isset( $timer['dl'] ) && ! empty( $timer['dl'] ) ) {
		$day_labal = $timer['dl'];
	}
	if ( isset( $timer['hl'] ) && ! empty( $timer['hl'] ) ) {
		$hrs_labal = $timer['hl'];
	}
	if ( isset( $timer['ml'] ) && ! empty( $timer['ml'] ) ) {
		$min_labal = $timer['ml'];
	}
	if ( isset( $timer['sl'] ) && ! empty( $timer['sl'] ) ) {
		$sec_labal = $timer['sl'];
	}
	?>
<div id="commercekit-timer" class="<?php echo esc_html( $class ); ?>" data-timer="<?php echo esc_html( $timer['total'] ); ?>" data-mode="<?php echo esc_html( $mode ); ?>" data-restart="<?php echo esc_html( $restart ); ?>" data-key="<?php echo esc_html( $session ); ?>" data-location="<?php echo esc_html( $location ); ?>" style="display:none;">
	<div class="commercekit-timer-title"><?php echo esc_html( stripslashes_deep( $title ) ); ?></div>
	<div class="commercekit-timer-blocks">
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="days"><?php echo esc_html( $timer['d'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $day_labal ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="hours"><?php echo esc_html( $timer['h'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $hrs_labal ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="minutes"><?php echo esc_html( $timer['m'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $min_labal ); ?></div>
		</div>
		<div class="commercekit-timer-sep">:</div>
		<div class="commercekit-timer-block">
			<div class="commercekit-timer-digit" id="seconds"><?php echo esc_html( $timer['s'] ); ?></div>
			<div class="commercekit-timer-label"><?php echo esc_html( $sec_labal ); ?></div>
		</div>
	</div>
</div>
<div id="commercekit-timer-message" class="<?php echo esc_html( $class ); ?>" style="display:none;"><?php echo esc_html( stripslashes_deep( $message ) ); ?></div>
<style>
#commercekit-timer.product { width: 50%; float: left; margin-right: 3%; margin-bottom: 10px;}
#commercekit-timer.product.has-cg-inventory { border-right: 1px solid #e2e2e2; }
#commercekit-timer.product .commercekit-timer-title { width: 100%; font-size: 15px; margin-bottom: 2px; }
#commercekit-timer.product .commercekit-timer-blocks { display: flex; white-space: nowrap; }
#commercekit-timer.product .commercekit-timer-block, #commercekit-timer.product .commercekit-timer-sep { display: inline-block; vertical-align: top; text-align: center; }
#commercekit-timer.product .commercekit-timer-digit, #commercekit-timer.product .commercekit-timer-sep { font-size: 22px; line-height: 26px; margin: 0px 2px; }
#commercekit-timer.product .commercekit-timer-label { font-size: 13px; color: #999; margin-bottom: -5px;}
#commercekit-timer-message.product { width: 50%; float: left; }
#commercekit-timer.non-product, #commercekit-timer-message.non-product { width: 100%; padding: 10px; background: #f8f6db; border: 1px solid #dfda9e; border-radius: 4px; text-align: center; font-size: 14px; color: #111; font-weight: 600; clear: both; margin-top: 20px; }
#commercekit-timer.non-product .commercekit-timer-title, #commercekit-timer.non-product .commercekit-timer-blocks, #commercekit-timer.non-product .commercekit-timer-block, #commercekit-timer.non-product .commercekit-timer-sep, #commercekit-timer.non-product .commercekit-timer-digit, #commercekit-timer.non-product .commercekit-timer-label { display: inline-flex; }
#commercekit-timer.non-product { display: flex; justify-content: center; }
#commercekit-timer.non-product .commercekit-timer-sep { display: none; }
#commercekit-timer.non-product .commercekit-timer-digit { margin-left: 5px; }
#commercekit-timer.non-product .commercekit-timer-label { margin-left: 3px; }
@media (max-width: 500px) { #commercekit-timer.product { display: block; width: 100%; float: none; } }
</style>
<script>
function setCKITCookie(cname, cvalue, exdays){
	var d = new Date();
	d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
	var expires = "expires=" + d.toGMTString() + "; ";
	if( ! exdays ) expires = "";
	document.cookie = cname + "=" + cvalue + "; " + expires + "path=/";
} 
function getCKITCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i].trim();
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return "";
}
document.addEventListener("DOMContentLoaded", function(){
	if( document.querySelector('#commercekit-timer') ){
		$this =  document.querySelector('#commercekit-timer');
		var timer = $this.getAttribute('data-timer');
		var mode = $this.getAttribute('data-mode');
		var restart = $this.getAttribute('data-restart');
		var key = $this.getAttribute('data-key');
		var location = $this.getAttribute('data-location');
		if( document.querySelector('.commercekit-inventory') ){
			$this.classList.add('has-cg-inventory');
		} 

		var otimer = timer;
		var ntimer = getCKITCookie(key);
		if( ntimer != '' ) timer = ntimer;

		var time = new Date().getTime();
		var countDownDate = time + ( timer * 1000 );

		var x = setInterval(function() {
			var now = new Date().getTime();
			var distance = countDownDate - now;

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			if( days <= 0 ) days = 0;
			if( hours <= 0 ) hours = 0;
			if( minutes <= 0 ) minutes = 0;
			if( seconds <= 0 ) seconds = 0;

			if( location != 'product' ){
				if( days <= 0 ) 
					document.querySelector('#days').parentNode.style.display = 'none';
				else
					document.querySelector('#days').parentNode.style.display = 'inline-flex';
				if( hours <= 0 ) 
					document.querySelector('#hours').parentNode.style.display = 'none';
				else
					document.querySelector('#hours').parentNode.style.display = 'inline-flex';
				if( minutes <= 0 )
					document.querySelector('#minutes').parentNode.style.display = 'none';
				else
					document.querySelector('#minutes').parentNode.style.display = 'inline-flex';
			}

			var ctimer = days * 60 * 60 * 24;
			ctimer = ctimer + ( hours * 60 * 60 );
			ctimer = ctimer + ( minutes * 60 );
			ctimer = ctimer + seconds;
			if( location != 'product' ){
				setCKITCookie(key, ctimer, 0);
			} else {
				setCKITCookie(key, ctimer, 30);
			}

			days = ("00"+days).slice(-2);
			hours = ("00"+hours).slice(-2);
			if( location == 'product' ){
				minutes = ("00"+minutes).slice(-2);
			}
			seconds = ("00"+seconds).slice(-2);

			document.querySelector('#days').innerHTML = days;
			document.querySelector('#hours').innerHTML = hours;
			document.querySelector('#minutes').innerHTML = minutes;
			document.querySelector('#seconds').innerHTML = seconds;

			if( location != 'product' ){
				document.querySelector('#commercekit-timer').style.display = 'flex';
			} else {
				document.querySelector('#commercekit-timer').style.display = 'inline';
			}

			if (ctimer <= 0) {
				if( mode == 'regular' || ( mode != 'regular' && restart == 'none' ) ){
					clearInterval(x);
					if( location != 'product' ){
						document.querySelector('#commercekit-timer').style.display = 'none';
						document.querySelector('#commercekit-timer-message').style.display = 'inline-block';
					}
				} else {
					if( restart == 'immediate' ){
						var ntime = new Date().getTime();
						countDownDate = ntime + ( otimer * 1000 );
					} else {
						clearInterval(x);
						if( location != 'product' ){
							document.querySelector('#commercekit-timer').style.display = 'none';
							document.querySelector('#commercekit-timer-message').style.display = 'inline-block';
							setCKITCookie(key, otimer, 0);
						} else {
							setCKITCookie(key, otimer, 30);
						}
					}
				}
			}
		}, 1000);
	}
});
</script>
	<?php
}

/**
 * Get timer by location
 *
 * @param  string $location of countdown timer for display.
 * @return string
 */
function commercekit_countdown_timer_by_location( $location ) {

	if ( 'product' === $location ) {
		global $product;
		if ( $product->managing_stock() && 0 === (int) $product->get_stock_quantity() ) {
			return;
		}

		$categories = array();
		$terms      = get_the_terms( $product->get_id(), 'product_cat' );
		if ( count( $terms ) ) {
			foreach ( $terms as $term ) {
				$categories[] = $term->term_id;
			}
		}
	}

	$commercekit_options = get_option( 'commercekit', array() );
	$ctd                 = isset( $commercekit_options['ctd'] ) ? $commercekit_options['ctd'] : array();
	$enable_ctd_timer    = isset( $commercekit_options['countdown_timer'] ) && 1 === (int) $commercekit_options['countdown_timer'] ? 1 : 0;
	if ( ! $enable_ctd_timer ) {
		return;
	}

	$title          = '';
	$timer          = array();
	$timer['total'] = 0;
	$mode           = 'regular';
	$restart        = 'none';
	$message        = '';

	if ( 'checkout' === $location ) {
		if ( isset( $ctd['ckt']['at'] ) && 1 === (int) $ctd['ckt']['at'] ) {
			$title           = $ctd['ckt']['tt'];
			$message         = $ctd['ckt']['em'];
			$timer['total']  = ( (int) $ctd['ckt']['m'] ) * 60;
			$timer['total'] += (int) $ctd['ckt']['s'];
			$timer['d']      = 0;
			$timer['h']      = 0;
			$timer['m']      = (int) $ctd['ckt']['m'];
			$timer['s']      = (int) $ctd['ckt']['s'];
		} else {
			return;
		}
	}

	if ( 'product' === $location ) {
		if ( isset( $ctd['pdt']['tt'] ) && count( $ctd['pdt']['tt'] ) > 0 ) {
			foreach ( $ctd['pdt']['tt'] as $k => $tt ) {
				if ( empty( $tt ) ) {
					continue;
				}
				if ( isset( $ctd['pdt']['at'][ $k ] ) && 1 === (int) $ctd['pdt']['at'][ $k ] ) {
					$can_display = false;
					$condition   = isset( $ctd['pdt']['cnd'][ $k ] ) ? $ctd['pdt']['cnd'][ $k ] : 'all';
					$pids        = isset( $ctd['pdt']['pids'][ $k ] ) ? explode( ',', $ctd['pdt']['pids'][ $k ] ) : array();
					$product_id  = (string) $product->get_id();
					if ( 'all' === $condition ) {
						$can_display = true;
					} elseif ( 'products' === $condition ) {
						if ( in_array( $product_id, $pids, true ) ) {
							$can_display = true;
						}
					} elseif ( 'non-products' === $condition ) {
						if ( ! in_array( $product_id, $pids, true ) ) {
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

					if ( $can_display ) {
						$title   = $tt;
						$restart = 'none';
						$mode    = 1 === (int) $ctd['pdt']['tp'][ $k ] ? 'evergreen' : 'regular';
						if ( 'evergreen' === $mode ) {
							$restart = 'nextvisit';
						}
						$timer['total']  = ( (int) $ctd['pdt']['d'][ $k ] ) * 60 * 60 * 24;
						$timer['total'] += ( (int) $ctd['pdt']['h'][ $k ] ) * 60 * 60;
						$timer['total'] += ( (int) $ctd['pdt']['m'][ $k ] ) * 60;
						$timer['total'] += (int) $ctd['pdt']['s'][ $k ];
						$timer['d']      = (int) $ctd['pdt']['d'][ $k ];
						$timer['h']      = (int) $ctd['pdt']['h'][ $k ];
						$timer['m']      = (int) $ctd['pdt']['m'][ $k ];
						$timer['s']      = (int) $ctd['pdt']['s'][ $k ];
						$timer['dl']     = $ctd['pdt']['dl'][ $k ];
						$timer['hl']     = $ctd['pdt']['hl'][ $k ];
						$timer['ml']     = $ctd['pdt']['ml'][ $k ];
						$timer['sl']     = $ctd['pdt']['sl'][ $k ];

						break;
					}
				}
			}
		}
	}

	if ( $timer['total'] ) {
		$session = 'ckit_' . md5( $timer['total'] . '-' . $mode );
		if ( 'product' === $location ) {
			if ( $product->is_type( 'simple' ) || $product->is_type( 'variable' ) ) {
				commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message );
			}
		} else {
			commercekit_countdown_timer_template( $title, $timer, $mode, $restart, $session, $location, $message );
		}
	}
}

/**
 * Single Product Page - Display Countdown timer
 */
function commercekit_product_countdown_timer() {
	commercekit_countdown_timer_by_location( 'product' );
}

add_action( 'woocommerce_single_product_summary', 'commercekit_product_countdown_timer', 39 );

/**
 * Checkout Page - Display Countdown timer
 */
function commercekit_checkout_countdown_timer() {
	commercekit_countdown_timer_by_location( 'checkout' );
}

add_action( 'woocommerce_before_checkout_form', 'commercekit_checkout_countdown_timer', 1 );
