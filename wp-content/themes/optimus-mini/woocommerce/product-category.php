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

	defined( 'ABSPATH' ) || exit;

	global $product;

	// Ensure visibility.
	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}
?>


<div class="card">
    <div class="image">
		<?php

			$image = get_product_primary_image( $product );

			if ( ! is_null( $image ) ) {
				$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
			}

		?>
		<?php if ( is_null( $image ) ) { ?>

            <img src="" alt="no image"
                 class="caol-ila_1984">


		<?php } else { ?>

            <img srcset="<?php echo $srcset; ?>" sizes="(max-width: 425px) 270px, (max-width: 768px) 600px, 1920px" src="<?php echo $image->small ?>" alt="">

		<?php } ?>


    </div>

    <div class="content price-discount">
        <div class="header price">
            <h2 class="current-price"><?php echo wc_price( $product->get_price() ); ?></h2>

			<?php if ( $product->is_on_sale() ) { ?>
                <h2 class="previous-price"><?php echo wc_price( $product->get_regular_price() ); ?></h2>
			<?php } ?>
        </div>

		<?php if ( $product->is_on_sale() ) { ?>
            <div class="discount"><?php echo get_percentage_discount( $product ); ?>
                Off
            </div>
		<?php } ?>
    </div>

    <div class="content">
        <div class="header"><?php echo $product->get_name(); ?></div>
    </div>

    <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="ui bottom attached button">buy </a>
</div>