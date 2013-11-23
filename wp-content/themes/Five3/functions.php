<?php
/**
 * five3.me functions.
 *
 * @package five3.me
 * @since 1.0
 */
/*  
	Copyright 2011  Leonard's Ego Pty. Ltd.  (email : freedoms@leonardsego.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( file_exists( 'custom-functions.php' ) )
	include_once( 'custom-functions.php' );

if( ! defined( 'FIVE3_IMAGES_DIR_URI' ) )
	define( 'FIVE3_IMAGES_DIR_URI', get_template_directory_uri() . '/images' );

require_once( 'inc/five3-settings.php' );
require_once( 'inc/custom-header.php' );

define( 'FIVE3_VERSION', '1.8.7' );

if ( ! function_exists( 'f3_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0
 */
function f3_setup() {
	global $five3_fonts, $five3_colors, $content_width;

	if ( ! isset( $content_width ) ) 
		$content_width = ( f3_is_mobile() ) ? 450 : 900;

	// Style the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	add_theme_support( 'automatic-feed-links' );

	if ( function_exists( 'get_custom_header' ) ) {
		add_theme_support( 'custom-background', array(
			'default-image' => get_template_directory_uri() . '/images/background.png',
			'default-color' => 'FFF'
		) );
	} else { // WP < 3.4
		add_custom_background();
	}

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header' => __( 'Header Navigation', 'five3' ),
	) );

	// Global array of Google Fonts which can be used in the theme
	$five3_fonts = array( 
		'Arvo', 'Artifika', 'Bangers', 'Brawler', 'Black Ops One', 'Bowlby One SC', 'Cabin Sketch', 'Carter One',
		'Droid Sans', 'Goudy Bookletter 1911', 'Inconsolata', 'Josefin Slab', 'Judson',
		'Kameron', 'Leckerli One', 'Limelight', 'Lobster', 'Lora', 'Muli', 'Nova Square',
		'Nunito', 'Oswald', 'Open Sans', 'Play', 'Playfair Display', 'Paytone One', 'Raleway',
		'Tenor Sans', 'Ubuntu', 'UnifrakturCook', 'VT323', 'Wire One'
	);

	$five3_colors = get_option( 'f3_colors', array(
		'heading' => '#121212',
		'link'    => '#121212',
		'button'  => '#121212',
		'menu'    => '#121212'
	) );

	// Remove elements that are not valid HTML5
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head');
	remove_action( 'wp_head', 'start_post_rel_link');
	remove_action( 'wp_head', 'parent_post_rel_link' );
}
endif; // f3_setup
add_action( 'after_setup_theme', 'f3_setup' );


/**
 * When Five3 is activated, run any steps required to upgrade the user's database to the latest version. 
 *
 * @since 1.2
 */
function f3_upgrade() {
	global $five3_colors;

	// Upgrade the `f3_highlight_color` to `f3_colors` array for version 1.1+ upgrades
	$f3_highlight_color = get_option( 'f3_highlight_color', '#121212' );

	add_option( 'f3_colors', array(
		'heading' => $f3_highlight_color,
		'link'    => $f3_highlight_color,
		'button'  => $f3_highlight_color,
		'menu'    => $f3_highlight_color
	) );

	$five3_colors = array(
		'heading' => $f3_highlight_color,
		'link'    => $f3_highlight_color,
		'button'  => $f3_highlight_color,
		'menu'    => $f3_highlight_color
	);

	delete_option( 'f3_highlight_color' );
}
add_action( 'after_switch_theme', 'f3_upgrade' );
if( ! function_exists( 'check_theme_switched' ) && is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) // Pre WP 3.3 theme switching
	f3_upgrade();

if ( ! function_exists( 'f3_widgets_init' ) ) :
/**
 * Register our widget areas.
 *
 * @since 1.0
 */
function f3_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'five3' ),
		'id' => 'sidebar-footer',
		'description' => __( 'An optional widget area at the base of your site', 'five3' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
endif; // f3_widgets_init
add_action( 'widgets_init', 'f3_widgets_init' );


if ( ! function_exists( 'f3_excerpt_more' ) ) :
/**
 * Sets the post excerpt length to 140 characters.
 *
 * @since 1.0
 */
function f3_get_excerpt( $text ) {

	if ( '' == $text ) {
		$text = get_the_content('');

		$text = strip_shortcodes( $text );

		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);

		$excerpt_length = apply_filters('excerpt_length', 100);
		$excerpt_more = apply_filters('excerpt_more', sprintf( __( '&nbsp;%sRead More &raquo;%s', 'five3' ), '<p><a href="'.get_permalink().'">', '</a></p>' ) );
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	}
	return $text;
}
endif; // f3_get_excerpt
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'f3_get_excerpt', 10, 2 );


if ( ! function_exists( 'f3_img_caption_shortcode' ) ) :
/**
 * Output HTML5 tags for images.
 *
 * @since 1.0
 */
function f3_img_caption_shortcode( $attr, $content = null ) {
	extract( shortcode_atts( array( 'id'    => '', 'align'    => 'alignnone', 'width'    => '', 'caption' => '' ), $attr ) );

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) 
		$idtag = 'id="' . esc_attr($id) . '" ';

	return '<figure ' . $idtag . 'aria-describedby="figcaption_' . $id . '" class="' . $align . '" style="width: ' . (10 + (int) $width) . 'px">'
		. do_shortcode( $content ) . '<figcaption id="figcaption_' . $id . '">' . $caption . '</figcaption></figure>';
}
endif; // f3_img_caption_shortcode
add_shortcode( 'wp_caption', 'f3_img_caption_shortcode' );
add_shortcode( 'caption', 'f3_img_caption_shortcode' );


if ( ! function_exists( 'f3_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 1.0
 */
function f3_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class='post pingback'>
		<p><?php _e( 'Pingback:', 'five3' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'five3' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id='li-comment-<?php comment_ID(); ?>'>
		<article id='comment-<?php comment_ID(); ?>' class='comment'>
			<footer class='comment-meta'>
				<div class='comment-author vcard'>
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						printf( __( '%1$s on %2$s%3$s at %4$s%5$s <span class="says">said:</span>', 'five3' ),
							sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ),
							'<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '"><time pubdate datetime="' . get_comment_time( 'c' ) . '">',
							get_comment_date(),
							get_comment_time(),
							'</time></a>'
						);
					?>

					<?php edit_comment_link( __( '[Edit]', 'five3' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'five3' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &rarr;', 'five3' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for f3_comment()


/**
 * Enqueue the scripts & styles required for the front end.
 *
 * @since 1.0
 */
function f3_styles_scripts() {
	global $five3_fonts;

	if( is_admin() )
		return;

	/* Scripts */
	$ie_version = f3_ie_version();

	if ( $ie_version < 9 && $ie_version > 5 )
		wp_enqueue_script( 'ie-js', get_template_directory_uri() . '/js/ie.js', FIVE3_VERSION );

	if ( $ie_version < 8 && $ie_version > 5 )
		wp_enqueue_style( 'ie-css', get_template_directory_uri() . '/css/ie.css', FIVE3_VERSION );

	if( file_exists( get_template_directory() . '/css/custom.css' ) )
		wp_enqueue_style( 'five3-custom-css', get_template_directory_uri() . '/css/custom.css', FIVE3_VERSION );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-plugins', get_template_directory_uri() . '/js/jquery-plugins.js', array( 'jquery' ), FIVE3_VERSION );
	$five3_js_uri  = get_template_directory_uri();
	$five3_js_uri .= ( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG === true ) ? '/js/five3.js' : '/js/five3.min.js';
	wp_enqueue_script( 'five3', $five3_js_uri, array( 'jquery', 'jquery-plugins' ), FIVE3_VERSION );

	$five3_font  = get_option( 'f3_headline_typeface', 'Cabin Sketch' );

	// Site data & l10n strings for 
	$script_data = array( 
			'templateUri'    => get_template_directory_uri() . '/',
			'googleFontsUri' => f3_get_font_url(),
			'adminUri'       => admin_url(),
			'adminAjaxUri'   => admin_url( 'admin-ajax.php' )
		);

	if( function_exists( 'wp_add_script_data' ) ) // WordPress 3.3 and newer
		wp_add_script_data( 'five3', 'five3', $script_data );
	else
		wp_localize_script( 'five3', 'five3', $script_data );

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

}
add_action( 'init', 'f3_styles_scripts' );



if ( ! function_exists( 'f3_login_background_image' ) ) :
/**
 * Add the custom background image to the login page.
 *
 * @since 1.0
 */
function f3_login_background_image(){

	// Get custom background if added
	if( function_exists( '_custom_background_cb' ) ) :
		_custom_background_cb();
		// Make the login page fill 100% of height ?>
		<style type="text/css">
		html, body {
			height: 100%;
		}
		</style>
		<?php
	endif;
}
endif; // f3_login_background_image
add_action( 'login_head', 'f3_login_background_image' );


/**
 * Javascript to initialise the Farbtastic picker on the theme options page.
 *
 * @since 1.0
 */
function f3_init_farbtastic() { ?>
	<script type="text/javascript">
	new function($) {
		$.fn.setCursorPosition = function(pos) {
		  this.each(function(index, elem) {
		    if (elem.setSelectionRange) {
		      elem.setSelectionRange(pos, pos);
		    } else if (elem.createTextRange) {
		      var range = elem.createTextRange();
		      range.collapse(true);
		      range.moveEnd('character', pos);
		      range.moveStart('character', pos);
		      range.select();
		    }
		  });
		  return this;
		};
	}(jQuery);
	jQuery(document).ready(function() {
		$('.five3-color-picker').each(function(){$(this).hide()});
		$('.five3-color-picker').each(function(){
			var picker_id = $(this).attr('id');
			var input_id = '#f3_color_' + picker_id.substring(0,picker_id.indexOf("-"));
			$(this).farbtastic(input_id)
		});
		$('.five3-color-input').each(function(){
			$(this).css('color',getContrast($(this).val()))
		});
		$('.five3-color-pick').click(function(){
		    $(this).parent().next().slideToggle();
			$(this).toggleClass('up down');
			return false;
		});
		$('.five3-color-picker').hover(function(){
			$('.five3-color-input',$(this).prev()).setCursorPosition(7);
		});
	});
	</script>
<?php
}


/**
 * Add metabox to capture post/page specific settings
 *
 * @since 1.0
 */
function f3_add_meta_boxes() {
	$post_types = apply_filters( 'f3_meta_box_post_type', array( 'post', 'page' ) );

	foreach( $post_types as $post_type ) {
		add_meta_box( 'f3_options', __( 'five3.me Options', 'five3' ), 'f3_options_meta_box', $post_type, 'side' );
		add_meta_box( 'five3_background', __( 'Background Image', 'five3' ), 'f3_background_meta_box', $post_type, 'side', 'low', 'background' );
		add_meta_box( 'five3_overlay', __( 'Overlay Image', 'five3' ), 'f3_background_meta_box', $post_type, 'side', 'low', 'overlay' );
	}
}
add_action( 'add_meta_boxes', 'f3_add_meta_boxes' );


/**
 * Add metabox to capture post/page specific settings
 *
 * @since 1.0
 */
function f3_options_meta_box() { 
	global $post;

	$alignments     = array( 'left' => __( 'Left', 'five3' ), 'center' => __( 'Center', 'five3' ), 'right' => __( 'Right', 'five3' ) );
	$repeats		= array( 'no-repeat' => __( 'No Repeat', 'five3' ), 'repeat' => __( 'Repeat', 'five3' ), 'repeat-x' => __( 'Repeat Horizontally', 'five3' ), 'repeat-y' => __( 'Repeat Vertically', 'five3' ) );

	$post_alignment = get_post_meta( $post->ID, '_f3_post_alignment', true );
	$post_alignment = ( empty( $post_alignment ) ) ? 'left' : $post_alignment; // default to left alignment

	$bg_repeat  = get_post_meta( $post->ID, '_f3_background_repeat', true );
	$bg_repeat  = ( empty( $bg_repeat ) ) ? 'left' : $bg_repeat;

	$overlay_repeat  = get_post_meta( $post->ID, '_f3_overlay_repeat', true );
	$overlay_repeat  = ( empty( $overlay_repeat ) ) ? 'left' : $overlay_repeat;

	wp_nonce_field( 'f3_post_meta', '_f3_post_meta_nonce' );
	?>
	<p><?php _e( 'Post Alignment:', 'five3' ); ?>
		<select name="_f3_post_alignment">
		<?php foreach( array_merge( $alignments, array( 'full' => __( 'Full Width', 'five3' ) ) ) as $alignment => $label ) : ?>
			<option value="<?php echo $alignment; ?>"<?php selected( $alignment, $post_alignment ); ?> /> <?php echo $label; ?></option>
		<?php endforeach; ?>
		</select>
	</p>
	<div id="background-options">
	<p><?php _e( 'Background Repeat:', 'five3' ); ?>
		<select name="_f3_background_repeat">
		<?php foreach( $repeats as $repeat => $label ) : ?>
			<option value="<?php echo $repeat; ?>"<?php selected( $repeat, $bg_repeat ); ?> /> <?php echo $label; ?></option>
		<?php endforeach; ?>
		</select>
	</p>
	</div>
	<div id="overlay-options">
	<p><?php _e( 'Overlay Repeat:', 'five3' ); ?>
		<select name="_f3_overlay_repeat">
		<?php foreach( $repeats as $repeat => $label ) : ?>
			<option value="<?php echo $repeat; ?>"<?php selected( $repeat, $overlay_repeat ); ?> /> <?php echo $label; ?></option>
		<?php endforeach; ?>
		</select>
	</p>
	</div>
	<?php 
}


/**
 * Output the background & overlay image metabox markup. 
 * 
 * Used as the callback in add_meta_box and passed the current post & details of the calling meta box, including 'args' which is a string of either 'background' or 'overlay'.
 *
 * @since 1.0
 */
function f3_background_meta_box( $post, $box_object ) {

	$position    = $box_object['args'];
	$id          = '_f3_' . $position;
	$description = sprintf( __( 'Set %s', 'five3' ), $box_object['title'] );

	$nonce         = wp_create_nonce( 'five3' );
	$attachment_id = get_post_meta( $post->ID, $id, true );
	$attachment_id = ( empty( $attachment_id ) ) ? -1 : $attachment_id;
	$href          = 'media-upload.php?post_id=' . $post->ID .
					 '&type=image&tab=five3_background' .
					 '&background=' . $position . 
					 '&TB_iframe=1&width=640&height=610';

	if( $attachment_id == -1 ) {
		$display = ' style="display:none"';
	} else {
		$display = '';
		$image_attributes = wp_get_attachment_image_src( $attachment_id ); ?>
		<img src="<?php echo $image_attributes[0] ?>" width="<?php echo $image_attributes[1] ?>" height="<?php echo $image_attributes[2] ?>" alt="<?php echo $box_object['title'] ?>" title="<?php echo $box_object['title'] ?>">
	<?php } ?>
	<input type='hidden' id='<?php echo $id; ?>' name='<?php echo $id; ?>' value='<?php echo $attachment_id; ?>'>
	<a id="set-<?php echo $position; ?>" title="<?php echo $description; ?>" href="<?php echo $href; ?>" class="thickbox"><?php echo $description; ?></a>
	<a id="remove-<?php echo $position; ?>" class="<?php echo $position; ?>" href="#"<?php echo $display; ?>><?php printf( __( 'Remove %s', 'five3' ), $box_object['title'] ); ?></a>
<?php
}


/**
 * Post Update callback for five3 background meta 
 *
 * @since 1.0
 */
function f3_save_post_meta( $post_id, $post ) {

	if ( ! isset( $_POST['_f3_post_meta_nonce'] ) || ! wp_verify_nonce( $_POST['_f3_post_meta_nonce'], 'f3_post_meta' ) || ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	if( isset( $_POST['_f3_post_alignment'] ) )
		update_post_meta( $post_id, '_f3_post_alignment', $_POST['_f3_post_alignment'] );

	if( isset( $_POST['_f3_background_alignment'] ) )
		update_post_meta( $post_id, '_f3_background_alignment', $_POST['_f3_background_alignment'] );

	if( isset( $_POST['_f3_background_repeat'] ) )
		update_post_meta( $post_id, '_f3_background_repeat', $_POST['_f3_background_repeat'] );

	if( isset( $_POST['_f3_overlay_alignment'] ) )
		update_post_meta( $post_id, '_f3_overlay_alignment', $_POST['_f3_overlay_alignment'] );

	if( isset( $_POST['_f3_overlay_repeat'] ) )
		update_post_meta( $post_id, '_f3_overlay_repeat', $_POST['_f3_overlay_repeat'] );

	if( isset( $_POST['_f3_background'] ) ) {
		if ( -1 == $_POST['_f3_background'])
			update_post_meta( $post_id, '_f3_background', null );
		else
			update_post_meta( $post_id, '_f3_background', $_POST['_f3_background'] );
	}

	if( isset( $_POST['_f3_overlay'] ) ) {
		if ( -1 == $_POST['_f3_overlay'] )
			update_post_meta( $post_id, '_f3_overlay', null );
		else
			update_post_meta( $post_id, '_f3_overlay', $_POST['_f3_overlay'] );		
	}
}
add_action( 'save_post', 'f3_save_post_meta', 1, 2 );


/**
 * Add the front end theme designer button to the admin bar
 *
 * @since 1.0
 */
function f3_add_admin_bar_button() {
	global $wp_admin_bar;

	if ( ! current_user_can( 'edit_theme_options' ) || is_admin() )
		return;

	$wp_admin_bar->add_menu( array(
			'id' => 'five3-designer',
			'title' => __( 'Design', 'five3' ),
			'href'  => add_query_arg( 'page', 'five3-options', admin_url( 'themes.php' ) )
		)
	);
}
add_action( 'admin_bar_menu', 'f3_add_admin_bar_button', 61 ); // Add just after Appearance


/**
 * Returns the URL for an array of fonts. 
 *
 * This function creates the query string for an array of Google fonts and appends 
 * it to the Google APIs URL. The Google fonts can be optionally specified as a parameter.
 *
 * The complexity of this grows once requesting bold, italic, bold italic fonts
 * and therefore has been abstract into a function. 
 *
 * @param fonts array options an array of fonts for to retrieve with the query, defaults to all fonts in the $f3_headline_typeface global array
 * @since 1.0
 **/
function f3_get_font_url( $fonts = array() ){
	global $five3_fonts;

	if( empty( $fonts ) )
		$fonts = $five3_fonts;
	elseif( ! is_array( $fonts ) )
		$fonts = array( $fonts );
	$query_str = str_replace( ' ', '+', implode( '|', $fonts ) );
	$query_str = str_ireplace( 'Cabin+Sketch', 'Cabin+Sketch:700', $query_str ); // Because I like Cabin Sketch & it only comes in bold
	$query_str = str_ireplace( 'Raleway', 'Raleway:100', $query_str ); // Because Raleway is elegant and only comes in light
	$query_str = str_ireplace( 'UnifrakturCook', 'UnifrakturCook:700', $query_str ); // Because UnifrakturCook is mad but it only comes in 700 weight
	return 'http://fonts.googleapis.com/css?family=' . $query_str;
}


/**
 * Add Post Backgrounds tab to Media Upload 
 *
 * @since 1.0
 */
function f3_add_media_background_tab( $tabs ) {
	if ( isset( $_GET['background']) && ! empty( $_GET['background'] ) )
		add_filter( 'media_upload_default_tab', 'f3_select_tab' );

	$tabs['five3_background'] = __( 'Post Backgrounds', 'five3' );
	return $tabs;
}
add_filter( 'media_upload_tabs', 'f3_add_media_background_tab' );


/**
 * Select Post Backgrounds tab by default when selecting post backgrounds links 
 *
 * @since 1.0
 */
function f3_select_tab( $tab ) {
	return 'five3_background';
}


/**
 * Add content to Backgrounds tab in Media Upload 
 *
 * @since 1.0
 */
function media_upload_five3_background() {
	$errors = array();

	if ( !empty( $_POST ) ) {
		$return = media_upload_form_handler();

		if ( is_string( $return ) )
			return $return;
		if ( is_array( $return ) )
			$errors = $return;
	}

	return wp_iframe( 'media_five3_background_form', $errors );
}
add_action( 'media_upload_five3_background', 'media_upload_five3_background');


/**
 * Background tab HTML 
 *
 * @since 1.0
 */
function media_five3_background_form( $errors ){
	global $wpdb, $wp_query, $wp_locale, $type, $tab, $post_mime_types;

	media_upload_header();

	$post_id = intval( $_REQUEST['post_id'] );

	$form_action_url = admin_url( "media-upload.php?type=$type&tab=library&post_id=$post_id" );

	$_GET['paged'] = isset( $_GET['paged'] ) ? intval($_GET['paged']) : 0;
	if ( $_GET['paged'] < 1 )
		$_GET['paged'] = 1;
	$start = ( $_GET['paged'] - 1 ) * 10;
	if ( $start < 1 )
		$start = 0;
	add_filter( 'post_limits', create_function( '$a', "return 'LIMIT $start, 10';" ) );

	list($post_mime_types, $avail_post_mime_types) = wp_edit_attachments_query();
	?>

	<form id="filter" action="" method="get">
	<input type="hidden" name="type" value="<?php echo esc_attr( $type ); ?>" />
	<input type="hidden" name="tab" value="<?php echo esc_attr( $tab ); ?>" />
	<input type="hidden" name="post_id" value="<?php echo (int) $post_id; ?>" />
	<input type="hidden" name="post_mime_type" value="<?php echo isset( $_GET['post_mime_type'] ) ? esc_attr( $_GET['post_mime_type'] ) : ''; ?>" />

	<p id="media-search" class="search-box">
		<label class="screen-reader-text" for="media-search-input"><?php _e( 'Search Media', 'five3' );?>:</label>
		<input type="text" id="media-search-input" name="s" value="<?php the_search_query(); ?>" />
		<?php submit_button( __( 'Search Images', 'five3' ), 'button', '', false ); ?>
	</p>

	<ul class="subsubsub">
	<?php
	$type_links = array();
	$_num_posts = (array) wp_count_attachments();
	$matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
	foreach ( $matches as $_type => $reals )
		foreach ( $reals as $real )
			if ( isset($num_posts[$_type]) )
				$num_posts[$_type] += $_num_posts[$real];
			else
				$num_posts[$_type] = $_num_posts[$real];
	// If available type specified by media button clicked, filter by that type
	if ( empty($_GET['post_mime_type']) && !empty($num_posts[$type]) ) {
		$_GET['post_mime_type'] = $type;
		list($post_mime_types, $avail_post_mime_types) = wp_edit_attachments_query();
	}
	if ( empty($_GET['post_mime_type']) || $_GET['post_mime_type'] == 'all' )
		$class = ' class="current"';
	else
		$class = '';
	$type_links[] = "<li><a href='" . esc_url(add_query_arg(array('post_mime_type'=>'all', 'paged'=>false, 'm'=>false))) . "'$class>".__( 'All Types', 'five3' )."</a>";
	foreach ( $post_mime_types as $mime_type => $label ) {
		$class = '';

		if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
			continue;

		if ( isset($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
			$class = ' class="current"';

		$type_links[] = "<li><a href='" . esc_url(add_query_arg(array('post_mime_type'=>$mime_type, 'paged'=>false))) . "'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), "<span id='$mime_type-counter'>" . number_format_i18n( $num_posts[$mime_type] ) . '</span>') . '</a>';
	}
	echo implode(' | </li>', apply_filters( 'media_upload_mime_type_links', $type_links ) ) . '</li>';
	unset( $type_links );
	?>
	</ul>

	<div class="tablenav">

	<?php
	$page_links = paginate_links( array(
		'base' => add_query_arg( 'paged', '%#%' ),
		'format' => '',
		'prev_text' => __( '&laquo;', 'five3' ),
		'next_text' => __( '&raquo;', 'five3' ),
		'total' => ceil($wp_query->found_posts / 10),
		'current' => $_GET['paged']
	));

	if ( $page_links )
		echo "<div class='tablenav-pages'>$page_links</div>";
	?>

	<div class="alignleft actions">
	<?php

	$arc_query = "SELECT DISTINCT YEAR(post_date) AS yyear, MONTH(post_date) AS mmonth FROM $wpdb->posts WHERE post_type = 'attachment' ORDER BY post_date DESC";

	$arc_result = $wpdb->get_results( $arc_query );

	$month_count = count( $arc_result );

	if ( $month_count && ! ( 1 == $month_count && 0 == $arc_result[0]->mmonth ) ) { ?>
	<select name='m'>
	<option<?php selected( @$_GET['m'], 0 ); ?> value='0'><?php _e( 'Show all dates', 'five3' ); ?></option>
	<?php
	foreach ($arc_result as $arc_row) {
		if ( $arc_row->yyear == 0 )
			continue;
		$arc_row->mmonth = zeroise( $arc_row->mmonth, 2 );

		if ( isset( $_GET['m'] ) && ( $arc_row->yyear . $arc_row->mmonth == $_GET['m'] ) )
			$default = ' selected="selected"';
		else
			$default = '';

		echo "<option$default value='" . esc_attr( $arc_row->yyear . $arc_row->mmonth ) . "'>";
		echo esc_html( $wp_locale->get_month($arc_row->mmonth) . " $arc_row->yyear" );
		echo "</option>\n";
	}
	?>
	</select>
	<?php } ?>

	<?php submit_button( __( 'Filter &#187;', 'five3' ), 'secondary', 'post-query-submit', false ); ?>

	</div>
	</div>
	</form>

	<form enctype="multipart/form-data" method="post" action="<?php echo esc_attr($form_action_url); ?>" class="media-upload-form validate five3-images" id="library-form">

	<div style="float: right; margin-right: 80px;">
		<?php _e( 'Set Image as:', 'five3' ); ?>
	</div>

	<?php wp_nonce_field( 'media-form' ); ?>

	<script type="text/javascript">
	jQuery(function($){
		var preloaded = $(".media-item.preloaded");
		if ( preloaded.length > 0 ) {
			preloaded.each(function(){prepareMediaItem({id:this.id.replace(/[^0-9]/g, '')},'');});
			updateMediaForm();
		}
	});
	</script>

	<div id="media-items" style="clear: both;">
	<?php add_filter( 'attachment_fields_to_edit', 'media_post_single_attachment_fields_to_edit', 10, 2 ); ?>
	<?php echo f3_get_media_items( $post_id, $errors ); ?>
	</div>
	<p class="ml-submit">
		<a href="<?php echo add_query_arg( array( 'tab' => 'type', 's' => false, 'paged' => false, 'post_mime_type' => false, 'm' => false ) ); ?>" class='button savebutton'><?php _e( 'Add New Image', 'five3' ); ?></a>
		<input type="hidden" name="post_id" id="post_id" value="<?php echo (int) $post_id; ?>" />
	</p>
	</form>
	<?php
}


/**
 * Get List of formatted media items 
 *
 * @since 1.0
 */
function f3_get_media_items( $post_id, $errors ) {
	$attachments = array();

	if ( is_array( $GLOBALS['wp_the_query']->posts ) )
		foreach ( $GLOBALS['wp_the_query']->posts as $attachment )
			$attachments[$attachment->ID] = $attachment;

	$output = '';
	foreach ( (array) $attachments as $id => $attachment ) {
		if ( $attachment->post_status == 'trash' )
			continue;

		if( get_post_meta( $post_id, '_f3_background', true ) == $id ) {
			$background_link_style = 'style="display:none;"';
			$overlay_link_style    = 'margin:8px 99px 8px 10px;';
		} else {
			$background_link_style = '';
			$overlay_link_style    = '';
		}

		if( get_post_meta( $post_id, '_f3_overlay', true ) == $id ) {
			$overlay_link_style .= 'display:none;';
		} else {
			$overlay_link_style .= '';
		}


		$image_attributes = wp_get_attachment_image_src( $id, 'thumbnail' ); // returns an array
		$img_src = '<img class="pinkynail" src="'.$image_attributes[0] .'"  alt="images" title="images">';
		$link    = "<a href='#' class='background' $background_link_style>Background</a>";
		$link   .= "<a href='#' class='overlay' style='$overlay_link_style'>Overlay</a>";

		$output .= "\n<div id='media-item-$id' class='media-item child-of-$attachment->post_parent preloaded'><div class='progress'><div class='bar'></div></div><div id='media-upload-error-$id'></div><div class='filename'></div> $img_src \n $link<div class='filename'><span class='title'>$attachment->post_title</span></div></div>";
	}

	return $output;
}


/**
 * Callback function for background media select AJAX 
 *
 * @since 1.0
 */
function f3_set_background() {

	$response = array();

	if ( ! wp_verify_nonce( $_POST['_ajax_nonce'], 'five3' ) ){
		$response['message'] = __( 'Nonce security check failed.', 'five3' );
		$response['success'] = false;
	} else {
		$response['success'] = true;

		// Remove background context image from post
		if ( -1 == intval( $_POST['attachment_id'] ) ){
			update_post_meta( $_POST['post_id'], '_f3_' . $_POST['context'], null );
			$response['message'] = __( 'Image removed.', 'five3' );
		}

		// Return $src to image
		if ( 0 < intval( $_POST['attachment_id'] ) ) {
			update_post_meta( $_POST['post_id'], '_f3_' . $_POST['context'], $_POST['attachment_id'] );
			$image_attributes = wp_get_attachment_image_src( $_POST['attachment_id'] );
			$response['img_src'] = '<img src="'. $image_attributes[0] .'" width="'. $image_attributes[1] .'" height="'. $image_attributes[2] .'" alt="images" title="images">';
			$response['message'] = sprintf( __( '%s Image Set.', 'five3' ), ucfirst( $_POST['context'] ) );
		}
	}

	$response = json_encode( $response );

	header( "Content-Type: application/json" );
	echo $response;
	exit;
}
add_action( 'wp_ajax_f3-set-background', 'f3_set_background' );


/**
 * Takes two colour values and provides the colors in between to blend the two together.
 * 
 * Based on JavaScript found here: http://meyerweb.com/eric/tools/color-blend/
 * 
 * @param $args array, optional
 * 		- from_color, string, default $five3_colors['button']. The start point for color blending.
 * 		- to_color, string, default black '#000000'. The end point for color blending.
 * 		- steps, int, default 10, the number of colors to return in between the from_color & end_color. 
 *
 * @since 1.0
 */
function f3_highlight_color_blender( $args = array() ){
	global $five3_colors;

	$defaults = array( 'from_color' => $five3_colors['button'],
					   'to_color'	=> '#000000',
					   'increments' => 10
					);

	$args = wp_parse_args( $args, $defaults );

	// Convert the colors to arrays
	$from_color = array( 'r' => hexdec( substr( $args['from_color'], 1, 2 ) ),
						 'g' => hexdec( substr( $args['from_color'], 3, 2 ) ),
						 'b' => hexdec( substr( $args['from_color'], 5, 2 ) )
						);
	$to_color   = array( 'r' => hexdec( substr( $args['to_color'], 1, 2 ) ),
						 'g' => hexdec( substr( $args['to_color'], 3, 2 ) ),
						 'b' => hexdec( substr( $args['to_color'], 5, 2 ) )
						);

	// Calculate the step between each color
	$step = array();
	$step['r'] = ( $to_color['r'] - $from_color['r'] ) / $args['increments'];
	$step['g'] = ( $to_color['g'] - $from_color['g'] ) / $args['increments'];
	$step['b'] = ( $to_color['b'] - $from_color['b'] ) / $args['increments'];

	// Create an array of the colors in between
	$palette        = array();
	$palette[0]     = $args['from_color'];

	for( $i = 1; $i < $args['increments']; $i++ ) {

		$r = ( $from_color['r'] + ( $step['r'] * $i ) );
		$g = ( $from_color['g'] + ( $step['g'] * $i ) );
		$b = ( $from_color['b'] + ( $step['b'] * $i ) );

		$palette[$i] = '#' . sprintf( '%02X%02X%02X', $r, $g, $b );
	}

	$palette[$args['increments']] = $args['to_color'];

	return $palette;
}


/**
 * Takes a hexadecimal colour value an returns whether white or black contrasts best against that colour.
 * 
 * Used for calculating the text colour on buttons. 
 *
 * @since 1.0
 */
function f3_get_contrast( $hex_color ) {
	
		if( strlen( $hex_color ) > 7 ) // Return white if invalid color hex given
			return '#ffffff';
		elseif( strlen( $hex_color ) == 7 ) // Remove preceeding # if it exists
			$hex_color = substr( $hex_color, 1, 6 );

		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 3, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );
		$yiq = ( ( $r * 299) + ( $g * 587 ) + ( $b * 114 ) ) / 1000;

		return ( $yiq >= 128) ? '#000000' : '#FFFFFF';
}


/**
 * Server side test for Internet Explorer. Returns IE version if IE, else -1. 
 *
 * @since 1.0
 **/
function f3_ie_version() {
	$matches = preg_match( '/MSIE ([0-9]\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg );

	if( $matches == 0 )
		return -1;
	else
		return intval( $reg[1] );
}


/**
 * Detect if browser if mobile (iPhone et. al.)
 * 
 * Based on code from: http://detectmobilebrowsers.com/
 */
function f3_is_mobile() {
	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if( preg_match( '/android.+mobile|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent ) || preg_match( '/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr( $useragent, 0, 4 ) ) )
		return true;
	else 
		return false;
}


/**
 * Fix a bug in IE 8 caused by jQuery version prior to 1.6.1
 * 
 * @since 1.1
 */
function f3_fix_ie_jquery() {
	global $wp_version;

	if( ! is_admin() && version_compare( $wp_version, '3.3', '<' ) && f3_ie_version() == 8 ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
	}
}
add_action('wp_enqueue_scripts', 'f3_fix_ie_jquery');


/**
 * When Five3 is first activated, provide a nice welcome message with the option of visiting a 
 * 
 * @since 1.2
 */
function f3_maybe_show_welcome() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
		// Enqueue stylesheet  in admin page to use push button
		add_action( 'admin_notices', 'f3_welcome_message' );
		wp_enqueue_style( 'five3', get_template_directory_uri() . '/css/buttons.css' );
	}

}
add_action( 'init', 'f3_maybe_show_welcome' );


/**
 * Output a welcome message and include custom button color styles.
 * 
 * @since 1.2
 */
function f3_welcome_message() { ?>
	<style><?php f3_gradient_button_styles( '#21759B' ); ?></style>
	<div id="five3-welcome-message" class="updated">
		<p>
			<?php printf( __( '<strong>Welcome to Five3!</strong> First time installing Five3? %sWatch a Tutorial &raquo;%s', 'five3' ), '<a class="gradient-button" href="' . add_query_arg( array( 'five3' => 'welcome-tutorial' ), admin_url() ) . '" style="padding-bottom: 0.7em; margin: 0 0 0 1em;">', '</a>' ); ?>
		</p>
	</div><?php
}

/**
 * Create dummy page with content etc. for new comers to Five3.
 * 
 * @since 1.2
 */
function f3_welcome_tutorial() {
	global $user_ID;

	if( ! isset( $_GET['five3'] ) || $_GET['five3'] != 'welcome-tutorial' )
		return;

	get_currentuserinfo();

	$welcome_page = array(
		'menu_order'     => 0,
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
		'post_author'    => $user_ID,
		'post_content'   => '<p class="five3-font" style="text-align: center; color: white; text-shadow: 15px 10px 15px #121212; font-size: 3em;">' 
						  . __( 'Welcome to Five3 and your first parallax web page. The video below teaches you how to create a page just like this one.', 'five3' ) 
						  . '</p>'
						  . '<iframe src="http://player.vimeo.com/video/35124576?color=ffffff" width="900" height="506" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
		'post_name'      => 'welcome-to-five3',
		'post_status'    => 'publish',
		'post_title'     => '',
		'post_type'      => 'page'
	);

	$post_id = wp_insert_post( $welcome_page );

	// Set background image meta data
	update_post_meta( $post_id, '_f3_background', 'five3-welcome-background' );
	update_post_meta( $post_id, '_f3_post_alignment', 'full' );
	update_post_meta( $post_id, '_f3_background_repeat', 'no-repeat' );
	update_post_meta( $post_id, '_f3_overlay', 'five3-welcome-overlay' );
	update_post_meta( $post_id, '_f3_overlay_repeat', 'no-repeat' );

	// Redirect to newly created welcome page
	wp_safe_redirect( get_permalink( $post_id ) );
}
add_action( 'init', 'f3_welcome_tutorial' );

/**
 * Set a one time background image on entire page - blueprint BG. Or, include a parallax image.
 *
 * Checks if the wp_get_attachment_image_src() function is requesting the image src for five3-welcome-background
 * or five3-welcome-overlay. If it is, it returns the URL to the files in the theme directory (as they don't exist 
 * in the media library).
 * 
 * The first filter we can use to filter the return of wp_get_attachment_image_src 
 */
function f3_spoof_welcome_bg( $image_src, $image_id ) {

	if( $image_id == 'five3-welcome-background' ) {

		$image_src = get_template_directory_uri() . '/images/five3-welcome-background.jpg';

	} elseif ( $image_id == 'five3-welcome-overlay' ) {

		$image_src = get_template_directory_uri() . '/images/five3-welcome-overlay.png';

	}

	return $image_src;
}
add_filter( 'f3_overlay_image_src', 'f3_spoof_welcome_bg', 10, 2 );
add_filter( 'f3_background_image_src', 'f3_spoof_welcome_bg', 10, 2 );


/**
 * Creates the gradient button styles, optionally echos them. 
 */
function f3_gradient_button_styles( $color = '#21759B', $echo = true ) {

	$five3_gradient = array_merge( f3_highlight_color_blender( array( 'from_color' => '#FFFFFF', 'to_color' => $color ) ), f3_highlight_color_blender( array( 'from_color' => $color ) ) );
	$five3_contrast = f3_get_contrast( $color );
	$five3_con_alt  = ( f3_get_contrast( $color ) == '#FFFFFF' ) ? '#121212' : '#C0C0C0';

	$button_styles = <<<EOT
	.gradient-button {
		color: $five3_contrast;
		text-shadow: 0px -1px 1px $five3_con_alt;
		background-color: $five3_con_alt;
		background-image: -webkit-gradient(linear, left top, left bottom, from($five3_gradient[11] 0%), to($five3_gradient[12] 50%));
		background-image: -webkit-linear-gradient(top, $five3_gradient[11] 0%, $five3_gradient[12] 50%, $five3_gradient[13] 50%, $five3_gradient[14] 100%);
		background-image: -moz-linear-gradient(top, $five3_gradient[11] 0%, $five3_gradient[12] 50%, $five3_gradient[13] 50%, $five3_gradient[14] 100%);
		background-image: -ms-linear-gradient(top, $five3_gradient[11] 0%, $five3_gradient[12] 50%, $five3_gradient[13] 50%, $five3_gradient[14] 100%);
		background-image: -o-linear-gradient(top, $five3_gradient[11] 0%, $five3_gradient[12] 50%, $five3_gradient[13] 50%, $five3_gradient[14] 100%);
		background-image: linear-gradient(top, $five3_gradient[11] 0%, $five3_gradient[12] 50%, $five3_gradient[13] 50%, $five3_gradient[14] 100%);
		border: 1px solid $five3_gradient[16];
	}
	.gradient-button:hover {
		color: $five3_contrast;
		background-color: $five3_gradient[9];
		background-image: -webkit-gradient(linear, left top, left bottom, from($five3_gradient[9] 0%), to($five3_gradient[1] 50%));
		background-image: -webkit-linear-gradient(top, $five3_gradient[9] 0%, $five3_gradient[11] 50%, $five3_gradient[12] 50%, $five3_gradient[13] 100%);
		background-image: -moz-linear-gradient(top, $five3_gradient[9] 0%, $five3_gradient[11] 50%, $five3_gradient[12] 50%, $five3_gradient[13] 100%);
		background-image: -ms-linear-gradient(top, $five3_gradient[9] 0%, $five3_gradient[11] 50%, $five3_gradient[12] 50%, $five3_gradient[13] 100%);
		background-image: -o-linear-gradient(top, $five3_gradient[9] 0%, $five3_gradient[11] 50%, $five3_gradient[12] 50%, $five3_gradient[13] 100%);
		background-image: linear-gradient(top, $five3_gradient[9] 0%, $five3_gradient[11] 50%, $five3_gradient[12] 50%, $five3_gradient[13] 100%);
	}
	.gradient-button:active {
		color: $five3_contrast;
		background-color: $five3_gradient[12];
		background-image: -webkit-gradient(linear, left top, left bottom, from($five3_gradient[12] 0%), to($five3_gradient[13] 50%));
		background-image: -webkit-linear-gradient(top, $five3_gradient[12] 0%, $five3_gradient[13] 50%, $five3_gradient[14] 50%, $five3_gradient[15] 100%);
		background-image: -moz-linear-gradient(top, $five3_gradient[12] 0%, $five3_gradient[13] 50%, $five3_gradient[14] 50%, $five3_gradient[15] 100%);
		background-image: -ms-linear-gradient(top, $five3_gradient[12] 0%, $five3_gradient[13] 50%, $five3_gradient[14] 50%, $five3_gradient[15] 100%);
		background-image: -o-linear-gradient(top, $five3_gradient[12] 0%, $five3_gradient[13] 50%, $five3_gradient[14] 50%, $five3_gradient[15] 100%);
		background-image: linear-gradient(top, $five3_gradient[12] 0%, $five3_gradient[13] 50%, $five3_gradient[14] 50%, $five3_gradient[15] 100%);
	}
	.push-button {
		color: $five3_contrast;
		background: $five3_gradient[11];
		border-top: 1px solid $five3_gradient[13];
		border-right: 1px solid $five3_gradient[14];
		border-bottom: 1px solid $five3_gradient[15];
		border-left: 1px solid $five3_gradient[14];
		-webkit-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 4px 1px #111111;
		-moz-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 4px 1px #111111;
		-ms-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 4px 1px #111111;
		-o-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 4px 1px #111111;
		box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 4px 1px #111111;
		text-shadow: 0px -1px 1px $five3_con_alt;
	}
	.push-button:hover {
		color: $five3_contrast;
		-webkit-box-shadow: inset 0 0px 1em 1px $five3_gradient[8], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 0.2em 1px #111111;
		-moz-box-shadow: inset 0 0px 1em 1px $five3_gradient[8], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 0.2em 1px #111111;
		-ms-box-shadow: inset 0 0px 1em 1px $five3_gradient[8], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 0.2em 1px #111111;
		-o-box-shadow: inset 0 0px 1em 1px $five3_gradient[8], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 0.2em 1px #111111;
		box-shadow: inset 0 0px 1em 1px $five3_gradient[8], 0px 1px 0 $five3_gradient[15], 0 1px 0px $five3_gradient[14], 0 0.4em 0.2em 1px #111111;
	}
	.push-button:active {
		color: $five3_contrast;
		-webkit-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0 1px 0 $five3_gradient[15], 0 0.1em 0 $five3_gradient[14], 0 0.25em 0.15em 0 #111111;
		-moz-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0 1px 0 $five3_gradient[15], 0 0.1em 0 $five3_gradient[14], 0 0.25em 0.15em 0 #111111;
		-ms-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0 1px 0 $five3_gradient[15], 0 0.1em 0 $five3_gradient[14], 0 0.25em 0.15em 0 #111111;
		-o-box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0 1px 0 $five3_gradient[15], 0 0.1em 0 $five3_gradient[14], 0 0.25em 0.15em 0 #111111;
		box-shadow: inset 0 1px 2px 1px $five3_gradient[9], 0 1px 0 $five3_gradient[15], 0 0.1em 0 $five3_gradient[14], 0 0.25em 0.15em 0 #111111;
	}
EOT;

	if( $echo === true )
		echo $button_styles;

	return $button_styles;
}


/**
 * Output markup for a fixed vertical side menu. Used in index & child index page templates. 
 *
 * @since 1.2
 */
function f3_vertical_nav( $parent_id = '' ) { 
	if ( get_option( 'f3_vertical_nav', 'true' ) != 'true' )
		return;

	rewind_posts(); ?>
	<nav id="page">
		<ul>
		<?php if( ! empty( $parent_id ) ) : ?>
			<?php $title         = get_the_title( $parent_id ); ?>
			<?php $post_title    = apply_filters( 'f3_side_menu_title', sprintf( __( 'Post %s', 'five3' ), $parent_id ) ); ?>
			<?php $display_title = ( empty ( $title ) ) ? $post_title : $title ?>
			<?php $display_title = strip_tags( $display_title ); ?>
			<?php $display_title = apply_filters( 'f3_side_menu_title', $display_title, $parent_id ); ?>
			<li id="<?php f3_anchor_title(); ?>-link" class="<?php f3_anchor_title( $parent_id ); ?>-link">
				<h6><a href="#<?php f3_anchor_title( $parent_id ); ?>"><?php echo $display_title; ?></a></h6>
				<a href="#<?php f3_anchor_title( $parent_id ); ?>"><?php echo $post_title; ?></a>
			</li>
		<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $title         = get_the_title(); ?>
			<?php $post_title    = sprintf( __( 'Post %s', 'five3' ), get_the_ID() ); ?>
			<?php $display_title = ( empty ( $title ) ) ? $post_title : $title ?>
			<?php $display_title = strip_tags( $display_title ); ?>
			<?php $display_title = apply_filters( 'f3_side_menu_title', $display_title, get_the_ID() ); ?>
			<li id="<?php f3_anchor_title(); ?>-link" class="<?php f3_anchor_title(); ?>-link">
				<h6><a href="#<?php f3_anchor_title(); ?>"><?php echo $display_title; ?></a></h6>
				<a href="#<?php f3_anchor_title(); ?>"><?php echo $post_title; ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
	</nav>
	<?php
}

/**
 * Outputs a link element based on the title of a post/page. Must be used within the loop.
 *
 * @since 1.4.1
 */
function f3_anchor_title( $post_id = '' ){

	$title = sanitize_title_with_dashes( get_the_title( $post_id ) );

	if ( empty( $title ) )
		$title = ( empty ( $post_id ) ) ? get_the_ID() : $post_id;

	echo urlencode( $title );
}

/**
 * Checks if a stylesheet exists in a child theme and if it does, return's the URI to the 
 * stylesheet in the child theme, otherwise returns the core Five3 style.
 *
 * @since 1.5
 */
function f3_get_style_uri( $stylesheet_name, $echo = true ) {
	$stylesheet_uri = '';

	if ( file_exists( STYLESHEETPATH . '/css/' . $stylesheet_name ) )
		$stylesheet_uri = get_stylesheet_directory_uri() . '/css/' . $stylesheet_name;
	else if ( file_exists( TEMPLATEPATH . '/css/' . $stylesheet_name ) )
		$stylesheet_uri = get_template_directory_uri() . '/css/' . $stylesheet_name;

	if ( $echo )
		echo $stylesheet_uri;

	return $stylesheet_uri;
}


/**
 * Takes a font string and removes any weight associated with it.
 *
 * @since 1.8
 */
function f3_remove_font_weight( $font_string ) {

	$font_string = preg_replace( '/:\d+$/', '', $font_string );

	return $font_string;
}