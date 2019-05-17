<?php
/**
 * town functions
 *
 *
 */

defined( 'ABSPATH' ) || exit;

define("DB_STORE_TABLE", "om_store");

define("DB_CONTACT_TABLE", "om_messages");

function om_store_init(){

  //create custom tables
  global $wpdb;

  $charset_collate = $wpdb->get_charset_collate();

  $table_name = $wpdb->prefix . DB_STORE_TABLE;

  $sql = "CREATE TABLE `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(225) DEFAULT NULL,
    `slug` varchar(220) DEFAULT NULL,
    `business_details` varchar(220) DEFAULT NULL,
    `business_code` varchar(220) DEFAULT NULL,
    `tag_line` varchar(220) DEFAULT NULL,
    `shop_front_image_url` varchar(255) DEFAULT NULL,
    `shop_front_video_url` varchar(255) DEFAULT NULL,
    `primary_phone_number` varchar(220) DEFAULT NULL,
    `alternate_phone` varchar(220) DEFAULT NULL,
    `physical_address` varchar(220) DEFAULT NULL,
    `primary_email` varchar(220) DEFAULT NULL,
    `alternate_email` varchar(220) DEFAULT NULL,
    `weekday_opening_hours` varchar(220) DEFAULT NULL,
    `weekday_closing_hours` varchar(220) DEFAULT NULL,
    `weekend_opening_hours` varchar(220) DEFAULT NULL,
    `weekend_closing_hours` varchar(220) DEFAULT NULL,
    `is_pulished` int(11) DEFAULT NULL,
    `is_on_trial` int(11) DEFAULT NULL,
    `is_active_on_chat` int(11) DEFAULT NULL,
    `is_open_on_weekends` int(11) DEFAULT NULL,
    `is_open_on_public_holidays` int(11) DEFAULT NULL,
    `shop_front_template_code` varchar(220) DEFAULT NULL,
    `currency_code` varchar(220) DEFAULT NULL,
    `currency_name` varchar(220) DEFAULT NULL,
    `timezone` varchar(220) DEFAULT NULL,
    `language` varchar(220) DEFAULT NULL,
    `trial_period_end_date` date DEFAULT NULL,
    `is_active` int(11) DEFAULT NULL,
    PRIMARY KEY(id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

}

//CRUD functions



function om_store_create(){

  global $wpdb;
  $table_name = $wpdb->prefix . DB_STORE_TABLE;
  $data = json_decode(file_get_contents('php://input'), true);

  $name = 'Optimus Mini Store';
  $slug = 'optimus-mini-store';
  $is_active = 1;
  $shop_front_image_url = 'default_banner.png';

  $wpdb->query("INSERT INTO $table_name(name, slug, shop_front_image_url, is_active) VALUES('$name','$slug','$shop_front_image_url','$is_active')");

  return ['status'=>'success'];

}

//update category
function om_store_update(){

  global $wpdb;
  $table_name = $wpdb->prefix . DB_STORE_TABLE;
  $data = json_decode(file_get_contents('php://input'), true);

  //$id = $request['id'];
  $id = 1;

  $store = om_store_show();

  isset($data['name']) ? $name = $data['name'] : $name = $store->name;
  isset($data['slug']) ? $slug = $data['slug'] : $slug = $store->slug;
  isset($data['tag_line']) ? $tag_line = $data['tag_line'] : $tag_line = $store->tag_line;
  isset($data['business_code']) ? $business_code = $data['business_code'] : $business_code = $store->business_code;
  isset($data['business_details']) ? $business_details = $data['business_details'] : $business_details = $store->business_details;
  isset($data['primary_phone_number']) ? $primary_phone_number = $data['primary_phone_number'] : $primary_phone_number = $store->primary_phone_number;
  isset($data['alternate_phone']) ? $alternate_phone = $data['alternate_phone'] : $alternate_phone = $store->alternate_phone;
  isset($data['primary_email']) ? $primary_email = $data['primary_email'] : $primary_email = $store->primary_email;
  isset($data['alternate_email']) ? $alternate_email = $data['alternate_email'] : $alternate_email = $store->alternate_email;
  isset($data['physical_address']) ? $physical_address = $data['physical_address'] : $physical_address = $store->physical_address;
  isset($data['weekday_opening_hours']) ? $weekday_opening_hours = $data['weekday_opening_hours'] : $weekday_opening_hours = $store->weekday_opening_hours;
  isset($data['weekday_closing_hours']) ? $weekday_closing_hours = $data['weekday_closing_hours'] : $weekday_closing_hours = $store->weekday_closing_hours;
  isset($data['weekend_opening_hours']) ? $weekend_opening_hours = $data['weekend_opening_hours'] : $weekend_opening_hours = $store->weekend_opening_hours;
  isset($data['weekend_closing_hours']) ? $weekend_closing_hours = $data['weekend_closing_hours'] : $weekend_closing_hours = $store->weekend_closing_hours;
  isset($data['shop_front_image_url']) ? $shop_front_image_url = save_image($data['shop_front_image_url']) : $shop_front_image_url = $store->shop_front_image_url;
  isset($data['shop_front_video_url']) ? $shop_front_video_url = $data['shop_front_video_url'] : $shop_front_video_url = $store->shop_front_video_url;
  isset($data['is_active']) ? $is_active = $data['is_active'] : $is_active = $store->is_active;
  isset($data['is_published']) ? $is_published = $data['is_published'] : $is_published = $store->is_published;
  isset($data['is_on_trial']) ? $is_on_trial = $data['is_on_trial'] : $is_on_trial = $store->is_on_trial;
  isset($data['is_active_on_chat']) ? $is_active_on_chat = $data['is_active_on_chat'] : $is_active_on_chat = $store->is_active_on_chat;
  isset($data['is_open_on_weekends']) ? $is_open_on_weekends = $data['is_open_on_weekends'] : $is_open_on_weekends = $store->is_open_on_weekends;
  isset($data['is_open_on_public_holidays']) ? $is_open_on_public_holidays = $data['is_open_on_public_holidays'] : $is_open_on_public_holidays = $store->is_open_on_public_holidays;
  isset($data['shop_front_template_code']) ? $shop_front_template_code = $data['shop_front_template_code'] : $shop_front_template_code = $store->shop_front_template_code;
  isset($data['trial_period_end_date']) ? $trial_period_end_date = $data['trial_period_end_date'] : $trial_period_end_date = $store->trial_period_end_date;
  isset($data['currency_code']) ? $currency_code = $data['currency_code'] : $currency_code = $store->currency_code;
  isset($data['currency_name']) ? $currency_name = $data['currency_name'] : $currency_name = $store->currency_name;
  isset($data['timezone']) ? $timezone = $data['timezone'] : $timezone = $store->timezone;
  isset($data['language']) ? $language = $data['language'] : $language = $store->language;




  $dt = $wpdb->update(
                $table_name, //table
                array(
                  'name' => $name,
                  'slug'=>$slug,
                  'business_code'=>$business_code,
                  'business_details'=>$business_details,
                  'tag_line'=>$tag_line,
                  'primary_phone_number'=>$primary_phone_number,
                  'alternate_phone'=>$alternate_phone,
                  'primary_email'=>$primary_email,
                  'alternate_email'=>$alternate_email,
                  'physical_address'=>$physical_address,
                  'weekday_opening_hours'=>$weekday_opening_hours,
                  'weekday_closing_hours'=>$weekday_closing_hours,
                  'weekend_opening_hours'=>$weekend_opening_hours,
                  'weekday_closing_hours'=>$weekday_closing_hours,
                  'shop_front_image_url'=>$shop_front_image_url,
                  'shop_front_video_url'=>$shop_front_video_url,
                  'is_active'=>$is_active,
                  'is_pulished'=>$is_published,
                  'is_on_trial'=>$is_on_trial,
                  'is_active_on_chat'=>$is_active_on_chat,
                  'is_open_on_weekends'=>$is_open_on_weekends,
                  'is_open_on_public_holidays'=>$is_open_on_public_holidays,
                  'shop_front_template_code'=>$shop_front_template_code,
                  'trial_period_end_date'=>$trial_period_end_date,
                  'currency_code'=>$currency_code,
                  'currency_name'=>$currency_name,
                  'timezone'=>$timezone,
                  'language'=>$language
                ), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );


        /*
        if($dt == 1){
          return ['status'=>'success'];
        } else {
          return ['status'=>'failed'];
        }
        */
        return $dt;



}



//show store
function om_store_show(){

  global $wpdb;
  $table_name = $wpdb->prefix . DB_STORE_TABLE;
  $data = $wpdb->get_row("SELECT * FROM $table_name  ORDER BY id DESC LIMIT 1");

  return $data;

}


function save_image( $image_url ) {

  require_once ABSPATH . 'wp-admin/includes/file.php';
      $tmp = download_url($image_url);
      // Set variables for storage
      // fix file filename for query strings
      preg_match('/[^\\?]+\\.(jpe?g|jpe|gif|png)\\b/i', $image_url, $matches);
      $file_array['name'] = basename($matches[0]);
      $file_array['tmp_name'] = $tmp;
      // If error storing temporarily, unlink
      if (is_wp_error($tmp)) {
          @unlink($file_array['tmp_name']);
          $file_array['tmp_name'] = '';
      }
      $time = current_time('mysql');
      $file = wp_handle_sideload($file_array, array('test_form' => false), $time);
      if (isset($file['error'])) {
          return new WP_Error('upload_error', $file['error']);
      } else {
        $url = $file['url'];
        return $url;
      }

}

function om_contact_init(){

  //create custom tables
  global $wpdb;

  $charset_collate = $wpdb->get_charset_collate();

  $table_name = $wpdb->prefix . DB_CONTACT_TABLE;

  $sql = "CREATE TABLE `$table_name` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(225) DEFAULT NULL,
    `phone` varchar(220) DEFAULT NULL,
    `email` varchar(220) DEFAULT NULL,
    `subject` varchar(220) DEFAULT NULL,
    `message` text(500) DEFAULT NULL,
    PRIMARY KEY(id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

}

function om_messages_create(){

  global $wpdb;
  $table_name = $wpdb->prefix . DB_CONTACT_TABLE;
  $data = json_decode(file_get_contents('php://input'), true);

  $name = $data['name'];
  $phone = $data['phone'];
  $email = $data['email'];
  $subject = $data['subject'];
  $message = $data['message'];

  $wpdb->query("INSERT INTO $table_name(name, phone, email, subject, message) VALUES('$name','$phone','$email','$subject', '$message')");

  return ['status'=>'success'];

}


function om_messages_list(){

  global $wpdb;
  $table_name = $wpdb->prefix . DB_CONTACT_TABLE;

  $data = $wpdb->get_results("SELECT id,name,phone,email,subject,message FROM $table_name");

  return $data;

}


//SHORTCODES

function display_shop_banner(){

  //get the shop
  $shop = om_store_show();


  return '
    <img src="'. $shop->shop_front_image_url .' " width="100%">
  ';

}

function display_shop_contact_form(){

    ob_start();
    echo '
    <form class="om_contact_form" method="post">
    <div class="om_contact_form_input_group">
    <label>Full Name</label>
    <input type="text" name="name" required />
    </div>

    <div class="om_contact_form_input_group">
    <label>Phone Number</label>
    <input type="text" name="phone_number" required />
    </div>

    <div class="om_contact_form_input_group">
    <label>Email Address</label>
    <input type="text" name="email" required />
    </div>

    <div class="om_contact_form_input_group">
    <label>Subject</label>
    <input type="text" name="subject" required />
    </div>

    <div class="om_contact_form_input_group">
    <label>Messages</label>
    <textarea  name="message" required ></textarea>
    </div>

    <div class="om_contact_form_input_group">
    <button type="submit">Send Message</button>
    </div>

    </form>';

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
