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
	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_state']);
	//unset($fields['billing']['billing_phone']);
	unset($fields['order']['order_comments']);
	//unset($fields['billing']['billing_email']);
	//unset($fields['account']['account_username']);
	//unset($fields['account']['account_password']);
	//unset($fields['account']['account_password-2']);
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

function get_product_variations($product) {

	$variations = get_post_meta($product->get_id(), '_product_variations', true);

	return $variations;

}

add_action('added_post_meta', 'auto_create_var', 10, 4);

function auto_create_var($post_id) {
	//check if post type is product
	if (get_post_type($post_id) == 'product') {
		$product = wc_get_product($post_id);

		//check if product has product variations
		$variations = get_post_meta($product->get_id(), '_product_variations', true);
		if (!empty($variations)) {
			create_product_var($product);
		}

	}
}

function create_product_var($product) {

	//set the product as a variable
	wp_set_object_terms($product->get_id(), 'variable', 'product_type');

	//set product attributes
	$attr_label = 'variant';
	$attr_slug = sanitize_title($attr_label);

	//get the variations and create them as attributes and posts
	$variations = json_decode(get_product_variations($product));

	foreach ($variations as $variation) {
		$variants[] = $variation->name;

	}

	$var_string = implode('|', $variants);

	$attributes_array[$attr_slug] = array(

		'name' => $attr_label,
		'value' => $var_string,
		'is_visible' => '1',
		'is_variation' => '1',
		'is_taxonomy' => '0',
	);

	update_post_meta($product->get_id(), '_product_attributes', $attributes_array);

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
		WC_Product_Variable::sync($product->get_id());

	}

}

add_action('woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9);
function remove_checkout_coupon_form() {
	remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
}

?>