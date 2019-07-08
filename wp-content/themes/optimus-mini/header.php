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
            <a href="<?php echo ('cart'); ?>" title="shopping cart" class="shopping-cart"><span class="icon-shopping-cart-outline"></span></a>
        </div>
    </div>
</nav>


<!-- Sidebar -->
<div id="sidebar">
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
                <li><a href="/optimus_mini">Homepage</a></li>
                <li><a href="shop">Shop</a></li>
                <li><a href="#">Elements</a></li>
                <li>
                    <span class="opener">Submenu</span>
                    <ul>
                        <li><a href="#">Lorem Dolor</a></li>
                        <li><a href="#">Ipsum Adipiscing</a></li>
                        <li><a href="#">Tempus Magna</a></li>
                        <li><a href="#">Feugiat Veroeros</a></li>
                    </ul>
                </li>
                <li><a href="#">Etiam Dolore</a></li>
                <li><a href="#">Adipiscing</a></li>
                <li>
                    <span class="opener">Another Submenu</span>
                    <ul>
                        <li><a href="#">Lorem Dolor</a></li>
                        <li><a href="#">Ipsum Adipiscing</a></li>
                        <li><a href="#">Tempus Magna</a></li>
                        <li><a href="#">Feugiat Veroeros</a></li>
                    </ul>
                </li>
                <li><a href="#">Maximus Erat</a></li>
                <li><a href="#">Sapien Mauris</a></li>
                <li><a href="#">Amet Lacinia</a></li>
            </ul>
        </nav>

    </div>
</div>