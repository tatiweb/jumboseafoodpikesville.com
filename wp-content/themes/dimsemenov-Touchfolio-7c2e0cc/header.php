<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml" <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width = device-width, initial-scale = 1.0, minimum-scale = 1.0" />

    <title><?php

        global $page, $paged;

        wp_title( '|', true, 'right' );

        bloginfo( 'name' );

        $site_description = get_bloginfo( 'description', 'display' );

        if ( $site_description && ( is_home() || is_front_page() ) )

            echo " | $site_description";

        if ( $paged >= 2 || $page >= 2 )

            echo ' | ' . sprintf( __( 'Page %s', 'ds-framework' ), max( $paged, $page ) );

    ?></title>

    <link rel="shortcut icon" href="/test/wp-content/jsico.ico" />

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

    <?php // Facebook stuff ?>

    <?php if(get_ds_option('fb_admin_id')) { ?>

    <meta property="fb:admins" content="<?php echo get_ds_option('fb_admin_id'); ?>" />

    <?php } ?>

    <?php if (is_single()) { ?>

    <meta property="og:url" content="<?php the_permalink() ?>"/>

    <meta property="og:title" content="<?php single_post_title(''); ?>" />

    <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />

    <meta property="og:type" content="article" />

    <meta property="og:image" content="<?php if (function_exists('ds_get_og_image')) { echo ds_get_og_image(); }?>" />

    <?php } else { ?>

    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />

    <meta property="og:description" content="<?php bloginfo('description'); ?>" />

    <meta property="og:type" content="website" />

    <meta property="og:image" content="<?php echo get_ds_option('main_logo'); ?>" /> <?php } ?>

    <?php

    $ds_gcode = get_ds_option('google_fonts_code');

    if($ds_gcode) {

        echo $ds_gcode;

    }

    ?>

    <!--[if lt IE 9]>

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?> style="">

<div id="main-wrap">

<div id="page" class="hfeed site">

    <?php global $data; ?>

    <header class="main-header">

        <section class="top-logo-group">

            <div class="logo">

                <a href="/test"><img class="logo" src="/test/wp-content/images/jslogo.jpg" width="150" /></a>

                </a>

            </div>

        </section>

        <div class="menus-container">

            <nav id="main-menu" class="menu">

            <?php

            if ( has_nav_menu( 'primary' ) ) {

                echo wp_nav_menu( array(

                    'theme_location' => 'primary',

                    'container'      => false,

                    'container_class' => 'menu-header',

                    'menu_class' => 'primary-menu',

                    'echo' => false

                ));

            } else {

            ?>

                <p><?php _e('Primary menu is not selected and/or created. Please go to "Appearance &rarr; Menus" and setup menu.' ,'dsframework'); ?></p>

            <?php } ?>

            </nav>

            <!-- <img src="/test/wp-content/images/beach.png" width="180"/> -->

            <?php if ( has_nav_menu( 'social' ) ) { ?>

                <nav class="social-menu menu">

                    <?php

                    echo wp_nav_menu( array(

                        'theme_location' => 'social',

                        'container'      => false,

                        'container_class' => '',

                        'menu_class' => false

                    ));

                    ?>              <br>

                    <p><?php /* echo get_ds_option('footer_text'); */ ?></p>

                </nav>          <?php } ?>

                </div><br>

                </header>

    <div id="main">