<!-- begin .post -->
<article <?php post_class(); ?>>
	
	<?php if(has_post_thumbnail()): ?>
	<!-- begin .post-thumb -->
	<div class="post-thumb">
		 <?php the_post_thumbnail('single-post-image', array('class'=>'blog-thumb')); ?> 
	</div>
	<!-- end .post-thumb -->
	<?php else: ?><?php endif; ?>


	<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<div class="meta">
		<span class="post-date"><?php echo get_the_date(); ?></span> - 
		<span class="post-comments"> 
			<?php comments_popup_link(__('No Comments', 'site5framework'), __('1 Comment', 'site5framework'), __('% Comments', 'site5framework')); ?>
		</span> - 
		<!-- <span class="post-author"><?php _e('by','site5framework') ?> <?php the_author(); ?></span> -->
		<span class="post-category"><?php the_category(', ') ?></span>
	</div>

	

	<div class="post-content">
		<?php the_content(__('Read More', 'site5framework')); ?>
	</div>

	<div class="tags"><?php the_tags( __('Tags: ', 'site5framework'), ' ', '' ); ?></div>


</article>
<!-- end .post -->