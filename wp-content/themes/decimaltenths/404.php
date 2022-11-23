<?php get_header(); ?>

<main id="main" class="main">

	<div class="row error_404">
		<div class="column large-6">

			<div class="error_image">
				<picture class="picture error-img-1">
					<?php print(wp_get_attachment_image( 164113, "large", array( 'loading' => 'lazy'))); ?>
				</picture>
			</div>

			<h1>Sorry, the page cannot be found</h1>			
			<p class="h6"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'decimaltenths' ); ?></p>
			<p><?php _e( 'Please try the following:', 'decimaltenths' ); ?></p>
			<ul>
				<li>
					<?php _e( 'Check your spelling', 'decimaltenths' ); ?>
				</li>
				<li>
					<?php
						/* translators: %s: home page url */
						printf(
							__( 'Return to the <a href="%s">home page</a>', 'decimaltenths' ),
							home_url()
						);
					?>
				</li>
				<li>
					<?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'decimaltenths' ); ?>
				</li>
			</ul>
			<?php
			$searchform_unique_id = wp_unique_id( 'search-form-' );

			$searchform_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';

			?>
			<form class="" role="search" <?php echo $searchform_aria_label; ?> method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="searchform--label" for="<?php echo esc_attr( $searchform_unique_id ); ?>"><?php _e( 'Search the website...', 'decimaltenths' ); ?></label>
				<div class="searchform--wrap">
					<input class="searchform--input" type="search" id="<?php echo esc_attr( $searchform_unique_id ); ?>" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search the website" onkeyup="buttonUp();" />
					<input class="searchform--submit" type="submit" value="Search" />
				</div>
			</form>
		</div>
	</div>

</main>

<?php get_footer();