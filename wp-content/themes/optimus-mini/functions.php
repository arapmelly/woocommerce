<?php

function customtheme_add_woocommerce_support() {
	
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'customtheme_add_woocommerce_support' );




function my_function_custom_archive_description() {
	
	$new_description = '<p>Welcome to my shop, please be generous and buy many things, thank you.</p>';
	return $new_description;
}

// Add the action
add_action('woocommerce_archive_description', 'my_function_custom_archive_description');



function get_percentage_discount($product){

    $sale_price = $product->get_sale_price();
    $regular_price = $product->get_regular_price();

    $percentage = round((($regular_price - $sale_price)/ $regular_price) * 100);

    return $percentage.' %';
  }


  function get_total_orders($status){

    $order_count = wc_orders_count($status);

    return $order_count;
  }

  
?>