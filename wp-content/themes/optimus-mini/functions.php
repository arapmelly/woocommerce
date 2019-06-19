<?php

function add_theme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );
   
  
    wp_register_script('my_amazing_script', get_template_directory_uri('js/main.js', __FILE__), array('jquery'),'1.1', true);
 
    wp_enqueue_script('my_amazing_script');

    
   
      
  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


  function get_percentage_discount($product){

    $sale_price = $product->get_sale_price();
    $regular_price = $product->get_regular_price();

    $percentage = round((($regular_price - $sale_price)/ $regular_price) * 100);

    return $percentage.' %';
  }

?>