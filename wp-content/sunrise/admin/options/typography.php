<?php
    $options[] = array( "name" => "Typography",
    					"sicon" => "font.png",
						"type" => "heading");

	$options[] = array( "name" => "Custom Headings Font",
						"desc" => "This theme uses Google Web Font for headings. You can change it by entering the font details in the fields below.",
						"id" => SN."customfontsinfo",
						"std" => "",
						"type" => "info");

	$options[] = array( "name" => "Enable Google Font",
						"desc" => "By unchecking this the theme will use default font for headings, Arial.",
						"id" => SN."customtypography",
						"std" => "1",
						"type" => "checkbox");

    $options[] = array( "name" => "Headings Google Font Link",
                        "desc" => "Ex: &lt;link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'&gt;",
                        "id" => SN."headingfontlink",
                        "std" => "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>",
                        "type" => "textarea");

    $options[] = array( "name" => "Headings Google Font Family",
                        "desc" => "Ex: font-family: 'Open Sans', sans-serif",
                        "id" => SN."headingfontface",
                        "std" => "font-family: 'Open Sans', sans-serif",
                        "type" => "text");

?>