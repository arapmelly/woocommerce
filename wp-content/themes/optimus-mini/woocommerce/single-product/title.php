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

global $product;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average = $product->get_average_rating();

?>

<section class="product-details">
    <div class="section-inner-wrapper">
        <h1 class="product-name"><?php echo $product->get_name(); ?></h1>
        <div class="price">
            <h2 class="current-price"><?php echo $product->get_price_html(); ?></h2>
        </div>

        <!-- <div class="price">
        	<?php //if ($product->get_sale_price() <= 0) {?>
        		<h2 class="current-price" id="productPrice"><?php //echo wc_price($product->get_price_html()); ?></h2>
        	<?php //}?>

			<?php //if ($product->get_sale_price() > 0) {?>
                <h2 class="previous-price" id="productPrice"><?php //echo wc_price($product->get_price_html()); ?></h2>
			<?php //}?>

        </div> -->

		<?php if ($average >= 3) {?>

            <div class="product-meta">
                <div class="rating-widget">
                    <div class="stars" data-score="<?php echo $average; ?>"></div>
                </div>
                <div class="orders-made">
                    <div class="num-rating tag-descriptor"><?php echo $average; ?> <span
                                class="total-reviews">(<?php echo $review_count; ?> Reviews)</span></div>
                    <div class="tag-descriptor"><?php echo $rating_count; ?> <span
                                class="total-reviews">Orders made</span></div>
                </div>
            </div>


		<?php }?>

        <?php
//create_product_var($product);

?>

		<?php //do_action('woocommerce_before_add_to_cart_button');?>




        <div class="actions">

           <!--  <form method="post" action="<?php //echo get_template_directory_uri() . '/post_order.php'; ?>" >

                <input type="hidden" id="productId" value="<?php //echo $product->get_id(); ?>" name="productId">

                <input type="hidden" id="atrribute"  value="" name="attribute">

                <input type="hidden" id="variation" value="" name="variation">

                <input type="hidden"  id="variationPrice" value="" name="variationPrice">


                <input type="submit" class="ui button" value="Buy">



            </form> -->


            <!--  <a href="<?php //echo do_shortcode('[add_to_cart_url id=<?php echo $product->get_id(); ?>]'); ?>"
               class="ui button">buy</a> -->
        </div>

		<?php do_action('woocommerce_after_add_to_cart_button');?>

    </div>
</section>


<script type="text/javascript">

    function setVariationPrice(){

        var variation = document.getElementById("variationSelect").options[document.getElementById("variationSelect").selectedIndex].value;
        console.log(variation);

        var vars = variation.split("-");

        var is_discounted = vars[2];

        var product_unit_price = vars[1];

        if(is_discounted > 0){
            var start_date = vars[4];
            var end_date = vars[5];

            var current_date = getTodayDate();
            //check if todays date is within the discount period
            var datecheck = dateCheck(start_date, end_date, current_date);

            if(dateCheck){
                product_unit_price = vars[3];
            }

        }

        console.log(vars);

        var price = formatPrice(product_unit_price, 'KSH');

        document.getElementById("productPrice").innerHTML = price;

        document.getElementById("variation").value = vars[0];
        document.getElementById("variationPrice").value = product_unit_price;

    }



    function dateCheck(sdate,edate,cdate) {

        var start_date,end_date,current_date;
        start_date = Date.parse(sdate);
        end_date = Date.parse(edate);
        current_date = Date.parse(cdate);

        if((current_date <= end_date && current_date >= start_date)) {
            return true;
        }
        return false;
    }


    function getTodayDate(){

        today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //As January is 0.
        var yyyy = today.getFullYear;

        var sp = "/";

        if(dd<10) dd='0'+dd;
        if(mm<10) mm='0'+mm;

        return (mm+sp+dd+sp+yyyy);
    }


    function formatPrice(value, currency){

        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency,
        });

        var price = formatter.format(value);

        return price;
    }


    function setProductAttribute(){

        var attribute = document.getElementById("attributeSelect").options[document.getElementById("attributeSelect").selectedIndex].value;

        console.log(attribute);

        document.getElementById("atrribute").value = attribute;
    }

</script>