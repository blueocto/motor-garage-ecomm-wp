<?php
/**
 *
 * Admin Order Bump
 *
 * @package CommerceKit
 * @subpackage Shoptimizer
 */

$obp = isset( $commercekit_options['obp'] ) ? $commercekit_options['obp'] : array();
?>
<div id="settings-content" class="postbox content-box">
	<h2><span><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></span></h2>

	<div class="inside meta-box-sortables" id="product-orderbump">

		<div class="postbox no-change closed" id="first-row" style="display:none;">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?></span></h2>
			<div class="inside">
				<table class="form-table admin-order-bump" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_obp_pdt_at[]" type="checkbox" class="check pdt-active" value="1"><span class="toggle-slider"></span><input type="hidden" name="commercekit[obp][pdt][at][]" class="pdt-active-val" value="0" /><input type="hidden" name="commercekit[obp][pdt][ato][]" class="pdt-active-val" value="0" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable order bump on checkout', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr>
						<th><?php esc_html_e( 'Select', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><select name="commercekit[obp][pdt][id][]" class="select2 order-bump-product required" data-type="products" data-tab="order-bump" data-mode="full" data-placeholder="Select a product to offer..." style="width:100%;"></select></label><br /><small><em><?php esc_html_e( 'This is the order bump product which will appear on the checkout page. Simple and variable products only.', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][tt][]" type="text" class="title pdt-title text required" value="" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button text', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][bt][]" type="text" class="title text btext required" value="<?php esc_html_e( 'Click to add', 'commercegurus-commercekit' ); ?>" /></label></td> 
					</tr>
					<tr> 
						<th>Button added: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][ba][]" type="text" class="title text badded required" value="<?php esc_html_e( 'Added!', 'commercegurus-commercekit' ); ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<select name="commercekit[obp][pdt][cnd][]" class="conditions">
								<option value="all" selected="selected"><?php esc_html_e( 'All products', 'commercegurus-commercekit' ); ?></option>
								<option value="products"><?php esc_html_e( 'Specific products', 'commercegurus-commercekit' ); ?></option>
								<option value="non-products"><?php esc_html_e( 'All products apart from', 'commercegurus-commercekit' ); ?></option>
								<option value="categories"><?php esc_html_e( 'Specific categories', 'commercegurus-commercekit' ); ?></option>
								<option value="non-categories"><?php esc_html_e( 'All categories apart from', 'commercegurus-commercekit' ); ?></option>
							</select>
						</td> 
					</tr>
					<tr class="product-ids" style="display:none;">
						<th class="options">
						<?php esc_html_e( 'Specific products:', 'commercegurus-commercekit' ); ?>
						</th>
						<td> <label><select name="commercekit_obp_pdt_pids[]" class="select2" data-type="all" multiple="multiple" style="width:100%;"></select><input type="hidden" name="commercekit[obp][pdt][pids][]" class="select3 text" value="" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><!--DELETE--></td></tr>
				</table>
			</div>
		</div>
		<?php
		if ( isset( $obp['pdt']['tt'] ) && count( $obp['pdt']['tt'] ) > 0 ) {
			foreach ( $obp['pdt']['tt'] as $k => $tt ) {
				if ( empty( $tt ) ) {
					continue;
				}
				?>
		<div class="postbox no-change closed">
			<button type="button" class="handlediv" aria-expanded="true"><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="gray"><span>
				<?php
				echo isset( $obp['pdt']['tt'][ $k ] ) && ! empty( $obp['pdt']['tt'][ $k ] ) ? esc_html( $obp['pdt']['tt'][ $k ] ) : esc_html__( 'Title', 'commercegurus-commercekit' );
				?>
			</span></h2>
			<div class="inside">
				<table class="form-table admin-order-bump" role="presentation">
					<tr> 
						<th width="20%"><?php esc_html_e( 'Enable', 'commercegurus-commercekit' ); ?>: </th>
						<td> <label class="toggle-switch"><input name="commercekit_obp_pdt_at[]" type="checkbox" class="check pdt-active" value="1" <?php echo isset( $obp['pdt']['at'][ $k ] ) && 1 === (int) $obp['pdt']['at'][ $k ] ? 'checked="checked"' : ''; ?>><span class="toggle-slider"></span><input type="hidden" name="commercekit[obp][pdt][at][]" class="pdt-active-val" value="<?php echo isset( $obp['pdt']['at'][ $k ] ) ? esc_attr( $obp['pdt']['at'][ $k ] ) : '0'; ?>" /><input type="hidden" name="commercekit[obp][pdt][ato][]" class="pdt-active-val" value="<?php echo isset( $obp['pdt']['ato'][ $k ] ) ? esc_attr( $obp['pdt']['ato'][ $k ] ) : '0'; ?>" /></label>&nbsp;&nbsp;<?php esc_html_e( 'Enable order bump on checkout', 'commercegurus-commercekit' ); ?></td> 
					</tr>
					<tr>
						<th><?php esc_html_e( 'Select', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><select name="commercekit[obp][pdt][id][]" class="select2 order-bump-product required" data-type="products" data-tab="order-bump" data-mode="full" data-placeholder="Select a product to offer..." style="width:100%;">
						<?php
						$pid = isset( $obp['pdt']['id'][ $k ] ) ? (int) $obp['pdt']['id'][ $k ] : 0;
						if ( $pid ) {
							echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( get_the_title( $pid ) ) . '</option>';
						}
						?>
						</select></label><br /><small><em><?php esc_html_e( 'This is the order bump product which will appear on the checkout page. Simple and variable products only.', 'commercegurus-commercekit' ); ?></em></small></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Title', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][tt][]" type="text" class="title pdt-title text required" value="<?php echo isset( $obp['pdt']['tt'][ $k ] ) ? esc_attr( stripslashes_deep( $obp['pdt']['tt'][ $k ] ) ) : ''; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button text', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][bt][]" type="text" class="title text btext required" value="<?php echo isset( $obp['pdt']['bt'][ $k ] ) ? esc_attr( stripslashes_deep( $obp['pdt']['bt'][ $k ] ) ) : 'Click to add'; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Button added', 'commercegurus-commercekit' ); ?>: <span class="star">*</span></th>
						<td> <label><input name="commercekit[obp][pdt][ba][]" type="text" class="title text badded required" value="<?php echo isset( $obp['pdt']['ba'][ $k ] ) ? esc_attr( stripslashes_deep( $obp['pdt']['ba'][ $k ] ) ) : 'Added!'; ?>" /></label></td> 
					</tr>
					<tr> 
						<th><?php esc_html_e( 'Conditions', 'commercegurus-commercekit' ); ?>: </th>
						<td> 
							<?php
							$ctype = 'all';
							if ( isset( $obp['pdt']['cnd'][ $k ] ) && in_array( $obp['pdt']['cnd'][ $k ], array( 'products', 'non-products' ), true ) ) {
								$ctype = 'products';
							}
							if ( isset( $obp['pdt']['cnd'][ $k ] ) && in_array( $obp['pdt']['cnd'][ $k ], array( 'categories', 'non-categories' ), true ) ) {
								$ctype = 'categories';
							}
							?>
							<select name="commercekit[obp][pdt][cnd][]" class="conditions">
								<option value="all" <?php echo isset( $obp['pdt']['cnd'][ $k ] ) && 'all' === $obp['pdt']['cnd'][ $k ] ? 'selected="selected"' : ''; ?>><?php esc_html_e( 'All products', 'commercegurus-commercekit' ); ?></option>
								<option value="products" <?php echo isset( $obp['pdt']['cnd'][ $k ] ) && 'products' === $obp['pdt']['cnd'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific products', 'commercegurus-commercekit' ); ?></option>
								<option value="non-products" <?php echo isset( $obp['pdt']['cnd'][ $k ] ) && 'non-products' === $obp['pdt']['cnd'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All products apart from', 'commercegurus-commercekit' ); ?></option>
								<option value="categories" <?php echo isset( $obp['pdt']['cnd'][ $k ] ) && 'categories' === $obp['pdt']['cnd'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'Specific categories', 'commercegurus-commercekit' ); ?></option>
								<option value="non-categories" <?php echo isset( $obp['pdt']['cnd'][ $k ] ) && 'non-categories' === $obp['pdt']['cnd'][ $k ] ? 'selected="selected"' : ''; ?> ><?php esc_html_e( 'All categories apart from', 'commercegurus-commercekit' ); ?></option>
							</select>
						</td> 
					</tr>
					<tr class="product-ids" <?php echo 'all' === $ctype ? 'style="display:none;"' : ''; ?>>
						<th class="options">
						<?php
						echo 'all' === $ctype || 'products' === $ctype ? esc_attr( 'Specific products:' ) : '';
						echo 'categories' === $ctype ? esc_html__( 'Specific categories:', 'commercegurus-commercekit' ) : '';
						?>
						</th>
						<td> <label><select name="commercekit_obp_pdt_pids[]" class="select2" data-type="<?php echo esc_attr( $ctype ); ?>" multiple="multiple" style="width:100%;">
						<?php
						$pids = isset( $obp['pdt']['pids'][ $k ] ) ? explode( ',', $obp['pdt']['pids'][ $k ] ) : array();
						if ( 'all' !== $ctype && count( $pids ) ) {
							foreach ( $pids as $pid ) {
								if ( empty( $pid ) ) {
									continue;
								}
								if ( 'products' === $ctype ) {
									echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( get_the_title( $pid ) ) . '</option>';
								}
								if ( 'categories' === $ctype ) {
									$nterm       = get_term_by( 'id', $pid, 'product_cat' );
									$nterm->name = isset( $nterm->name ) ? $nterm->name : '';
									echo '<option value="' . esc_attr( $pid ) . '" selected="selected">#' . esc_attr( $pid ) . ' - ' . esc_html( $nterm->name ) . '</option>';
								}
							}
						}
						?>
						</select><input type="hidden" name="commercekit[obp][pdt][pids][]" class="select3 text" value="<?php echo esc_html( implode( ',', $pids ) ); ?>" /></label></td> 
					</tr>
					<tr><td colspan="2" align="right"><a href="javascript:;" class="delete-orderbump" onclick="delete_product_orderbump(this);"><?php esc_html_e( 'Delete order bump', 'commercegurus-commercekit' ); ?></a></td></tr>
				</table>
			</div>
		</div>
				<?php
			}
		}
		?>
	</div>
	<script> 
	var global_delete_orderbump = '<?php esc_html_e( 'Delete order bump', 'commercegurus-commercekit' ); ?>';
	var global_delete_orderbump_confirm = '<?php esc_html_e( 'Are you sure you want to delete this product order bump?', 'commercegurus-commercekit' ); ?>';
	var global_required_text = '<?php esc_html_e( 'This field is required', 'commercegurus-commercekit' ); ?>';
	</script>

	<div class="inside add-new-order-bump"><button type="button" class="button button-secondary" onclick="add_new_order_bump();"><span class="dashicons dashicons-plus"></span> <?php esc_html_e( 'Add new order bump', 'commercegurus-commercekit' ); ?></button></div>

</div>

<div class="postbox" id="settings-note">
	<h4><?php esc_html_e( 'Order Bump', 'commercegurus-commercekit' ); ?></h4>
	<p><?php esc_html_e( 'An order bump allows a user to add an additional item to the cart, before they complete an order. This captures the excitement of making a purchase, and can increase the average order value. Only one order bump is displayed at a time on the checkout page.', 'commercegurus-commercekit' ); ?></p>
</div>
