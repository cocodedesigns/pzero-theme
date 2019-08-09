<?php
global $ccd_options;
class CCD_Author_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_author_widget',
            __( 'Author Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_author_widget',
                'description' => __( 'Adds an author information box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-admin-users'
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
        
        $uid    = $instance['uid'];
        $lr     = $instance['lr'];
        
        $uinfo = get_userdata( $uid );
        $up = get_cupp_meta( $uid, 'large' );
        if ( $up == "" || $up == null ){ $grav = get_template_directory_uri().'/images/profile_images/Characters_A_11.png'; }
        else { $grav = $up; }
        
        echo $before_widget;
        echo '
        <div class="author-widget author-widget-[left/right]">
          <div class="author-widget-element author-photo" style="background-image: url(\''.$grav.'\');"></div>
          <div class="author-widget-element author-data">
            <h2 class="author-name">About '.$uinfo->first_name.'</h2>
            <p>'.$uinfo->description.'</p>
          </div>
        </div>
        ';
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

        $instance['uid'] = strip_tags( $new_instance['uid'] );
        $instance['lr'] = strip_tags( $new_instance['lr'] );
         
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
     
        $uid   = esc_attr( $instance['uid'] );
        $lr   = esc_attr( $instance['lr'] );
        if ( $uid ) { $us = $uid; } else { $us = false; }
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('uid'); ?>"><?php _e('Select User:'); ?></label> 
            <?php wp_dropdown_users( array( 'name' => $this->get_field_name('uid'), 'selected' => $us ) ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('lr'); ?>"><?php _e('Photo on left or right:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('lr'); ?>" name="<?php echo $this->get_field_name('lr'); ?>" type="text" value="<?php echo lr; ?>" />
        </p>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Author_Widget' );
});