<?php
/**
 * The five3.me Header.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package five3.me
 * @since 1.0
 */
global $five3_fonts, $five3_colors, $link_title;

$fix_header   = ( get_option( 'f3_fix_header', 'false' ) == 'true' ) ? 'fixed' : '';
$link_title   = ( get_option( 'f3_link_title', 'false' ) == 'true' ) ? true : false;
$icon_url     = ( file_exists( ABSPATH . 'favicon.ico' ) ) ? site_url( 'favicon.ico' ) : site_url( '/wp-includes/images/wlw/wp-watermark.png' );
$five3_font   = get_option( 'f3_headline_typeface', 'Cabin Sketch' );
$vertical_nav = ( get_option( 'f3_vertical_nav', 'true' ) == 'true' ) ? 'has-vertical-nav' : 'no-vertical-nav';
$shadow       = ( ! empty( $fix_header ) && get_option( 'f3_show_shadows', 'true' ) == 'true' ) ? 'shadow-container' : '';

?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	if( is_home() )
		echo get_bloginfo( 'name' ) . ' &raquo; ' . get_bloginfo( 'description' );
	else
		wp_title( '&raquo; ' .  get_bloginfo( 'name' ), true, 'right' );

?>
</title>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri() . '?' . FIVE3_VERSION; ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo f3_get_style_uri( 'buttons.css', false ) . '?' . FIVE3_VERSION; ?>" />
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1024px)" href="<?php echo f3_get_style_uri( 'tablet.css', false ) . '?' . FIVE3_VERSION; ?>" />
<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="<?php echo f3_get_style_uri( 'smartphone.css', false ) . '?' . FIVE3_VERSION; ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" type="image/png" href="<?php echo $icon_url; ?>">
<!-- Google Fonts -->
<link href='<?php echo f3_get_font_url( array( $five3_font ) ); ?>' rel='stylesheet' type='text/css'>
<!-- Five3 Custom Styles -->
<style>
a { color: <?php echo $five3_colors['link']; ?>; }
h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
#branding .entry-title, .entry-title *, .five3-font, .five3-font *, #reply-title, .widgettitle, .widgettitle * { color: <?php echo $five3_colors['heading']; ?>; font-family: "<?php echo f3_remove_font_weight( $five3_font ); ?>", "Helvetica Neue", Helvetica, Arial, sans-serif; }
nav#page > a:hover, nav#page li:hover > a, nav#page h6, nav#page li.in-viewport a { background-color: <?php echo $five3_colors['menu']; ?>; }
nav#page h6:before { border-color: transparent <?php echo $five3_colors['menu']; ?>; }
.third-box { border-color: <?php echo $five3_colors['menu']; ?>; }
/* Five3 Button Styles */
<?php f3_gradient_button_styles( $five3_colors['button'] ); ?>
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class( array( $fix_header, $vertical_nav ) ); ?>>
	<div id="wrapper">

	<!-- Branding -->
		<header id="branding" role="banner" class="<?php echo $shadow; ?>">
			<div class="shadow-background">
				<div class="branding-container">
					<?php $header_image = get_header_image(); ?>
					<?php if ( ! empty( $header_image ) ) : ?>
					<a id="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php $header_image_width  = ( function_exists( 'get_custom_header' ) ) ? get_custom_header()->width : HEADER_IMAGE_WIDTH; ?>
						<?php $header_image_height = ( function_exists( 'get_custom_header' ) ) ? get_custom_header()->height : HEADER_IMAGE_HEIGHT; ?>
						<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
					<?php else : ?>
					<h1 id="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img src ="/test/wp-content/themes/Five3/images/logo-gray-text.png" height=55 /></a>
					</h1>
					<?php endif; ?>
					<!-- Access -->
					<nav id="access" role="navigation">
						<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
						<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'five3' ); ?>"><?php _e( 'Skip to primary content', 'five3' ); ?></a></div>
						<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
						<?php wp_nav_menu( array( 'theme_location' => 'header', 'fallback_cb' => false ) ); ?>
					</nav><!-- #access -->
				</div>
			</div>
		</header><!--#branding-->
