<?php get_header(); ?>

		
	
		<!-- begin main -->
		<section class="main block grid4">
			

			<div class="column-one">
			
				<header>
					<h2 class="post-title"><?php if (is_category()) { ?>
							<?php _e("Posts Categorized", "site5framework"); ?> / <span><?php single_cat_title(); ?></span> 
					<?php } elseif (is_tag()) { ?> 
							<?php _e("Posts Tagged", "site5framework"); ?> / <span><?php single_cat_title(); ?></span>
					<?php } elseif (is_author()) { ?>
							<?php _e("Posts By", "site5framework"); ?> / <span><?php the_author_meta('display_name', $post->post_author) ?> </span> 
					<?php } elseif (is_day()) { ?>
							<?php _e("Daily Archives", "site5framework"); ?> / <span><?php the_time('l, F j, Y'); ?></span>
					<?php } elseif (is_month()) { ?>
					    	<?php _e("Monthly Archives", "site5framework"); ?> / <span><?php the_time('F Y'); ?></span>
					<?php } elseif (is_year()) { ?>
					    	<?php _e("Yearly Archives", "site5framework"); ?> / <span><?php the_time('Y'); ?></span> 
					<?php } elseif (is_Search()) { ?>
					    	<?php _e("Search Results", "site5framework"); ?> / <span><?php echo esc_attr(get_search_query()); ?></span> 
					<?php } ?></h2>
				</header>



				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php include('part.post.php') ?>

				<?php endwhile; ?>

				<!-- begin #pagination -->
				<?php if (function_exists("emm_paginate")) { 
						emm_paginate();  
					 } else { ?>
				<div class="navigation">
			        <div class="alignleft"><?php next_posts_link('Older') ?></div>
			        <div class="alignright"><?php previous_posts_link('Newer') ?></div>
			    </div>
			    <?php } ?>
			    <!-- end #pagination -->

				<?php endif;?>
			</div><!-- end .column-one -->

			<div class="column-two">
				<?php get_template_part( 'blog', 'sidebar' ); ?>
			</div><!-- end .column-two -->
		</section>
		<!-- end main -->
	



<?php get_footer(); ?>