<?php
    $options[] = array( "name" => "Slider",
                        "sicon" => "slider-32x32.png",
                        "type" => "heading");

    $options[] = array( "name" => "Display Slider?",
                        "desc" => "Display slider on homepage",
                        "id" => SN."displayslider",
                        "std" => "",
                        "type" => "checkbox",
                        "class" => "tiny", //mini, tiny, small
                        "options" => $sliders_array);

    $options[] = array( "name" => "Slider effect",
                        "desc" => "Default is 'slide'",
                        "id" => SN."slidereffect",
                        "std" => "slide",
                        "type" => "select",
                        "class" => "tiny", //mini, tiny, small
                        "options" => $slidersfx_array);

    $options[] = array( "name" => "Animation Speed",
                        "desc" => "Default is 500",
                        "id" => SN."slideranimationspeed",
                        "std" => "500",
                        "type" => "text");
    $options[] = array( "name" => "Animation Pause Time",
                        "desc" => "Default is 3000",
                        "id" => SN."sliderpausetime",
                        "std" => "3000",
                        "type" => "text");



?>