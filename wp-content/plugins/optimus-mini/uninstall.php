<?php
/**
* Trigger this file on plugin uninstall
*
* @package OptimusMini
*/

if( ! defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

//clear database stored data


//access the database via SQL
global $wpdb;

//drop optimus mini custom tables

//$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'om-menu'" );
//$wpdb->query( " DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
//$wpdb->query( " DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
