<?php
get_header();

?>

<?php if (is_front_page()) {
	?>

     <section class="shop-banner margin-top-phone-7">

        <?php

	$image = get_blog_primary_image();
	$srcset = $image->medium . ' , ' . $image->large;

	?>

        <img src="<?php echo $image->small ?>" srcset="<?php echo $srcset; ?>">
    </section>

<?php }?>

<?php if (is_front_page()) {?>
    <main class="main-content">
    <section class="business-details">
        <div class="section-inner-wrapper">
            <h1 class="business-name"><?php echo get_option('blogname'); ?></h1>
            <div class="rating-widget">
                <div class="stars" data-score="4.5"></div>
                <div class="num-rating tag-descriptor">4.25 <span class="total-reviews">(<?php echo get_reviews_count(); ?> Reviews)</span></div>
            </div>
            <div class="orders-made">
                <div class="tag-descriptor"><?php echo get_total_orders('complete'); ?> <span class="total-reviews">Orders made</span>
                </div>
                <div class="tag-descriptor"><?php echo get_total_orders('on-hold'); ?> <span class="total-reviews">Deliveries made</span>
                </div>
            </div>
        </div>
    </section>

<?php }?>


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
                        <div class="owl-carousel owl-theme ui link cards">

                            <?php
$query = new WC_Product_Query(array(
		'limit' => 5,
		'orderby' => 'date',
		'order' => 'DESC',
		'category' => [$cat->slug],

	));
	$products = $query->get_products();

	foreach ($products as $product) {

		wc_get_template_part('content', 'product');

		?>


                                <?php }?>

                        </div> <!-- end of owl-carousel -->
                    </div> <!-- end of products slider -->
                </div> <!-- end of inner wrapper -->


            </div>    <!-- end of products -->
        <?php }?>

    </section>



    </main>
<?php

get_footer();

?>