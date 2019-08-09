<?php

add_action( 'widgets_init', 'ccd_recent_posts_widget' );


function ccd_recent_posts_widget() {
	register_widget( 'CCD_Recent_Posts_Widget' );
}

class CCD_Recent_Posts_Widget extends WP_Widget {

	function CCD_Recent_Posts_Widget() {
		$widget_ops = array( 'classname' => 'recent-posts', 'description' => __('Widget to display recent posts', 'recent-posts'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-editor-ul' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recent-posts-widget' );
		
		$this->WP_Widget( 'recent-posts-widget', __('Recent Posts Widget', 'recent-posts'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		if ( $instance['wcount'] >= 5 ) { $wcount = 5; } else { $wcount = $instance['wcount']; }
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
?>

    <div class="ccd-posts-list ccd-posts-list-wrap ccd-recent-posts">
      <?php
        $recent_args = array(
          'post_type' => 'post',
          'posts_per_page' => $wcount
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : 
        $i = 0;
        while ( $recent_query->have_posts() ) : $recent_query->the_post();
        $i++;
      ?>
        <div class="ccd-recent-post ccd-posts-list-post recent-posts" id="recent_<?php get_the_ID(); ?>">
          <div class="ccd-post-display">
            <p class="recent-posts-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
            <p class="recent-posts-date"><?php the_time('F j, Y'); ?></p>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <div class="ccd-recent-post ccd-posts-list-post recent-posts" id="recent_nothing">
          <div class="ccd-post-count">
            <p>&nbsp;</p>
          </div>
          <div class="ccd-post-display">
            <p class="recent-posts-title">We haven't posted anything to the blog just yet. Hold on and we'll put something here.</p>
            <hr class="recent-posts-hr"></hr>
          </div>
        </div>
      <?php endif; ?>
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
		$instance['wcount'] = strip_tags( $new_instance['wcount'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Recent Posts', 'recent-posts'), 'wcount' => __('5', 'recent-posts'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'recent-posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'wcount' ); ?>"><?php _e('Number of events shown:', 'recent-posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'wcount' ); ?>" name="<?php echo $this->get_field_name( 'wcount' ); ?>" value="<?php echo $instance['wcount']; ?>" type="number" min="0" max="10" style="width:100%;" />
		</p>

	<?php
	}
}
