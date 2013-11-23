<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package five3.me
 * @since 1.0
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="article-0" class="content">
				<section id="post-0" class="left">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Hit the floor!', 'five3' ); ?></h1>
						<h2 class="entry-title"><?php _e( 'It\'s a 404.', 'five3' ); ?></h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'We can&rsquo;t find what you&rsquo;re looking for.', 'five3' ); ?></p>
						<p><?php _e( 'Perhaps searching, or one of the links below, can help.', 'five3' ); ?></p>

						<?php get_search_form(); ?>

						<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

						<div class="widget">
							<h2 class="widgettitle"><?php _e( 'Categories', 'five3' ); ?></h2>
							<ul>
							<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>
						</div>
					</div><!-- .entry-content -->

				</section><!-- #post-0 -->
				<div class="hit-the-floor">404</div>
			</article><!-- #article-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>