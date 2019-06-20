<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 */
?>
<?php get_header(); ?>
<div class="page-content">
    <div class="grid_sub_24 sub_alpha">
        <div class="content-bar">
            <?php if (have_posts()) : the_post(); ?>

<!--
<h1 class="page-title">
                    <?php the_title(); ?>
                </h1>
-->
                <?php
                the_content();
                

                 ?>
                <?php wp_link_pages(array('before' => '<div class="clear"></div><div class="page-link"><span>' . __('Pages:', 'elite-lite') . '</span>', 'after' => '</div>')); ?>
            <?php endif; ?>
             <!--Start Comment box-->
            <?php //comments_template(); ?>
            <!--End Comment box-->
        </div>
    </div>
    <div class="grid_sub_8 sub_omega">
        <?php //get_sidebar(); ?>
    </div>
</div>
</div>
<?php get_footer(); ?>
