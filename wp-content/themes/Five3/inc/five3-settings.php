<?php
/**
 * Five3 Settings - both as they appear in the Admin Page & Theme Designer
 *
 * @since 1.2
 */

/**
 * Register five3.me Settings.
 * 
 * @since 1.0
 */
function f3_register_settings() {
	register_setting( 'five3_settings', 'f3_colors' );
	register_setting( 'five3_settings', 'f3_headline_typeface' );
	register_setting( 'five3_settings', 'f3_show_shadows' );
	register_setting( 'five3_settings', 'f3_site_copyright' );
	register_setting( 'five3_settings', 'f3_site_generator' );
	register_setting( 'five3_settings', 'f3_fix_header' );
	register_setting( 'five3_settings', 'f3_vertical_nav' );
}
add_action( 'admin_init', 'f3_register_settings' );


/**
 * Hook the five3.me Options page to the admin menu.
 */
function f3_add_settings_page() {
	global $f3_admin_page;

	if( ! _get_admin_bar_pref( 'front' ) )
		$f3_admin_page = add_theme_page( __( 'five3 Options', 'five3' ), __( 'Theme Options', 'five3' ), 'edit_theme_options', 'five3-options', 'f3_settings_page' );

	add_action( 'admin_print_styles-'.$f3_admin_page, 'f3_admin_styles_scripts' );

	add_action( 'admin_footer-'.$f3_admin_page, 'f3_init_farbtastic' );
}
add_action( 'admin_menu', 'f3_add_settings_page' );


/**
 * Scripts & Styles used to enhanced background setting page & the theme options page.
 */
function f3_admin_styles_scripts() {
	global $five3_fonts, $f3_admin_page, $current_screen, $post_id;

	wp_enqueue_style( 'five3-admin', get_template_directory_uri() . '/css/admin-style.css' );

	// five3.me Admin Page
	if( $current_screen->id == $f3_admin_page ) {
		// Get the Google Fonts to display on the selection
		wp_register_style( 'five3-fonts', f3_get_font_url() );
		wp_enqueue_style( 'five3-fonts' );

		// Enqueue the Color Picker Styles & Scripts
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );

	} elseif( in_array( $current_screen->id, get_post_types( array( '_builtin' => false ) ) + array( 'post', 'page', 'media-upload' ) ) ){

		wp_enqueue_script( 'five3-admin', get_template_directory_uri() . '/js/five3-admin.js', array( 'jquery' ) );

		if( $current_screen->id == 'media-upload' )
			$post_id = intval( $_REQUEST['post_id'] ); // Post ID global not set on media upload screen

		$is_bbPress_active = ( class_exists( 'bbPress' ) ) ? 'true' : 'false';
		

		$script_data = array(
						'ajaxurl'         => admin_url( 'admin-ajax.php' ),
						'post_id'         => $post_id,
						'nonce'           => wp_create_nonce( 'five3' ),
						'isbbPressActive' => $is_bbPress_active
					);

		if( function_exists( 'wp_add_script_data' ) ) // WordPress 3.3 and newer
			wp_add_script_data( 'five3-admin', 'five3', $script_data );
		else
			wp_localize_script( 'five3-admin', 'five3', $script_data );
	}
}
add_action( 'admin_enqueue_scripts', 'f3_admin_styles_scripts' );

if ( ! function_exists( 'f3_settings_page' ) ) :
/**
 * Handler for the five3.me Options page. 
 * 
 * @since 1.0
 */
function f3_settings_page() { 
	global $five3_fonts;
?>
<div id="five3-admin" class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e( 'five3.me Options', 'five3' ); ?></h2>
	<form id="five3-settings-form" method="post" action="options.php">
		<?php settings_fields( 'five3_settings' ); ?>
		<?php f3_settings_fields(); ?>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Settings', 'five3' ) ?>" />
		</p>
	</form>
</div>
<?php
}
endif;


if ( ! function_exists( 'f3_settings_fields' ) ) :
/**
 * Prints the theme settings fields as used on the front end editor and admin options page.
 * 
 * The entire form is not printed in this function for two difference between the front-end and
 * back-end: the form's action and nonce's. Specifically, the back-end form uses settings_fields()
 * where as this function does not exist on the front-end and the nonce must be generated manually.
 * 
 * @since 1.0
 */
function f3_settings_fields() { 
	global $five3_fonts, $five3_colors;

	$f3_headline_typeface = get_option( 'f3_headline_typeface', 'Cabin Sketch' );
	$f3_show_shadows      = get_option( 'f3_show_shadows', 'true' );
	$f3_fix_header        = get_option( 'f3_fix_header', false );
	$f3_vertical_nav      = get_option( 'f3_vertical_nav', 'true' );
	$f3_site_copyright    = get_option( 'f3_site_copyright', sprintf( __( '&copy; %s', 'five3' ), get_bloginfo( 'name' ) ) );
	$f3_site_generator    = get_option( 'f3_site_generator', sprintf( __( 'Powered by %sWordPress%s & %sfive3%s', 'five3' ), '<a title="WordPress Publishing Software" href="http://wordpress.org/">', '</a>', '<a title="five3 - HTML5 & CSS3 WordPress Theme" href="http://five3.me/">', '</a>' ) );
	$f3_link_title        = get_option( 'f3_link_title', false );

	sort( $five3_fonts );
?>
<h3 class="accordion-toggle"><?php _e( 'Colors', 'five3' ); ?></h3>
<div class="accordion-pane">
	<?php foreach( array_keys( $five3_colors ) as $element ) : ?>
	<h4><?php echo ( $element == 'menu' ) ? sprintf( __( 'Side %s Color', 'five3' ), ucfirst( $element ) ) : sprintf( __( '%s Color', 'five3' ), ucfirst( $element ) ); ?></h4>
	<label for="f3_color_<?php echo $element; ?>" class="five3-color-label">
		<input class="five3-color-input" type="text" id="f3_color_<?php echo $element; ?>" name="f3_colors[<?php echo $element; ?>]" value="<?php echo $five3_colors[$element]; ?>" />
		<a class="five3-color-pick down" href="#"><?php _e( 'Pick a Color', 'five3' ); ?></a>
	</label>
	<div id="<?php echo $element; ?>-color-picker" class="five3-color-picker"></div>
	<?php endforeach; ?>
</div>
<h3 class="accordion-toggle"><?php _e( 'Typography', 'five3' ); ?></h3>
<div id="five3-font-selector" class="accordion-pane"> <?php // The <select> element is replaced by jQuery and then click events for #five3-font-selector are required for updating styles changes ?>
	<h4><?php _e( 'Headline Typeface', 'five3' ); ?></h3>
	<select id="five3-fonts" name="f3_headline_typeface" size="4" style="height:14em">
	<?php foreach( $five3_fonts as $font ) : ?>
	<option value="<?php echo f3_remove_font_weight( $font ); ?>"<?php selected( $font, $f3_headline_typeface ); ?> style="font-family: <?php echo f3_remove_font_weight( $font ); ?>;">
		<?php echo f3_remove_font_weight( $font ); ?>
	</option>
	<?php endforeach; ?>
	</select>
</div>
<h3 class="accordion-toggle"><?php _e( 'Bonus Options', 'five3' ); ?></h3>
<div class="accordion-pane">
		<p>
			<label for="f3_show_shadows">
				<input type="checkbox" name="f3_show_shadows" value="true" <?php checked( $f3_show_shadows, "true" ); ?> id="f3_show_shadows" />
				<?php _e( 'Display Shadows', 'five3' ); ?></label>
			</label>
			<label for="f3_fix_header">
				<input type="checkbox" name="f3_fix_header" value="true" <?php checked( $f3_fix_header, "true" ); ?> id="f3_fix_header" />
				<?php _e( 'Fix Header', 'five3' ); ?></label>
			</label>
			<label for="f3_vertical_nav">
				<input type="checkbox" name="f3_vertical_nav" value="true" <?php checked( $f3_vertical_nav, "true" ); ?> id="f3_vertical_nav" />
				<?php _e( 'Display Vertical Navigation', 'five3' ); ?></label>
			</label>
			<label for="f3_link_title">
				<input type="checkbox" name="f3_link_title" value="true" <?php checked( $f3_link_title, "true" ); ?> id="f3_link_title" />
				<?php _e( 'Link Page/Post Titles', 'five3' ); ?></label>
			</label>
		</p>
		<p>
			<label for="f3_site_copyright">
				<?php _e( 'Site Copyright', 'five3' ); ?></label>
			</label>
			<input name="f3_site_copyright" id="f3_site_copyright" value="<?php echo esc_textarea( $f3_site_copyright ); ?>" type="text" />
		</p>
		<p>
			<label for="f3_site_generator">
				<?php _e( 'Site Generator', 'five3' ); ?></label>
			</label>
			<input name="f3_site_generator" id="f3_site_generator" value='<?php echo esc_textarea( $f3_site_generator ); ?>' type="text" />
		</p>
	</div>
</div>
<?php
}
endif;

/**
 * The markup for the five3.me front end designer (hooked to wp_footer)
 */
function f3_theme_designer_footer() {
	global $five3_fonts;

	// Only print the markup for users who can actually make use of it
	if ( ! current_user_can( 'edit_theme_options' ) )
		return;
?>
<menu id='theme-designer' type='toolbar'>
	<h2><?php _e( 'five3.me Options', 'five3' ); ?><span>x</span></h2>
	<form id='five3-settings-form' method='post' action='<?php echo admin_url( 'admin-ajax.php' ); ?>'>
		<?php wp_nonce_field( __FILE__, '_five3nonce' ); ?>
		<input type='hidden' name='action' value='f3_theme_designer_save'>
		<?php f3_settings_fields(); ?>
		<?php do_action( 'f3_theme_designer_fields' ); ?>
	</form>
</menu>
<?php
}
add_action( 'wp_footer', 'f3_theme_designer_footer', 1000 );


/**
 * Save theme settings made via the front end theme designer.
 *
 * Hooked to the wp_ajax_ action.
 **/
function f3_theme_designer_save() {

	if( ! current_user_can( 'edit_theme_options' ) || ! wp_verify_nonce( $_POST[ '_five3nonce' ], __FILE__ ) )
		exit;

	$_POST = array_map( 'stripslashes_deep', $_POST );

	foreach( $_POST as $option => $value ) {
		if( in_array( $option, array( '_five3nonce', '_wp_http_referer', 'action' ) ) )
			continue;

		update_option( $option, $value );
	}

	if( ! isset( $_POST['f3_show_shadows'] ) )
		update_option( 'f3_show_shadows', '' );

	if( ! isset( $_POST['f3_fix_header'] ) )
		update_option( 'f3_fix_header', '' );

	if( ! isset( $_POST['f3_link_title'] ) )
		update_option( 'f3_link_title', '' );

	if( ! isset( $_POST['f3_vertical_nav'] ) )
		update_option( 'f3_vertical_nav', '' );

	$response = json_encode( array( 'success' => true ) );

	header( "Content-Type: application/json" );
	echo $response;

	exit;
}
add_action( 'wp_ajax_f3_theme_designer_save', 'f3_theme_designer_save' );


