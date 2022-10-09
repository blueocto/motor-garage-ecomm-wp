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

    <?php get_template_part( 'template-parts/blocks/brand-logos' ); ?>

    <?php get_template_part( 'template-parts/blocks/new-in-products' ); ?>

    <?php get_template_part( 'template-parts/blocks/category-panels' ); ?>

    <?php get_template_part( 'template-parts/blocks/popular-products' ); ?>

    <?php get_template_part( 'template-parts/blocks/service-highlight' ); ?>

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