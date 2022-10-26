<?php
/**
 * The Search template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Dosth
 */
get_header();

$manufacturer = $_GET['manufacturer'] ?? '';
$model = $_GET['model'] ?? '';
?>

<div class="archive">
    <input type="hidden" class="model_search" value="<?php print($model); ?>" />
    <h1>Search for &ldquo;<?php echo esc_html( $_GET['manufacturer'] ); ?> (<?php echo esc_html( $model ); ?>)&rdquo;</h1>
    <?php
    $category = get_term_by( 'slug', ''.$model.'', 'product_cat' );
    ?>
    <?php echo do_shortcode("[woof_products per_page=24 columns=3 is_ajax=1 taxonomies=product_cat:$category->term_id]"); ?>
</div>

<?php get_footer(); ?>