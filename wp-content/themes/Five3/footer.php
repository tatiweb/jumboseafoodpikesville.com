<?php
/**
 * The footer template file.
 *
 * @package five3.me
 * @since 1.0
 */
?>

<!-- Footer -->
	<footer id="footer">
		<section id="footer-widgets">
		<?php if ( ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>


		<?php endif; // end sidebar widget area ?>
		</section>
		<?php if( ! defined( 'SHOW_SITE_GENERATOR' ) || ! SHOW_SITE_GENERATOR ) : ?>
		<section id="site-copyright">
		&copy; 2012 Jumbo Seafood 
			<?php /* echo apply_filters( 'five3_site_copyright', get_option( 'f3_site_copyright', sprintf( __( '&copy; %s', 'five3' ), get_bloginfo( 'name' ) ) ) ); */ ?>
		</section>
		<section id="site-generator">
			<?php /* echo apply_filters( 'five3_site_generator', get_option( 'f3_site_generator', sprintf( __( 'Powered by %sWordPress%s & %sfive3%s', 'five3' ), '<a title="WordPress Publishing Software" href="http://wordpress.org/">', '</a>', '<a title="five3 - HTML5 & CSS3 WordPress Theme" href="http://five3.me/">', '</a>' ) ) ); */ ?>
		</section>
		<?php endif; ?>
	</footer><!-- Footer -->
</div><!-- wrapper -->
<?php wp_footer(); ?>
</body>
</html>