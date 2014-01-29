<?php get_header(); ?>

		
		<!-- begin main -->
		<section class="main block grid4">

			
			




			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<!-- begin .post -->
			<article <?php post_class(); ?>>
				
				<h2 class="post-title"><?php the_title(); ?></h2>

				<span>
					<?php 
						$categories = wp_get_object_terms( get_the_ID(), 'menus'); 
						$separator = ''; 
						foreach ($categories as $category) { ?>

						<?php echo $separator ?>
						<a href="<?php echo get_term_link($category->slug, 'menus') ?>"><?php echo $category->name;?></a>
						<?php $separator=' / ' ?>
						<?php } ?>
				</span>
				<!-- begin .post-thumb -->
				<div class="post-thumb">
					<?php if(has_post_thumbnail()): the_post_thumbnail('single-post-image', array('class'=>'blog-thumb')); else: ?><?php endif; ?>
				</div>
				<!-- end .post-thumb -->

				<div class="meta">
					<span class="post-date"><?php echo get_the_date(); ?></span> - 
					<span class="post-comments"> 
						<?php comments_popup_link(__('No Comments', 'site5framework'), __('1 Comment', 'site5framework'), __('% Comments', 'site5framework')); ?>
					</span> - 
					<span class="post-author"><?php _e('by','site5framework') ?> <?php the_author(); ?></span>
				</div>

				

				<?php the_content(); ?>

				<?php endwhile; ?>
				<?php comments_template(); ?>

			</article>
			<!-- end .post -->

			<?php endif;?>
		</section>
		<!-- end main -->



<?php get_footer(); ?>