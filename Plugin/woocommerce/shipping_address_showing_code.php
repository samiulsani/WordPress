Woocommerce my account page order section shipping address not showing problem fix:
Goto theme editor > function.php

add_filter( 'woocommerce_order_needs_shipping_address', '__return_true' );
