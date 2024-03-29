<?php
/**
 * The template for displaying Comments.
 * 
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to tiga_comment() which is
 * located in the includes/templates.php file.
 *
 * @package 	Tiga
 * @author		Satrya
 * @license		license.txt
 * @since 		0.0.1
 *
 */
?>
	<div id="comments" class="comments-area">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tiga' ); ?></p>
	</div><!-- #comments .comments-area -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'tiga' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php tiga_comment_nav(); ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'tiga_comment' ) ); ?>
		</ol>

		<?php tiga_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'tiga' ); ?></p>
	<?php endif; ?>

	<?php
		$args = array(
			'title_reply' => __( 'Leave a Comment', 'tiga' ),
			'label_submit' => __( 'Send your comment', 'tiga' ),
			'comment_notes_after' => ''
		);
			
		comment_form($args); 
	?>

</div><!-- #comments .comments-area -->
