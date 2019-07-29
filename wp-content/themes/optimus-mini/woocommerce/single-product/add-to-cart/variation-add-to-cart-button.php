<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

global $product;

?>

<?php if ($product->get_stock_quantity() > 0): ?>

<div class="woocommerce-variation-add-to-cart variations_button">

	<?php do_action('woocommerce_before_add_to_cart_button');?>

	<?php
do_action('woocommerce_before_add_to_cart_quantity');

do_action('woocommerce_after_add_to_cart_quantity');
?>

    <button type="submit" class="single_add_to_cart_button button alt">Order Now</button>

	<?php do_action('woocommerce_after_add_to_cart_button');?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>"/>
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>"/>
    <input type="hidden" name="variation_id" class="variation_id" value="0"/>

</div>

<?php endif;?>

<div class="talk-to-seller-button">
	<?php $link = contact_seller_link($product);?>
    <a class="button" id="whatsapp_btn" target="_blank" href="<?php echo $link; ?>" style="display: none;"><span class="icon-whatsapp" ></span> WhatsApp Seller</a>

    <a class="button" href="#" onclick="showForm()"><span class="icon-whatsapp"></span> WhatsApp Seller</a>
</div>

<div id="whatsapp_form"  >


	<!-- The Modal -->
<div id="myModal" class="modal" style="display: none;">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>

    <form method="post" action="#">


	<label>Name</label>
	<input type="text" id="whatsapp_lead_name" name="whatsapp_lead_name" required>

	<label>Phone</label>
	<input type="text" id="whatsapp_lead_phone" name="whatsapp_lead_phone" required>

	<label>Email</label>
	<input type="text" id="whatsapp_lead_email" name="whatsapp_lead_email" required>

	<input type="hidden" id="whatsapp_lead_product" value="<?php echo $product->get_name(); ?>" name="whatsapp_lead_product" >
	<input type="hidden" id="whatsapp_lead_product_sku" value="<?php echo $product->get_sku(); ?>" name="whatsapp_lead_product_sku" >

	<input type="submit" id="submit_whatsapp" onclick="submitForm()" name="submitWhatsapp" value="Submit">


	</form>

  </div>

</div>







</div>




<script type="text/javascript">

	function showForm(){

		document.getElementById("myModal").style.display = "block";

	}


	function submitForm(){


		document.getElementById("whatsapp_btn").click();
		//document.getElementById('whatsapp_form').style.display = "none";

	}


	function closeModal(){

		document.getElementById("myModal").style.display = "none";
	}
</script>


