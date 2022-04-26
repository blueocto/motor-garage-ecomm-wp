<?php
/**
 *
 * Admin Settings
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

/**
 * Adding admin settings page
 */
function commercekit_admin_page() {
	add_menu_page(
		'CommerceKit Settings',
		'CommerceKit',
		'manage_options',
		'commercekit',
		'commercekit_admin_page_html'
	);
}
add_action( 'admin_menu', 'commercekit_admin_page' );

/**
 * Adding admin setting page update
 */
function commercekit_admin_page_update() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return false;
	}

	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	if ( ! $commercekit_nonce || ! wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' ) ) {
		return false;
	}

	$tab = isset( $_REQUEST['tab'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['tab'] ) ) : 'dashboard';
	if ( isset( $_POST['commercekit'] ) ) {
		$commercekit_options = get_option( 'commercekit', array() );
		if ( 'dashboard' === $tab ) {
			if ( ! isset( $_POST['commercekit']['countdown_timer'] ) ) {
				$_POST['commercekit']['countdown_timer'] = 0;

				$ctd = isset( $commercekit_options['ctd'] ) ? $commercekit_options['ctd'] : array();

				$_POST['commercekit']['ctd'] = $ctd;
				if ( isset( $ctd['pdt']['at'] ) && count( $ctd['pdt']['at'] ) > 0 ) {
					foreach ( $ctd['pdt']['at'] as $k => $v ) {
						$_POST['commercekit']['ctd']['pdt']['at'][ $k ] = 0;
					}
				}
				$_POST['commercekit']['ctd']['ckt']['at'] = 0;
			} else {
				$ctd = isset( $commercekit_options['ctd'] ) ? $commercekit_options['ctd'] : array();

				$_POST['commercekit']['ctd'] = $ctd;
				if ( isset( $ctd['pdt']['at'] ) && count( $ctd['pdt']['at'] ) > 0 ) {
					foreach ( $ctd['pdt']['at'] as $k => $v ) {
						$_POST['commercekit']['ctd']['pdt']['at'][ $k ] = isset( $ctd['pdt']['ato'][ $k ] ) ? $ctd['pdt']['ato'][ $k ] : 0;
					}
				}
				$_POST['commercekit']['ctd']['ckt']['at'] = 1;
			}
			if ( ! isset( $_POST['commercekit']['inventory_display'] ) ) {
				$_POST['commercekit']['inventory_display'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['order_bump'] ) ) {
				$_POST['commercekit']['order_bump'] = 0;

				$obp = isset( $commercekit_options['obp'] ) ? $commercekit_options['obp'] : array();

				$_POST['commercekit']['obp'] = $obp;
				if ( isset( $obp['pdt']['at'] ) && count( $obp['pdt']['at'] ) > 0 ) {
					foreach ( $obp['pdt']['at'] as $k => $v ) {
						$_POST['commercekit']['obp']['pdt']['at'][ $k ] = 0;
					}
				}
			} else {
				$obp = isset( $commercekit_options['obp'] ) ? $commercekit_options['obp'] : array();

				$_POST['commercekit']['obp'] = $obp;
				if ( isset( $obp['pdt']['at'] ) && count( $obp['pdt']['at'] ) > 0 ) {
					foreach ( $obp['pdt']['at'] as $k => $v ) {
						$_POST['commercekit']['obp']['pdt']['at'][ $k ] = isset( $obp['pdt']['ato'][ $k ] ) ? $obp['pdt']['ato'][ $k ] : 0;
					}
				}
			}
			if ( ! isset( $_POST['commercekit']['ajax_search'] ) ) {
				$_POST['commercekit']['ajax_search'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['wishlist'] ) ) {
				$_POST['commercekit']['wishlist'] = 0;
			}
			if ( ! isset( $_POST['commercekit']['waitlist'] ) ) {
				$_POST['commercekit']['waitlist'] = 0;
			}
		}
		if ( 'inventory-bar' === $tab ) {
			if ( ! isset( $_POST['commercekit']['inventory_display'] ) ) {
				$_POST['commercekit']['inventory_display'] = 0;
			}
		}
		if ( 'countdown-timer' === $tab ) {
			if ( ! isset( $_POST['commercekit']['ctd']['ckt']['at'] ) ) {
				$_POST['commercekit']['ctd']['ckt']['at'] = 0;
			}
		}
		if ( 'ajax-search' === $tab ) {
			if ( ! isset( $_POST['commercekit']['ajax_search'] ) ) {
				$_POST['commercekit']['ajax_search'] = 0;
			}
		}
		if ( 'waitlist' === $tab ) {
			$bulk_action = isset( $_POST['bulk_action'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_action'] ) ) : '';
			$bulk_apply  = isset( $_POST['bulk_apply'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_apply'] ) ) : 0;
			if ( 1 === (int) $bulk_apply ) {
				return commercekit_admin_waitlist_bulk_action( $bulk_action );
			}
			if ( ! isset( $_POST['commercekit']['waitlist'] ) ) {
				$_POST['commercekit']['waitlist'] = 0;
			}
		}
		if ( 'wishlist' === $tab ) {
			if ( ! isset( $_POST['commercekit']['wishlist'] ) ) {
				$_POST['commercekit']['wishlist'] = 0;
			}
		}
		if ( 'support' === $tab ) {
			$fname    = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
			$email    = isset( $_POST['email'] ) ? sanitize_text_field( wp_unslash( $_POST['email'] ) ) : '';
			$url      = isset( $_POST['url'] ) ? sanitize_text_field( wp_unslash( $_POST['url'] ) ) : '';
			$title    = isset( $_POST['title'] ) ? sanitize_text_field( wp_unslash( $_POST['title'] ) ) : '';
			$question = isset( $_POST['question'] ) ? sanitize_textarea_field( wp_unslash( $_POST['question'] ) ) : '';
			$width    = isset( $_POST['screen_width'] ) ? sanitize_text_field( wp_unslash( $_POST['screen_width'] ) ) : '';
			$height   = isset( $_POST['screen_height'] ) ? sanitize_text_field( wp_unslash( $_POST['screen_height'] ) ) : '';
			$to_mail  = 'support@commercegurus.com';
			if ( ! empty( $email ) && ! empty( $url ) && ! empty( $title ) && ! empty( $question ) ) {
				global $wp_version, $woocommerce;
				$version       = explode( '.', phpversion() );
				$theme         = wp_get_theme();
				$template      = $theme->get_template();
				$theme_data    = wp_get_theme( 'shoptimizer' );
				$email_headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $email, 'Reply-To: ' . $email );
				$email_subject = $title;
				$email_body    = '
<p>' . nl2br( $question ) . '</p>
<p>&nbsp;</p>
<hr/>
<p>First name: <br />' . $fname . '</p>
<p>URL: <br />' . $url . '</p>
<p>Subscription number: <br />#' . commercekit_get_subscription_number() . '</p>
<p>Shoptimizer version: <br />' . ( isset( $theme_data['Version'] ) && false !== stripos( $theme_data['Name'], 'shoptimizer' ) ? esc_html( $theme_data['Version'] ) : 'Shoptimizer is not active' ) . '</p>
<p>WordPress version: <br />' . esc_html( $wp_version ) . '</p>
<p>WooCommerce version: <br />' . ( isset( $woocommerce->version ) ? esc_html( $woocommerce->version ) : '' ) . '</p>
<p>Using a child theme?<br />' . ( isset( $template ) && false !== stripos( $template, '-child' ) ? 'Yes' : 'No' ) . '</p>
<p>PHP version: <br />' . $version[0] . '.' . $version[1] . '.' . $version[2] . '</p>
<p>OS Platform: <br />' . commercekit_admin_get_os() . '</p>
<p>Browser: <br />' . commercekit_admin_get_browser() . '</p>
<p>Screen Width: <br />' . $width . '</p>
<p>Screen Height: <br />' . $height . '</p>
<p>Site URL: <br />' . home_url( '/' ) . '</p>';

				$success = wp_mail( $to_mail, $email_subject, $email_body, $email_headers );
				if ( $success ) {
					return esc_html__( 'Your email has been sent to our support team.', 'commercegurus-commercekit' );
				} else {
					return esc_html__( 'Error on sending email to support team.', 'commercegurus-commercekit' );
				}
			} else {
				return false;
			}
		}

		$commercekit = map_deep( wp_unslash( $_POST['commercekit'] ), 'sanitize_text_field' );
		foreach ( $commercekit as $key => $value ) {
			$commercekit_options[ $key ] = $value;
		}

		update_option( 'commercekit', $commercekit_options );
	}

	return true;
}

/**
 * Adding admin setting page HTML
 */
function commercekit_admin_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	global $commerce_gurus_commercekit;

	$success = commercekit_admin_page_update();

	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	$verify_nonce      = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$notice            = '';
	$tab               = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'dashboard';
	if ( true === $success ) {
		$notice = esc_html__( 'CommerceKit Settings has been saved.', 'commercegurus-commercekit' );
	} elseif ( false !== $success ) {
		$notice = $success;
	} else {
		$notice = '';
	}
	$commercekit_options = get_option( 'commercekit', array() );
	$domain_connected    = commercekit_is_domain_connected();
	$environment_warning = $commerce_gurus_commercekit->get_environment_warning();
	?>
	<div class="wrap">
		<?php if ( ! empty( $notice ) && 'support' !== $tab ) { ?>
		<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
		<?php } ?>
		<?php if ( ! $environment_warning ) { ?>
		<form action="" method="post" id="commercekit-form" enctype="multipart/form-data" class="form-horizontal">
		<div id="ajax-loading-mask"><div class="ajax-loading"></div></div>
		<h1 style="display: none;">&nbsp;</h1>
		<div class="setting-page-title"><?php echo esc_html( get_admin_page_title() ); ?></div>
		<p class="intro"><?php esc_html_e( 'Conversion-boosting, performance-focused eCommerce features which work together seamlessly. From', 'commercegurus-commercekit' ); ?> <a href="https://www.commercegurus.com/" target="_blank"><?php esc_html_e( 'CommerceGurus', 'commercegurus-commercekit' ); ?></a>.</p>
		<nav class="nav-tab-wrapper" id="settings-tabs">
			<a href="?page=commercekit" data-tab="dashboard" class="nav-tab <?php echo 'dashboard' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Dashboard', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=ajax-search" data-tab="ajax-search" class="nav-tab <?php echo 'ajax-search' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=countdown-timer" data-tab="countdown-timer" class="nav-tab <?php echo 'countdown-timer' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Countdown Timers', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=order-bump" data-tab="order-bump" class="nav-tab <?php echo 'order-bump' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=inventory-bar" data-tab="inventory-bar" class="nav-tab <?php echo 'inventory-bar' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Stock Meter', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=waitlist" data-tab="waitlist" class="nav-tab <?php echo 'waitlist' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></a>
			<a href="?page=commercekit&tab=wishlist" data-tab="wishlist" class="nav-tab <?php echo 'wishlist' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Wishlist', 'commercegurus-commercekit' ); ?></a>
			<?php if ( $domain_connected ) { ?>
				<a href="?page=commercekit&tab=support" data-tab="waitlist" class="nav-tab <?php echo 'support' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Support', 'commercegurus-commercekit' ); ?></a>
			<?php } ?>
		</nav>

		<div class="tab-content">
			<?php
			switch ( $tab ) {
				case 'dashboard':
					require_once dirname( __FILE__ ) . '/admin-dashboard.php';
					break;
				case 'countdown-timer':
					require_once dirname( __FILE__ ) . '/admin-countdown-timer.php';
					break;
				case 'inventory-bar':
					require_once dirname( __FILE__ ) . '/admin-inventory-bar.php';
					break;
				case 'order-bump':
					require_once dirname( __FILE__ ) . '/admin-order-bump.php';
					break;
				case 'ajax-search':
					require_once dirname( __FILE__ ) . '/admin-ajax-search.php';
					break;
				case 'wishlist':
					require_once dirname( __FILE__ ) . '/admin-wishlist.php';
					break;
				case 'waitlist':
					require_once dirname( __FILE__ ) . '/admin-waitlist.php';
					break;
				case 'support':
					if ( $domain_connected ) {
						require_once dirname( __FILE__ ) . '/admin-support.php';
					}
					break;
			}
			?>
		</div>
		<div class="submit-button">
			<input type="hidden" name="commercekit[settings]" value="1" />
			<?php wp_nonce_field( 'commercekit_settings', 'commercekit_nonce' ); ?>
			<?php if ( 'dashboard' !== $tab && 'support' !== $tab ) { ?>
				<input type="submit" name="btn-submit" id="btn-submit" class="button button-primary" value="Save Changes">
			<?php } ?>
		</div>
		</form>
		<?php } ?>
	</div>
	<?php
}

/**
 * Get products or categories IDs
 */
function commercekit_get_pcids() {
	$return            = array();
	$commercekit_nonce = isset( $_POST['commercekit_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['commercekit_nonce'] ) ) : '';
	$verify_nonce      = wp_verify_nonce( $commercekit_nonce, 'commercekit_settings' );
	$type              = isset( $_GET['type'] ) ? sanitize_text_field( wp_unslash( $_GET['type'] ) ) : 'products';
	$tab               = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';
	$mode              = isset( $_GET['mode'] ) ? sanitize_text_field( wp_unslash( $_GET['mode'] ) ) : '';

	if ( 'products' === $type ) {
		if ( 'order-bump' === $tab && 'full' === $mode ) {
			$post_types = array( 'product', 'product_variation' );
		} else {
			$post_types = array( 'product' );
		}
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			's'              => $query,
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'post_type'      => $post_types,
		);
		if ( is_numeric( $query ) ) {
			unset( $args['s'] );
			$args['post__in'] = array( $query );
		}

		$search_results = new WP_Query( $args );

		if ( $search_results->have_posts() ) {
			while ( $search_results->have_posts() ) {
				$search_results->the_post();
				if ( 'product' === $search_results->post->post_type ) {
					$product = wc_get_product( $search_results->post->ID );
					if ( ! $product || ( ! $product->is_type( 'simple' ) && ! $product->is_type( 'variable' ) ) ) {
						continue;
					}
				}
				$title    = ( mb_strlen( $search_results->post->post_title ) > 80 ) ? mb_substr( $search_results->post->post_title, 0, 79 ) . '...' : $search_results->post->post_title;
				$title    = '#' . $search_results->post->ID . ' - ' . $title;
				$return[] = array( $search_results->post->ID, $title );
			}
		}
	} elseif ( 'pages' === $type ) {
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			's'              => $query,
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'post_type'      => 'page',
		);
		if ( is_numeric( $query ) ) {
			unset( $args['s'] );
			$args['post__in'] = array( $query );
		}

		$search_results = new WP_Query( $args );

		if ( $search_results->have_posts() ) {
			while ( $search_results->have_posts() ) {
				$search_results->the_post();
				$title    = ( mb_strlen( $search_results->post->post_title ) > 80 ) ? mb_substr( $search_results->post->post_title, 0, 79 ) . '...' : $search_results->post->post_title;
				$title    = '#' . $search_results->post->ID . ' - ' . $title;
				$return[] = array( $search_results->post->ID, $title );
			}
		}
	} else {
		$query = ! empty( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
		$args  = array(
			'name__like' => $query,
			'hide_empty' => true,
			'number'     => 20,
		);
		if ( is_numeric( $query ) ) {
			$terms = array( get_term( $query, 'product_cat' ) );
		} else {
			$terms = get_terms( 'product_cat', $args );
		}
		if ( count( $terms ) > 0 ) {
			foreach ( $terms as $term ) {
				if ( isset( $term->name ) ) {
					$term->name = '#' . $term->term_id . ' - ' . $term->name;
					$return[]   = array( $term->term_id, $term->name );
				}
			}
		}
	}

	echo wp_json_encode( $return );
	exit();
}

add_action( 'wp_ajax_commercekit_get_pcids', 'commercekit_get_pcids' );

/**
 * Admin ajax save settings
 */
function commercekit_ajax_save_settings() {
	$ajax            = array();
	$ajax['status']  = 0;
	$ajax['message'] = esc_html__( 'Error on saving settings.', 'commercegurus-commercekit' );

	$return = commercekit_admin_page_update();
	if ( $return ) {
		$ajax['status']  = 1;
		$ajax['message'] = esc_html__( 'Settings has been saved.', 'commercegurus-commercekit' );
	}

	echo wp_json_encode( $ajax );
	exit();
}

add_action( 'wp_ajax_commercekit_save_settings', 'commercekit_ajax_save_settings' );

/**
 * Admin waitlist bulk action
 *
 * @param  string $bulk_action of waitlist.
 * @return string
 */
function commercekit_admin_waitlist_bulk_action( $bulk_action ) {
	global $wpdb;
	if ( 'export' === $bulk_action ) {
		$rows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ORDER BY created', ARRAY_A ); // db call ok; no-cache ok.
		if ( is_array( $rows ) && count( $rows ) ) {
			return false;
		} else {
			return esc_html__( 'There are no waitlist for export.', 'commercegurus-commercekit' );
		}
	} elseif ( 'delete' === $bulk_action ) {
		$nonce   = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
		$wtl_ids = isset( $_POST['wtl_ids'] ) ? map_deep( wp_unslash( $_POST['wtl_ids'] ), 'sanitize_text_field' ) : array();
		if ( is_array( $wtl_ids ) && count( $wtl_ids ) ) {
			foreach ( $wtl_ids as $wtl_id ) {
				$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'commercekit_waitlist WHERE id IN (%s)', $wtl_id ) ); // db call ok; no-cache ok.
			}
			return esc_html__( 'Selected waitlist has been deleted.', 'commercegurus-commercekit' );
		} else {
			return esc_html__( 'Please select at least one waitlist for delete.', 'commercegurus-commercekit' );
		}
	}

	return false;
}

/**
 *  Admin waitlist bulk export
 */
function commercekit_admin_waitlist_export() {
	global $wpdb;
	$nonce       = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
	$tab         = isset( $_POST['tab'] ) ? sanitize_text_field( wp_unslash( $_POST['tab'] ) ) : '';
	$bulk_action = isset( $_POST['bulk_action'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_action'] ) ) : '';
	$bulk_apply  = isset( $_POST['bulk_apply'] ) ? sanitize_text_field( wp_unslash( $_POST['bulk_apply'] ) ) : 0;
	if ( 'waitlist' === $tab && 'export' === $bulk_action && 1 === (int) $bulk_apply ) {
		$rows = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ORDER BY created', ARRAY_A ); // db call ok; no-cache ok.
		if ( is_array( $rows ) && count( $rows ) ) {
			$output = fopen( 'php://output', 'w' );
			header( 'Content-Type: text/csv; charset=UTF-8' );
			header( 'Content-Transfer-Encoding: Binary' );
			header( 'Content-Disposition: attachment; filename="Waitlist.csv"' );
			$headers = array( 'Email', 'Product', 'Date added' );
			fputcsv( $output, $headers );
			if ( count( $rows ) ) {
				foreach ( $rows as $row ) {
					$tmp   = array();
					$tmp[] = $row['email'];
					$tmp[] = get_the_title( $row['product_id'] );
					$tmp[] = gmdate( 'j F Y', $row['created'] );
					fputcsv( $output, $tmp );
				}
			}
			fclose( $output );
			exit();
		}
	}
}
add_action( 'admin_init', 'commercekit_admin_waitlist_export' );

/**
 *  Get browser OS
 */
function commercekit_admin_get_os() {
	$user_agent  = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
	$os_platform = 'Unknown OS Platform';

	$os_array = array(
		'/windows nt 10/i'      => 'Windows 10',
		'/windows nt 6.3/i'     => 'Windows 8.1',
		'/windows nt 6.2/i'     => 'Windows 8',
		'/windows nt 6.1/i'     => 'Windows 7',
		'/windows nt 6.0/i'     => 'Windows Vista',
		'/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
		'/windows nt 5.1/i'     => 'Windows XP',
		'/windows xp/i'         => 'Windows XP',
		'/windows nt 5.0/i'     => 'Windows 2000',
		'/windows me/i'         => 'Windows ME',
		'/win98/i'              => 'Windows 98',
		'/win95/i'              => 'Windows 95',
		'/win16/i'              => 'Windows 3.11',
		'/macintosh|mac os x/i' => 'Mac OS X',
		'/mac_powerpc/i'        => 'Mac OS 9',
		'/linux/i'              => 'Linux',
		'/ubuntu/i'             => 'Ubuntu',
		'/iphone/i'             => 'iPhone',
		'/ipod/i'               => 'iPod',
		'/ipad/i'               => 'iPad',
		'/android/i'            => 'Android',
		'/blackberry/i'         => 'BlackBerry',
		'/webos/i'              => 'Mobile',
	);

	foreach ( $os_array as $index => $value ) {
		if ( preg_match( $index, $user_agent ) ) {
			$os_platform = $value;
		}
	}
	return $os_platform;
}

/**
 *  Get browser name
 */
function commercekit_admin_get_browser() {
	$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '';
	$browser    = 'Unknown Browser';

	$browsers = array(
		'/msie/i'      => 'Internet Explorer',
		'/firefox/i'   => 'Firefox',
		'/safari/i'    => 'Safari',
		'/chrome/i'    => 'Chrome',
		'/edge/i'      => 'Edge',
		'/opera/i'     => 'Opera',
		'/netscape/i'  => 'Netscape',
		'/maxthon/i'   => 'Maxthon',
		'/konqueror/i' => 'Konqueror',
		'/mobile/i'    => 'Handheld Browser',
	);

	foreach ( $browsers as $index => $value ) {
		if ( preg_match( $index, $user_agent ) ) {
			$browser = $value;
		}
	}

	return $browser;
}

/**
 *  Get domain connected status
 */
function commercekit_is_domain_connected() {
	if ( ! class_exists( 'CG_Helper' ) ) {
		return false;
	}

	$whitelisted = CG_Helper::maybe_whitelisted();
	if ( '1' === $whitelisted['domain_auth'] ) {
		return true;
	}

	if ( ! isset( $subscriptions ) ) {
		$subscriptions = CG_Helper::get_subscriptions();
	}

	if ( empty( $subscriptions ) ) {
		return false;
	}

	$theme    = wp_get_theme();
	$template = $theme->get_template();
	if ( false === stripos( $template, 'shoptimizer' ) ) {
		return false;
	}

	$theme  = wp_get_theme( 'shoptimizer' );
	$header = $theme->get( 'CGMeta' );

	if ( empty( $header ) ) {
		return false;
	}

	list( $product_id, $file_id ) = explode( ':', $header );
	if ( empty( $product_id ) || empty( $file_id ) ) {
		return false;
	}

	foreach ( $subscriptions as $subscription ) {
		if ( (string) $subscription['product_id'] !== (string) $product_id ) {
			continue;
		}

		if ( 'active' === $subscription['sub_status'] || 'pending-cancel' === $subscription['sub_status'] ) {
			return true;
		}
	}

	return false;
}

/**
 *  Get subscription number
 */
function commercekit_get_subscription_number() {
	if ( ! class_exists( 'CG_Helper' ) ) {
		return 0;
	}

	if ( ! isset( $subscriptions ) ) {
		$subscriptions = CG_Helper::get_subscriptions();
	}

	if ( empty( $subscriptions ) ) {
		return 0;
	}

	$theme    = wp_get_theme();
	$template = $theme->get_template();
	if ( false === stripos( $template, 'shoptimizer' ) ) {
		return 0;
	}

	$theme  = wp_get_theme( 'shoptimizer' );
	$header = $theme->get( 'CGMeta' );

	if ( empty( $header ) ) {
		return 0;
	}

	list( $product_id, $file_id ) = explode( ':', $header );
	if ( empty( $product_id ) || empty( $file_id ) ) {
		return 0;
	}

	foreach ( $subscriptions as $subscription ) {
		if ( (string) $subscription['product_id'] !== (string) $product_id ) {
			continue;
		}

		if ( 'active' === $subscription['sub_status'] || 'pending-cancel' === $subscription['sub_status'] ) {
			return $subscription['sub_id'];
		}
	}

	return 0;
}
