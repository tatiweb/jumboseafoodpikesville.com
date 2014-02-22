<?php
 global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
</div>
    </div>
	 <div id="footer">
	     <!-- <div id="footer-border"></div> -->

	 <h3>Contact</h3>
<p>48 E. Sudbrook Lane<br>
Pikesville, MD 21208<br>
401-602-1441<br>
<a href='emailto:stevechuemailedyou@gmail.com'>stevechuemailedyou@gmail.com</a></p>
<br>
<h3>Hours</h3><span class="arrow"></span>
<p>Monday: Closed<br>
Tuesday-Thursday: 11:30 AM - 10:00 PM<br>
Friday & Saturday: 11:30 AM - 10:30 PM <br>
Sun: 12:00 PM - 10:00 PM</p><br>

		<div class="widgets">
			<div class="widecol">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer (wide)') ) : ?> <?php endif; ?>
			</div><!-- / .column -->
			<div class="clear"></div>
			
			<div class="column">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 1') ) : ?> <?php endif; ?>
			</div><!-- / .column -->
			
			<div class="column last">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer: Column 2') ) : ?> <?php endif; ?>
			</div><!-- / .column -->
			
			<div class="clear"></div>
 		</div>
 		
		<div class="copyright">
			<div class="left"><p class="copy"><?php _e('Copyright', 'wpzoom'); ?> &copy; <?php echo date("Y",time()); ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'wpzoom'); ?>.</p></div>
			<div class="right"></div>
		</div>
 	</div>
     
 
<?php if ($wpzoom_misc_analytics != '' && $wpzoom_misc_analytics_select == 'Yes')
{
  echo stripslashes($wpzoom_misc_analytics);
} ?> 
<script src="/test/wp-content/themes/bonpress/js/selectnav.min.js"></script>
<script>selectnav('mainmenu'); </script>

<?php wp_footer(); ?>
</body>
</html>