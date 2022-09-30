<?php
/**
* Template Name: Homepage
*/
get_header(); ?>

<main id="main" class="main">
    <hero-car-filters>
        <hero-inner>
            <hero-content>
                <h2 class="hero--heading">Quality Parts</h2>
                <p class="hero--subheading">For your beloved Audi, SEAT, VW and more&hellip;</p>
                <?php get_template_part( 'template-parts/search-by-car' ); ?>
            </hero-content>
        </hero-inner>
    </hero-car-filters>

    <brand-logos>
        <div class="column">
            <img class="b-logo" src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/audi-white.svg'; ?>" alt="" />
        </div>
        <div class="column">
            <img class="b-logo" src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/seat-white.svg'; ?>" alt="" />
        </div>
        <div class="column">
            <img class="b-logo" src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/skoda-white.svg'; ?>" alt="" />
        </div>
        <div class="column">
            <img class="b-logo" src="<?php echo get_stylesheet_directory_uri() . '/dist/svg/volkswagen-white.svg'; ?>" alt="" />
        </div>
    </brand-logos>

    <scrolling-products>
        <div class="row column">
            <h2 class="h3">New In</h2>
        </div>
        <div class="row">
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
        </div>
    </scrolling-products>

    <category-panels>
        <h2 class="visuallyhidden">Browse our categories</h2>
        <div class="row column">
            <panel>
                <h3 class="h4">Engines</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3 class="h4">Lorum</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3 class="h4">Ipsum</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3 class="h4">Hover</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3 class="h4">Amet</h3>
                <p><a href="#">Browse</a></p>
            </panel>
        </div>
    </category-panels>

    <scrolling-products>
        <div class="row column">
            <h2 class="h3">Popular</h2>
        </div>
        <div class="row">
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
            <div class="column small-12 medium-6 large-3">
                <product-card>
                    <img class="product--img" src="<?php echo get_stylesheet_directory_uri() . '/dist/img/placeholder-product.png'; ?>" alt="" />
                    <div class="product--desc">
                        <p class="product--title">Genuine 2.0 TFSI 1.8T Stroker Crankshaft</p>
                        <p class="product--price">&pound;1,324.99</p>
                        <p class="product--category">Crankshafts</p>
                    </div>
                </product-card>
            </div>
        </div>
    </scrolling-products>

    <service-highlight>
        <div class="row column">
            <h2>Custom Tuning</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis commodo pulvinar lacus, et porta diam rutrum non.</p>
            <p><a href="#">View services</a></p>
        </div>
    </service-highlight>

    <video-feed>
        <div class="row column">
            <h2 class="h3">Latest Videos <p><a href="#">View All</a></p></h2>
        </div>
        <div class="row column">
            <p>[ Youtube Channel Feed ]</p>
        </div>
    </video-feed>

	<?php /*if ( have_posts() ) : ?>
	
		<?php while ( have_posts() ) : the_post(); ?>	
			<?php get_template_part( 'template-parts/content-page' ); ?>
		<?php endwhile; ?>

	<?php else : ?>
			
		<?php get_template_part( 'template-parts/content-none' ); ?>

	<?php endif; // End have_posts() check. */ ?>
</main>

<?php get_footer();