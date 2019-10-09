<?php

function customtheme_add_woocommerce_support() {

	add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'customtheme_add_woocommerce_support');

function my_function_custom_archive_description() {

	$new_description = '<p>Welcome to my shop, please be generous and buy many things, thank you.</p>';
	return $new_description;
}

// Add the action
add_action('woocommerce_archive_description', 'my_function_custom_archive_description');

function get_product_categories() {

	$categories = get_terms(['taxonomy' => 'product_cat']);

	return $categories;
}

function get_percentage_discount($product) {

	$sale_price = $product->get_sale_price();
	$regular_price = $product->get_regular_price();

	$percentage = round((($regular_price - $sale_price) / $regular_price) * 100);

	return $percentage . ' %';
}

function get_total_orders($status) {

	$order_count = wc_orders_count($status);

	return $order_count;
}

function get_product_primary_image($product) {

	if (get_post_type($product->get_id()) == 'product_variation') {

		$images = get_post_meta($product->get_parent_id(), '_product_primary_full_cdn_image', true);

	} else {

		$images = get_post_meta($product->get_id(), '_product_primary_full_cdn_image', true);

	}

	$images = json_decode($images);

	return $images;
}

function get_blog_primary_image() {

	$images = get_option('blogprimaryimage');

	$images = json_decode($images);

	return $images;
}

function get_product_images($product) {

	$images = get_post_meta($product->get_id(), '_product_full_cdn_images', true);

	$images = json_decode($images);

	return $images;
}

function get_reviews_count() {

	return get_comments(array(
		'status' => 'approve',
		'type' => 'review',
		'count' => true,
	));
}

function get_prod_attributes($product) {

	$formatted_attributes = array();

	$attributes = $product->get_attributes();

	foreach ($attributes as $attr => $attr_deets) {

		$attribute_label = wc_attribute_label($attr);

		if (isset($attributes[$attr]) || isset($attributes['pa_' . $attr])) {

			$attribute = isset($attributes[$attr]) ? $attributes[$attr] : $attributes['pa_' . $attr];

			if ($attribute['is_taxonomy']) {

				$formatted_attributes[$attribute_label] = implode(', ', wc_get_product_terms($product->get_id(), $attribute['name'], array('fields' => 'names')));

			} else {

				$formatted_attributes[$attribute_label] = $attribute['value'];
			}

		}
	}

//print_r($formatted_attributes);

	return $formatted_attributes;
}

function get_product_category_names($product) {
	if (isset($product)) {
		$terms = get_the_terms($product->get_id(), 'product_cat');
		$product_cat = array();

		foreach ($terms as $term) {
			$product_cat[] .= $term->name;
		}

		return implode(', ', $product_cat);
	} else {
		return "";
	}
}

/*
function layout_cart_page() {

echo '<span style="margin-top: 200px"> <p>This is the cart page</p></span>';
}

add_action('woocommerce_before_cart', 'layout_cart_page');
 */

//	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
//	add_action('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);

add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function custom_override_checkout_fields($fields) {
	//($fields['billing']['billing_last_name']);
	unset($fields['billing']['billing_company']);
	//unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
	//unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_state']);
	//unset($fields['billing']['billing_phone']);
	unset($fields['order']['order_comments']);
	//unset($fields['billing']['billing_email']);
	//unset($fields['account']['account_username']);
	//unset($fields['account']['account_password']);
	//unset($fields['account']['account_password-2']);

	//$fields['billing']['billing_email']['required'] = false;
	return $fields;
}

add_action('woocommerce_order_details_after_customer_details', 'custom_process_order', 10, 1);

function custom_process_order($order_id) {
	$order = new WC_Order($order_id);

	$order_number = $order->get_id();

	//$phone = '254728510140';

	$phone = get_option('blogprimaryphonenumber');

	$text = 'Hi! I have made an order on your shop. My order number is ' . $order_number . ' Kindly update when this will be delivered.';

	$link = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . $text;

	?>

	<button><a href="<?php echo $link; ?>" target="_blank"> Send Whatsapp Message</a></button>

	<?php

}

function contact_seller_link($product) {

	$phone = get_option('blogprimaryphonenumber');

	$text = 'Hi! I would like to enquire about this product -' . $product->get_name() . ' Kindly get back to me.';

	$link = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . $text;

	return $link;

}

function get_product_variations($product) {

	$variations = get_post_meta($product->get_id(), '_product_variations', true);

	return $variations;

}

//add_action('woocommerce_update_product', 'create_prod_attributes', 10, 1);

//add_action('edit_post', 'auto_create_var', 10, 1);
//add_action('updated_post_meta', 'auto_create_var', 10, 1);

//add_action('added_post_meta', 'auto_create_var');
//add_action('updated_post_meta', 'auto_create_var');

function auto_create_var($post_id) {
	//check if post type is product
	if (get_post_type($post_id) == 'product') {
		$product = wc_get_product($post_id);

		create_prod_attributes($product);

	}
}

function create_prod_attributes($product) {

	//$product = wc_get_product($product_id);

	//get the product variations and create them as attributes
	$variations = json_decode(get_product_variations($product));

	if (!empty($variations)) {

		wp_set_object_terms($product->get_id(), 'variable', 'product_type');

		$attr_label = 'variations';
		$attr_slug = sanitize_title($attr_label);

		foreach ($variations as $variation) {
			$variants[] = $variation->name;

		}

		$var_string = implode('|', $variants);

		$attribute_array[$attr_slug] = array(
			'name' => $attr_label,
			'value' => $var_string,
			'is_visible' => '1',
			'is_variation' => '1',
			'is_taxonomy' => '0',
		);

		update_post_meta($product->get_id(), '_product_attributes', $attribute_array);

	}

}

function create_var($product) {

	//delete existing variations and product attributes
	if ($product->is_type('variable')) {

		$childs = $product->get_children();

		if (!empty($childs)) {

			foreach ($childs as $child_id) {

				wp_delete_post($child_id);

			}
		}

		wp_set_object_terms($product->get_id(), 'simple', 'product_type');
		//delete_post_meta($product->get_id(), '_product_attributes');

	}

	//get the variations and create them as attributes

	//get original product attributes
	$product_attributes = $product->get_attributes();

	$variations = json_decode(get_product_variations($product));

	if (!empty($variations)) {

		// set product as variable and status as instock
		wp_set_object_terms($product->get_id(), 'variable', 'product_type');

		$attr_label = 'variations';
		$attr_slug = sanitize_title($attr_label);

		foreach ($variations as $variation) {
			$variants[] = $variation->name;

		}

		$var_string = implode('|', $variants);

		$attribute_array[$attr_slug] = array(

			'name' => $attr_label,
			'value' => $var_string,
			'is_visible' => '1',
			'is_variation' => '1',
			'is_taxonomy' => '0',
		);

		update_post_meta($product->get_id(), '_product_attributes', $attribute_array);

		foreach ($variations as $variation) {

			$variationData = array(
				'post_title' => $product->get_name() . '-' . $variation->name,
				'post_status' => 'publish',
				'post_parent' => $product->get_id(),
				'post_type' => 'product_variation',
			);

			$variation_id = wp_insert_post($variationData);

			update_post_meta($variation_id, '_regular_price', $variation->unit_price);
			update_post_meta($variation_id, '_price', $variation->unit_price);
			update_post_meta($variation_id, '_stock_qty', 0);

			update_post_meta($variation_id, 'attribute_' . $attr_slug, $variation->name);
		}

		//set original product attributes to be used with variations
		/*if (!empty($product_attributes)) {

			//make it usable with variation
			foreach ($product_attributes as $attribute) {

				$att_name = $attribute->get_name();

				$terms = wp_get_post_terms($product->get_id(), $att_name, 'all');

				if (!empty($terms)) {
					foreach ($terms as $term) {

						$attribute_options[] = $term->name;
					}

				}

				$var_string = implode('|', $attribute_options);

				$attribute_array[$att_name] = array(
					'name' => $att_name,
					'value' => $var_string,
					'is_visible' => '1',
					'is_variation' => '1',
					'is_taxonomy' => '1',
				);

			}

			update_post_meta($product->get_id(), '_product_attributes', $attribute_array);

		}*/

		update_post_meta($product->get_id(), '_stock_status', 'instock');

	} /*else {

		//set original product attributes to be used with variations
		if (!empty($product_attributes)) {

			// set product as variable and status as instock
			wp_set_object_terms($product->get_id(), 'variable', 'product_type');

			//make it usable with variation
			foreach ($product_attributes as $attribute) {

				$att_name = $attribute->get_name();

				$terms = wp_get_post_terms($product->get_id(), $att_name, 'all');

				if (!empty($terms)) {
					foreach ($terms as $term) {

						$attribute_options[] = $term->name;
					}

				}

				$var_string = implode('|', $attribute_options);

				$attribute_array[$att_name] = array(
					'name' => $att_name,
					'value' => $var_string,
					'is_visible' => '1',
					'is_variation' => '1',
					'is_taxonomy' => '1',
				);

			}

			update_post_meta($product->get_id(), '_product_attributes', $attribute_array);

			foreach ($attribute_options as $value) {

				//create as a variation

				$variationData = array(
					'post_title' => $product->get_name() . '-' . $value,
					'post_status' => 'publish',
					'post_parent' => $product->get_id(),
					'post_type' => 'product_variation',
				);

				$variation_id = wp_insert_post($variationData);

				update_post_meta($variation_id, '_regular_price', $product->get_price());
				update_post_meta($variation_id, '_price', $product->get_price());
				update_post_meta($variation_id, '_stock_qty', 0);

				update_post_meta($variation_id, 'attribute_' . $att_name, $value);

			}

			update_post_meta($product->get_id(), '_stock_status', 'instock');

		}
	}*/

}

/*function create_product_var($product) {

//get product variations and delete them if they
if ($product->is_type('variable')) {

$childs = $product->get_children();

if (!empty($childs)) {

foreach ($childs as $child_id) {

wp_delete_post($child_id);

}
}

wp_set_object_terms($product->get_id(), 'simple', 'product_type');
delete_post_meta($product->get_id(), '_product_attributes');

}

//set the product as a variable
wp_set_object_terms($product->get_id(), 'variable', 'product_type');
update_post_meta($product->get_id(), '_stock_status', 'instock');

//set product attributes
$attr_label = 'variant';
$attr_slug = sanitize_title($attr_label);

//get the variations and create them as attributes and posts
$variations = json_decode(get_product_variations($product));

foreach ($variations as $variation) {
$variants[] = $variation->name;

}

//get all existing attributes
$attributes = $product->get_attributes();

//print_r($attributes);

if (!empty($attributes)) {

$var_string = implode('|', $variants);

$attribute_array[$attr_slug] = array(

'name' => $attr_label,
'value' => $var_string,
'is_visible' => '1',
'is_variation' => '1',
'is_taxonomy' => '0',
);

//update attributes to use as variation
foreach ($attributes as $attribute) {

//convert array to string
$var_string = implode('|', $attribute['options']);

$attribute_array[$attribute['name']] = array(

'name' => $attribute['name'],
'value' => $var_string,
'is_visible' => '1',
'is_variation' => '1',
'is_taxonomy' => '0',
);

}

} else {

$var_string = implode('|', $variants);

$attribute_array[$attr_slug] = array(

'name' => $attr_label,
'value' => $var_string,
'is_visible' => '1',
'is_variation' => '1',
'is_taxonomy' => '0',
);

}

update_post_meta($product->get_id(), '_product_attributes', $attribute_array);

foreach ($variations as $variation) {

$variationData = array(
'post_title' => $product->get_name() . '-' . $variation->name,
'post_status' => 'publish',
'post_parent' => $product->get_id(),
'post_type' => 'product_variation',
);

$variation_id = wp_insert_post($variationData);

update_post_meta($variation_id, '_regular_price', $variation->unit_price);
update_post_meta($variation_id, '_price', $variation->unit_price);
update_post_meta($variation_id, '_stock_qty', 0);

update_post_meta($variation_id, 'attribute_' . $attr_slug, $variation->name);

//get other attributes and loop through attributes and add them
//get other options now
$attributes = $product->get_attributes();

// all attributes except the first
$variation_attributes = array_slice($attributes, 1);

if (count($variation_attributes) > 0) {

foreach ($variation_attributes as $key => $value) {

//loop through the options
foreach ($value['options'] as $key => $value) {

update_post_meta($variation_id, 'attribute_' . $key, '');
}

}

}

WC_Product_Variable::sync($product->get_id());

}

}*/

add_action('woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9);
function remove_checkout_coupon_form() {
	remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
}

/**
 * @param $woocommerce
 * @param $productID
 *
 * @return boolean
 */
function check_if_product_id_in_cart($productID) {
	if (!empty($productID)) {
		$cart = WC()->cart->get_cart_contents();

		foreach ($cart as $item) {
			$item = (object) $item;

			if (isset($item->product_id) && !empty($item->product_id)) {
				if ($item->product_id == $productID) {
					return true;
				}
			}
		}
	}

	return false;
}

/**
 * Get the number of items in the shop
 */
function get_total_number_of_products() {
	$args = array('post_type' => 'product', 'post_status' => 'publish',
		'posts_per_page' => -1);
	$products = new WP_Query($args);
	return $products->found_posts;
}

add_action('init', 'submit_whatsapp_lead');

function submit_whatsapp_lead() {

	if (isset($_POST['submitWhatsapp'])) {

		$name = (isset($_POST['whatsapp_lead_name'])) ? $_POST['whatsapp_lead_name'] : '';
		$phone = (isset($_POST['whatsapp_lead_phone'])) ? $_POST['whatsapp_lead_phone'] : '';
		$email = (isset($_POST['whatsapp_lead_email'])) ? $_POST['whatsapp_lead_email'] : '';
		$product = (isset($_POST['whatsapp_lead_product'])) ? $_POST['whatsapp_lead_product'] : '';
		$product_sku = (isset($_POST['whatsapp_lead_product_sku'])) ? $_POST['whatsapp_lead_product_sku'] : '';
		$post_type = 'whatsapp_lead';

		$content = array('name' => $name, 'phone' => $phone, 'email' => $email, 'product' => $product, 'product_sku' => $product_sku);

		$post_args = array(

			'post_title' => $name,
			'post_content' => json_encode($content),
			'post_status' => 'published',
			'post_type' => $post_type,

		);

// insert the post into the database

		wp_insert_post($post_args);

		die();

	}

}

function is_featured_category($category) {

	if (get_term_meta($category->term_taxonomy_id, '_category_is_featured', true)) {

		return true;
	} else {
		return false;
	}
}

function get_product_payment_terms($product) {

	return get_post_meta($product->get_id(), '_product_payment_terms', true);

}

function get_published_product_variations($product) {

	$variations = $product->get_available_variations();

	return $variations;
}

add_filter('woocommerce_variation_option_name', 'display_price_in_variation_option_name');
function display_price_in_variation_option_name($term) {
	global $wpdb, $product;

	if (empty($term)) {
		return $term;
	}

	if (empty($product->get_id())) {
		return $term;
	}

	$id = @$product->get_id();

	$result = $wpdb->get_col("SELECT slug FROM {$wpdb->prefix}terms WHERE name = '$term'");

	$term_slug = (!empty($result)) ? $result[0] : $term;

	$query = "SELECT postmeta.post_id AS product_id
                FROM {$wpdb->prefix}postmeta AS postmeta
                    LEFT JOIN {$wpdb->prefix}posts AS products ON ( products.ID = postmeta.post_id )
                WHERE postmeta.meta_key LIKE 'attribute_%'
                    AND postmeta.meta_value = '$term_slug'
                    AND products.post_parent = $id";

	$variation_id = $wpdb->get_col($query);

	$parent = @wp_get_post_parent_id($variation_id[0]);

	if ($parent > 0) {
		$_product = new WC_Product_Variation($variation_id[0]);
		return $term . ' (' . wp_kses(wc_price($_product->get_price()), array()) . ')';
	}
	return $term;

}

/*add_action('woocommerce_thankyou', 'checkout_redirect');

function checkout_redirect($order_id) {
$order = wc_get_order($order_id);

$url = get_site_url();

if ($order->status != 'failed') {
//wp_safe_redirect($url);
header("refresh:10;url=$url");
exit;
}
}*/

/*add_action('woocommerce_order_status_processing', 'trigger_webhook');

function trigger_webhook() {
add_filter('woocommerce_webhook_deliver_async', '__return_false');
}*/

add_filter('woocommerce_webhook_deliver_async', '__return_false');

//add_filter('action_scheduler_run_schedule', function ($arg) {return 20;});

function get_order_details($order_id) {

	$order = wc_get_order($order_id);

	return $order;
}

//Removing button in message notification

add_filter( 'wc_add_to_cart_message_html', 'empty_wc_add_to_cart_message', 10, 2 );
function empty_wc_add_to_cart_message( $message, $products ) {
    foreach( $products as $product_id => $quantity ) {
        // (If needed) get the WC_Product object
        $product = wc_get_product($product_id);
        // The product title
        $product_title = $product->get_title();
    }

    $new_message = '"'. $product_title . '"' . ' has been added to your cart.';

    return $new_message;
};




//////////////////////////////////////////////////////////////////////////////////////////

add_action('rest_api_init', function () {
  	register_rest_route( 'theme/v1', 'deploy', array(
                'methods'  => 'POST',
                'callback' => 'process_pull_request'
      ));
});



function process_pull_request(){

	//verifies the pull request and calls the appropriate functions.

	return update_theme();
}


function get_root_path(){

	$path = get_template_directory();

	$path = explode('/', $path);


	array_splice($path, count($path) - 3, 3);

	$path = implode('/', $path);

	return 200;

}



function update_theme(){



	$result = array();
	exec("./deploy.sh 2>&1", $result);

	return $result;
	
}









?>