<?php get_header(); ?>

<main id="main" class="main">

   	<h1>Sorry, the page cannot be found</h1>

	<article>
		<div class="entry-content">
			
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
			<?php get_template_part( 'searchform' ); ?>
	</article>

</main>

<?php get_footer();