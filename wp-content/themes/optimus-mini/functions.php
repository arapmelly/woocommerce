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

	$images = get_post_meta($product->get_id(), '_product_primary_full_cdn_image', true);

	$images = json_decode($images);

	return $images;
}

function get_blog_primary_image() {

	$images = get_option('blogprimaryimage');

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

?>