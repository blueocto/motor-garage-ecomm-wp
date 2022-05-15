<?php
/**
 * Template part for displaying post archives and search results
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) { ?>				
	<picture class="excerpt--picture picture">
		<?php the_post_thumbnail( array(1348, 1348), array( 'loading' => 'lazy' ) ); ?>
	</picture>
	<?php } else { ?>
	{picture}
	<?php } ?>
	<div class="excerpt--content">
		<header class="entry-header">
			<?php echo '<time class="date-time" datetime="' . get_the_time( 'c' ) . '">'. sprintf( __( '%1$s', 'decimaltenths' ), get_the_date(), get_the_time() ) . '</time>'; ?>
			<?php
				the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );
				//twenty_twenty_one_posted_on();
			?>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
			<p class="read-more"><a class="btn" href="<?php echo esc_url( get_permalink()); ?>">Continue reading<span class="visuallyhidden"> about <?php get_the_title(); ?></span> &gt;</a></p>
		</div>
	</div>
</article>