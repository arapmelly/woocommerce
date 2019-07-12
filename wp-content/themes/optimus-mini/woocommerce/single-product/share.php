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


	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	do_action( 'woocommerce_share' ); // Sharing plugins can hook into here.
?>

<div class="share-btn">

    <div class="share-icons">
        <a href="#">
            <span class="icon-facebook"></span>
        </a>
        <a href="#">
            <span class="icon-twitter"></span>
        </a>
        <a href="#">
            <span class="icon-email"></span>
        </a>
        <a href="#">
            <span class="icon-link-2"></span>
        </a>

    </div>
</div>

<!--	Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues.-->

</div>
</section>