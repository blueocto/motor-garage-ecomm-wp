<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$searchform_unique_id = wp_unique_id( 'search-form-' );

$searchform_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';

?>
<form class="searchform" role="search" <?php echo $searchform_aria_label; ?> method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="searchform--label" for="<?php echo esc_attr( $searchform_unique_id ); ?>"><?php _e( 'Search the website...', 'decimaltenths' ); ?></label>
    <div class="searchform--wrap">
        <input class="searchform--input" type="search" id="<?php echo esc_attr( $searchform_unique_id ); ?>" value="<?php echo get_search_query(); ?>" name="s" placeholder="Search the website" onkeyup="buttonUp();" />
        <input class="searchform--submit" type="submit" value="Search" />
     </div>
</form>