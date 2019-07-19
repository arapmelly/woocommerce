<?php
	/**
	 * Single variation cart button
	 *
	 * @see https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce/Templates
	 * @version 3.4.0
	 */

	defined( 'ABSPATH' ) || exit;

	global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

    <button type="submit" class="single_add_to_cart_button button alt">Order Now</button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"/>
    <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"/>
    <input type="hidden" name="variation_id" class="variation_id" value="0"/>
</div>

<div class="talk-to-seller-button">
	<?php $link = contact_seller_link( $product ); ?>
    <a class="button" target="_blank" href="<?php echo $link; ?>"><span class="icon-whatsapp"></span> WhatsApp Seller</a>
</div>

