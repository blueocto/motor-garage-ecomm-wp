<?php
/**
 *
 * Admin Waitlist
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

global $wpdb;
$pg_url = '/wp-admin/admin.php?page=commercekit&tab=waitlist';
$total  = (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'commercekit_waitlist' ); // db call ok; no-cache ok.
$offset = 0;
$limit  = 10;
$nonce  = wp_verify_nonce( 'commercekit_nonce', 'commercekit_settings' );
$wpage  = isset( $_REQUEST['paged'] ) ? sanitize_text_field( (int) $_REQUEST['paged'] ) : 1;
$wpage  = $wpage > 0 ? $wpage : 1;
$wpages = ceil( $total / $limit );
if ( $wpages && $wpage > $wpages ) {
	$wpage = $wpages;
}
$offset = ( $wpage - 1 ) * $limit;
$rows   = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'commercekit_waitlist ORDER BY created DESC LIMIT %d, %d', $offset, $limit ), ARRAY_A ); // db call ok; no-cache ok.
$flink  = '';
$plink  = '';
$nlink  = '';
$llink  = '';
if ( $wpage > 1 ) {
	$flink = $pg_url . '&paged=1';
	$plink = $pg_url . '&paged=' . ( $wpage - 1 );
}
if ( $wpages > 1 && $wpage < $wpages ) {
	$nlink = $pg_url . '&paged=' . ( $wpage + 1 );
	$llink = $pg_url . '&paged=' . $wpages;
}
?>
<div id="settings-content">
	<div class="tablenav top">
		<div class="alignleft actions bulkactions">
			<select name="bulk_action" id="bulk-action-selector-top" onchange="jQuery('#bulk-apply').val(0);">
				<option value=""><?php esc_html_e( 'Bulk Actions', 'commercegurus-commercekit' ); ?></option>
				<option value="delete"><?php esc_html_e( 'Delete', 'commercegurus-commercekit' ); ?></option>
				<option value="export"><?php esc_html_e( 'Export', 'commercegurus-commercekit' ); ?></option>
			</select>
			<input type="button" id="waitlist-doaction" class="button action" value="Apply" onclick="jQuery('#bulk-apply').val(1);jQuery('#commercekit-form').submit();jQuery('#bulk-apply').val(0);"><input type="hidden" id="bulk-apply" name="bulk_apply" value="0" />
		</div>
		<?php if ( $total ) { ?>
		<div class="tablenav-pages">
			<span class="displaying-num"><?php echo esc_html( $total ); ?> <?php esc_html_e( 'items', 'commercegurus-commercekit' ); ?></span>
			<span class="pagination-links">
			<?php if ( '' !== $flink || '' !== $plink ) { ?>
			<a class="first-page button" href="<?php echo esc_url( $flink ); ?>">
				<span aria-hidden="true">«</span>
			</a>
			<a class="first-page button" href="<?php echo esc_url( $plink ); ?>">
				<span aria-hidden="true">‹</span>
			</a>
			<?php } else { ?>
				<span class="tablenav-pages-navspan button disabled">«</span>
				<span class="tablenav-pages-navspan button disabled">‹</span>
			<?php } ?>
			</span>
			<span class="paging-input">
				<input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo esc_html( $wpage ); ?>" size="2" />
				<span class="tablenav-paging-text"> <?php esc_html_e( 'of', 'commercegurus-commercekit' ); ?> <span class="total-pages"><?php echo esc_html( $wpages ); ?></span></span>
			</span>

			<?php if ( '' !== $nlink || '' !== $llink ) { ?>
			<a class="next-page button" href="<?php echo esc_url( $nlink ); ?>">
				<span aria-hidden="true">›</span>
			</a>
			<a class="last-page button" href="<?php echo esc_url( $llink ); ?>">
				<span aria-hidden="true">»</span>
			</a>
			<?php } else { ?>
			<span class="tablenav-pages-navspan button disabled">›</span>
			<span class="tablenav-pages-navspan button disabled">»</span>
			<?php } ?>
		</div>
		<?php } ?>
		<br class="clear">
	</div>
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<td id="cb" class="manage-column column-cb check-column"><input id="cb-select-all" type="checkbox"></td>
				<th scope="col" id="email" width="40%"><?php esc_html_e( 'Email', 'commercegurus-commercekit' ); ?></th>
				<th scope="col" id="product" width="30%"><?php esc_html_e( 'Product', 'commercegurus-commercekit' ); ?></th>
				<th scope="col" id="created"><?php esc_html_e( 'Date added', 'commercegurus-commercekit' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ( count( $rows ) ) {
				foreach ( $rows as $row ) {
					?>
			<tr>
				<th id="cb" class="manage-column column-cb check-column"><input id="cb-select-all-<?php echo esc_html( $row['id'] ); ?>" name="wtl_ids[]" value="<?php echo esc_html( $row['id'] ); ?>" type="checkbox"></th>
				<td scope="col" id="email"><?php echo esc_html( $row['email'] ); ?></td>
				<td scope="col" id="product"><?php echo esc_html( get_the_title( $row['product_id'] ) ); ?></td>
				<td scope="col" id="created"><?php echo esc_html( gmdate( 'j F Y', $row['created'] ) ); ?></td>
			</tr>
					<?php
				}
			} else {
				?>
			<tr>
				<td scope="col" colspan="4" align="center"><?php esc_html_e( 'No Items', 'commercegurus-commercekit' ); ?></td>
			</tr>
				<?php
			}
			?>
		</tbody>
	</table><br /><br />

	<div class="postbox content-box">
		<h2><span><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></span></h2>
		<div class="inside">
			<table class="form-table" role="presentation">
				<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_waitlist" class="toggle-switch"> <input name="commercekit[waitlist]" type="checkbox" id="commercekit_waitlist" value="1" <?php echo isset( $commercekit_options['waitlist'] ) && 1 === (int) $commercekit_options['waitlist'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable waitlist for out of stock products', 'commercegurus-commercekit' ); ?></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Introduction', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_intro"> <input name="commercekit[wtl_intro]" type="text" id="commercekit_wtl_intro" value="<?php echo isset( $commercekit_options['wtl_intro'] ) && ! empty( $commercekit_options['wtl_intro'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_intro'] ) ) : esc_html__( 'Notify me when the item is back in stock.', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Email placeholder', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_email_text"> <input name="commercekit[wtl_email_text]" type="text" id="commercekit_wtl_email_text" value="<?php echo isset( $commercekit_options['wtl_email_text'] ) && ! empty( $commercekit_options['wtl_email_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_email_text'] ) ) : esc_html__( 'Enter your email address...', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Button label', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_button_text"> <input name="commercekit[wtl_button_text]" type="text" id="commercekit_wtl_button_text" value="<?php echo isset( $commercekit_options['wtl_button_text'] ) && ! empty( $commercekit_options['wtl_button_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_button_text'] ) ) : esc_html__( 'Join waiting list', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Consent label', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_wtl_consent_text"> <input name="commercekit[wtl_consent_text]" type="text" id="commercekit_wtl_consent_text" value="<?php echo isset( $commercekit_options['wtl_consent_text'] ) && ! empty( $commercekit_options['wtl_consent_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['wtl_consent_text'] ) ) : esc_html__( 'I consent to being contacted by the store owner', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
				<tr> <th scope="row"><?php esc_html_e( 'Success message', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_success_text"> <input name="commercekit[ajs_success_text]" type="text" id="commercekit_ajs_success_text" value="<?php echo isset( $commercekit_options['ajs_success_text'] ) && ! empty( $commercekit_options['ajs_success_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_success_text'] ) ) : esc_html__( 'You have been added to the waiting list for this product!', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			</table>
			<input type="hidden" name="tab" value="waitlist" />
			<input type="hidden" name="action" value="commercekit_save_settings" />
		</div>
	</div>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Waitlist', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'Product waitlists are used to notify interested shoppers when sold-out products are back in stock. This module collects data on customers who sign up.', 'commercegurus-commercekit' ); ?></p>
</div>
