<?php

// show featured images in dashboard
add_image_size( 'blueocto-admin-post-featured-image', 100, 100, false );

// Add the posts and pages columns filter. They both use the same function.
add_filter('manage_posts_columns', 'blueocto_add_post_admin_thumbnail_column', 2);
add_filter('manage_pages_columns', 'blueocto_add_post_admin_thumbnail_column', 2);

// Add the column
function blueocto_add_post_admin_thumbnail_column($blueocto_columns){
    $blueocto_columns['blueocto_thumb'] = __('Featured Image');
    return $blueocto_columns;
}

// Manage Post and Page Admin Panel Columns
add_action('manage_posts_custom_column', 'blueocto_show_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'blueocto_show_post_thumbnail_column', 5, 2);

// Get featured-thumbnail size post thumbnail and display it
function blueocto_show_post_thumbnail_column($blueocto_columns, $blueocto_id){
    switch($blueocto_columns){
        case 'blueocto_thumb':
        if( function_exists('the_post_thumbnail') ) {
            echo the_post_thumbnail( 'blueocto-admin-post-featured-image' );
        }
        else
            echo 'hmm... your theme doesn\'t support featured image...';
        break;
    }
}
