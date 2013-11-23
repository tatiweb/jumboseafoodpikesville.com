<?php
/**
 * five3.me functions.
 *
 * @package five3
 * @since 1.4
 */

/**
 * Sets up header image for adding a logo to the theme header.
 *
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Five3 1.4
 */
function f3_header_logo_setup() {
	global $five3_fonts, $five3_colors, $content_width;

	if ( function_exists( 'get_custom_header' ) ) {
		add_theme_support( 'custom-header', array(
			'width'              => apply_filters( 'five3_header_logo_width', 450 ),
			'flex-width'         => true,
			'height'             => apply_filters( 'five3_header_logo_height', 95 ),
			'flex-height'        => true,
			'default-text-color' => str_replace( '#', '', $five3_colors['heading'] ),
			'random-default'     => true,
			'header-text'        => false
		) );
	} else { // WP < 3.4

		// The default header text color
		define( 'HEADER_TEXTCOLOR', str_replace( '#', '', $five3_colors['heading'] ) );

		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'five3_header_logo_width', 450 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'five3_header_logo_height', 95 ) );

		define( 'NO_HEADER_TEXT', true );

		add_custom_image_header( 'f3_header_style', 'f3_admin_header_style', 'f3_admin_header_logo' );
	}
}
add_action( 'after_setup_theme', 'f3_header_logo_setup', 12 );


if ( ! function_exists( 'f3_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Five3 1.4
 */
function f3_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // f3_header_style

if ( ! function_exists( 'f3_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in f3_setup().
 *
 * @since Five3 1.4
 */
function f3_admin_header_style() { ?>
<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
		min-height: 80px;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#headimg img {
		max-width: 400px;
		height: auto;
		width: 100%;
	}
</style>
<?php
}
endif; // f3_admin_header_style

if ( ! function_exists( 'f3_admin_header_logo' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in f3_setup().
 *
 * @since Five3 1.4
 */
function f3_admin_header_logo() { ?>
	<div id="headimg">
		<?php $header_image = get_header_image(); ?>
		<?php if ( ! empty( $header_image ) ) : ?>
		<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo( 'name' ); ?>" />
		<?php else : ?>
		<h1 id="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" onclick="return false;"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<?php endif; ?>
	</div>
<?php }
endif; // f3_admin_header_logo

