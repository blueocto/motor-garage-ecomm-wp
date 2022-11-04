<brand-logos>
    <?php 
    if( have_rows('brand_logos', 'option') ):
        ?>
        <?php
        while ( have_rows( 'brand_logos', 'option' ) ) : the_row();
        ?>
        <div class="column">
            <img class="b-logo" src="<?php print(get_sub_field("logo", 'option')); ?>" alt="Car logo" />
        </div>
        <?php
        endwhile;
        ?>
    <?php
    endif;
    ?>
</brand-logos>