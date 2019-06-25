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
	add_action( 'woocommerce_archive_description', 'my_function_custom_archive_description' );


	function get_percentage_discount( $product ) {

		$sale_price    = $product->get_sale_price();
		$regular_price = $product->get_regular_price();

		$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

		return $percentage . ' %';
	}


	function get_total_orders( $status ) {

		$order_count = wc_orders_count( $status );

		return $order_count;
	}


	/**
	 * Enqueue scripts and styles.
	 */
	function optimus_mini_scripts() {
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array( 'js' ), null, true );
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugin.js', 'jquery', true );
		wp_enqueue_script( 'main', get_template_directory_uri() . '/js/scripts.js', 'plugins', true );
	}

	add_action( 'wp_enqueue_scripts', 'optimus_mini_scripts' );


?>