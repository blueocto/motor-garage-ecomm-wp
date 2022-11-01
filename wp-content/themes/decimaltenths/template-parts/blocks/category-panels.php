<category-panels>
    <h2 class="visuallyhidden">Browse our categories</h2>
    <div class="row">
        <?php 
        if( have_rows('category_panel', 'option') ):
            ?>
            <?php
            while ( have_rows( 'category_panel', 'option' ) ) : the_row();
            ?>
                <panel class="column">
                    <h3 class="h4"><?php print(get_sub_field("name", 'option')); ?></h3>
                    <p>
                        <a href="<?php print(get_sub_field("link", 'option')); ?>">
                            <span class="arrow-right">Browse</span>
                            <span class="picture">
                                <?php print(wp_get_attachment_image( get_sub_field("image", 'option'), "large", array( 'loading' => 'lazy'))); ?>
                            </span>
                        </a>
                    </p>
                </panel>
            <?php
            endwhile;
            ?>
        <?php
        endif;
        ?>
    </div>
</category-panels>