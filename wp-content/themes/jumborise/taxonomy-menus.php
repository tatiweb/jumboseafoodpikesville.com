<?php get_header(); ?>

		
		<!-- begin main -->
		<section class="main menulist block grid4 ">

			<header>
				<h2 class="post-title">
					<?php single_cat_title(); ?>
				</h2>
			</header>

			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php include 'part.menuitem.php'; ?>
			
			<?php endwhile; ?>
			<!-- end .post -->

			<?php else: ?>
				
				No entries.

			<?php endif;?>
		</section>
		<!-- end main -->



<?php get_footer(); ?>