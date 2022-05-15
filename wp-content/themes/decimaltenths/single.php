<?php get_header(); ?>

<main id="main" class="main">

	<picture class="picture">
		<?php if ( has_post_thumbnail() ) { ?>
			<?php the_post_thumbnail( 'full', array( 'loading' => 'lazy' ) ); ?>
		<?php } ?>
	</picture>

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content-single' ); ?>
			
			<?php 
				the_post_navigation( 
					array(
						'prev_text' => __( '<span>Previous Post</span> %title' ),
						'next_text' => __( '<span>Next Post</span> %title' ),
						'screen_reader_text' => __( 'Continue Reading' ),
					)
				);
			?>

		<?php endwhile; ?>
		
		<?php else : ?>
		
			<?php get_template_part( 'template-parts/content-none' ); ?>
		
	<?php endif; // End have_posts() check. ?>
	
	<?php 
		/* Display navigation to next/previous pages when applicable */
	?>
	<div class="row">
		<div class="column small-12">
			<nav id="post-nav">
				<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'decimaltenths' ) ); ?></div>
				<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'decimaltenths' ) ); ?></div>
			</nav>
		</div>
	</div>
	
	<div class="index--sidebar">
		<?php //get_sidebar(); ?>
	</div>

</main>

<?php //get_template_part( 'template-parts/single/related-posts' ); ?>

<?php get_footer();