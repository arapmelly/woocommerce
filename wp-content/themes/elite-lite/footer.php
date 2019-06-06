<div class="clear"></div>
<div class="footer-wrapper">
    <?php $options = get_option('elite-lite'); ?>
    <div class="footer-top">
        <div class="footer">
            <?php
            /* A sidebar in the footer? Yep. You can customize
             * your footer with four columns of widgets.
             */
            get_sidebar('footer');
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="bottom-footer">
        <?php if (elite_get_option('elite_footertext') != '') { ?>
            <p class="copyright"><?php echo elite_get_option('elite_footertext'); ?></p> 
        <?php } else { ?>
            <p><a href="<?php echo esc_url('https://www.inkthemes.com/market/clean-flat-wordpress-theme/'); ?>" rel="nofollow">Elite Theme</a> powered by <a href="<?php echo esc_url('http://www.wordpress.org'); ?>">WordPress</a></p>
        <?php } ?>
    </div>
</div>
</div>
</div>
<div class="clear"></div>
<?php wp_footer(); ?>
</body></html>