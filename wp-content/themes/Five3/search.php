<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package five3.me
 * @since 1.0
 */

get_header(); ?>

<article id="search-results" class="content">

<?php if ( have_posts() ) : ?>

	<section class="f3_section full">
		<header class="entry-header">
			<h1 class="entry-title">
				<?php printf( __( 'Results for: "%s"', 'five3' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header><!-- .entry-header -->
	</section>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<section id="post-<?php the_ID(); ?>" class="f3_section full">
		<header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'five3' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="entry-title">
					<?php the_title(); ?>
				</a>
			</h1>
		</header><!-- .entry-header -->

		<footer class="entry-meta">
			<?php
			printf( __( '<span class="sep">Published</span> <a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'five3' ),
				get_permalink(),
				get_the_date( 'c' ),
				get_the_date(),
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'five3' ), get_the_author() ),
				get_the_author()
			);
			?>
			<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( ' in', 'five3' ); ?></span> <?php the_category( ', ' ); ?></span>
			<?php the_tags( '<span class="sep"> | </span> <span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __( 'Tagged', 'five3' ) . '</span> ', ', ', '</span>' ); ?>
			<span class="sep"> | </span>

			<?php if ( comments_open() ) : ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'five3' ) . '</span>', __( '<b>1</b> Comment', 'five3' ), __( '<b>%</b> Comments', 'five3' ) ); ?></span>
			<?php endif; ?>

		</footer><!-- .entry-meta -->

	</section><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

<?php else : ?>

	<section id="no-results" class="full">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'five3' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'five3' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</section><!-- #post-0 -->

	<?php endif; ?>

	<nav id="posts">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
	</nav><!-- #nav-above -->

</article><!-- #search-results -->

<?php get_footer(); ?>