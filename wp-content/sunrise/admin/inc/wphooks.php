<?php
/*********************************************************************************************

WP_Hooks - Enqueue Javascripts

*********************************************************************************************/
function site5framework_header_init() {
    if (!is_admin()) {

    wp_enqueue_script( 'jquery' );

   	wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/modernizr.custom.js');

	wp_enqueue_script('custom', get_template_directory_uri() .'/js/custom.js');
	wp_enqueue_script('superfish', get_template_directory_uri() .'/js/superfish.js');


	wp_enqueue_script('prettyphoto-js', get_template_directory_uri() .'/lib/prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.1.4', false);
	wp_enqueue_style ('prettyphoto-css', get_template_directory_uri().'/lib/prettyphoto/css/prettyPhoto.css', 'style', false);



}
}
add_action('init', 'site5framework_header_init');


/*********************************************************************************************

Admin Hooks / Portfolio and Slider Media Uploader

*********************************************************************************************/
function site5framework_mediauploader_init() {
    if (is_admin()) {
    wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('site5mediauploader', get_template_directory_uri().'/admin/js/site5mediauploader.js', array('jquery'));
}
}
add_action('init', 'site5framework_mediauploader_init');


/*********************************************************************************************

Favicon

*********************************************************************************************/
function site5framework_custom_shortcut_favicon() {
	if (of_get_option('custom_shortcut_favicon') != '') {
    echo '<link rel="shortcut icon" href="'. of_get_option('custom_shortcut_favicon') .'" type="image/ico" />'."\n";
	}
	else { ?><link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/ico" />
	<?php }
}
add_action('wp_head', 'site5framework_custom_shortcut_favicon');

/*********************************************************************************************

Contact Form JS

*********************************************************************************************/
function site5framework_contactform_init() {
	if (is_page_template('page.template.contact.php') && !is_admin()) {
    wp_enqueue_script('contactform', get_template_directory_uri().'/lib/contactform/contactform.js');
    }
}
add_action('template_redirect', 'site5framework_contactform_init');

/*********************************************************************************************

Stats

*********************************************************************************************/
function site5framework_analytics(){
	$output = of_get_option('stats');
	if ( $output <> "" )
	echo stripslashes($output) . "\n";
}
add_action('wp_footer','site5framework_analytics');
?>