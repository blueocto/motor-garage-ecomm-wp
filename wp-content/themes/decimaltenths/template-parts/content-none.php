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

		<?php else : ?>

			<h2 class="entry-title"><?php esc_html_e( 'Nothing here', 'decimaltenths' ); ?></h2>
				

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

		<?php else : ?>

			<?php //get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
