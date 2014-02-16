
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
		<div class="container">
			<div class="footer_widgets block grid4 clearfix">
				<?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('sidebar-footer') ) { ?><?php } else { ?>
			    <?php }?>
			</div>
	        <!-- end footer -->

			<!-- begin .copyright -->
			<div class="oneThird">
				48 E. Sudbrook Lane
				Pikesville, MD   21208<br/>
				Phone: 410-602-1441, 401-602-1442 
			</div>
			<div class="oneThird">
				<h5>
					M: Closed<br/>
					Tu-Th: 11:30AM-10:00PM<br/>
					Fr &amp; Sa: 11:30AM-10:30PM<br/>
					Su: 12:00PM-10:00PM
				</h5>
			</div>	
			<div class="oneThird">
				<ul class="social">
					<li><a href="http://facebook.com/jumboseafoodpikesville" class="facebook"></a></li>
					<li><a href="http://facebook.com/jumboseafoodpikesville" class="twitter"></a></li>
					<li><a href="http://facebook.com/jumboseafoodpikesville" class="gplus"></a></li>
				</ul>
			</div>
			<br/>
			<div class="copyright">&copy; Jumbo Seafood Pikesville</div>
		</div>
	</div>
	<!-- end container -->

	<?php wp_footer(); ?> 
		</footer>

	</body>
</html>