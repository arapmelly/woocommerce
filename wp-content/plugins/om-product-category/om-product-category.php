<?php
/**
 * @package OM-Category
 * @version 1.0.0
 */
/*
Plugin Name: OM-Category Manager
Plugin URI: http://optimus.site
Description: Optimus mini products categories manager
Author: Jacob Chumo
Version: 1.0.0
Author URI: http://arapmelly.co.ke/
License: GPLv2
Text Domain: om-product-category
*/

//validat path and restrict direct access

defined('ABSPATH') or die('you cant access this file, says the developer');

//register activation hook
register_activation_hook(__FILE__, 'om_category_plugin_activation');

function om_category_plugin_activation(){
  //create a custom table
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'om_product_categories';
  $sql = "CREATE TABLE `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `icon` varchar(220) DEFAULT NULL,
    `name` varchar(220) DEFAULT NULL,
    PRIMARY KEY(id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

}

//create new Category
function om_category_create(){

  global $wpdb;
  $table_name = $wpdb->prefix . 'om_product_categories';
  $data = json_decode(file_get_contents('php://input'), true);

  $icon = $data['icon'];
  $name = $data['name'];

  $wpdb->query("INSERT INTO $table_name(icon,name) VALUES('$icon','$name')");

  return $data;

}


//list categories
function om_category_list(){
  global $wpdb;
  $table_name = $wpdb->prefix . 'om_product_categories';

  $data = $wpdb->get_results("SELECT icon,name FROM $table_name");

  return $data;
}


//update category
function om_category_update($request){

  global $wpdb;
  $table_name = $wpdb->prefix . 'om_product_categories';
  $data = json_decode(file_get_contents('php://input'), true);

  $id = $request['id'];
  $icon = $data['icon'];
  $name = $data['name'];

  //$wpdb->query("INSERT INTO $table_name(icon,name) VALUES('$icon','$name')");
  $wpdb->update(
                $table_name, //table
                array('name' => $name, 'icon'=>$icon), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
  $data = $wpdb->get_results("SELECT icon,name FROM $table_name WHERE id=$id");

  return $data;

}


//update category
function om_category_delete($request){

  global $wpdb;
  $table_name = $wpdb->prefix . 'om_product_categories';

  $id = $request['id'];

  $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));


  return true;

}

add_action('rest_api_init', function() {

    register_rest_route('om/v1/categories', 'create', array('methods'=>'POST', 'callback'=>'om_category_create'));
    register_rest_route('om/v1/categories', 'list', array('methods'=>'GET', 'callback'=>'om_category_list'));
    register_rest_route('om/v1/categories', 'update/(?P<id>[\d]+)', array('methods'=>'POST', 'callback'=>'om_category_update'));
    register_rest_route('om/v1/categories', 'delete/(?P<id>[\d]+)', array('methods'=>'POST', 'callback'=>'om_category_delete'));
});


//create shortcodes
function om_category_list_shortcode($atts, $content = null){
  ob_start();

  extract( shortcode_atts ( array (
    'type'=>'list',
    'class_name'=>'sitenav'
  ), $atts));


  $categories = om_category_list();
  $className = $atts['class_name'];


  if($atts['type'] == 'list' ){

    if ( is_array( $categories ) || is_object( $categories ) ) {

      echo ('<div class="'.$className.'">');
      echo ('<ul>');
        foreach ( $categories as $category ) {
          echo('<li>'. $category->name . '</li>');
        }
      echo ('</ul>');
      echo ('</div>');
    } else {
      echo $categories;
    }

  }


  if($atts['type'] == 'menu' ){

    if ( is_array( $categories ) || is_object( $categories ) ) {

      echo ('<div class="'.$className.'">');
      echo ('<ul>');
        foreach ( $categories as $category ) {
          echo('<li><a href="#">'. $category->name . '</a></li>');
        }
      echo ('</ul>');
      echo ('</div>');
    } else {
      echo $categories;
    }


  }




$output = ob_get_contents();
ob_end_clean();

return $output;


}

add_shortcode('om-categories', 'om_category_list_shortcode');
