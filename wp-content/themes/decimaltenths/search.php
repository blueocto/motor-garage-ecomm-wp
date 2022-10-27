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
    <h1>Search for &ldquo;<?php echo esc_html( $manufacturer ); ?> (<?php echo esc_html( $model ); ?>)&rdquo;</h1>
    <?php
    $category = get_term_by( 'slug', ''.$model.'', 'product_cat' );

    $args = array('post_type' => 'product', 'status' => 'publish', 'posts_per_page' => -1, 'product_cat' => $model);
    $productSearch = get_posts($args);

    $brandsArray = array();
    $tagsArray = array();
    $priceArray = array();
    foreach($productSearch as $post) : setup_postdata($post);

        $product = wc_get_product( $post->ID );
        $priceArray[] = $product->get_price();

        $brands = get_the_terms( $post->ID, 'pwb-brand' );
        $tags = get_the_terms( $post->ID, 'product_tag' );
        if (is_array($brands)) {
            foreach($brands as $brand){
                $brandsArray[] = $brand->slug;
            }
        }
        if (is_array($tags)) {
            foreach($tags as $tag){
                $tagsArray[] = $tag->slug;
            }
        }
        wp_reset_postdata(); 
    endforeach;

    sort($priceArray);
    $filterPriceArray = array_values(array_filter($priceArray));
    ?>
    <input type="hidden" class="brands_array" value='<?php print(json_encode(array_values(array_unique($brandsArray)))); ?>' />
    <input type="hidden" class="tags_array" value='<?php print(json_encode(array_values(array_unique($tagsArray)))); ?>' />
    <input type="hidden" class="cheapest_price" value='<?php print($filterPriceArray[0]); ?>' />
    <input type="hidden" class="expensive_price" value='<?php print($filterPriceArray[count($filterPriceArray)-1]); ?>' />
    <?php echo do_shortcode("[woof_products per_page=24 columns=3 is_ajax=1 taxonomies=product_cat:$category->term_id]"); ?>
</div>

<?php get_footer(); ?>