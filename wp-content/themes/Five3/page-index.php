<?php
/**
 * Template Name: All Top Level Pages
 * Description: List all top level pages on your site. 
 *
 * @package five3.me
 * @since 1.0
 */
global $wp_query;

query_posts( 
	array_merge( 
		$wp_query->query, 
		array( 
			'post_type'      => 'page', 
			'post_parent'    => 0, 
			'posts_per_page' => -1, 
			'orderby'        => 'menu_order', 
			'order'          => 'ASC' 
		) 
	) 
);

get_header(); ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_type() ); ?>

	<?php endwhile; ?>

	<?php f3_vertical_nav(); ?>

<?php get_footer(); ?>