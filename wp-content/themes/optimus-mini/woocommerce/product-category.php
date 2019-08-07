<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>


<a class="card" href="<?php echo get_permalink($product->get_id()); ?>">

	<?php

$image = get_product_primary_image($product);

if (!is_null($image)) {
	$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
}

$product = wc_get_product( $product->get_id() );
$productPriceHTML = $product->get_price_html();
$productType  = $product->get_type();
?>

    <div class="image" style="background-image: url(<?php echo isset($image->medium) ? $image->medium : "https://via.placeholder.com/600x600.png?text=No+Image" ?>)"></div>

    <div class="content">
        <div class="header">
            <h2><?php echo $product->get_name(); ?></h2>
        </div>
        <div class="meta">
	        <?php
                echo get_product_category_names($product);
	        ?>
        </div>
    </div>

    <div class="content price-discount">

            <div class="header price">
	            <?php if ( $product->is_type( 'variable' ) ) {?>

                <h3 class="current-price" id="productPrice">
                    <?php
                        echo $productPriceHTML;
                    ?>
                </h3>

            <?php } else {?>
            <?php if ($product->get_sale_price() <= 0) {?>
                <h3 class="current-price" id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h3>
            <?php }?>

            <?php if ($product->get_sale_price() > 0) {?>
                <h3 class="previous-price" id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h3>

                <h4 class="current-price" id="productPrice"><?php echo wc_price($product->get_sale_price()); ?></h4>
            <?php }?>

            <?php }?>
               <!--  <?php //if ($product->get_sale_price() <= 0) {?>
                <h2 class="current-price"><?php //echo wc_price($product->get_regular_price()); ?></h2>
            <?php //}?>

                <?php //if ($product->get_sale_price() > 0) {?>
                    <h2 class="previous-price"><?php //echo wc_price($product->get_regular_price()); ?></h2>
                <?php //}?> -->
            </div>

		<?php if ($product->get_sale_price() > 0) {?>
            <div class="discount"><?php echo get_percentage_discount($product); ?> Off</div>
		<?php }?>
    </div>

</a>