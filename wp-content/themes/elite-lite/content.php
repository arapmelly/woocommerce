<div class="content-bar">
    <!--Start Loop-->
    <!--post start-->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <ul class="post_meta">
                    <li class="post_date"><?php the_time(get_option('date_format')); ?></li>
                    <li class="post_category">
                        <?php the_category(', '); ?>
                    </li>
                    <li class="posted_by">
                        <?php the_author_posts_link(); ?>
                    </li>
                    <li class="postc_comment"><span></span>&nbsp;
                        <?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?>
                    </li>
                </ul>
                <div class="clear"></div>
                <div class="post_content">
                    <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                        <?php elite_get_thumbnail(182, 165); ?>
                    <?php } else { ?>
                        <?php elite_get_image(182, 165); ?>
                        <?php
                    }
                    ?>
                    <div class="post_data">
                        <?php the_excerpt(); ?>
                        <div class="clear"></div>
                        <?php if (has_tag()) { ?>
                            <div class="tag">
                                <?php the_tags('Post Tagged with ', ', ', ''); ?>
                            </div>
                        <?php } ?>
                        <a class="read_more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'elite-lite'); ?></a>
                    </div>
                </div>
            </div>
            <!--post End-->
        <?php
        endwhile;
    else:
        ?>
        <div class="post">
            <p>
    <?php _e('Sorry, no posts matched your criteria.', 'elite-lite'); ?>
            </p>
        </div>
<?php endif; ?>
    <!--End Loop-->
    <nav id="nav-single"> <span class="nav-previous">
            <?php next_posts_link(__('&larr; Older posts', 'elite-lite')); ?>
        </span> <span class="nav-next">
<?php previous_posts_link(__('Newer posts &rarr;', 'elite-lite')); ?>
        </span> </nav>
</div>