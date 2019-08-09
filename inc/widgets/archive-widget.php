<?php

add_action( 'widgets_init', 'ccd_archive_widget' );


function ccd_archive_widget() {
	register_widget( 'CCD_Archive_Widget' );
}

class CCD_Archive_Widget extends WP_Widget {

	function CCD_Archive_Widget() {
		$widget_ops = array( 'classname' => 'archive-posts', 'description' => __('Widget to display post archive', 'archive-posts'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-calendar-alt' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'archive-posts-widget' );
		
		$this->WP_Widget( 'archive-posts-widget', __('Archive Widget', 'archive-posts'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
?>

    <div class="ccd-posts-list ccd-posts-list-wrap ccd-archive-posts widgets-archive">
      <?php
        global $wpdb;
        $limit = 0;
        $year_prev = null;
        $months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month ,
                                      YEAR( post_date ) AS year,
                                      COUNT( id ) as post_count FROM $wpdb->posts
                                      WHERE post_status = 'publish' and post_date <= now( )
                                      and post_type = 'post'
                                      GROUP BY month , year
                                      ORDER BY post_date DESC");
        foreach($months as $month) :
            $year_current = $month->year;
        if ($year_current != $year_prev){
          if ($year_prev != null){?>
        </ul>
        <div class="clear"></div>
          <?php } ?>
        <h3><?php echo $month->year; ?></h3>
        <ul class="archive-list">
        <?php } ?>
          <li>
            <a href="<?php bloginfo('url') ?>/<?php echo $month->year; ?>/<?php echo date("m", mktime(0, 0, 0, $month->month, 1, $month->year)) ?>">
              <span class="archive-month"><?php echo date("F", mktime(0, 0, 0, $month->month, 1, $month->year)) ?></span>
              <span class="archive-count"><?php echo $month->post_count; ?></span>
            </a>
          </li>
        <?php $year_prev = $year_current;
        endforeach; ?>
        </ul>
        <div class="clear"></div>
    </div>
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
		$defaults = array( 'title' => __('Recent Posts', 'archive-posts') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'archive-posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	<?php
	}
}
