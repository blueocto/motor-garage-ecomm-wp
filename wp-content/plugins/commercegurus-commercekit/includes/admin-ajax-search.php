<?php
/**
 *
 * Admin Ajax Search
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></span></h2>
	<div class="inside">
		<table class="form-table" role="presentation">
			<tr> <th scope="row"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajax_search" class="toggle-switch"> <input name="commercekit[ajax_search]" type="checkbox" id="commercekit_ajax_search" value="1" <?php echo isset( $commercekit_options['ajax_search'] ) && 1 === (int) $commercekit_options['ajax_search'] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span></label><label>&nbsp;&nbsp;<?php esc_html_e( 'Enable ajax search in the main search bar', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Placeholder', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_placeholder"> <input name="commercekit[ajs_placeholder]" type="text" id="commercekit_ajs_placeholder" value="<?php echo isset( $commercekit_options['ajs_placeholder'] ) && ! empty( $commercekit_options['ajs_placeholder'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_placeholder'] ) ) : esc_html__( 'Search products...', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Display', 'commercegurus-commercekit' ); ?></th> <td> <label><input type="radio" value="all" name="commercekit[ajs_display]" <?php echo ( isset( $commercekit_options['ajs_display'] ) && 'all' === $commercekit_options['ajs_display'] ) || ! isset( $commercekit_options['ajs_display'] ) ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'All contents', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="products" name="commercekit[ajs_display]" <?php echo isset( $commercekit_options['ajs_display'] ) && 'products' === $commercekit_options['ajs_display'] ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'Just products', 'commercegurus-commercekit' ); ?></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;Other results&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_other_text"> <input name="commercekit[ajs_other_text]" type="text" id="commercekit_ajs_other_text" value="<?php echo isset( $commercekit_options['ajs_other_text'] ) && ! empty( $commercekit_options['ajs_other_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_other_text'] ) ) : esc_html__( 'Other results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;No results&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_no_text"> <input name="commercekit[ajs_no_text]" type="text" id="commercekit_ajs_no_text" value="<?php echo isset( $commercekit_options['ajs_no_text'] ) && ! empty( $commercekit_options['ajs_no_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_no_text'] ) ) : esc_html__( 'No results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( '&ldquo;View all&rdquo; text', 'commercegurus-commercekit' ); ?></th> <td> <label for="commercekit_ajs_all_text"> <input name="commercekit[ajs_all_text]" type="text" id="commercekit_ajs_all_text" value="<?php echo isset( $commercekit_options['ajs_all_text'] ) && ! empty( $commercekit_options['ajs_all_text'] ) ? esc_attr( stripslashes_deep( $commercekit_options['ajs_all_text'] ) ) : esc_html__( 'View all results', 'commercegurus-commercekit' ); ?>" size="70" /></label></td> </tr>
			<tr> <th scope="row"><?php esc_html_e( 'Out of stock products', 'commercegurus-commercekit' ); ?></th> <td> <label><input type="radio" value="0" name="commercekit[ajs_outofstock]" <?php echo ( isset( $commercekit_options['ajs_outofstock'] ) && 0 === (int) $commercekit_options['ajs_outofstock'] ) || ! isset( $commercekit_options['ajs_outofstock'] ) ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'Include', 'commercegurus-commercekit' ); ?></label> <span class="radio-space">&nbsp;</span><label><input type="radio" value="1" name="commercekit[ajs_outofstock]" <?php echo isset( $commercekit_options['ajs_outofstock'] ) && 1 === (int) $commercekit_options['ajs_outofstock'] ? 'checked="checked"' : ''; ?>/>&nbsp;<?php esc_html_e( 'Exclude', 'commercegurus-commercekit' ); ?></label></td></tr> 
			<tr> <th scope="row"><?php esc_html_e( 'Exclude', 'commercegurus-commercekit' ); ?></th>  <td> <label for="commercekit_ajs_excludes"> <input name="commercekit[ajs_excludes]" type="text" id="commercekit_ajs_excludes" value="<?php echo isset( $commercekit_options['ajs_excludes'] ) && ! empty( $commercekit_options['ajs_excludes'] ) ? esc_attr( $commercekit_options['ajs_excludes'] ) : ''; ?>" size="70" /></label><br /><small><em><?php esc_html_e( 'Enter Product/Page/Post ID&rsquo;s to be excluded, separated by a comma.', 'commercegurus-commercekit' ); ?></em></small></td></tr>  
		</table>
		<input type="hidden" name="tab" value="ajax-search" />
		<input type="hidden" name="action" value="commercekit_save_settings" />
	</div>
</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Ajax Search', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'Research has shown that instant search results are an important feature on eCommerce sites. It helps users save time and find products faster.', 'commercegurus-commercekit' ); ?></p>
</div>