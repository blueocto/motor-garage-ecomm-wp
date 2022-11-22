<?php
/**
* Template Name: Homepage
*/
get_header(); ?>

<main id="main" class="main">
    <hero-car-filters>
        <hero-images>
            <div class="hero_image_carousel">
                <?php 
                if( have_rows('home_hero_carousel', 'option') ):
                    ?>
                    <?php
                    while ( have_rows( 'home_hero_carousel', 'option' ) ) : the_row();
                    ?>
                        <?php print(wp_get_attachment_image( get_sub_field("image", 'option'), "large")); ?>
                    <?php
                    endwhile;
                    ?>
                <?php
                endif;
                ?>
            </div>
        </hero-images>
        
        <hero-inner>
            <hero-content>
                <h2 class="hero--heading"><?php print(get_field("home_hero_heading", 'option')); ?></h2>
                <p class="hero--subheading"><?php print(get_field("home_hero_sub_heading", 'option')); ?></p>
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
            <h2 class="h3">Latest Videos <p><a href="https://www.youtube.com/channel/UCIipR1T51cr5fsfCSRX_kgA" target="_blank">View All</a></p></h2>
        </div>
        <div class="row column">
            <?php echo do_shortcode("[youtube-feed feed=1]"); ?>
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