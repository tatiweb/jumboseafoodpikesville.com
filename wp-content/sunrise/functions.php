<?php
/*********************************************************************************************

Adding Translation Option

*********************************************************************************************/
load_theme_textdomain( 'site5framework', get_template_directory().'/languages' );
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) ) require_once($locale_file);


/*********************************************************************************************

Load site5framework Theme Options

*********************************************************************************************/
require('theme-options.php');


/*********************************************************************************************

Add Thumbnail Support

*********************************************************************************************/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 100, 100, true ); // Normal post thumbnails
add_image_size( 'single-post-image', 720, 320, TRUE );



/*********************************************************************************************

Adding Nav Menus

*********************************************************************************************/
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu' ),
		)
	);
}

/*********************************************************************************************

Add Custom Background Support

*********************************************************************************************/
$defaults = array(
	'default-color'          => '000000',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );


/*********************************************************************************************

Replaces the excerpt "more" text by a link

*********************************************************************************************/
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '<a class="post_read_more" href="'. get_permalink( get_the_ID() ) . '">Read More</a>'; 
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/*********************************************************************************************

Array Random

*********************************************************************************************/
function array_random($arr, $num = 1) {
    shuffle($arr);
   
    $r = array();
    for ($i = 0; $i < $num; $i++) {
        $r[] = $arr[$i];
    }
    return $num == 1 ? $r[0] : $r;
}
