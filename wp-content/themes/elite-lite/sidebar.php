<div class="sidebar">
  <?php $options = get_option('elite-lite');  ?> 
  
  <?php if ((elite_get_option('elite_facebook') != '' ) || (elite_get_option('elite_twitter') != '' ) || (elite_get_option('elite_rss') != '') || (elite_get_option('elite_google') != '') || (elite_get_option('elite_flickr') != '') || (elite_get_option('elite_pintrust') != '') || (elite_get_option('elite_pintrust') != '') || (elite_get_option('elite_youtube') != '') ) { ?>
  <div class="social-links">
  <ul class="social_logos">
                <?php if (elite_get_option('elite_facebook') != '') { ?>
                            <li class="facebook"><a href="<?php echo esc_url(elite_get_option('elite_facebook')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_twitter') != '') { ?>
                            <li class="twitter"><a href="<?php echo esc_url(elite_get_option('elite_twitter')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_youtube') != '') { ?>
                            <li class="youtube"><a href="<?php echo esc_url(elite_get_option('elite_youtube')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_linked') != '') { ?>
                            <li class="linkedin"><a href="<?php echo esc_url(elite_get_option('elite_linked')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_flickr') != '') { ?>
                            <li class="flickr"><a href="<?php echo esc_url(elite_get_option('elite_flickr')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_google') != '') { ?>
                            <li class="google"><a href="<?php echo esc_url(elite_get_option('elite_google')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_tumblr') != '') { ?>
                            <li class="tumblr"><a href="<?php echo esc_url(elite_get_option('elite_tumblr')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_pinterest') != '') { ?>
                            <li class="pinterest"><a href="<?php echo esc_url(elite_get_option('elite_pinterest')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>

                        <?php if (elite_get_option('elite_digg') != '') { ?>
                            <li class="digg"><a href="<?php echo esc_url(elite_get_option('elite_digg')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>
                    

                            <?php if (elite_get_option('elite_instagram') != '') { ?>
                            <li class="instagram"><a href="<?php echo esc_url(elite_get_option('elite_instagram')); ?>"><span></span></a></li>
                            <?php
                        } else {
                            
                        }
                        ?>
                        
                </ul>
  </div>
  <?php } ?>
  <div class="clear"></div>
  <?php if (!dynamic_sidebar('primary-widget-area')) : ?>
  <?php get_search_form(); ?>
  <h4>
    <?php _e('Categories', 'elite-lite'); ?>
  </h4>
  <ul>
    <?php wp_list_categories('title_li'); ?>
  </ul>
  <h4>
    <?php _e('Archives', 'elite-lite'); ?>
  </h4>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
  <?php endif; // end primary widget area ?>
  <?php
// A second sidebar for widgets, just because.
    if (is_active_sidebar('secondary-widget-area')) :
        ?>
  <?php dynamic_sidebar('secondary-widget-area'); ?>
  <?php endif; ?>
</div>
