<?php
get_header();

?>

<?php echo do_shortcode('[shop-banner]'); ?>



<main class="main-content">

    <section class="business-details">
        <div class="section-inner-wrapper">
            <h1 class="business-name"><?php bloginfo('name'); ?></h1>
            <div class="rating-widget">
                <div class="stars" data-score="4.5"></div>
                <div class="num-rating tag-descriptor">4.25 <span class="total-reviews">(560 Reviews)</span></div>
            </div>
            <div class="orders-made">
                <div class="tag-descriptor"><?php echo get_total_orders('processing'); ?><span class="total-reviews"> Orders made</span></div>
                <div class="tag-descriptor"><?php echo get_total_orders('completed'); ?> <span class="total-reviews">Deliveries made</span></div>
            </div>
        </div>
    </section>

   


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
                <div class="item"><h4><?php echo $cat->name; ?></h4></div>
            <?php } ?>
                
            </div>
            <div class="custom-nav owl-nav"></div>
        </div>
    </section>

<?php
foreach($cats as $cat){ 

    
?>


<section class="products-by-category">
        <div class="products">
            <header class="category-header">
                <div class="inner-wrapper">
                    <h3><?php echo $cat->name; ?></h3>
                    <a href="#">View All</a>
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

    <?php 
        include( locate_template( 'templates/product.php', false, false ) );                   
    ?>

<?php    
}

?>

</div>

</div>
</div>
</div>



    
<?php
}

?>


   
     
</main>

<?php get_footer(); ?>

