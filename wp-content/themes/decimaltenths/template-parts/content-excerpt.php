<?php
/**
 * Template part for displaying post archives and search results
 *
 */
?>
<li id="post-<?php the_ID(); ?>" class="product">

	<a href="<?php echo esc_url( get_permalink()); ?>">
		<?php if( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) { ?>				
		<picture class="excerpt--picture picture">
			<?php the_post_thumbnail( array(1348, 1348), array( 'loading' => 'lazy' ) ); ?>
		</picture>
		<?php } else { ?>
		<picture class="excerpt--picture picture">
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/10/dt-product-placeholder.png" width="307" height="307" alt="Decimal Tenths Placeholder logo" />
		</picture>
		<?php } ?>
		<div class="blog-title"><?php the_title( sprintf( '<h2>'), '</h2>' ); ?></div>
	</a>
</li>