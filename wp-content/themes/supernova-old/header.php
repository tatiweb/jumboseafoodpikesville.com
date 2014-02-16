<?php
/**
 * The template for header of theme
 * Contains part upto navigation below title
 * The div ID 'wrapper' will close in the footer
 * supernova_title_image is a cutom function created for the header image and can be found in custom_function.php file.
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width">    
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
      
        <?php get_template_part('includes/top', 'most');  ?>    
<div id="wrapper">
    <header id="header_wrapper">
         <div id="title_wrapper">            
            <div id="header_title" rel="home">
                <?php supernova_title_image(); ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/"><?php bloginfo('name'); ?></a></h1>                
                <p class="site-description"><?php bloginfo('description'); ?></p>                
            </div><!--header_title -->
            <?php do_action('supernova_next_to_logo'); ?>
                                     <div class="clearfix"></div>
        </div><!--title_wrapper -->
    </header><!--header_wrapper ENDS -->

<?php if(!supernova_options('disable-main-nav')){ ?>

<?php } ?>

<?php do_action('supernova_below_nav'); ?>