<?php

add_action( 'widgets_init', 'ccd_education_history_widget' );


function ccd_education_history_widget() {
	register_widget( 'CCD_Education_History_Widget' );
}

class CCD_Education_History_Widget extends WP_Widget {

	function CCD_Education_History_Widget() {
		$widget_ops = array( 'classname' => 'education-history', 'description' => __('Widget to display education history', 'education-history'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-editor-ol' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'education-history-widget' );
		
		$this->WP_Widget( 'education-history-widget', __('Education History', 'education-history'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        
?>
    <section id="education" class="wrap">
      <div class="div-content-meta">
        <?php
          $args = array(
            'post_type' => 'education',
            'posts_per_page' => -1,
            'post_status' => 'publish',
//            'order' => 'ASC'
          );
          $education = new WP_Query( $args );
          if ( $education->have_posts() ) {
            while ( $education->have_posts() ) {
              $education->the_post();
        ?>
        <div id="ed-<?php echo get_the_ID(); ?>" class="ccd-education-entry ccd-resume-entry">
          <div class="div-meta"><p><?php echo date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'eveedu_start', true ) ) ); ?> - <?php if (get_post_meta( get_the_ID(), 'eveedu_end', true ) != "") { echo date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'eveedu_end', true ) ) ); } else { echo 'Present'; } ?></p></div>
          <div class="div-content">
            <h3 class="post-title"><span class="course"><?php echo get_post_meta( get_the_ID(), 'eveedu_course', true ); ?> <?php if (get_post_meta( get_the_ID(), 'eveedu_level', true ) != "") { echo '('.get_post_meta( get_the_ID(), 'eveedu_level', true ).')'; } ?></span> @ <span class="company"><?php echo get_post_meta( get_the_ID(), 'eveedu_school', true ); ?></span></h3>
            <div class="div-full-content"><?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'eveedu_details', true ) ); ?></div>
          </div>
          <div class="clear"></div>
        </div>
        <?php } } else { ?>
        <div id="ed-none">
          <div class="div-meta"></div>
          <div class="div-content">
            <p>Sorry, but I haven't posted anything for my education history.  Give me a few moments and I'll make sure it's added.</p>
          </div>
          <div class="clear"></div>
        </div>
        <?php } ?>
      </div>
      <div class="clear"></div>
    </section>
<?php

		echo $before_widget;
?>

    <div class="ccd-education-history ccd-education-history-wrap">
      
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
<?php
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Employment History', 'education-history') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'education-history'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
