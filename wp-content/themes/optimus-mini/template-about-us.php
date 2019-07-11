<?php
	/**
	 * Created by PhpStorm.
	 * User: kevin
	 * Date: 08/07/2019
	 * Time: 14:32
	 * Template Name: About Us
	 */
?>

<?php get_header(); ?>

    <section class="about-us">
        <div class="section-inner-wrapper">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="container">
					<?php echo get_the_content(); ?>
                </div>
			<?php endwhile; endif;
				wp_reset_query(); ?>
        </div>
    </section>

<?php get_footer();
