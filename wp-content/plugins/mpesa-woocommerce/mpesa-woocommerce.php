<?php
/*
Plugin Name: Optimus Mini - Lipa na Mpesa
Plugin URI: http://www.optimus.site/
Description: WooCommerce custom payment gateway integration for Lipa Na Mpesa Push STK provided by Safaricom Ltd.
Author: Jacob Chumo
Version: 1.0.0
Author URI: http://arapmelly.co.ke/
License: GPLv2
*/

defined('ABSPATH') or die('you cant access this file');


//activation
register_activation_hook(__FILE__, 'init_mpesa');

function init_mpesa(){

  //create custom tables
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'lipa_na_mpesa_payments';
  $sql = "CREATE TABLE `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `checkout_request_id` varchar(255) DEFAULT NULL,
    `merchant_request_id` varchar(255) DEFAULT NULL,
    `transaction_date` date DEFAULT NULL,
    `transaction_amount` float(8,2) DEFAULT NULL,
    `mpesa_receipt_number` varchar(255) DEFAULT NULL,
    `transaction_phone` varchar(255) DEFAULT NULL,
    `order_id` int(11) DEFAULT NULL,
    `transaction_status` varchar(255) DEFAULT NULL,
    PRIMARY KEY(id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

}

add_action('plugins_loaded', 'init_lipa_na_mpesa');

function init_lipa_na_mpesa(){
  //check if WooCommerce is intsalled and activated
  if( ! class_exists('WC_Payment_Gateway')) return;
  include_once('lipa_na_mpesa.php');


}


/**
 * Add Gateway class to all payment gateway methods
 */
function woo_add_gateway_class( $methods ) {
  
	$methods[] = 'Lipa_Na_Mpesa';
	return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'woo_add_gateway_class' );
