<?php get_header(); ?>

		<?php if(of_get_option('show_infoboxes') == true) { ?>
		<div class="promo">
			<section class=" block grid4">
				<div class="col">
					<?php if(of_get_option('infobox_image_1')) { ?> <img src="<?php echo of_get_option('infobox_image_1') ?>" alt="" /> <?php } ?>
					<?php echo of_get_option('infobox_text_1') ?>
				</div>

				<div class="col">
					<?php if(of_get_option('infobox_image_2')) { ?> <img src="<?php echo of_get_option('infobox_image_2') ?>" alt="" /> <?php } ?>
					<?php echo of_get_option('infobox_text_2') ?>
				</div>

				<div class="col">
					<?php if(of_get_option('infobox_image_3')) { ?> <img src="<?php echo of_get_option('infobox_image_3') ?>" alt="" /> <?php } ?>
					<?php echo of_get_option('infobox_text_3') ?>
				</div>

				<div class="col">
					<?php if(of_get_option('infobox_image_4')) { ?> <img src="<?php echo of_get_option('infobox_image_4') ?>" alt="" /> <?php } ?>
					<?php echo of_get_option('infobox_text_4') ?>
				</div>
			</section>
		</div>
		<?php  } ?>

		<section class="featured block grid3">
			
			<h2><?php echo of_get_option('featured_header_text') ?></h2>

			<?php

			$args=array('post_type'=> 'post', 'post_status'=> 'publish','orderby'=> 'menu_order','posts_per_page'=>3,'showposts'=>3,'caller_get_posts'=>1); query_posts($args); 
			if ( have_posts() ) :while (have_posts()): the_post(); 
				
			?>

				
				<div class="col">
					<?php if(has_post_thumbnail()): ?>
					<div class="post-thumb-wrap">
						<?php the_post_thumbnail('post-thumb', array('class'=>'post-thumb')); ?>
					</div>
					<?php else: ?><?php endif; ?>
			
				<h3 class="post-title"><a href="<?php the_permalink() ?>" ><?php echo the_title() ?></a></h3>
				<div class="post-content">
					<?php the_excerpt() ?>
				</div>
				</div>

			<?php 
			endwhile;
			wp_reset_query();
			?>
			<?php 
			else :
			?>
			
			<?php 
			endif;
			?>

			

		</section>


		



<?php get_footer(); ?>