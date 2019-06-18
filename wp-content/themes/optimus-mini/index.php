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
                <div class="tag-descriptor">2,500 <span class="total-reviews">Orders made</span></div>
                <div class="tag-descriptor">510 <span class="total-reviews">Deliveries made</span></div>
            </div>
        </div>
    </section>

    <section class="filter-by-category">
        <div class="section-inner-wrapper">
            <div class="owl-carousel owl-theme">
                <div class="item"><h4>Whiskey</h4></div>
                <div class="item"><h4>Wine</h4></div>
                <div class="item"><h4>Vodka</h4></div>
                <div class="item"><h4>Beer</h4></div>
                <div class="item"><h4>Gin</h4></div>
                <div class="item"><h4>Rum</h4></div>
                <div class="item"><h4>cognac</h4></div>
            </div>
            <div class="custom-nav owl-nav"></div>
        </div>
    </section>



    <section class="products-by-category">
        <div class="products">
            <header class="category-header">
                <div class="inner-wrapper">
                    <h3>whiskey</h3>
                    <a href="#">View All</a>
                </div>
            </header>
            <div class="section-inner-wrapper">
                <div class="products-slider">
                    <div class="owl-carousel owl-theme ui link cards">
  
<?php 
$query = new WC_Product_Query( array(
    'limit' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    
) );
$products = $query->get_products();

foreach($products as $product){
    ?>

<div class="item card">
                            <div class="image">
                                
                                <span class="caol-ila_1984"><?php echo $product->get_image(); ?></span>

                               
                                
                            </div>
                            <div class="content price-discount">
                                <div class="header price"><?php echo $product->get_price_html(); ?></div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header"><?php echo $product->get_name(); ?></div>
                                <div class="description">
                                <?php echo $product->get_description(); ?>
                                </div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>

<?php    
}

?>

</div>

</div>
</div>
</div>
   

    
         <!--               
        <div class="products">
            <header class="category-header">
                <div class="inner-wrapper">
                    <h3>wine</h3>
                    <a href="#">View All</a>
                </div>
            </header>
            <div class="section-inner-wrapper">
                <div class="products-slider">
                    <div class="owl-carousel owl-theme ui link cards">
                        <div class="item card">
                            <div class="image">
                                <img src="img/chateau-micalet-2014-copy.jpg"
                                     srcset="img/chateau-micalet-2014-copy@2x.jpg 2x,img/chateau-micalet-2014-copy@3x.jpg 3x"
                                     class="CHATEAU-MICALET-2014-copy">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">CHATEAU MICALET 2014</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                        <div class="item card">
                            <div class="image">
                                <img src="img/veronica-ortega-copy.jpg"
                                     srcset="img/veronica-ortega-copy@2x.jpg 2x,img/veronica-ortega-copy@3x.jpg 3x"
                                     class="VERONICA-ORTEGA-copy">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">VERONICA ORTEGA QUITE 2016</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                        <div class="item card">
                            <div class="image">
                                <img src="img/chateau-des-tours-brouilly-2017-copy.jpg"
                                     srcset="img/chateau-des-tours-brouilly-2017-copy@2x.jpg 2x,img/chateau-des-tours-brouilly-2017-copy@3x.jpg 3x"
                                     class="CHATEAU-DES-TOURS-BROUILLY-2017-copy">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">CHATEAU DES TOURS 2017</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="products">
            <header class="category-header">
                <div class="inner-wrapper">
                    <h3>beer</h3>
                    <a href="#">View All</a>
                </div>
            </header>
            <div class="section-inner-wrapper">
                <div class="products-slider">
                    <div class="owl-carousel owl-theme ui link cards">
                        <div class="item card">
                            <div class="image">
                                <img src="img/heineken-500-ml-can.jpg"
                                     srcset="img/heineken-500-ml-can@2x.jpg 2x,img/heineken-500-ml-can@3x.jpg 3x"
                                     class="Heineken-500ml-can">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">Heineken lager</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                        <div class="item card">
                            <div class="image">
                                <img src="img/guinness.jpg"
                                     srcset="img/guinness@2x.jpg 2x,img/guinness@3x.jpg 3x"
                                     class="guinness">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">Guinness</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                        <div class="item card">
                            <div class="image">
                                <img src="img/tusker-cidar-can-500-ml.jpg"
                                     srcset="img/tusker-cidar-can-500-ml@2x.jpg 2x,img/tusker-cidar-can-500-ml@3x.jpg 3x"
                                     class="Tusker-cidar-can-500ml">
                            </div>
                            <div class="content price-discount">
                                <div class="header price">6,800 KES</div>
                                <div class="discount">30% off</div>
                            </div>
                            <div class="content">
                                <div class="header">Tusker cidar</div>
                            </div>

                            <a href="#" class="ui bottom attached button">
                                buy
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
-->
</main>

<?php get_footer(); ?>

