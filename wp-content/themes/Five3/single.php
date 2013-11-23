<?php
/**
 * The Template for displaying a single posts.
 *
 * @package five3.me
 * @since 1.0
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>
		<nav id="single">
			<span class="nav-previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'five3' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next &rarr;', 'five3' ) ); ?></span>
		</nav><!-- #single -->

		<?php /* comments_template( '', true ); */ ?>

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>