<?php

//include 'functions.php

global $woocommerce;

$product_id = $_POST['productId'];

$variation = $_POST['variation'];

$attribute = $_POST['attribute'];

$variationPrice = $_POST['variationPrice'];

WC()->cart->add_to_cart($product_id);

//post_order($product_id, $variation, $attribute, $variationPrice);

?>