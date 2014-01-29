<?php 
$withThumb="";
if(has_post_thumbnail()): $withThumb="with-thumb";  
endif;
?>
<!-- begin .post -->
<article <?php post_class(array($withThumb, 'clearfix')); ?>>
	
	

	<?php if(has_post_thumbnail()): ?>
	<!-- begin .post-thumb -->
	<div class="post-thumb">
		<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
		<a href="<?php echo $large_image_url[0] ?>" title="<?php echo the_title_attribute() ?>" class="prettyPhoto" >
			<?php the_post_thumbnail('small', array('class'=>'menu-item-thumb')); ?>
		</a>
	</div>
	<!-- end .post-thumb -->
	<?php endif; ?>

	<!-- begin .post-content -->
	<div class="post-content">
		<h2 class="menu-item-title"> 
			<?php if( get_post_meta($post->ID, SN.'menu_item_price', true) != '') { ?><span class="menu-item-price"> <?php echo get_post_meta($post->ID, SN.'menu_item_price', true); ?></span><?php } ?>
			<?php the_title(); ?>
		</h2>

		<?php if(get_the_content() !='') { ?><div class="menu-item-content"><?php the_content(); ?></div><?php } ?>

	</div>
	<!-- end .post-content -->


</article>