<?php
/**
 * Template Name: Current Page & its Children
 * Description: List all children of the page this template is applied to. 
 *
 * @package five3.me
 * @since 1.0
 */

get_header(); ?>

	<?php /* Run the main loop to get the parent's ID */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php $parent_id = get_the_ID(); // store the parent page's ID ?>

		<?php get_template_part( 'content', get_post_type() ); ?>

	<?php endwhile; ?>

	<?php /* Create an Array with parent and children IDs */ ?>
	<?php $children =& get_children( array( 'post_parent' => $parent_id, 'post_type' => 'page', 'numberposts' => -1 ) ); ?>
	<?php $pages    = array_keys( $children ); ?>

	<?php /* Create a new loop with all pages, important to have all pages in one loop to display lines correctly */ ?>
	<?php $args = array( 'post_type' => 'page', 'post__in' => $pages, 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => -1 ); ?>
	<?php query_posts( $args ); // need to use the main query to correctly place lines ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_type() ); ?>

	<?php endwhile; ?>

	<?php f3_vertical_nav( $parent_id ); ?>

<?php get_footer(); ?>