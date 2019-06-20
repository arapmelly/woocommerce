<?php
get_header();


?>
    <?php if(is_front_page()) { ?> 
	   <section class="shop-banner margin-top-phone-7">
    	   <?php echo do_shortcode('[shop-banner]'); ?>
	   </section>
    <?php } ?>

<?php if(is_front_page()) { ?> 
<main class="main-content">
	<section class="business-details">
        <div class="section-inner-wrapper">
            <h1 class="business-name"><?php echo bloginfo('sitename'); ?></h1>
            <div class="rating-widget">
                <div class="stars" data-score="4.5"></div>
                <div class="num-rating tag-descriptor">4.25 <span class="total-reviews">(560 Reviews)</span></div>
            </div>
            <div class="orders-made">
                <div class="tag-descriptor"><?php echo get_total_orders('complete'); ?> <span class="total-reviews">Orders made</span></div>
                <div class="tag-descriptor"><?php echo get_total_orders('on-hold'); ?> <span class="total-reviews">Deliveries made</span></div>
            </div>
        </div>
    </section>

<?php } ?>

    


    <?php 

$args = array(
    'type'                     => 'product',
    'parent'                   => get_queried_object_id(),
    'orderby'                  => 'term_group',
    'hide_empty'               => true,
    'hierarchical'             => 1,
    'taxonomy'                 => 'product_cat',
    'pad_counts'               => false
);

$cats = get_categories( $args );

?>

    <section class="filter-by-category">
        <div class="section-inner-wrapper">
            <div class="owl-carousel owl-theme">
                <?php foreach($cats as $cat) { ?>
                    <div class="item">
                        <a href="<?php echo  get_term_link( $cat->term_taxonomy_id, 'product_cat' ); ?>"><h4><?php echo $cat->name; ?></h4></a>
                    </div>
                <?php } ?>
            </div>
            <div class="custom-nav owl-nav"></div>
        </div>
    </section>



    <section class="products-by-category">
        <?php foreach($cats as $cat) { ?>
        <div class="products">
            <header class="category-header">
                <div class="inner-wrapper">
                    <h3><?php echo $cat->name; ?> </h3>
                    <a href="<?php echo  get_term_link( $cat->term_taxonomy_id, 'product_cat' ); ?>">View All</a>
                </div>
            </header>

            <div class="section-inner-wrapper">
                <div class="products-slider">
                    <div class="owl-carousel owl-theme ui link cards">

                    <?php 
$query = new WC_Product_Query( array(
    'limit' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category' => [$cat->slug],
    
) );
$products = $query->get_products();

foreach($products as $product){
    
    ?>

                        <div class="item card">
                            <div class="image">
                                
                                <span class="caol-ila_1984"><?php echo $product->get_image(); ?></span>
                            </div>
                            <div class="content price-discount">
                                    <div class="header price"><?php echo wc_price($product->get_price()); ?></div>
                                    
                                    <?php if($product->is_on_sale()) { ?> 
                                        <div class="header price" style="text-decoration:line-through"><?php echo wc_price($product->get_regular_price()); ?></div>
                                        <div class="discount"><?php echo get_percentage_discount($product); ?> Off</div>
                                    <?php } ?>
                                    
                            </div>
                            <div class="content">
                                <div class="header"><?php echo $product->get_name(); ?></div>
                                <div class="description">
                                    <?php echo $product->get_description(); ?>
                                </div>
                            </div>

                            <a href="<?php echo get_permalink( $product->get_id() ); ?>" data-quantity="1" class="ui bottom attached button">
                                buy
                            </a>
                        </div>

<?php } ?>

                    </div> <!-- end of owl-carousel -->
                </div> <!-- end of products slider -->
            </div> <!-- end of inner wrapper -->


        </div>    <!-- end of products -->   
        <?php } ?>
    
    </section>



    <?php 

    if(!is_front_page()){
        woocommerce_content();
    }

    ?>
    

</main>



<?php



get_footer();

?>