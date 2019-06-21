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

//the_title( '<h1 class="product_title entry-title">', '</h1>' );

?>
<main class="main-content">

    <section class="product-details">
        <div class="section-inner-wrapper">
            <h1 class="product-name"><?php echo $product->get_name(); ?></h1>


            <div class="product-meta">
                <div class="rating-widget">
                    <div class="stars" data-score="<?php echo $average; ?>"></div>
                </div>
                <div class="orders-made">
                    <div class="num-rating tag-descriptor"><?php echo $average; ?> <span class="total-reviews">(<?php echo $review_count; ?> Reviews)</span></div>
                    <div class="tag-descriptor"><?php echo $rating_count; ?> <span class="total-reviews">Orders made</span></div>
                </div>
            </div>

            <div class="actions">
                <a href="#" class="ui button">buy</a>
            </div>

        </div>
    </section>
