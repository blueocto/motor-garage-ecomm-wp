<?php
/**
 * Template part for displaying page content in page.php
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single--article'); ?>>

	<?php get_template_part( 'template-parts/blocks/yoast-breadcrumbs' ); ?>	

	<div class="entry-content">

		<div class="wp-container-2 wp-block-group alignfull no-padding has-brand-green-background-color has-background">
			<div class="wp-block-media-text alignfull is-stacked-on-mobile is-image-fill" style="grid-template-columns:40% auto">
				<?php if( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) { ?>				
					<figure class="wp-block-media-text__media" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>');background-position:53% 45%">
						<?php the_post_thumbnail( array(1348, 1348), array( 'loading' => 'lazy' ) ); ?>
					</figure>
				<?php } else { ?>
					<figure class="wp-block-media-text__media" style="background-image:url('<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/10/dt-product-placeholder.png');background-position:53% 45%">
						<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2022/10/dt-product-placeholder.png" width="307" height="307" alt="Decimal Tenths Placeholder logo" />
					</figure>
				<?php } ?>

				<div class="wp-block-media-text__content">
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
					<h1 class="small-h has-brand-light-grey-color has-text-color" id="h-welcome-to-decimal-tenths-ltd"><br><?php the_title( ); ?></h1>
					<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
				</div>
			</div>
		</div>
		<div class="wp-container-3 wp-block-group alignfull has-brand-light-grey-background-color has-background has-bo-off-black-color">
			<?php the_content(); ?>
		</div>
	</div>
</article>