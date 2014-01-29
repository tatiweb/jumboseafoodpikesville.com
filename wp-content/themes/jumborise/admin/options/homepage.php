<?php
      $options[] = array( "name" => "Homepage",
      					"sicon" => "user-home.png",
                        "type" => "heading");


      $options[] = array( "name" => "Header Image",
                        "desc" => "Header image that will appear on the homepage",
                        "id" => SN."homebackground",
                        "std" => "$blogpath/img/homebackground.jpg",
                        "type" => "upload");

      $options[] = array( "name" => "Intro Text",
                        "id" => SN."intro_text",
                        "std" => "<h2>Welcome to SUNRISE PUB!</h2><p>The place you want to be with your friends</p>",
                        "type" => "textarea");

      $options[] = array( "name" => "Header text for Featured posts",
                        "id" => SN."featured_header_text",
                        "std" => "Featured",
                        "type" => "text");


      $options[] = array( "name" => "Show Info Boxes",
                        "id" => SN."show_infoboxes",
                        "desc" => "Display Info Boxes",
                        "type" => "checkbox",
                        "std" => 1,
                        "class" => "tiny", //mini, tiny, small
                        "options" => array('1')
                        );

      $options[] = array( "name" => "Infobox Image 1",
                        "desc" => "Infobox Image  on the homepage",
                        "id" => SN."infobox_image_1",
                        "std" => "$blogpath/img/ico_coffee.png",
                        "type" => "upload");
      $options[] = array( "name" => "Infobox Text 1",
                        "id" => SN."infobox_text_1",
                        "std" => "<h3>Imported coffee</h3><p>Checkout our various tyes of imported coffee.</p> ",
                        "type" => "textarea");
      $options[] = array( "name" => "Infobox Image 2",
                        "desc" => "Infobox Image  on the homepage",
                        "id" => SN."infobox_image_2",
                        "std" => "$blogpath/img/ico_music.png",
                        "type" => "upload");
       $options[] = array( "name" => "Infobox Text 2",
                        "id" => SN."infobox_text_2",
                        "std" => "<h3>Great Music </h3> <p>Our DJs will entertain you like never before.</p> ",
                        "type" => "textarea");
      $options[] = array( "name" => "Infobox Image 3",
                        "desc" => "Infobox Image  on the homepage",
                        "id" => SN."infobox_image_3",
                        "std" => "$blogpath/img/ico_food.png",
                        "type" => "upload");
       $options[] = array( "name" => "Infobox Text 3",
                        "id" => SN."infobox_text_3",
                        "std" => "<h3>Finest Cuisine</h3><p>From Italian to Tex-Mex, you will find all types of food</p>",
                        "type" => "textarea");
      $options[] = array( "name" => "Infobox Image 4",
                        "desc" => "Infobox Image  on the homepage",
                        "id" => SN."infobox_image_4",
                        "std" => "$blogpath/img/ico_service.png",
                        "type" => "upload");
       $options[] = array( "name" => "Infobox Text 4",
                        "id" => SN."infobox_text_4",
                        "std" => "<h3>Nice Staff</h3><p>You will never forget our smile and professional attitude.</p>",
                        "type" => "textarea");


?>