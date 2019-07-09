<?php if (is_front_page()) {
	?>

    <section class="shop-banner margin-top-phone-7">

		<?php

	$image = get_blog_primary_image();
	$srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';

	?>

        <img srcset="<?php echo $srcset; ?>" sizes="(max-width: 425px) 270px, (max-width: 768px) 600px, 1920px"
             src="<?php echo $image->small ?>" alt="">
    </section>

    <main class="main-content">

    <section class="business-details">
        <div class="section-inner-wrapper">
            <h1 class="business-name"><?php echo get_option('blogname'); ?></h1>
            <div class="rating-widget">
                <div class="stars" data-score="4.5"></div>
                <div class="num-rating tag-descriptor">4.25 <span
                            class="total-reviews">(<?php echo get_reviews_count(); ?> Reviews)</span></div>
            </div>
            <div class="orders-made">
                <div class="tag-descriptor"><?php echo get_total_orders('complete'); ?> <span class="total-reviews">Orders made</span>
                </div>
                <div class="tag-descriptor"><?php echo get_total_orders('on-hold'); ?> <span class="total-reviews">Deliveries made</span>
                </div>
            </div>
        </div>
    </section>

    <section class="filter-by-category">
        <div class="section-inner-wrapper">
            <div class="owl-carousel owl-theme">

				<?php $cats = get_product_categories();?>
				<?php foreach ($cats as $cat) {?>
                    <div class="item">
                        <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>">
                            <h4><?php echo $cat->name; ?></h4></a>
                    </div>
				<?php }?>
            </div>
            <div class="custom-nav owl-nav"></div>
        </div>
    </section>

    <section class="products-by-category">

		<?php $cats = get_product_categories();?>
		<?php foreach ($cats as $cat) {
		?>
            <div class="products">
                <header class="category-header">
                    <div class="inner-wrapper">
                        <h3><?php echo $cat->name; ?> </h3>
                        <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>">View All</a>
                    </div>
                </header>

                <div class="section-inner-wrapper">
                    <div class="products-slider">
                        <div class="ui link cards">

							<?php
								$query    = new WC_Product_Query( array(
									'limit'    => 4,
									'orderby'  => 'date',
									'order'    => 'DESC',
									'category' => [ $cat->slug ],

								) );
								$products = $query->get_products();
								$itemWidth = "";

//								var_dump($products);
                                $productsLoopCounter = 1;
								foreach ( $products as $product ) {

                                    if ( count( $products ) == 1 ) {

                                        $itemWidth = "full-width";

                                    } elseif ( count( $products ) > 1 ) {
                                        if ( count( $products ) == 3 ) {
                                            $itemWidth = "full-width";
                                        }
                                    }

//                                    echo key( $products );
                                //echo count( $products );

                                    if ( $productsLoopCounter == count($products) && count($products) == 3) { ?>

                                        <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="card <?php echo $itemWidth; ?>">

                                    <?php } elseif ($productsLoopCounter == count($products) && count($products) == 1){ ?>
                                            <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="card <?php echo $itemWidth; ?>">

                                    <?php }else { ?>

                                        <a href="<?php echo get_permalink( $product->get_id() ); ?>" class="card">
                                    <?php } ?>

                                    <?php

                                        $image = get_product_primary_image( $product );

                                        if ( ! is_null( $image ) ) {
                                            $srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
                                        }

                                    ?>

                                    <div class="image"
                                         style="background-image: url(<?php echo $image->medium ?>)"></div>

                                        <div class="content">
                                            <div class="header"><?php echo $product->get_name(); ?></div>
                                            <div class="meta"><?php echo $cat->name; ?></div>
                                        </div>

                                        <div class="content price-discount">
                                            <div class="header price">
                                                <?php if ($product->get_sale_price() <= 0) {?>

                                                    <h2 class="current-price"><?php echo wc_price($product->get_regular_price()); ?></h2>

                                                <?php }?>


												<?php if ($product->get_sale_price() > 0) {?>
                                                    <h2 class="previous-price"><?php echo wc_price($product->get_regular_price()); ?></h2>
												<?php }?>
                                            </div>

											<?php if ($product->get_sale_price() > 0) {?>
                                                <div class="discount"><?php echo get_percentage_discount($product); ?>
                                                    Off
                                                </div>
											<?php }?>
                                        </div>

                                    </a>


								<?php }?>

                        </div> <!-- end of owl-carousel -->
                    </div> <!-- end of products slider -->
                </div> <!-- end of inner wrapper -->


            </div>    <!-- end of products -->
		<?php }?>

    </section>

<?php }?>