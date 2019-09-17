<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $post;
global $product;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();

$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);
if (!$short_description) {
	return;
}

$product = wc_get_product( $product->get_id() );
//$productPriceHTML = $product->get_price_html();
$productPriceHTML = get_option('woocommerce_currency').' '.$product->get_price();
$productType  = $product->get_type();
?>

<section class="product-details">
    <div class="section-inner-wrapper">

        <h1 class="product-name"><?php echo $product->get_name(); ?></h1>

		<?php //if ($average < 3) {?>

            <div class="product-meta">
                <div class="rating-widget">
                    <div class="stars" data-score="<?php echo $average; ?>"></div>
                </div>
               <!--  <div class="orders-made">
                    <div class="num-rating tag-descriptor"><?php //echo $average; ?> <span
                                class="total-reviews">(<?php //echo $review_count; ?> Reviews)</span></div>
                    <div class="tag-descriptor"><?php //echo $rating_count; ?> <span
                                class="total-reviews">Orders made</span></div>
                </div> -->
            </div>


		<?php //}?>

        <?php
//create_var($product);
//create_prod_attributes($product);
//test_debug();
//test_log($product);
?>


        <div class="price">

			<?php if ($product->is_type('variable')) {
	?>

                <h2 class="current-price" id="productPrice">
                    <?php
                        echo $productPriceHTML;
                    ?>
                </h2>

			<?php } else {?>
				<?php if ($product->get_sale_price() <= 0) {?>
                    <h2 class="current-price"
                        id="productPrice"><?php 
                        //echo wc_price($product->get_regular_price()); 
                        echo get_option('woocommerce_currency').' '.$product->get_regular_price();
                        ?></h2>
				<?php }?>

				<?php if ($product->get_sale_price() > 0) {?>

                    <h2 class="current-price"
                        id="product_price"><?php 
                        //echo wc_price($product->get_sale_price()); 
                        echo get_option('woocommerce_currency').' '.$product->get_sale_price();
                        ?></h2>

                    <h2 class="previous-price"
                        id="productPrice"><?php 
                        //echo wc_price($product->get_regular_price()); 
                        echo get_option('woocommerce_currency').' '.$product->get_regular_price();
                        ?></h2>
				<?php }?>

			<?php }?>




        </div>

        <?php if (get_post_meta($product->get_id(), '_product_payment_terms', true)) {?>
        <div class="payment_terms">
            <p><b>Payment Terms:</b> <?php echo get_product_payment_terms($product); ?></p>
        </div>
    <?php }?>

        <div class="out_of_stock">

         <?php if (!$product->is_in_stock()): ?>
            <h5>Out of Stock</h5>
        <?php endif;?>


        </div>


        <div class="poduct-desc">

            <p>
	            <?php
echo wp_trim_words($product->get_short_description(), 20, ' <a href="#tabs" class="scroll-to">[...]</a>');
?>
            </p>
            <!-- <p>--><?php //echo $product->get_short_description(); // WPCS: XSS ok.?><!--</p>-->
        </div>

<?php do_action('woocommerce_after_add_to_cart_button');?>