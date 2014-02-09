<?php
$options[] = array( "name" => "General",
						"sicon" => "advancedsettings.png",
                        "type" => "heading");


    $options[] = array( "name" => "Your Company Logo",
                        "desc" => "You can use your own company logo. Click to 'Upload Image' button and upload your logo.",
                        "id" => SN."clogo",
                        "std" => "$blogpath/img/logo.png",
                        "type" => "upload");

	$options[] = array( "name" => "Text as Logo",
                        "desc" => "If you don't upload your own company logo, this text will show up in it's place.",
                        "id" => SN."clogo_text",
                        "std" => "Sunrise",
                        "type" => "text");


	$options[] = array( "name" => "Custom Favicon",
                        "desc" => "You can use your own custom favicon. Click to 'Upload Image' button and upload your favicon.",
                        "id" => SN."custom_shortcut_favicon",
                        "std" => "",
                        "type" => "upload");
     

?>