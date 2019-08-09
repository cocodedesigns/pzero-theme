<?php

class ccd_IconLine_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_icli__widget',
            __( 'Icon Line Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_icli_widget',
                'description' => __( 'Creates an Icon Box widget for use on the home page or individual pages.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-editor-textcolor'
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
        
        $title      = urlencode( $instance['title'] );
        $icon       = $instance['icon'];
         
        echo $before_widget;
        echo do_shortcode('[iconbox format="line" icon="'.$icon.'" title="'.$title.'"][/iconbox]');
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
         
        $instance['title']     = strip_tags( $new_instance['title'] );
        $instance['icon']      = strip_tags( $new_instance['icon'] );
         
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
     
        $title      = esc_attr( $instance['title'] );
        $icon       = esc_attr( $instance['icon'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><strong><?php _e('Icon:'); ?></strong></label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" />
        </p>
        <?php include TEMPLATEPATH . '/inc/loops/icon-class-names.php'; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'ccd_IconLine_Widget' );
});