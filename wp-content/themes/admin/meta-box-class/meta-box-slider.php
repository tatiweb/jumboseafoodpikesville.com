<?php

require_once("meta-box-class.php");

if (is_admin()){

	//All meta boxes prefix, inherited from theme Shortname
	$prefix = SN;


	//Meta box config
	$config = array(
	'id' => 'slider_settings',          			// meta box id, unique per meta box
	'title' => 'Slider Settings',          		// meta box title
	'pages' => array('slider'),      		// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal',            		// where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high',            		// order of meta box: high (default), low; optional
	'fields' => array(),            		// list of meta fields (can be added by field arrays)
	'local_images' => true,          		// Use local or hosted images (meta box images for add/remove)
	'use_with_theme' => true          		//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);


	//Initiate Meta box
	$my_meta =  new AT_Meta_Box($config);



	$my_meta->addText ($prefix.'slider_item_caption',array('name'=> 'Slider Item Caption ','desc' => 'Enter slider item caption (leave blank if you dont want caption)'));
	$my_meta->addText ($prefix.'slider_item_link',array('name'=> 'Slider Item Link ','desc' => 'Enter slider item link'));
	$my_meta->addImage ($prefix.'slider_item_img',array('name'=> 'Slider Item Image ','desc' => 'Upload slider item image'));

    //Finish Meta box declaration
	$my_meta->Finish();



}