<?php
/**
 * The main template file.
 *
 * @package five3.me
 * @since 1.0
 */

get_header(); ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_type() ); ?>

	<?php endwhile; ?>

	<nav id="posts">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
	</nav><!-- #nav-above -->

	<?php f3_vertical_nav(); ?>

<?php get_footer(); ?>