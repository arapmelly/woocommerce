<?php
	/**
	 * Cart Page
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce/Templates
	 * @version 3.5.0
	 */

	defined( 'ABSPATH' ) || exit;

	do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-item-list">


    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
                    <div class="single-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                        <div class="inner-container">
                            <a href="<?php echo $product_permalink; ?>" class="image">

								<?php $image = get_product_primary_image( $_product ); ?>

								<?php if ( ! is_null( $image ) ) { ?>
                                    <img src="<?php echo $image->small; ?>" alt="">
								<?php } else { ?>
                                    <img src="https://via.placeholder.com/600.png?text=No+Image" alt="no image provided">
								<?php } ?>
                            </a>

                            <div class="right-column">

                                <h2 data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
									<?php
										if ( ! $product_permalink ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
										} else {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
										}

										do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

										// Meta data.
										echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

										// Backorder notification.
										if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
											echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
										}
									?>
                                </h2>

                                <div class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
                                </div>

                                <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
										} else {
//											$product_quantity = sprintf( '<input type="text" onchange="updateQuantity()" name="cart[%s][qty]" value="' . $cart_item['quantity'] . '" />', $cart_item_key );

											$product_quantity= sprintf(
											        '<div class="qty-input"><i class="less">-</i> <input type="text" name="cart[%s][qty]" value="' . $cart_item['quantity'] . '"/><i class="more">+</i></div>', $cart_item_key
                                            );

											/*$product_quantity = woocommerce_quantity_input( array(
																				'input_name'   => "cart[{$cart_item_key}][qty]",
																				'input_value'  => $cart_item['quantity'],
																				'max_value'    => $_product->get_max_purchase_quantity(),
																				'min_value'    => '0',
																				'product_name' => $_product->get_name(),
																			), $_product, false );*/
										}

									?>

                                    <div class="item_subtotal">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
										?>
                                    </div>

									<?php
										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
									?>
                                </div>

<!--                                <script type="text/javascript">-->
<!---->
<!--                                    function updateQuantity() {-->
<!---->
<!--                                        document.getElementById("update_cart_btn").click();-->
<!--                                    }-->
<!--                                </script>-->

                            </div>

                            <div class="product-remove">
								<?php
									// @codingStandardsIgnoreLine
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove button" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove <span class="icon-close-circle-outline"></span></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									), $cart_item_key );
								?>

                                <button style="display: none;" type="submit" class="button update" name="update_cart"
                                        id="update_cart_btn"
                                        value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                            </div>
                        </div>
                    </div>
					<?php
				}
			}
		?>

		<?php do_action( 'woocommerce_cart_contents' ); ?>

		<?php do_action( 'woocommerce_cart_actions' ); ?>

		<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
    </form>


    <div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
    </div>

	<?php do_action( 'woocommerce_after_cart' ); ?>

</div>


