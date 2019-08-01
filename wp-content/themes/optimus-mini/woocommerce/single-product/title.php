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


        <div class="price">

			<?php if ($product->is_type('variable')) {
	?>

                <h2 class="current-price" id="productPrice"><?php echo get_woocommerce_currency_symbol();
	echo get_post_meta($product->get_id(), '_price', true) ?></h2>

			<?php } else {?>
				<?php if ($product->get_sale_price() <= 0) {?>
                    <h2 class="current-price"
                        id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h2>
				<?php }?>

				<?php if ($product->get_sale_price() > 0) {?>

                    <h2 class="current-price"
                        id="product_price"><?php echo wc_price($product->get_sale_price()); ?></h2>

                    <h2 class="previous-price"
                        id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h2>
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

        <script type="text/javascript">

            /*
            function setVariationPrice() {

                var variation = document.getElementById("variationSelect").options[document.getElementById("variationSelect").selectedIndex].value;
                console.log(variation);

                var vars = variation.split("-");

                var is_discounted = vars[2];

                var product_unit_price = vars[1];

                if (is_discounted > 0) {
                    var start_date = vars[4];
                    var end_date = vars[5];

                    var current_date = getTodayDate();
                    //check if todays date is within the discount period
                    var datecheck = dateCheck(start_date, end_date, current_date);

                    if (dateCheck) {
                        product_unit_price = vars[3];
                    }

                }

                console.log(vars);

                var price = formatPrice(product_unit_price, 'KSH');

                document.getElementById("productPrice").innerHTML = price;

                document.getElementById("variation").value = vars[0];
                document.getElementById("variationPrice").value = product_unit_price;

            }


            function dateCheck(sdate, edate, cdate) {

                var start_date, end_date, current_date;
                start_date = Date.parse(sdate);
                end_date = Date.parse(edate);
                current_date = Date.parse(cdate);

                if ((current_date <= end_date && current_date >= start_date)) {
                    return true;
                }
                return false;
            }


            function getTodayDate() {

                today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //As January is 0.
                var yyyy = today.getFullYear;

                var sp = "/";

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                return (mm + sp + dd + sp + yyyy);
            }


            function formatPrice(value, currency) {

                var formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: currency,
                });

                var price = formatter.format(value);

                return price;
            }


            function setProductAttribute() {

                var attribute = document.getElementById("attributeSelect").options[document.getElementById("attributeSelect").selectedIndex].value;

                console.log(attribute);

                document.getElementById("atrribute").value = attribute;
            }
            */

        </script>