<brand-logos>
    <?php 
    if( have_rows('brand_logos', 'option') ):
        ?>
        <?php
        while ( have_rows( 'brand_logos', 'option' ) ) : the_row();
        ?>
        <div class="column">
            <?php
            echo wp_get_attachment_image( get_sub_field('logo', 'option'), "large", "", array("class" => "b-logo") );
            ?>
        </div>
        <?php
        endwhile;
        ?>
    <?php
    endif;
    ?>
</brand-logos>