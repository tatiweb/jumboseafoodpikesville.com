<!doctype html>
<html>

<!-- begin head -->
<head>

<title><?php wp_title(' | ', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<!-- begin meta -->
<meta charset="utf-8"/>
<meta name="viewport" content="user-scalable=no, maximum-scale=1,  width=device-width, initial-scale=1"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="keywords" content="<?php echo of_get_option('metakeywords'); ?>" />
<meta name="description" content="<?php echo of_get_option('metadescription'); ?>" />
<!-- end meta -->

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- stylesheet -->
<link rel="stylesheet" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>
<!-- stylesheet -->

<!-- wp_head -->
<?php wp_head(); ?>
<!-- wp_head -->

<?php if(of_get_option('customtypography') == '1') { ?>
<!-- custom typography-->

<?php if(of_get_option('headingfontlink') != '') { ?>
<?php echo of_get_option('headingfontlink');?>
<?php } ?>

<?php load_template( get_template_directory() . '/custom.typography.css.php' );?>

<!-- custom typography -->

<?php } ?>

</head>
<!-- end head -->

	<body <?php body_class(); ?> lang="en" onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">

	<!-- begin container -->
	<div class="container">

		<!-- begin header -->
		<div class="header-wrapper <?php if(is_home()) { ?>home-background<?php } ?> clearfix" >
			<header>

				<h1 class="title">

					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
						<?php if(of_get_option('clogo')) : echo '<img src="'.of_get_option('clogo').'" alt="'.get_bloginfo('name').'" />'; else: echo ''.of_get_option('clogo_text').''; endif; ?>

					</a>

				</h1>

				<span class="description"><?php bloginfo('description'); ?></span>

				<!-- begin nav -->
				<div class="nav-wrapper">
					<nav>

					<?php wp_nav_menu('theme_location=main-menu&container=&container_class=menu&menu_id=main&menu_class=main-nav sf-menu&link_before=&link_after=&fallback_cb=false'); ?>

					</nav>
				</div>
				<!-- end nav -->


				<?php if (of_get_option('display_social') ==1) { ?>
					<ul class="social">
						<?php if (of_get_option('facebook') !='' ) { ?><li><a href="<?php echo of_get_option('facebook');?>" class="facebook" title="<?php _e( 'Facebook', 'site5framework' ); ?>"><?php _e( 'Facebook', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('twitter') !='' ) { ?><li><a href="<?php echo of_get_option('twitter');?>" class="twitter" title="<?php _e( 'Twitter', 'site5framework' ); ?>"><?php _e( 'Twitter', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('youtube') !='' ) { ?><li><a href="<?php echo of_get_option('youtube');?>" class="youtube" title="<?php _e( 'Youtube', 'site5framework' ); ?>"><?php _e( 'Youtube', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('gplus') !='' ) { ?><li><a href="<?php echo of_get_option('gplus');?>" class="gplus" title="<?php _e( 'Google+', 'site5framework' ); ?>"><?php _e( 'Google+', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('skype') !='' ) { ?><li><a href="<?php echo of_get_option('skype');?>" class="skype" title="<?php _e( 'Skype', 'site5framework' ); ?>"><?php _e( 'Skype', 'site5framework' ); ?></a></li><?php } ?>
						<?php if(of_get_option('rss')=='1'): ?>
							<li><a href="<?php echo of_get_option('extrss') ?  of_get_option('extrss') : bloginfo('rss_url'); ?>" title="<?php _e( 'RSS', 'site5framework' ); ?>" class="rss"></a></li>
						<?php endif ?>
					</ul>
				<?php } ?>

				<?php if(is_home()) { ?>
					<?php if(of_get_option('intro_text') !='') { ?>
					<div class="slogan block">
						<?php echo of_get_option('intro_text')?>
					</div>
					<?php } ?>
				<?php } ?>

				<div class="clear"></div>


			</header>
		</div>
		<!-- end header -->


