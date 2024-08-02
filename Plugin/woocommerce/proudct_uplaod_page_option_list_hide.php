Hide option add product data select item in woocommerce product type:


add_filter( 'product_type_selector', 'remove_product_types' );

function remove_product_types( $types ){
    unset( $types['grouped'] );
    unset( $types['external'] );

    return $types;
}


Goto theme editor>function.php and pastle
