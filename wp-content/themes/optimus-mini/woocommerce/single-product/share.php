<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
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

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

do_action('woocommerce_share'); // Sharing plugins can hook into here.

global $product;
?>




<div class="share-btn">

    <h3>Share This On:</h3>

    <div class="share-icons">
	    <?php
$link = get_permalink($product->get_id());

$share_url = 'https://www.facebook.com/sharer/sharer.php?' . $link;

$twitter_share_url = 'http://twitter.com/share?url=' . $link;

$whatsapp = 'whatsapp://send?text=' . $link;

$email = get_option('admin_email');
?>

        <a href="<?php echo $share_url; ?>" target="_blank" tracking-name="<?php echo 'facebook_icon-product-' . $product->get_sku(); ?>">
            <span class="icon-facebook"></span>
        </a>
        <a href="<?php echo $twitter_share_url; ?>" target="_blank" tracking-name="<?php echo 'twitter_icon-product-' . $product->get_sku(); ?>">
            <span class="icon-twitter"></span>
        </a>
        <a href="mailto:<?php echo $email; ?>" target="_blank" tracking-name="<?php echo 'email_icon-product-' . $product->get_sku(); ?>">
            <span class="icon-email"></span>
        </a>

        <a href="<?php echo $whatsapp; ?>" data-action="share/whatsapp/share" target="_blank" tracking-name="<?php echo 'whatsapp_icon-product-' . $product->get_sku(); ?>">
            <span class="icon-whatsapp" ></span>
        </a>

    </div>
</div>

<!--	Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues.-->

</div>
</section>