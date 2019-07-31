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

?>

    <div class="image" style="background-image: url(<?php echo $image->medium ?>)"></div>

    <div class="content">
        <div class="header"><?php echo $product->get_name(); ?></div>
        <div class="meta">
	        <?php
		        if ( $term = get_term_by( 'id', $product->get_id(), 'product_cat' ) ) {
			        echo $term->name;
		        }
	        ?>
        </div>
    </div>

    <div class="content price-discount">

            <div class="header price">


	            <?php if ( $product->is_type( 'variable' ) ) {
		            ?>

                <h2 class="current-price" id="productPrice"><?php echo get_woocommerce_currency_symbol();
	echo get_post_meta($product->get_id(), '_price', true) ?></h2>

            <?php } else {?>
            <?php if ($product->get_sale_price() <= 0) {?>
                <h2 class="current-price" id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h2>
            <?php }?>

            <?php if ($product->get_sale_price() > 0) {?>
                <h2 class="previous-price" id="productPrice"><?php echo wc_price($product->get_regular_price()); ?></h2>

                <h2 class="current-price" id="productPrice"><?php echo wc_price($product->get_sale_price()); ?></h2>
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