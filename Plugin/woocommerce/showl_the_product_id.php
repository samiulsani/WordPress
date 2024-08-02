Show woocommerce product id on any page:
Download Code snippet plugin.
Goto > Add Html code and pastle code.

<?php
global $product;
$id = $product->get_id();
echo 'Product Id: ' . $id;
?>

Use shortcode for showing product id any page.
