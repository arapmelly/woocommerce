<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title><?php echo bloginfo('sitename'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

</head>

<body <?php body_class();?>>

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
        </div>
        <div class="right">
            <a href="<?php echo ('cart'); ?>" title="shopping cart" class="shopping-cart">
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
            <form method="post" action="#">
                <input type="text" name="query" id="query" placeholder="Search" />
            </form>
        </section>

        <!-- Menu -->
        <nav id="menu">
<!--            <header class="major">-->
<!--                <h2>Menu</h2>-->
<!--            </header>-->
            <ul>
                <li><a href="<?php echo get_site_url(); ?>">Homepage</a></li>

                <li><a href="<?php echo get_permalink(get_page_by_path('about')); ?>">About Us</a></li>

                <li>
                    <span class="opener">Categories</span>
                    <ul>
                        <?php $cats = get_product_categories();?>
                        <?php foreach ($cats as $cat) {?>
                            <?php if ($cat->name != 'Uncategorized') {?>
                            <li>
                                <a href="<?php echo get_term_link($cat->term_taxonomy_id, 'product_cat'); ?>"><?php echo $cat->name; ?></a>
                            </li>

                            <?php }?>
                        <?php }?>


                    </ul>
                </li>
                <li><a href="<?php echo get_permalink(get_page_by_path('contact')); ?>">Contact Us</a></li>

            </ul>
        </nav>

    </div>
</div>