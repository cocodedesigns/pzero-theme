<?php
class CCD_Portfolio_Grid_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'ccd_portfolio_grid_widget',
            __( 'Portfolio Grid', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_portfolio_grid_widget',
                'description' => __( 'Adds an portfolio preview.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-media-spreadsheet'
                )
        );

        load_plugin_textdomain( 'ccd_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        extract( $args );

        $wID      = $args['widget_id'];

        echo $before_widget;

        echo do_shortcode('[title h1="' . $instance['title'] . '" h2="' . $instance['subtitle'] . '" align="center" size="small" showbar="false"]');

        $recent_args = array(
          'post_type' => 'portfolio',
          'posts_per_page' => 6,
          'post_status' => 'publish'
        );
        $recent_query = new WP_Query( $recent_args );
        $i = 0;
        ?>
        <div class="portfolio-grid-widget portfolio-widget clearfix" id="pgw-<?php echo $wID; ?>">
          <div class="masonry-grid clearfix">
        <?php
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
          get_template_part( 'inc/posts/portfolio', 'post'); 
        endwhile; wp_reset_postdata(); else : endif;
         ?>
          </div>
          <a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>" class="read-more-link view-projects-link block-link portfolio-grid-link"><?php echo $instance['link_text']; ?></a>
        </div>
        <?php
        echo $after_widget;

    }


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

    		//Strip tags from title and name to remove HTML
    		$instance['title']      = strip_tags( $new_instance['title'] );
    		$instance['subtitle']   = strip_tags( $new_instance['subtitle'] );
    		$instance['link_text']  = strip_tags( $new_instance['link_text'] );

        return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {

      //Set up some default widget settings.
      $defaults = array( 'title' => __('Past Work', 'ccdClient-wp'), 'subtitle' => __('Examples of work we have done in the past', 'ccdClient-wp'), 'link_text' => __('View Portfolio', 'ccdClient-wp') );
      $instance = wp_parse_args( (array) $instance, $defaults ); 
      wp_enqueue_style('ccdWidget-mainStyles', plugins_url( '../css/widget-editor-styles.css', __FILE__ ), array(),'all');

    ?>
      <p class="can-hide ccdWidget-widgetTitle" style="margin: 0 0 24px;">
  			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ccdClient-wp'); ?></label>
  			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
  		</p>
  		<p>
  			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'ccdClient-wp'); ?></label>
  			<input id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:100%;" />
  		</p>
  		<p>
  			<label for="<?php echo $this->get_field_id( 'link_text' ); ?>"><?php _e('Button Text:', 'ccdClient-wp'); ?></label>
  			<input id="<?php echo $this->get_field_id( 'link_text' ); ?>" name="<?php echo $this->get_field_name( 'link_text' ); ?>" value="<?php echo $instance['link_text']; ?>" style="width:100%;" />
  		</p>
    <?php
    }

}


/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Portfolio_Grid_Widget' );
});
