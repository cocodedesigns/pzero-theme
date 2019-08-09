<?php

add_action( 'widgets_init', 'ccd_map_preview_widget' );


function ccd_map_preview_widget() {
	register_widget( 'CCD_Map_Preview_Widget' );
}

class CCD_Map_Preview_Widget extends WP_Widget {

	function CCD_Map_Preview_Widget() {
		$widget_ops = array( 'classname' => 'showmap', 'description' => __('Display a map, powered by OpenStreetMap and the MapQuest API', 'showmap'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-location-alt' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'showmap-preview-widget' );
		
		$this->WP_Widget( 'showmap-preview-widget', __('Map', 'showmap'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
        
        global $db_options;
        
        if ( !$instance['address'] ) { $address = $db_options['db-contact-address']; } else { $address = $instance['address']; }
        
        $id = str_replace('-', '', $args['widget_id']);

		echo $before_widget;
		echo do_shortcode( '[map id="'.$id.'" address="'.$address.'" lat="'.$instance['lat'].'" lon="'.$instance['lon'].'" place="'.$instance['title'].'" height="'.$instance['height'].'"]' );
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['lat'] = $new_instance['lat'];
		$instance['lon'] = $new_instance['lon'];
		$instance['height'] = $new_instance['height'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'height' => '450' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Place Name:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Address:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $instance['address']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'lat' ); ?>"><?php _e('Latitude:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'lat' ); ?>" name="<?php echo $this->get_field_name( 'lat' ); ?>" type="number" value="<?php echo $instance['lat']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'lon' ); ?>"><?php _e('Longitude:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'lon' ); ?>" name="<?php echo $this->get_field_name( 'lon' ); ?>" type="number" value="<?php echo $instance['lon']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Map height (in pixels):', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="number" value="<?php echo $instance['height']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
