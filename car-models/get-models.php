<?php
header("Expires: Thu, 1 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require_once dirname( __DIR__ ) . '/wp-load.php';

header('Content-Type: application/json');
try {

    $jsonData = "[";

    $categories = get_terms( ['taxonomy' => 'product_cat'] );
    
    if(empty($categories)){

    } else {
        foreach ( $categories as $models ) {
            if($models->parent != 0 && ($models->parent != "15723" && $models->parent != "15235" && $models->parent != "10705" && $models->parent != "14406" && $models->parent != "14599" && $models->parent != "14421" && $models->parent != "3735")){
                $jsonData .= "{\"name\": \"".$models->name."\", \"slug\": \"".$models->slug."\", \"parent\": \"".$models->parent."\", \"id\": \"".$models->term_id."\"},";
            }
        }
    }

    $jsonData .= "]";
    $jsonData = str_replace('},]', '}]', $jsonData);
    $data2 = "";
    $data2 = json_decode($jsonData);

    print(json_encode($data2, JSON_PRETTY_PRINT));

    $fp = fopen(ABSPATH.'/car-models/models.json', 'w');
    fwrite($fp, json_encode($data2, JSON_PRETTY_PRINT));
    fclose($fp);

} catch (\Exception $ex) {
    die($ex);
}
?>