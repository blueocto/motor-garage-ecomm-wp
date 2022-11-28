<?php
/**
 * The Search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dosth
 */
get_header();
?>

<div class="archive">

    <?php if(isset($_GET['manufacturer']) && isset($_GET['model'])){    
        $manufacturer = $_GET['manufacturer'] ?? '';
        $model = $_GET['model'] ?? '';
        $chassis = $_GET['chassis'] ?? '';

        $searchCat = "";
        if($chassis == ""){
            $searchCat = $model;
        } else {
            $searchCat = $chassis;
        }
    ?>

    <h1>Search for &ldquo;<?php echo esc_html( $manufacturer ); ?> (<?php echo esc_html( $model ); ?>)&rdquo;</h1>
    <section class="woo-container">

        <?php
        // An array of arguments
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array( 
            'post_type' => 'product',
            'status' => 'publish',
            'posts_per_page' => 16, 
            'product_cat' => $searchCat,
            'paged' => $paged, 
        );
        // The Query
        $wp_query = new WP_Query( $args );
        // The Loop
        if ( $wp_query->have_posts() ) {
            ?>
            <ul class="products columns-4">
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

    <aside class="shop-sidebar">
        <div class="widget">
            <h3>Engine size</h3>
            <?php echo do_shortcode('[wpf-filters id=1]' ); ?>
        </div>
        <div class="widget">
            <h3>Part Type</h3>
            <?php echo do_shortcode('[wpf-filters id=5]' ); ?>
        </div>
        <div class="widget">
            <h3>Turbo</h3>
            <?php echo do_shortcode('[wpf-filters id=3]' ); ?>
        </div>
    </aside>

    </section>
        
    <?php } else { ?>

        <h1>Search for &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;</h1>

        <section class="woo-container search_results">
        <?php
        // An array of arguments
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array( 
            'post_type' => array( 'post', 'product' ),
            's' => get_search_query(),
            'status' => 'publish',
            'posts_per_page' => 16, 
            'paged' => $paged, 
        );
        // The Query
        $wp_query = new WP_Query( $args );

        // The Loop
        if ( $wp_query->have_posts() ) {
            ?>
            <ul class="products columns-4">
            <?php
            while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                ?>
                <li class="product">
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
                <?php
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
    </section>

    <?php } ?>

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

<?php get_footer(); ?>