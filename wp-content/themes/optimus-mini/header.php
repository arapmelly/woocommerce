<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title><?php echo bloginfo('sitename'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

</head>

<body <?php body_class();?>>

<!-- Panel Top #library/panel/panel-top-10.html -->
<nav class="navigation panel top  white">
    <div class="sections">
        <div class="left">
            <a href="#" title="menu toggle" class="menu actionButton sidebarTrigger"><span
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