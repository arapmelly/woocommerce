<?php
	/**
	 * Created by PhpStorm.
	 * User: kevin
	 * Date: 09/07/2019
	 * Time: 09:20
	 * Template Name: Contact Us
	 */
?>

<?php get_header(); ?>
    <div id="main" class="main-wrapper">
        <section class="about-us get-in-touch">
            <div class="section-inner-wrapper">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="container">
						<?php echo get_the_content(); ?>
                    </div>
				<?php endwhile; endif;
					wp_reset_query(); ?>
            </div>
        </section>

        <section class="contact-us">
            <div class="section-inner-wrapper">
                <div class="ui form">
                    <form method="post" action="#">
                        <div class="three fields">
                            <div class="field">
                                <label for="full_name">Name</label>
                                <input type="text" id="full_name" placeholder="Enter full name">
                            </div>
                            <div class="field">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" placeholder="Phone number">
                            </div>
                            <div class="field">
                                <label for="email">Email</label>
                                <input type="text" id="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea id="message"></textarea>
                        </div>

                        <div class="field">
                            <input type="submit" value="Send Message" class="ui primary button">
                        </div>
                    </form>
                </div>
                <div class="contact-details">

                    <ul>
                        <?php if (get_option('blogprimaryphonenumber')) { ?><li><span class="icon-phone-outline"></span><span>Phone:</span> <a href="tel:<?php echo get_option('blogprimaryphonenumber'); ?>"> <?php echo get_option('blogprimaryphonenumber'); ?></a></li><?php } ?>
                        <?php if (get_option('admin_email')) { ?><li><span class="icon-email-outline"></span><span>Email:</span> <a href="mailto:<?php echo get_option('admin_email'); ?>"><?php echo get_option('admin_email'); ?></a></li><?php } ?>
                        <?php if (get_option('blogprimaryaddress')) { ?><li><span class="icon-store"></span><span>Address:</span> <?php echo get_option('blogprimaryaddress'); ?></li><?php } ?>
                    </ul>

                </div>
            </div>
        </section>
    </div>

<?php get_footer();
