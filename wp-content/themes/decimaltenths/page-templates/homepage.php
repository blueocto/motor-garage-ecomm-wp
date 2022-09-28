<?php
/**
* Template Name: Homepage
*/
get_header(); ?>

<main id="main" class="main">

    <hero-car-filters>
        <h2>Quality Parts</h2>
        <p>For your beloved Audi, SEAT, VW and more&hellip;</p>
        <?php get_template_part( 'template-parts/search-by-car' ); ?>
    </hero-car-filters>

    <brand-logos>
        <p>[ Affiliate logo's ]</p>
    </brand-logos>

    <scrolling-products>
        <h2>New In</h2>
        <div>[ scrolling products - new feed ]</div>
    </scrolling-products>

    <category-panels>
        <h2>Browse our categories</h2>
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
    </category-panels>

    <scrolling-products>
        <h2>Popular</h2>
        <div>[ scrolling products - popular ]</div>
    </scrolling-products>

    <service-highlight>
        <h2>Custom Tuning</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis commodo pulvinar lacus, et porta diam rutrum non.</p>
        <p><a href="#">View services</a></p>
    </service-highlight>

    <video-feed>
        <h2>Latest Videos <a href="#">View All</a></h2>
        <p>[ Youtube Channel Feed ]</p>
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