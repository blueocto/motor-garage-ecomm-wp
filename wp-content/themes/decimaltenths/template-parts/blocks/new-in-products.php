<scrolling-products>
    <div class="row">
        <div class="column medium-6 large-9">
            <h2 class="h3">New In</h2>
        </div>
        <div class="new_in_carousel_buttons column medium-6 large-3">
            <button class="slick-prev prev-new" type="button"><span class="slick-prev-icon" aria-hidden="true"></span><span class="slick-sr-only">Previous</span></button>
            <button class="slick-next next-new" type="button"><span class="slick-next-icon" aria-hidden="true"></span><span class="slick-sr-only">Next</span></button>
        </div>
    </div>
    <div class="new_in_carousel">
        <?php
        if(!empty(get_field('auto_show_new_in_products', 'option'))) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_query' => array( array(
                    'key'     => '_stock_status',
                    'value'   => 'outofstock',
                    'compare' => '!=',
                ) )
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                ?>
                <div class="column">
                    <a href="<?php the_permalink(); ?>">
                        <product-card>
                            <?php echo wp_get_attachment_image( $product->get_image_id(), "large", array( 'loading' => 'lazy')); ?>
                            <div class="product--desc">
                                <p class="product--title"><?php the_title(); ?></p>
                                <p class="product--price">&pound;<?php echo $product->get_price(); ?></p>
                                <p class="product--category">
                                <?php 
                                $terms = get_the_terms( $post->id, 'product_cat' ); 
                                print($terms[0]->name);
                                ?>
                                </p>
                            </div>
                        </product-card>
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_query();
        } else {
            $new_in_products = get_field('new_in_products', 'option');
            if( $new_in_products ): 
                foreach( $new_in_products as $post ): 
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post);
                    global $product;
                ?>
                <div class="column">
                    <a href="<?php the_permalink(); ?>">
                        <product-card>
                            <?php echo wp_get_attachment_image( $product->get_image_id(), "large", array( 'loading' => 'lazy')); ?>
                            <div class="product--desc">
                                <p class="product--title"><?php the_title(); ?></p>
                                <p class="product--price">&pound;<?php echo $product->get_price(); ?></p>
                                <p class="product--category">
                                <?php 
                                $terms = get_the_terms( $post->id, 'product_cat' ); 
                                print($terms[0]->name);
                                ?>
                                </p>
                            </div>
                        </product-card>
                    </a>
                </div>
                <?php
                endforeach;
            endif;
        }
        ?>
    </div>
</scrolling-products>