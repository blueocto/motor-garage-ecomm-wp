<?php
/**
 * Template part for displaying page content in page.php
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single--article'); ?>>

	<?php get_template_part( 'template-parts/blocks/yoast-breadcrumbs' ); ?>	
	
	<header class="single--header">

		<div class="entry-meta">
			<?php echo '<time class="date-time" datetime="' . get_the_time( 'c' ) . '">'. sprintf( __( '%1$s', 'decimaltenths' ), get_the_date(), get_the_time() ) . '</time>'; ?> 
			&bull; 
			<?php echo '' . __( 'by', 'decimaltenths' ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author">' . get_the_author() . '</a>'; ?> 
			&bull; 
			<span id="readingTime"></span> min read
		</div>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<div id="readingArticle" class="entry-content">
		<?php the_content(); ?>
	</div>

</article>