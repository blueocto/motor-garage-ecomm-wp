<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
?>
<section class="no-results not-found">
	<header class="entry-header alignfull">
		<?php if ( is_search() ) : ?>

			<h1 class="entry-title">
				<?php
				printf(
					/* translators: %s: Search term. */
					esc_html__( 'Results for "%s"', 'decimaltenths' ),
					'<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>

		<?php else : ?>

			<div class="page-404">
				<h1 class="entry-title"><?php esc_html_e( '404', 'decimaltenths' ); ?></h1>
				<p><?php esc_html_e( 'We can&rsquo;t semm find to what you&rsquo;re looking for.', 'decimaltenths' ); ?></p>
				<div class="wp-block-buttons is-content-justification-center">
					<div class="wp-block-button">
						<a class="wp-block-button__link has-wt-brand-blue-color has-wt-brand-green-background-color has-text-color has-background" href="/">Go home</a>
					</div>
				</div>
			</div>

		<?php endif; ?>
	</header>

	<div class="entry-content default-max-width">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php
			printf(
				'<p>' . wp_kses(
					/* translators: %s: Link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'decimaltenths' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'decimaltenths' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<?php //get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
