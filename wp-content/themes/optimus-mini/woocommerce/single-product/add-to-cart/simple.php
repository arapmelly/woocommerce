<?php
	/**
	 * Simple product add to cart
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce/Templates
	 * @version 3.4.0
	 */

	defined( 'ABSPATH' ) || exit;

	global $product;

	if ( ! $product->is_purchasable() ) {
		return;
	}

	//echo wc_get_stock_html($product); // WPCS: XSS ok.

	if ( check_if_product_id_in_cart( $product->get_id() ) ) {
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
	} else {

		if ( $product->is_in_stock() ): ?>

			<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

            <form class="cart"
                  action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>"
                  method="post" enctype='multipart/form-data'>
				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

				<?php
					do_action( 'woocommerce_before_add_to_cart_quantity' );

					do_action( 'woocommerce_after_add_to_cart_quantity' );
				?>

                <div class="actions">
                    <div class="woocommerce-variation-add-to-cart variations_button">

                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"
                                class="single_add_to_cart_button button alt">
                            <span class="icon-shopping-bag-outline"></span>Order Now
                        </button>
                    </div>

                    <div class="talk-to-seller-button">
						<?php $link = contact_seller_link( $product ); ?>
                        <a class="button" id="whatsapp_btn" target="_blank" href="<?php echo $link; ?>"
                           style="display: none;"><span class="icon-whatsapp"></span>WhatsApp Us</a>

                        <a class="button" onclick="showForm()"><span class="icon-whatsapp"></span>WhatsApp Us</a>
                    </div>

                </div>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            </form>

			<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

		<?php endif; ?>

		<?php if ( ! $product->is_in_stock() ): ?>
            <div class="actions talk-to-seller-button">
				<?php $link = contact_seller_link( $product ); ?>
                <a class="button" id="whatsapp_btn" target="_blank" href="<?php echo $link; ?>"
                   style="display: none;"><span class="icon-whatsapp"></span>WhatsApp Us</a>

                <a class="button" href="#" onclick="showForm()"><span class="icon-whatsapp"></span>WhatsApp Us</a>
            </div>
		<?php endif; ?>


	<?php } ?>


<div id="whatsapp_form">


    <!-- The Modal -->
    <div id="myModal" class="modal" style="display: none;">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()"><span class="icon-close-outline"></span></span>

            <form method="post" class="ui form" action="#">
                <div class="field">
                    <label for="whatsapp_lead_name">Name</label>
                    <input type="text" id="whatsapp_lead_name" name="whatsapp_lead_name" required>
                </div>

                <div class="field">
                    <label for="whatsapp_lead_phone">Phone</label>
                    <input type="text" id="whatsapp_lead_phone" name="whatsapp_lead_phone" required>
                </div>

<!--                <div class="field">-->
<!--                    <label for="whatsapp_lead_email">Email</label>-->
<!--                    <input type="text" id="whatsapp_lead_email" name="whatsapp_lead_email" required>-->
<!--                </div>-->

                <input type="hidden" id="whatsapp_lead_product" value="<?php echo $product->get_name(); ?>"
                       name="whatsapp_lead_product">
                <input type="hidden" id="whatsapp_lead_product_sku" value="<?php echo $product->get_sku(); ?>"
                       name="whatsapp_lead_product_sku">

                <input type="submit" id="submit_whatsapp" class="button" onclick="submitForm()" name="submitWhatsapp" value="WhatsApp Us">


            </form>

        </div>

    </div>
</div>


<script type="text/javascript">

    function showForm() {

        document.getElementById("myModal").style.display = "block";

    }


    function submitForm() {


        document.getElementById("whatsapp_btn").click();
        //document.getElementById('whatsapp_form').style.display = "none";

    }


    function closeModal() {

        document.getElementById("myModal").style.display = "none";
    }
</script>




