<?php
	/**
	 * Theme Index Section for our theme.
	 *
	 * @package ThemeGrill
	 * @subpackage Spacious
	 * @since Spacious 1.0
	 */
	get_header(); ?>


<?php if ( have_posts() ): ?>

	<?php while ( have_posts() ): the_post(); ?>


		<?php

		if ( is_front_page() ) {
			get_template_part( 'content', get_post_format() );

		} else {
			the_content();
		}
		?>


	<?php endwhile; ?>

<?php else: ?>

	<?php echo '<p>There are no products at the moment</p>'; ?>

<?php endif; ?>


<?php get_footer(); ?>
