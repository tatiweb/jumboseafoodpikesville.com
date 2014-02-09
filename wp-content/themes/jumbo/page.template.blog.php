<?php
/*
 * Template Name: Blog Page
 */
?>
<?php get_header(); ?>

		
	
		<!-- begin main -->
		<section class="main block grid4">
			
			<div class="column-one">
			<h2 class="post-title"><?php the_title(); ?></h2>
			
			<?php
			// WP 3.0 PAGED BUG FIX
			if ( get_query_var('paged') )
			$paged = get_query_var('paged');
			elseif ( get_query_var('page') )
			$paged = get_query_var('page');
			else
			$paged = 1;

			$args = array(
			'post_type' => 'post',
			'paged' => $paged );

			query_posts($args);
			?>
			



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