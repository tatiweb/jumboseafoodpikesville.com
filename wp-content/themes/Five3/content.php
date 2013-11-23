<?php
/**
 * The default template for content
 *
 * @package five3.me
 * @since 1.0
 */
global $wp_query, $post_alignment, $link_title;

$post_id = get_the_ID();

$background_image_id  = get_post_meta( $post_id, '_f3_background', true );
$background_image_src = wp_get_attachment_image_src( $background_image_id, 'full' );

$background_image_src = apply_filters( 'f3_background_image_src', $background_image_src[0], $background_image_id, $post_id );
$background_repeat    = get_post_meta( $post_id, '_f3_background_repeat', true );

$overlay_image_id     = get_post_meta( $post_id, '_f3_overlay', true );
$overlay_repeat       = get_post_meta( $post_id, '_f3_overlay_repeat', true );

$has_background       = ( isset( $background_image_src ) || ! empty( $overlay_image_id ) ) ? 'has-background' : '';

$post_alignment       = get_post_meta( $post_id, '_f3_post_alignment', true );

if ( get_option( 'f3_show_shadows', 'true' ) == 'true' ) { 
	// If there is no overlay, set the shadow to the content container, otherwise, it's added to the overlay container
	if ( empty( $overlay_image_id ) ) {
		$content_container_shadow = 'shadow-container';
		$overlay_container_shadow = '';
	} else {
		$content_container_shadow = '';
		$overlay_container_shadow = 'shadow-container';
	}
} else {
	$content_container_shadow = $overlay_container_shadow = '';
}


?>
<article id="<?php f3_anchor_title(); ?>" <?php post_class( array( 'content' ) ); ?>>
	<div class="content-container <?php echo $background_repeat . ' ' . $has_background . ' ' . $content_container_shadow; ?>"<?php echo ( isset( $background_image_src ) ) ? " style=\"background-image:url('$background_image_src');\"" : ''; ?>>
		<section id="post-<?php the_ID(); ?>" class="f3_section <?php echo $post_alignment; ?>">
			<header class="entry-header">
				<h1 class="entry-title">
					<?php if( $link_title ) : ?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'five3' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="entry-title"><?php endif; ?>
						<?php the_title(); ?>
					<?php if( $link_title ) : ?></a><?php endif; ?>
				</h1>
			</header><!-- .entry-header -->

			<?php if ( is_search() ) : ?>
			<div class="entry-summary">
				<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'five3' ) ); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'five3' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'five3' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			<?php endif; ?>

			<?php if( is_object( $post ) && ( 'post' == $post->post_type || current_user_can( 'edit_posts' ) ) ) : ?>
			<footer class="entry-meta">
				<?php if ( 'post' == $post->post_type ) : ?>
					<?php
					printf( __( '<span class="sep">Posted on </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'five3' ),
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

				<?php endif; ?>
				<?php edit_post_link( __( 'Edit', 'five3' ), '<div class="edit-link">', '</div>' ); ?>
			</footer><!-- .entry-meta -->
		<?php endif; ?>
		</section><!-- #post-<?php the_ID(); ?> -->
		<?php if( ! empty( $overlay_image_id ) ) : ?>
			<?php $overlay_image_src = wp_get_attachment_image_src( $overlay_image_id, 'full' ); ?>
			<?php $overlay_image_src = apply_filters( 'f3_overlay_image_src', $overlay_image_src[0], $overlay_image_id, $post_id ); ?>
			<div class='overlay <?php echo $overlay_repeat . ' ' . $overlay_container_shadow; ?>' style='background-image:url(<?php echo $overlay_image_src; ?>);'></div>
		<?php endif; ?>
	</div>
	<div class="preloader"><div><?php echo get_option( 'f3_loading_text', __( 'Loading', 'five3' ) ); ?></div></div>
</article><!-- #article-<?php the_ID(); ?> -->
