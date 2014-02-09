<?php
    $options[] = array( "name" => "Social",
    					"sicon" => "social.png",
						"type" => "heading");

    $options[] = array( "name" => "Display social icons?",
                        "id" => SN."display_social",
                        "std" => "1",
                        "type" => "checkbox");

    $options[] = array( "name" => "Facebook URL",
                        "id" => SN."facebook",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Twitter URL",
                        "id" => SN."twitter",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Youtube URL",
                        "id" => SN."youtube",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Skype URL",
                        "id" => SN."skype",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "Google+ URL",
                        "id" => SN."gplus",
                        "std" => "",
                        "type" => "text");

    $options[] = array( "name" => "RSS",
                        "desc" => "Display RSS link",
                        "id" => SN."rss",
                        "std" => "1",
                        "type" => "checkbox");
    $options[] = array( "name" => "External RSS URL",
                        "desc" => "Add external RSS URL, like Feedburner, etc. This will overwrite the regular blog RSS, if enabled.",
                        "id" => SN."extrss",
                        "std" => "",
                        "type" => "text");




?>