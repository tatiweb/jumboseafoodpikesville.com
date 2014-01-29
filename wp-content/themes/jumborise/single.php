<?php get_header(); ?>

		
		<!-- begin main -->
		<section class="main block grid4">


		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php include('part.post.php') ?>


			<?php comments_template(); ?>

		
		<?php endwhile;  endif;?>
		</section>
		<!-- end main -->



<?php get_footer(); ?>