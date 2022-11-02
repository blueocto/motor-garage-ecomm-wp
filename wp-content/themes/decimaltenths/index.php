<?php get_header(); ?>

<main id="main" class="main">

	<?php if ( is_home() ) { ?>
		<h1>Decimal Tenth Blog</h1>
	<?php } elseif ( is_category() || is_archive() ) { ?>
		<h1><?php the_archive_title( '' ); ?></h1>
	<?php } elseif( is_search() ) { ?>
		<h1>&ldquo;<?php echo esc_html( $_GET['s'] ); ?>&rdquo;</h1>
	<?php } ?>
	
	<div class="index--content">
	<?php if ( have_posts() ) : ?>
		<ul class="products columns-3">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'excerpt' ); ?>
		<?php endwhile; ?>
		</ul>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; // End have_posts() check. ?>
		</div>

	
	<?php 
		/* Display navigation to next/previous pages when applicable */
		if ( function_exists( 'octopress_pagination' ) ) :
			octopress_pagination();
		elseif ( is_paged() ) :
	?>
		<div class="row">
			<div class="column small-12">
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'decimaltenths' ) ); ?></div>
					<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'decimaltenths' ) ); ?></div>
				</nav>
			</div>
		</div>	
	<?php endif; ?>
	
	<div class="index--sidebar">
		<?php //get_sidebar(); ?>
	</div>

</main>

<?php get_footer();