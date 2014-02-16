<?php
/**
 * The template for sidebar which will only show on the home page
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */

global $supernova_options;

if(!supernova_options('nosidebar-home') && $supernova_options['sidebar-pos'] != 3): ?>
<aside id="sidebar">
	<?php if ( ! dynamic_sidebar( 'Sidebar Home' ) ) : ?>
		
        <div class="widget widget_pages">
        <h2><?php _e('Pages', 'Supernova'); ?></h2>
		<?php wp_list_pages(array('title_li'=>false)); ?>
        </div>
    	        
        <div class="widget widget_archive">
    	<h2><?php _e('Archives', 'Supernova'); ?></h2>
    	<ul>
    		<?php wp_get_archives('type=monthly'); ?>
    	</ul>
        </div>
        
        <div class="widget widget_categories">
        <h2><?php _e('Categories', 'Supernova'); ?></h2>
        <ul>
    	   <?php wp_list_categories('show_count=1&title_li='); ?>
        </ul>
        </div>

	<?php endif;?>
    <div class="clearfix"></div>
</aside><!--sidebar ENDS -->
<?php endif; ?>