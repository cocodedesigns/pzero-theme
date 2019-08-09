<?php

add_action( 'widgets_init', 'ccd_dedo_insert_widget' );


function ccd_dedo_insert_widget() {
	register_widget( 'CCD_DeDo_Insert_Widget' );
}

class CCD_DeDo_Insert_Widget extends WP_Widget {

	function CCD_DeDo_Insert_Widget() {
		$widget_ops = array( 'classname' => 'dedoinsert', 'description' => __('Inserts a Delightful Download widget.  Requires Delightful Downloads to be installed.', 'dedoinsert'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-download' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'dedoinsert-widget' );
		
		$this->WP_Widget( 'dedoinsert-widget', __('Display Delightful DL', 'dedoinsert'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
        
        global $db_options;
        
        if ( $instance['size'] == "s" ) { // If small button
          $style = 'ddl-button-small-'.$instance['mode'];
        } else { // If large button
          $style = 'ddl-button-large-'.$instance['mode'];
        }
      
		echo $before_widget;
		echo do_shortcode( '[ddownload id="'.$instance['id'].'" style="'.$style.'" button="ddl-clr" text="'.$instance['title'].'"]' );
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['id'] = $new_instance['id'];
		$instance['size'] = $new_instance['size'];
		$instance['mode'] = $new_instance['mode'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'height' => '450' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title (will be displayed):', 'dedoinsert'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('File to download:', 'dedoinsert'); ?></label>
          <?php 
            $query = new WP_Query( 'post_type=dedo_download&showposts=-1' );
            if ( $query->have_posts() ) {
                echo '<select name="'.$this->get_field_name('id').'" id="'.$this->get_field_id('id').'" style="width: 250px;">';
                echo '<option value="0" '.selected( $instance['id'], '0' ).'>Select file</option>';
                while ( $query->have_posts() ){
                    $query->the_post();
                    echo '<option value="'.get_the_ID().'" '.selected( $instance['id'], get_the_ID() ).'>'.get_the_title().'</option>';
                }
                echo '</select>';
            } else {
            }
          ?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e('Button Size:', 'dedoinsert'); ?></label>
            <select id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
                <option value="l" <?php selected( $instance['size'], 'l' ); ?>>Large Button</option>
                <option value="s" <?php selected( $instance['size'], 's' ); ?>>Small Button</option>
            </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mode' ); ?>"><?php _e('Colour Mode:', 'dedoinsert'); ?></label>
            <select id="<?php echo $this->get_field_id( 'mode' ); ?>" name="<?php echo $this->get_field_name( 'mode' ); ?>">
                <option value="dark" <?php selected( $instance['mode'], 'dark' ); ?>>Dark Mode</option>
                <option value="light" <?php selected( $instance['mode'], 'light' ); ?>>Light Mode</option>
                <option value="clr" <?php selected( $instance['mode'], 'clr' ); ?>>Full Colour Mode</option>
            </select>
		</p>

	<?php
	}
}
