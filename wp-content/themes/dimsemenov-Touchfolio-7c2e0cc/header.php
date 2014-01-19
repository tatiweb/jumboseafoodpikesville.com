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
	<link rel="shortcut icon" href="/jumboseafoodpikesville.com/wp-content/jsico.ico" />
    <link href='http://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/jumboseafoodpikesville.com/wp-content/themes/dimsemenov-Touchfolio-7c2e0cc/css-less/slabtext.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	    <style>
        .col-1
            {
            width:47.5%;
            margin:0 2.5% 0 0;
            float:left;
            }
        .col-2
            {
            width:47.5%;
            margin:0 0 0 2.5%;
            float:left;
            }
        .col-1 p,
        .col-2 p
            {
            color:#888;
            font-size:80%;
            text-align:center;
            }
        a
            {
            color:#111;
            }
        h1 a
            {
            text-decoration:none;
            }
        p
            {
            margin:0 0 1.5em 0;
            line-height:1.5em;
            }
        dt
            {
            font-family:monospace;
            }
        pre
            {
            line-height:1.2;
            }
        footer
            {
            border-top:3px double #aaa;
            padding-top:1em;
            }
        footer section
            {
            border-bottom:3px double #aaa;
            padding-bottom:1em;
            margin-bottom:1em;
            }
        sup a
            {
            text-decoration:none;
            }
        #h4
            {
            clear:both;
            }
        .amp
            {
            font-family:Baskerville,'Goudy Old Style',Palatino,'Book Antiqua',serif;
            font-style:italic;
            font-weight:lighter;
            }
        /* Set font-sizes for the headings to be given the slabText treatment */
        h1
            {
            text-align:left;
            font-family:'', "Impact", Charcoal, Arial Black, Gadget, Sans serif;
            text-transform: uppercase;
            line-height:1;
            color:#222;
            font-size:300%;
            /* Remember to set the correct font weight if using fontface */
            font-weight:normal;
            }
        /* Smaller font-size for the side-by-side demo */
        .col-1 h1,
        .col-2 h1
            {
            font-size: 32px;
            }
        h2
            {
            font-size: 25px;
            }
        /* Adjust the line-height for all headlines that have been given the
           slabtext treatment. Use a unitless line-height to stop sillyness */
        .slabtexted h1
            {
            line-height:.9;
            }
        /* Target specific lines in the preset Studio One demo */
        .slabtexted #studio-one span:nth-child(2)
            {
            line-height:.8;
            }
        .slabtexted #studio-one span:nth-child(3)
            {
            line-height:1.1;
            }
        /* Fun with media queries - resize your browser to view changes. */
        @media screen and (max-width: 960px)
            {
                body
                    {
                    padding:10px 0;
                    min-width:20em;
                    }
                .col-1,
                .col-2
                    {
                    float:none;
                    margin:0;
                    width:100%;
                    }
                h1
                    {
                    font-size:36px;
                    }
                h2
                    {
                    font-size:22px;
                    }
            }
        @media screen and (max-width: 460px)
            {
                h1
                    {
                    font-size:26px;
                    }
                h2
                    {
                    font-size:18px;
                    }
            }
    </style>
	<script>

		$(document).ready(function(){

			var $container = $('#iso-content');
			var toFilter = '*';

			$container.isotope({
				filter: toFilter,
				animationOptions: {
					duration: 500,
					easing: 'linear',
					queue: false,
				}
			});

			$container.attr('data-current',toFilter);

			checkActive();

			$('#menu-iso a').click(function(){
				var title = $(this).attr('title');
				var text = $(this).text();
				if(text == "All"){
					var selector = title;
				}
				else {
					var selector = "." + title;
				}

				$container.attr('data-current',selector);

				$container.isotope({
					filter: selector,
					animationOptions: {
						duration: 500,
						easing: 'linear',
						queue: false,
					}
				});

				checkActive();

				return false;
			});

			function checkActive(){

			$('#menu-iso a').each(function(){

				$(this).css({
					color: '#97a6b3'
				});

				var title = $(this).attr('title');

				title = '.'+title;

				if(title=='.*'){
					title = '*';
				}


				var currentCat = $container.attr('data-current');

				if(title==currentCat){
					$(this).css({
					color: '#9a3c9a'
					});
					}
				});
			}
		});
	</script>
	<script type="text/javascript" src="/jumboseafoodpikesville.com/wp-content/themes/dimsemenov-Touchfolio-7c2e0cc/js/jquery.slabtext.min.js"></script>
    <script>
        // Function to slabtext the H1 headings
        function slabTextHeadlines() {
                $("h1.yum").slabText({
                        // Don't slabtext the headers if the viewport is under 380px
                        "viewportBreakpoint":380
                });
        };

        // Called one second after the onload event for the demo (as I'm hacking the fontface load event a bit here)
        // you should really use google WebFont loader events (or something similar) for better control
        $(window).load(function() {
                setTimeout(slabTextHeadlines, 1000);
        });
    </script>
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
<!-- <img src="/test/wp-content/images/sand.png" style="left:-16px;position:fixed"/> -->
<div id="page" class="hfeed site">
	<?php global $data; ?>
	<header class="main-header">
		<section class="top-logo-group">
			<div class="logo">
				<a href="/jumboseafoodpikesville.com"><img class="logo" src="/jumboseafoodpikesville.com/wp-content/images/jslogo.jpg" width="150" /></a>
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
					?>				<br>
					<p><?php /* echo get_ds_option('footer_text'); */ ?></p>
				</nav>			<?php }	?>
				</div><br>
				</header>
	<div id="main">