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

    <?php get_template_part( 'template-parts/blocks/new-in-products' ); ?>

    <category-panels>
        <h2 class="visuallyhidden">Browse our categories</h2>
        <div class="row">
            <panel class="column">
                <h3 class="h4">Engines</h3>
                <p><a class="arrow-right" href="#">Browse</a></p>
                <picture class="picture">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/dist/img/green-car-bg.jpg'; ?>" alt="" />
                </picture>
            </panel>
            <panel class="column">
                <h3 class="h4">Lorum</h3>
                <p><a class="arrow-right" href="#">Browse</a></p>
                <picture class="picture">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/dist/img/green-car-bg.jpg'; ?>" alt="" />
                </picture>
            </panel>
            <panel class="column">
                <h3 class="h4">Ipsum</h3>
                <p><a class="arrow-right" href="#">Browse</a></p>
                <picture class="picture">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/dist/img/green-car-bg.jpg'; ?>" alt="" />
                </picture>
            </panel>
            <panel class="column">
                <h3 class="h4">Hover</h3>
                <p><a class="arrow-right" href="#">Browse</a></p>
                <picture class="picture">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/dist/img/green-car-bg.jpg'; ?>" alt="" />
                </picture>
            </panel>
        </div>
    </category-panels>

    <?php get_template_part( 'template-parts/blocks/popular-products' ); ?>

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