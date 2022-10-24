<?php
// Get Woocommerce product categories WP_Term objects
$categories = get_terms( ['taxonomy' => 'product_cat'] );
?>

<section class="search-by-car-form">
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <div class="form-row">
            <select class="manufacturer" name="manufacturer">
                <option value="">--Choose Your Manufacturer--</option>
                <?php
                foreach( $categories as $manufacturer ) {
                    if($manufacturer->parent == 0 && ($manufacturer->slug != "spark-plugs" && $manufacturer->slug != "universal" && $manufacturer->slug != "uncategorised")){
                        echo "<option data-catid=\"".$manufacturer->term_id."\" value=\"".$manufacturer->slug."\">".$manufacturer->name."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-row">
            <select class="model" name="model">
                <option value="">--Model--</option>
            </select>
        </div>
        <div class="form-row">
            <input type="submit" value="Search">
            <a class="btn btn-white" href="#">Shop all</a>
        </div>
    </form>
</section>