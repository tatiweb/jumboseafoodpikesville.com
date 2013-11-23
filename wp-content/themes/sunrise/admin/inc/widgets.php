<?php
/*********************************************************************************************

Register Global Sidebars

*********************************************************************************************/
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __( 'Sidebar Footer', 'site5framework' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<div class="footer_widget col">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',

	));

	register_sidebar( array (
	    'name' => __( 'Sidebar Blog', 'site5framework' ),
	    'id' => 'sidebar-blog',
	    'before_widget' => '<div id="%1$s" class="widget_sidebar clearfix %2$s" >',
	    'after_widget' => "</div>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
    ));


}



/*********************************************************************************************

Register Twitter Widget

*********************************************************************************************/

/* Add function to widgets_init that'll load the widget */
add_action( 'widgets_init', 'latest_tweet_widget' );

function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Latest_Tweets() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('Display a list of latest tweets', 'site5famework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'latest-tweets-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-tweets-widget', __('Latest Tweets', 'site5famework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = $instance['no_of_tweets'];
		$avatar = $instance['avatar'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		if ( $title )
			echo '<h2 class="twitter">'. $title . $after_title;

		if ( $no_of_tweets )?>
				<div id="twitter">
					<script>
						jQuery.noConflict();
    					jQuery(document).ready(function($){
							  $("#twitter").tweet({
							  	<?php if($avatar == 'yes'){?>
								avatar_size: 24,
								<?php }?>
								count: <?php echo $instance['no_of_tweets'];?>,
								username: "<?php echo of_get_option('twitter');?>",
								loading_text: "<span style='color:#999;font-size:11px;'><?php _e('...searching twitter...','site5framework') ?></span>",
								//refresh_interval: 10,
								template: "{avatar}{text} <br/>{time}"
							  });
							});
						</script>

				</div>
				<a href="http://twitter.com/<?php echo of_get_option('prosume_twitter_user'); ?>" class="followTwitter"><?php _e('Follow Us on Twitter!','site5framework') ?> &raquo;</a>

	<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		$instance['avatar'] = strip_tags( $new_instance['avatar'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Latest Tweets', 'example'), 'no_of_tweets' => '3', 'avatar' => 'no' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'site5framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- No of Tweets: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('No. of Tweets:', 'site5framework'); ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" style="width:100%;" />
		</p>

		<!-- Avatar: Select -->
		<p>
			<label for="<?php echo $this->get_field_id( 'avatar' ); ?>"><?php _e('Display avatar?:', 'site5framework'); ?></label>
			<select id="<?php echo $this->get_field_id( 'avatar' ); ?>" name="<?php echo $this->get_field_name( 'avatar' ); ?>">
				<option value="no" <?php if($instance['avatar'] == 'no'){?>selected="selected"<?php }?>>No</option>
				<option value="yes" <?php if($instance['avatar'] == 'yes'){?>selected="selected"<?php }?>>Yes</option>
			</select>
		</p>

	<?php
	}
}
?>