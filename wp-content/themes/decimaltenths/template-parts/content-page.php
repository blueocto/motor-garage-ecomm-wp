<?php
/**
 * Template part for displaying page content in page.php
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php /* ?>

		<?php if( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail() ) { ?>
		<header class="entry-header alignfull">
			<picture class="picture">
				<?php the_post_thumbnail( array(1348, 1348), array( 'loading' => 'lazy' ) ); ?>
			</picture>
		</header>
		<?php } ?>
	<?php */ ?>
	
	<div class="entry-header--title">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<?php /* if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer default-max-width">
			<?php
				edit_post_link(
					sprintf(
						esc_html__( 'Edit this page %s', 'decimaltenths' ),
						'<span class="visuallyhidden">' . get_the_title() . '</span>'
					),
					'<p class="edit-link">',
					'</p>'
				);
			?>
		</footer>
	<?php endif; */ ?>
</article>