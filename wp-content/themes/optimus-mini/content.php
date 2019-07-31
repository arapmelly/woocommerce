<?php if (is_front_page()): ?>


    <section class="shop-banner margin-top-phone-7">

        <?php

$image = get_blog_primary_image();
$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';

?>

        <img srcset="<?php echo $srcset; ?>" sizes="(max-width: 425px) 270px, (max-width: 768px) 600px, 1920px"
             src="<?php echo $image->small ?>" alt="">
    </section>


<?php endif;?>

<main class="main-content">

    <section class="business-details">

        <div class="section-inner-wrapper">
            <!-- shop name -->
            <h1 class="business-name"><?php echo get_option('blogname'); ?></h1>

	        <?php if (get_option('blogindustry')) {?>
            <!-- shop prducts count -->

                <h2 class="business-category"><?php echo get_option('blogindustry'); ?></h2>

<!--            <div class="orders-made">-->
<!--                <div class="tag-descriptor">-->
<!--                    <span>--><?php //echo get_option('blogindustry'); ?><!--</span>-->
<!--                </div>-->
<!--            </div>-->
	        <?php }?>

            <!-- end shop products count -->

            <div class="sec-rating-shop-contact">
                <!-- reviews count -->
	            <?php //if (get_reviews_count() < 10): ?>

                <div class="rating-widget">
                    <div class="stars" data-score="4.5"></div>
                    <div class="num-rating tag-descriptor"><?php echo get_reviews_count(); ?> Ratings
<!--                        <span class="total-reviews">(--><?php //echo get_reviews_count(); ?><!-- Ratings)</span>-->
                    </div>
                </div>

	            <?php //endif; // end of reviews count if block ?>
                <!-- end of reviews count -->

                <div class="share-btn">
                    <div class="share-icons">
			            <?php

				            $link = get_option('blogprimaryphonenumber');

				            $call_shop = 'tel:+' . $link;

			            ?>

                        <a href="<?php echo $call_shop; ?>">
                            <span class="icon-phone-outline"></span>
                        </a>
                    </div>
                </div>
            </div>

        </div> <!-- /end of inner wrapper div -->


    </section> <!-- end of section business details -->

    <section class="products-by-category">

	    <?php
		    $cats = get_product_categories();
		    foreach ( $cats as $cat ) { ?>
			    <?php if ( is_featured_category( $cat ) ): ?>

        <div class="products">

                <header class="category-header">
                    <div class="inner-wrapper">
                        <h3><?php echo $cat->name; ?> </h3>
                        <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>">View All</a>
                    </div>
                </header> <!-- end of category header -->

                <div class="section-inner-wrapper">

                    <div class="products-slider">
                        <!-- start of ui div -->
                        <div class="ui link cards">
                        <?php
$query = new WC_Product_Query(array('limit' => 4, 'orderby' => 'date', 'order' => 'DESC', 'status' => 'publish', 'category' => [$cat->slug]));
	$products = $query->get_products();
	$itemWidth = "";
	$productsLoopCounter = 1;
	foreach ($products as $product) {
		?>
                            <?php
if (count($products) == 1) {
			$itemWidth = "full-width";
		} elseif (count($products) > 1) {
			if (count($products) == 3) {
				$itemWidth = "full-width";
			}
		}
		?>

                            <?php if ($productsLoopCounter == count($products) && count($products) == 3) {?>

                                <a href="<?php echo get_permalink($product->get_id()); ?>" class="card <?php echo $itemWidth; ?>">

                            <?php } elseif ($productsLoopCounter == count($products) && count($products) == 1) {?>
                                <a href="<?php echo get_permalink($product->get_id()); ?>" class="card <?php echo $itemWidth; ?>">
                            <?php } else {?>
                                <a href="<?php echo get_permalink($product->get_id()); ?>" class="card">
                            <?php } // end of product loop else if block ?>

                            <?php
$image = get_product_primary_image($product);
		if (!is_null($image)) {
			$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
		}
		?>
                            <div class="image" style="background-image: url(<?php echo $image->medium ?>)">

                            </div> <!-- end of image div -->
                            <div class="content">
                                <div class="header">
                                    <?php echo $product->get_name(); ?>
                                </div> <!-- end of header div -->
                                <div class="meta">
                                    <?php echo $cat->name; ?>
                                </div> <!-- end of meta div -->
                            </div> <!-- end of content div -->

                            <div class="content price-discount">
                                <div class="header price">

                                    <?php
if ($product->is_type('variable')) {
			?>
                                            <h2 class="current-price" id="productPrice">
                                                <?php echo get_woocommerce_currency_symbol();
			echo get_post_meta($product->get_id(), '_price', true) ?>
                                            </h2>

                                    <?php } else {
			?>
                                        <?php
if ($product->get_sale_price() <= 0) {?>
                                                <h2 class="current-price" id="productPrice">
                                                    <?php echo wc_price($product->get_regular_price()); ?>
                                                </h2>
                                        <?php }?>

                                        <?php if ($product->get_sale_price() > 0) {?>
                                            <h2 class="current-price" id="product_price">
                                                <?php echo wc_price($product->get_sale_price()); ?>
                                            </h2>
                                            <h2 class="previous-price" id="productPrice">
                                                <?php echo wc_price($product->get_regular_price()); ?>
                                            </h2>
                                        <?php }?>

                                    <?php }?>


                                </div> <!-- /end of header price div -->

                                <?php
if ($product->get_sale_price() > 0) {?>
                                        <div class="discount">
                                            <?php echo get_percentage_discount($product); ?>
                                                    Off
                                        </div>
                                <?php }?>


                            </div> <!-- end of price div -->

                            </a> <!-- end of ahref -->


                        <?php } //end of products foreach loop ?>

                        </div>
                        <!-- end of ui link cards div -->

                    </div> <!-- end of products slider div -->

                </div> <!-- end of section inner wrapper div -->

        </div> <!-- end of products div -->


        <?php endif; //end of is_featured if block ?>

        <?php } //end of cats loop ?>

    </section> <!-- end of section products by category -->

</main>