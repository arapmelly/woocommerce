<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title><?php echo bloginfo('sitename'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/images/favicon.ico'; ?>"
          type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri() . '/images/favicon.ico'; ?>" type="image/x-icon">
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script language="javascript">
        window.onload = function (e) {
            $(".pre-loader").fadeOut(2500);
        }
    </script>

</head>

<body <?php body_class();?>>

<div class="pre-loader">
    <div class="circle circle_green"></div>
    <div class="circle circle_red"></div>
</div>

<div id="wrapper">

    <!-- Panel Top #library/panel/panel-top-10.html -->
    <nav class="navigation panel top  white">
        <div class="sections">
            <div class="left">
                <a href="#" title="menu toggle" class="menu actionButton toggle sidebarTrigger"><span
                            class="icon-menu-outline"></span></a>
                <a href="<?php echo get_site_url(); ?>" title="shop logo" class="logo">
					<?php echo get_option('blogacronym'); ?>
                </a>

                <div id="search" class="search-top">
                    <form method="post" action="<?php echo home_url('/'); ?>">
                        <input type="text" name="search" placeholder="What you are looking for?"
                               value="<?php the_search_query();?>">
                        <input type="hidden" name="post_type" value="product">
                    </form>
                </div>

            </div>

            <div class="right">
                <a href="<?php echo ('cart'); ?>" title="shopping cart" class="shopping-cart" tracking-name="shopping_cart_icon">
                    <span class="icon-shopping-cart-outline"></span>
                    <span class="item-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
            </div>
        </div>
    </nav>


    <!-- Sidebar -->
    <div id="sidebar" class="inactive">
        <div class="inner">

            <!-- Search -->
            <section id="search" class="alt">
                <form method="post" action="<?php echo home_url('/'); ?>">
                    <input type="text" name="s" placeholder="What you are looking for?"
                           value="<?php the_search_query();?>">
                    <input type="hidden" name="post_type" value="product">
                </form>
            </section>

            <!-- Menu -->
            <nav id="menu">
                <!--            <header class="major">-->
                <!--                <h2>Menu</h2>-->
                <!--            </header>-->
                <ul>

                    <li><a href="<?php echo get_site_url() . '/shop'; ?>">All</a></li>

					<?php $cats = get_product_categories();?>
					<?php foreach ($cats as $cat) {?>
						<?php if ($cat->name != 'Uncategorized') {?>
                            <li>
                                <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>"><?php echo $cat->name; ?></a>
                            </li>


						<?php }?>
					<?php }?>


                    <!-- <li><a href="<?php //echo get_permalink(get_page_by_path('about')); ?>">About Us</a></li>

                <li>
                    <span class="opener">Categories</span>
                    <ul>
                        <li>
                                <a href="shop">All</a>
                            </li>

                        <?php //$cats = get_product_categories();?>
                        <?php //foreach ($cats as $cat) {?>
                            <?php //if ($cat->name != 'Uncategorized') {?>
                            <li>
                                <a href="<?php //echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>"><?php //echo $cat->name; ?></a>
                            </li>

                            <?php //}?>
                        <?php // }?>


                    </ul>
                </li> -->
                    <!-- <li><a href="<?php //echo get_permalink(get_page_by_path('contact')); ?>">Contact Us</a></li> -->

                </ul>
            </nav>

        </div>
    </div>