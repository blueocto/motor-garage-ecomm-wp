<?php 
    echo '
    <div class="primary-menu-container">
        <ul id="primary-menu-list" class="menu primary--menu">
            <li id="menu-item-163427" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-163427"><a href="'.home_url().'">Home</a></li>
            <li id="menu-item-163478" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item current_page_item menu-item-163478"><a href="'.home_url().'/shop/" aria-current="page">Shop</a></li>
            <li class="menu-item menu-item-has-children">
                <a href="#">Shop by Vehicle</a>
                <button class="sub-menu-toggle" aria-expanded="false" onclick="twentytwentyoneExpandSubMenu(this)"><span class="visuallyhidden">Open menu</span></button>
                <ul class="sub-menu vehicles">
    ';

    $taxonomy = 'product_cat'; 
    $orderby = 'name'; 
    $show_count = 0; // 1 for yes, 0 for no 
    $pad_counts = 0; // 1 for yes, 0 for no 
    $hierarchical = 1; // 1 for yes, 0 for no 
    $title = ''; 
    $empty = 0; 
    $args = array( 
        'taxonomy' => $taxonomy, 
        'orderby' => $orderby, 
        'show_count' => $show_count, 
        'pad_counts' => $pad_counts, 
        'hierarchical' => $hierarchical, 
        'title_li' => $title, 
        'hide_empty' => $empty
    );

    $all_categories = get_categories( $args ); 

    foreach ($all_categories as $cat) { 

        if($cat->category_parent == 0 && ($cat->term_id == 18087 || $cat->term_id == 18089 || $cat->term_id == 18090 || $cat->term_id == 18088)){

            $category_id = $cat->term_id; 
            $term_link = get_term_link( $cat );

            echo '
            <li class="level-1 menu-item menu-item-has-children">
                <a href="' . esc_url( $term_link ) . '">
            ';
            echo $cat->name; 
            echo '
                </a>
                <ul class="sub-sub-menu">
            ';

            $args2 = array( 
                'taxonomy' => $taxonomy, 
                'child_of' => 0, 
                'parent' => $category_id, 
                'orderby' => $orderby, 
                'show_count' => $show_count, 
                'pad_counts' => $pad_counts, 
                'hierarchical' => $hierarchical, 
                'title_li' => $title, 
                'hide_empty' => $empty
            ); 
            $sub_cats = get_categories( $args2 ); 
            
			if($sub_cats) { 

                foreach($sub_cats as $sub_category) { 

                    $term_link = get_term_link( $sub_category );
                                            
                    echo '
                        <li class="level-2 menu-item menu-item-has-children">
                            <a href="' . esc_url( $term_link ) . '">
                    ';
                    echo $sub_category->cat_name;
                    echo '
                            </a>
                        </li>
                    ';
                
                } // end foreach
            
            } // endif

            echo '
                </ul><!-- // sub-sub-menu -->
            </li>
            ';

        } //endif
    } //end foreach
    
    wp_reset_query(); 

    echo '
                </ul><!-- // sub-menu -->
            </li>
            <li class="menu-item menu-item-has-children">
                <a href="#">Brands</a>
                <button class="sub-menu-toggle" aria-expanded="false" onclick="twentytwentyoneExpandSubMenu(this)"><span class="visuallyhidden">Open menu</span></button>
                <ul class="sub-menu brands">';

                $args_brands = array( 
                    'taxonomy' => "pwb-brand", 
                    'orderby' => 'name', 
                    'show_count' => 0, 
                    'pad_counts' => 0, 
                    'hierarchical' => 1, 
                    'hide_empty' => 0
                );
            
                $all_brands = get_categories( $args_brands ); 

                foreach ($all_brands as $brand) { 
                    $brand_id = $brand->term_id; 
                    $term_link = get_term_link( $brand );

                    echo '
                    <li class="level-1 menu-item">
                        <a href="' . esc_url( $term_link ) . '">
                    ';
                    echo $brand->name; 
                    echo '</a></li>';
                }
            echo '</ul>
            </li>
        </ul>
    </div>
    ';
?>