Hide option from woocommerce my account page:

/**
 * @snippet       Hide Dashboard on the My Account Page
  */
add_filter( 'woocommerce_account_menu_items', 'njengah_remove_my_account_dashboard' );
function njengah_remove_my_account_dashboard( $menu_links ){

            unset( $menu_links['dashboard'] );

            return $menu_links;
 }


 