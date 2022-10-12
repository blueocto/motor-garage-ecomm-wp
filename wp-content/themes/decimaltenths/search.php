<?php
/**
 * The Search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dosth
 */
get_header();

$manufacturer = $_GET['manufacturer'] ?? '';
$model = $_GET['model'] ?? '';
?>

<main id="main" class="main archive">
    <h1>Search for &ldquo;<?php echo esc_html( $_GET['manufacturer'] ); ?> ( <?php echo esc_html( $model ); ?>)&rdquo;</h1>
    <div class="search_results">
    <?php
    // An array of arguments
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $args = array( 
        'post_type' => 'product',
        'status' => 'publish',
        'posts_per_page' => 9, 
        'product_cat' => $model,
        'paged' => $paged, 
    );
    // The Query
    $wp_query = new WP_Query( $args );
    // The Loop
    if ( $wp_query->have_posts() ) {
        ?>
        <ul class="products columns-3">
        <?php
        while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
            wc_get_template_part( 'content', 'product' );
        endwhile;
        ?>
        </ul>
        <?php
    } else {
        get_template_part( 'template-parts/content', 'none' );
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    ?>

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

    </div>
</main>

<?php get_footer(); ?>