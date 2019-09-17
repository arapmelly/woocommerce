<?php if (is_front_page()): ?>

    <section class="shop-banner margin-top-phone-7">
        <div class="banner-inner-wrapper">

            <div class="shop-description">

                <div id="search" class="search-mobile">
                    <form method="post" action="<?php echo home_url('/'); ?>">
                        <input type="text" name="search" placeholder="What you are looking for?"
                               value="<?php the_search_query(); ?>">
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>

                <header class="shop-name">
                    <h1><?php echo get_option('blogname'); ?></h1>

                    <?php if (get_option('blogdescription')) { ?>
                        <div class="tag-description">
                            <p><?php echo get_option('blogdescription'); ?></p>
                        </div>
                    <?php } ?>

                    <div class="share-btn">
                        <div class="share-icons">
                            <?php

                            $phone = get_option('blogprimaryphonenumber');

                            $call_shop = 'tel:+' . $phone;

                            $text = 'Hi! I would like to make an enquiry on your shop. Get back to me';

                            $shop_link = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . $text;
                            $lat = '-1.2922618';
                            $long = '36.8063141';
                            $query_place_id = 'ChIJKxjxuaNqkFQR3CK6O1HNNqY';
                            $location = 'https://www.google.com/maps/search/?api=1&query=' . $lat . ',' .  $long . '&query_place_id=' . $query_place_id;
//                            'https://www.google.com/maps/search/?api=1&query=47.5951518,-122.3316393'

                            ?>

                            <a href="<?php echo $call_shop; ?>" tracking-name="phone_icon_home">
                                <span class="icon-phone-outline"></span>
                            </a>

                            <a href="<?php echo $shop_link; ?>" data-action="share/whatsapp/share" target="_blank"
                               tracking-name="whatsapp_icon_home">
                                <span class="icon-whatsapp"></span>
                            </a>

                            <?php if ($location) { ?>
                                <a href="<?php echo $location; ?>" target="_blank" class="location"><span class="icon-pin-outline"></span> </a>
                            <?php } ?>

<!--                            --><?php //echo get_option('blogprimaryaddress'); ?>

<!--                            <a href="--><?php //echo $call_shop; ?><!--" tracking-name="phone_icon_home">-->
<!--                                <span class="icon-phone-outline"></span>-->
<!--                            </a>-->

                        </div>
                    </div>

                </header>
            </div>

            <div class="shop-cover-photo">
                <?php

                $image = get_blog_primary_image();
                $srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';

                ?>

<!--                <img src="https://massdrop-s3.imgix.net/hero-banner/TReEW4PJSD2VxYw2evyZ_3450x1767_HD6XX_Copy.jpg?auto=format&fm=jpg&fit=crop" alt="">-->
<!--                <img src="--><?php //echo get_template_directory_uri() . '/images/banner3.jpg'; ?><!--" alt="">-->
                        <img srcset="<?php echo $srcset; ?>" sizes="(max-width: 425px) 270px, (max-width: 768px) 600px, 1920px"
                             src="<?php echo $image->small ?>" alt="">

            </div>
        </div>
    </section>

<?php endif; ?>

<main class="main-content">

    <section class="products-by-category">

        <?php
        $cats = get_product_categories();
        foreach ($cats as $cat) {
            ?>
            <?php if (is_featured_category($cat)): ?>

                <div class="products">

                    <header class="category-header">
                        <div class="inner-wrapper">
                            <h1><?php echo $cat->name; ?> </h1>
                            <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>"
                               tracking-name="">View All</a>
                        </div>
                    </header> <!-- end of category header -->

                    <div class="section-inner-wrapper">

                        <div class="products-slider">
                            <!-- start of ui div -->
                            <div class="ui link cards">
                                <?php
                                $query = new WC_Product_Query(array(
                                    'limit' => 4,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'status' => 'publish',
                                    'category' => [$cat->slug],
                                ));
                                $products = $query->get_products();
                                $itemWidth = "";
                                $productsLoopCounter = 1;
                                foreach ($products

                                as $product) {
                                $product = wc_get_product($product->get_id());
                                $productPriceHTML = $product->get_price_html();
                                $productType = $product->get_type();
                                ?>
                                <?php
                                if (isset($products) && is_array($products) && count($products) == 1) {
                                    $itemWidth = "full-width";
                                } elseif (count($products) > 1) {
                                    if (count($products) == 3) {
                                        $itemWidth = "full-width";
                                    }
                                }
                                ?>

                                <?php if ($productsLoopCounter == count($products) && count($products) == 3) { ?>

                                <a href="<?php echo get_permalink($product->get_id()); ?>"
                                   class="card <?php echo $itemWidth; ?>"
                                   tracking-name="<?php echo 'product-' . $product->get_sku(); ?>">

                                    <?php } elseif ($productsLoopCounter == count($products) && count($products) == 1) { ?>
                                    <a href="<?php echo get_permalink($product->get_id()); ?>"
                                       class="card <?php echo $itemWidth; ?>"
                                       tracking-name="<?php echo 'product-' . $product->get_sku(); ?>">
                                        <?php } else { ?>
                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="card"
                                           tracking-name="<?php echo 'product-' . $product->get_sku(); ?>">
                                            <?php } // end of product loop else if block ?>

                                            <?php
                                            $image = get_product_primary_image($product);
                                            if (!is_null($image)) {
                                                $srcset = $image->small . ' 425w' . ', ' . $image->medium . ' 768w' . ', ' . $image->large . ' 1920w';
                                            }
                                            ?>
                                            <div class="image"
                                                 style="background-image: url(<?php echo isset($image->medium) ? $image->medium : "https://via.placeholder.com/600x600.png?text=No+Image" ?>)">

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
                                                            <?php
                                                            echo $productPriceHTML;
                                                            ?>
                                                        </h2>

                                                    <?php } else {
                                                        ?>
                                                        <?php
                                                        if ($product->get_sale_price() <= 0) { ?>
                                                            <h2 class="current-price" id="productPrice">
                                                                <?php echo wc_price($product->get_regular_price()); ?>
                                                            </h2>
                                                        <?php } ?>

                                                        <?php if ($product->get_sale_price() > 0) { ?>
                                                            <h2 class="current-price" id="product_price">
                                                                <?php echo wc_price($product->get_sale_price()); ?>
                                                            </h2>
                                                            <h2 class="previous-price" id="productPrice">
                                                                <?php echo wc_price($product->get_regular_price()); ?>
                                                            </h2>
                                                        <?php } ?>

                                                    <?php } ?>


                                                </div> <!-- /end of header price div -->

                                                <?php
                                                if ($product->get_sale_price() > 0) { ?>
                                                    <div class="discount">
                                                        <?php echo get_percentage_discount($product); ?>
                                                        Off
                                                    </div>
                                                <?php } ?>


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