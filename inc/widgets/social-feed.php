<?php

add_action( 'widgets_init', 'wca_social_widget' );


function wca_social_widget() {
	register_widget( 'WCA_Social_Widget' );
}

class WCA_Social_Widget extends WP_Widget {

	function WCA_Social_Widget() {
		$widget_ops = array( 'classname' => 'social-feeds', 'description' => __('Widget that displays social feeds', 'social-feeds') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'social-feeds-widget' );
		
		$this->WP_Widget( 'social-feeds-widget', __('Social Feeds Widget', 'social-feeds'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . '
        <div class="wcaag-twitter-follow-button" style="float: right; margin: 0 3px 0 0;">
          <a href="https://twitter.com/opencultureuk" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @opencultureuk</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script></div>'. $after_title;

		?>
        <div class="wcaag-twitter-feed">
          <a class="twitter-timeline" href="https://twitter.com/opencultureuk" data-widget-id="573150275621560320" data-chrome="nofooter noborders noheader" height="300">Tweets by @opencultureuk</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
<?php

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['show_info'] = $new_instance['show_info'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Example', 'social-feeds'), 'name' => __('Bilal Shaheen', 'social-feeds'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		//Widget Title: Text Input.
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'social-feeds'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		//Text Input.
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'social-feeds'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>

		
		//Checkbox.
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'social-feeds'); ?></label>
		</p>

	<?php
	}
}
