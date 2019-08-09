<?php

add_action( 'widgets_init', 'ccd_employment_history_widget' );


function ccd_employment_history_widget() {
	register_widget( 'CCD_Employment_History_Widget' );
}

class CCD_Employment_History_Widget extends WP_Widget {

	function CCD_Employment_History_Widget() {
		$widget_ops = array( 'classname' => 'employment-history', 'description' => __('Widget to display employment history', 'employment-history'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-editor-ol' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'employment-history-widget' );
		
		$this->WP_Widget( 'employment-history-widget', __('Employment History', 'employment-history'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        
?>
    <section id="employment" class="wrap">
      <div class="div-content-meta">
        <?php
          $args = array(
            'post_type' => 'employment',
            'posts_per_page' => -1,
            'post_status' => 'publish',
//            'order' => 'DESC',
//            'orderby' => 'meta_value',
//            'meta_key' => 'eveemp_start'
          );
          $employment = new WP_Query( $args );
          if ( $employment->have_posts() ) {
            while ( $employment->have_posts() ) {
              $employment->the_post();
        ?>
        <div id="em-<?php echo get_the_ID(); ?>" class="ccd-employment-entry ccd-resume-entry">
          <div class="div-meta"><p><?php echo date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'eveemp_start', true ) ) ); ?> - <?php if (get_post_meta( get_the_ID(), 'eveemp_end', true ) != "") { echo date( 'M Y', strtotime( get_post_meta( get_the_ID(), 'eveemp_end', true ) ) ); } else { echo 'Present'; } ?></p></div>
          <div class="div-content">
            <h3 class="post-title"><span class="job-title"><?php echo get_post_meta( get_the_ID(), 'eveemp_jobtitle', true ); ?></span> @ <span class="company"><?php echo get_post_meta( get_the_ID(), 'eveemp_employer', true ); ?></span></h3>
            <div class="div-full-content"><?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), 'eveemp_details', true ) ); ?></div>
          </div>
        </div>
        <?php } } else { ?>
        <div id="em-none">
          <div class="div-meta"></div>
          <div class="div-content">
            <p>Sorry, but I haven't posted anything for my employment history.  Give me a few moments and I'll make sure it's added.</p>
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

    <div class="ccd-employment-history ccd-employment-history-wrap">
      
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
		$defaults = array( 'title' => __('Employment History', 'employment-history') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'employment-history'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
