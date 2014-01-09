
		<div class="clear"></div>
		
		<?php if( of_get_option('show_contact_map') == true ) { ?>
		<div class="google-map">
			<a href="#map" class="map-toggle expand"><span class="show"><?php echo __('Show Map', 'site5framework'); ?></span><span class="hide"><?php echo __('Hide Map', 'site5framework'); ?></span></a>
			<div id="map">
				<?php echo of_get_option('contact_map') ?>
			</div>
		</div>
		<?php } ?>

		<!-- begin footer -->
		<footer>

		<div class="footer_widgets block grid4 clearfix">

			<?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('sidebar-footer') ) { ?><?php } else { ?>
		    <?php }?>

		</div>

		</footer>
        <!-- end footer -->

		<!-- begin .copyright -->
		<div class="copyright">	</div>
		
				<?php if (of_get_option('display_social') ==1) { ?>
					<ul class="social">
						<?php if (of_get_option('facebook') !='' ) { ?><li><a href="<?php echo of_get_option('facebook');?>" class="facebook" title="<?php _e( 'Facebook', 'site5framework' ); ?>"><?php _e( 'Facebook', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('twitter') !='' ) { ?><li><a href="<?php echo of_get_option('twitter');?>" class="twitter" title="<?php _e( 'Twitter', 'site5framework' ); ?>"><?php _e( 'Twitter', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('youtube') !='' ) { ?><li><a href="<?php echo of_get_option('youtube');?>" class="youtube" title="<?php _e( 'Youtube', 'site5framework' ); ?>"><?php _e( 'Youtube', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('gplus') !='' ) { ?><li><a href="<?php echo of_get_option('gplus');?>" class="gplus" title="<?php _e( 'Google+', 'site5framework' ); ?>"><?php _e( 'Google+', 'site5framework' ); ?></a></li><?php } ?>
						<?php if (of_get_option('skype') !='' ) { ?><li><a href="<?php echo of_get_option('skype');?>" class="skype" title="<?php _e( 'Skype', 'site5framework' ); ?>"><?php _e( 'Skype', 'site5framework' ); ?></a></li><?php } ?>
						<?php if(of_get_option('rss')=='1'): ?>
							<li><a href="<?php echo of_get_option('extrss') ?  of_get_option('extrss') : bloginfo('rss_url'); ?>" title="<?php _e( 'RSS', 'site5framework' ); ?>" class="rss"></a></li>
						<?php endif ?>
					</ul>
				<?php } ?>
		<!-- end .copyright -->


	</div>
	<!-- end container -->

	<?php wp_footer(); ?> 

	</body>
</html>