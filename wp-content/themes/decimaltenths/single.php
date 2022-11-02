<?php get_header(); ?>

<main id="main" class="main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content-single' ); ?>

			<?php endwhile; ?>
			
			<?php else : ?>
			
				<?php get_template_part( 'template-parts/content-none' ); ?>
			
		<?php endif; // End have_posts() check. ?>
	
	</div>

</main>

<?php get_footer();