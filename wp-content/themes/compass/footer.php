<div class="clear"></div>
<div class="footer">
    <?php
    /* A sidebar in the footer? Yep. You can can customize
     * your footer with four columns of widgets.
     */
    get_sidebar('footer');
    ?>
</div>
<div class="clear"></div>
<div class="bottom_footer_content">
    <div class="grid_16 alpha">         
        <div class="copyrightinfo">
            <p class="copyright"><a href="<?php echo esc_url('http://wordpress.org/'); ?>" rel="generator"><?php _e('Powered by WordPress', 'compass');
    ?></a>
                <span class="sep">&nbsp;|&nbsp;</span>
                <?php
                printf(__('%1$s by %2$s.', 'compass'), 'Compass', '<a href="'.esc_url( "https://www.inkthemes.com/market/featured-content-slider-wordpress-theme/" ).'" rel="nofollow">InkThemes</a>');?></p>
        </div>
    </div>
    <div class="grid_8 omega">
        <ul class="social_logos">			
            <?php if (compass_get_option('compass_rss') != '') { ?>
                <li class="rss"><a href="<?php echo compass_get_option('compass_rss'); ?>" alt="RSS" title="RSS" target="_blank"></a></li>
            <?php } 
            if (compass_get_option('compass_pinterest') != '') { ?>
                <li class="pn"><a href="<?php echo compass_get_option('compass_pinterest'); ?>" alt="Pinterest" target="_blank" title="Pinterest"></a></li>
            <?php }
            if (compass_get_option('compass_linkedin') != '') { ?>
                <li class="ln"><a href="<?php echo compass_get_option('compass_linkedin'); ?>" alt="Linked In" target="_blank" title="Linked In"></a></li> 
            <?php } ?> 
            <?php if (compass_get_option('compass_google') != '') { ?>
                <li class="gp"><a href="<?php echo compass_get_option('compass_google'); ?>" alt="Google" title="Google" target="_blank"></a></li>
            <?php } 
            if (compass_get_option('compass_instagram') != '') { ?>
                <li class="insta"><a href="<?php echo compass_get_option('compass_instagram'); ?>" alt="Instagram" target="_blank" title="Instagram"></a></li>
            <?php }
            if (compass_get_option('compass_twitter') != '') { ?>
                <li class="twitter"><a href="<?php echo compass_get_option('compass_twitter'); ?>" alt="Twitter" target="_blank" title="Twitter"></a></li> 
            <?php } ?> 
            <?php if (compass_get_option('compass_youtube') != '') { ?>
                <li class="yt"><a href="<?php echo compass_get_option('compass_youtube'); ?>" alt="Youtube" title="Youtube" target="_blank"></a></li>
            <?php } 
            if (compass_get_option('compass_tumblr') != '') { ?>
                <li class="tumblr"><a href="<?php echo compass_get_option('compass_tumblr'); ?>" alt="Tumblr" target="_blank" title="Tumblr"></a></li>
            <?php }
            if (compass_get_option('compass_flickr') != '') { ?>
                <li class="flikr"><a href="<?php echo compass_get_option('compass_flickr'); ?>" alt="Flickr" target="_blank" title="Flickr"></a></li> 
            <?php } ?> 
            <?php 
            if (compass_get_option('compass_facebook') != '') { ?>
                <li class="fb"><a href="<?php echo compass_get_option('compass_facebook'); ?>" alt="Facebook" target="_blank" title="Facebook"></a></li>
            <?php }?>
        </ul>  
    </div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php wp_footer(); ?>
</body>
</html>