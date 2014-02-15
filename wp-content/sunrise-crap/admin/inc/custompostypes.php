<?php
// Menu Items Custom Post Type
$labels = array(
	'name' => _x('Menu Items', 'post type general name', 'site5framework'),
    'singular_name' => _x('Menu Item', 'post type singular name', 'site5framework'),
    'add_new' => _x('Add New', 'work', 'site5framework'),
    'add_new_item' => __('Add New Menu Item', 'site5framework'),
    'edit_item' => __('Edit Menu Item', 'site5framework'),
    'new_item' => __('New  Menu Item', 'site5framework'),
    'view_item' => __('View  Menu Item', 'site5framework'),
    'search_items' => __('Search  Menu Item', 'site5framework'),
    'not_found' =>  __('No Menu Item found', 'site5framework'),
    'not_found_in_trash' => __('No Menu Item found in Trash', 'site5framework'),
    'parent_item_colon' => ''
  );


register_post_type( 'menu-item',
    array(
        'labels' => array(
            'name' => _x('Menu Items', 'post type general name', 'site5framework'),
            'singular_name' => _x('Menu Item', 'post type singular name', 'site5framework'),
            'add_new' => _x('Add New', 'work', 'site5framework'),
            'add_new_item' => __('Add New Menu Item', 'site5framework'),
            'edit_item' => __('Edit Menu Item', 'site5framework'),
            'new_item' => __('New  Menu Item', 'site5framework'),
            'view_item' => __('View  Menu Item', 'site5framework'),
            'search_items' => __('Search  Menu Item', 'site5framework'),
            'not_found' =>  __('No Menu Item found', 'site5framework'),
            'not_found_in_trash' => __('No Menu Item found in Trash', 'site5framework'),
            'parent_item_colon' => ''
            ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'permalink_epmask'      => true,
        'menu_position'         => 5,
        'show_in_menu'          => true,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'rewrite'               => array( 'slug' => 'menu-item', 'with_front' => false ),
        'has_archive'           => true
    )
);


register_taxonomy("menus", array("menu-item"), array("hierarchical" => true, "label" => "Menus", "singular_label" => "Menu", "rewrite" => true));



// Styling for the custom post type icon
add_action( 'admin_head', 'wpt_menu_icons' );

function wpt_menu_icons() {
    ?>
    <style type="text/css" media="screen">
        #menu-posts-work .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/admin/images/portfolio-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-work:hover .wp-menu-image, #menu-posts-work.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-work {background: url(<?php echo get_template_directory_uri(); ?>/admin/images/portfolio-32x32.png) no-repeat;}
    </style>

<?php }
?>