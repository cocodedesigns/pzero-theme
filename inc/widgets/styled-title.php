<?php
global $ccd_options;
class CCD_Styled_Title_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_styled_title_widget',
            __( 'Styled Title Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_styled_title_widget',
                'description' => __( 'Adds an title information box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-welcome-widgets-menus'
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
        
        $Ptit    = $instance['Ptit'];
        $Stit    = $instance['Stit'];
        $wid     = $args['widget_id'];        
        
        echo $before_widget;
        ?>
    
          <div class="widget-titles styled-title">
            <div class="widget-title-wrap max-title max-title3">
              <h1 class="widget-title block-title centred"><?php echo $Ptit; ?></h1>
            </div>
            <?php if ( $Stit ) { ?>
            <h2 class="widget-subtitle styled-subtitle centred clrc-target bgc-target"><?php echo $Stit; ?></h2>
            <?php } ?>
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

        $instance['Ptit']  = strip_tags( $new_instance['Ptit'] );
        $instance['Stit']  = strip_tags( $new_instance['Stit'] );
         
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
     
        $Ptit    = esc_attr( $instance['Ptit'] );
        $Stit    = esc_attr( $instance['Stit'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('Ptit'); ?>"><?php _e('Main Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('Ptit'); ?>" name="<?php echo $this->get_field_name('Ptit'); ?>" type="text" value="<?php echo $Ptit; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Stit'); ?>"><?php _e('Sub Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('Stit'); ?>" name="<?php echo $this->get_field_name('Stit'); ?>" type="text" value="<?php echo $Stit; ?>" />
        </p>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Styled_Title_Widget' );
});