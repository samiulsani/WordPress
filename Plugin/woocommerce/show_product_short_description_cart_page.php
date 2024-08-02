Show product short description on cart page also hide on product page:
// show product short description in cart page

add_filter( 'woocommerce_get_item_data', 'wc_checkout_description_so_15127954', 10, 2 );
function wc_checkout_description_so_15127954( $other_data, $cart_item ) {
    $post_data = get_post( $cart_item['product_id'] );
    $other_data[] = array( 'name' =>  $post_data->post_excerpt );
    return $other_data;
}

// hide product short description in product page

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
function woocommerce_template_single_excerpt() {
        return;
}


Goto theme editor > select theme > function.php > pastle code.


