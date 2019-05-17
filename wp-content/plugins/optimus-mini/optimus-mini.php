<?php
/**
 *
 * @version 1.0.0
 */
/*
Plugin Name: Optimus Mini
Plugin URI: http://optimus.site
Description: Optimus Mini E-Commerce Manager
Author: Jacob Chumo
Version: 1.0.0
Author URI: http://arapmelly.co.ke/
License: GPLv2
Text Domain: om-manager
*/

defined('ABSPATH') or die('you cant access this file');

include_once dirname( __FILE__ ) . '/functions/store.php';

//activation
register_activation_hook(__FILE__,'om_activate');

//deactivation
register_deactivation_hook(__FILE__, 'om_deactivate');

function hello_world(){

  return '<p>Hello World</p>';
}
function om_activate(){


  //activate store
  om_store_init();
  om_store_create();
  om_contact_init();



}


//SHORTCODES

add_shortcode('shop-banner', 'display_shop_banner');
add_shortcode('shop-contact-form', 'display_shop_contact_form');


//REST API Definitions

add_action('rest_api_init', function() {


    //store rest endpoints
    register_rest_route('om/v1/store', 'show', array('methods'=>'GET', 'callback'=>'om_store_show'));
    //register_rest_route('om/v1/store', 'create', array('methods'=>'POST', 'callback'=>'om_store_create'));
    register_rest_route('om/v1/store', 'update', array('methods'=>'POST', 'callback'=>'om_store_update'));
    //register_rest_route('om/v1/store', 'delete/(?P<id>[\d]+)', array('methods'=>'POST', 'callback'=>'om_store_delete'));

    register_rest_route('om/v1/messages', 'create', array('methods'=>'POST', 'callback'=>'om_messages_create'));
    register_rest_route('om/v1/messages', 'list', array('methods'=>'GET', 'callback'=>'om_messages_list'));



});
