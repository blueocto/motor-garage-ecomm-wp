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
        <div class="row column">[ Affiliate logo's ]</div>
    </brand-logos>

    <scrolling-products>
        <div class="row column">
            <h2>New In</h2>
        </div>
        <div class="row column">
            <p>[ scrolling products - new feed ]</p>
        </div>
    </scrolling-products>

    <category-panels>
        <div class="row column">
            <h2>Browse our categories</h2>
        </div>
        <div class="row column">
            <panel>
                <h3>Engines</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3>Lorum</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3>Ipsum</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3>Hover</h3>
                <p><a href="#">Browse</a></p>
            </panel>
            <panel>
                <h3>Amet</h3>
                <p><a href="#">Browse</a></p>
            </panel>
        </div>
    </category-panels>

    <scrolling-products>
        <div class="row column">
            <h2>Popular</h2>
        </div>
        <div class="row column">
            <p>[ scrolling products - popular ]</p>
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
            <h2>Latest Videos <a href="#">View All</a></h2>
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