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
    ?>

        <h1>Search for &ldquo;<?php echo esc_html( $manufacturer ); ?> (<?php echo esc_html( $model ); ?>)&rdquo;</h1>
        <?php
        $category = get_term_by( 'slug', ''.$model.'', 'product_cat' );

        $args = array('post_type' => 'product', 'status' => 'publish', 'posts_per_page' => -1, 'product_cat' => $model);
        $productSearch = get_posts($args);

        $brandsArray = array();
        $tagsArray = array();
        $priceArray = array();
        foreach($productSearch as $post) : setup_postdata($post);

            $product = wc_get_product( $post->ID );
            $priceArray[] = $product->get_price();

            $brands = get_the_terms( $post->ID, 'pwb-brand' );
            $tags = get_the_terms( $post->ID, 'product_tag' );
            if (is_array($brands)) {
                foreach($brands as $brand){
                    $brandsArray[] = $brand->slug;
                }
            }
            if (is_array($tags)) {
                foreach($tags as $tag){
                    $tagsArray[] = $tag->slug;
                }
            }
            wp_reset_postdata(); 
        endforeach;

        sort($priceArray);
        $filterPriceArray = array_values(array_filter($priceArray));
        ?>
        <input type="hidden" class="brands_array" value='<?php print(json_encode(array_values(array_unique($brandsArray)))); ?>' />
        <input type="hidden" class="tags_array" value='<?php print(json_encode(array_values(array_unique($tagsArray)))); ?>' />
        <input type="hidden" class="cheapest_price" value='<?php print($filterPriceArray[0]); ?>' />
        <input type="hidden" class="expensive_price" value='<?php print($filterPriceArray[count($filterPriceArray)-1]); ?>' />
        <?php echo do_shortcode("[woof_products per_page=24 columns=3 is_ajax=1 taxonomies=product_cat:$category->term_id]"); ?>

    <?php } else { ?>

        <h1>Search for &ldquo;<?php echo esc_html( get_search_query() ); ?>&rdquo;</h1>

        <div class="search_results">
        <?php
        // An array of arguments
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args = array( 
            'post_type' => array( 'post', 'product' ),
            's' => get_search_query(),
            'status' => 'publish',
            'posts_per_page' => 9, 
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

        <aside class="shop-sidebar">
            <?php echo do_shortcode('[searchandfilter fields="search,category,pwb-brand,product_cat" headings="Search,Blog,Brands,Product Categories" post_types="post,product" hide_empty="1"]' ); ?>
        </aside>

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

    <?php } ?>

</div>

<?php get_footer(); ?>