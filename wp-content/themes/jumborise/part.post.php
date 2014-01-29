<!-- begin .post -->
<article <?php post_class(); ?>>
	
	<?php if(has_post_thumbnail()): ?>
	<!-- begin .post-thumb -->
	<div class="post-thumb">
		 <?php the_post_thumbnail('single-post-image', array('class'=>'blog-thumb')); ?> 
	</div>
	<!-- end .post-thumb -->
	<?php else: ?><?php endif; ?>


	<h2 class="post-title"><?php the_title(); ?></h2>

	<div class="post-content">
		<?php the_content(__('Read More', 'site5framework')); ?>
	</div>

	<div class="tags"><?php the_tags( __('Tags: ', 'site5framework'), ' ', '' ); ?></div>


</article>
<!-- end .post -->