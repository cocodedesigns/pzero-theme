<?php
global $db_options;
class LVK_Resmio_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'lvk_resmio_widget',
            __( 'Resmio Widget', 'ccd_widget' ),
            array(
                'classname'   => 'lvk_resmio_widget',
                'description' => __( 'Adds the Resmio booking widget, booking button or feedback badge. Responsive.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-businessman'
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
        
        global $db_options;
        
        extract( $args );
        
        $wID            = $args['widget_id'];
        $widget_style   = $instance['widget_style'];
        $resmio_id      = $instance['resmio_id'];
        
        echo $before_widget;
        
        ?>
        <div id="<?php echo $wID; ?>" class="resmio-widget-wrapper resmio-<?php echo $widget_style; ?>-widget-wrapper">
        <?php
        
        if ( $widget_style == "feedback" ){
            $resmio_colour = $instance['resmio_colour'];
            ?>
            <div class="resmio-reputation-widget" data-resmio-reputation-id="<?php echo $resmio_id; ?>" data-resmio-reputation-language="en" data-resmio-reputation-color="<?php echo $resmio_colour; ?>"></div>
            <script>
            (function() {
               var script = document.createElement("script");
               script.async = true;
               script.src = "https://static.resmio.com/static/reputation-widget.js";
               var entry = document.getElementsByTagName("script")[0];
               entry.parentNode.insertBefore(script, entry);
            })();
            </script>
            <?php
        } elseif ( $widget_style == "booking" ){
            ?>
            <div id="resmio-<?php echo $resmio_id; ?>" class="resmio-widget-outer"></div>
            <script>(function(d, s) {
                var js, rjs = d.getElementsByTagName(s)[0];
                js = d.createElement(s);
                js.src = "//static.resmio.com/static/en-gb/widget.js#id=<?php echo $resmio_id; ?>&amp;width=275px&amp;height=400px";
                rjs.parentNode.insertBefore(js, rjs);
            }(document, "script"));
            </script>
            <?php
        } elseif ( $widget_style == "button" ){
            ?>
            <script data-resmio-button="<?php echo $resmio_id; ?>">
              (function(d, s) {
                var js, rjs = d.getElementsByTagName(s)[0];
                js = d.createElement(s);
                js.src = "//static.resmio.com/static/en-gb/button.js";
                js.async = true;
               rjs.parentNode.insertBefore(js, rjs); }(document, "script")
              );
            </script>
            <?php
        } else { }
        ?>
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

        $instance['widget_style']  = $new_instance['widget_style'];
        $instance['resmio_colour'] = $new_instance['resmio_colour'];
        $instance['resmio_id']     = strip_tags( $new_instance['resmio_id'] );
         
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
     
        $widget_style  = $instance['widget_style'];
        $resmio_colour = $instance['ctaImage'];
        $resmio_id     = strip_tags( $instance['resmio_id'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('widget_style'); ?>"><?php _e('Widget:'); ?></label> 
            <select id="<?php echo $this->get_field_id('widget_style'); ?>" name="<?php echo $this->get_field_name('widget_style'); ?>">
                <option value="booking" <?php selected( 'booking', $widget_style ); ?>>Booking Widget</option>
                <option value="button" <?php selected( 'button', $widget_style ); ?>>Booking Button</option>
                <option value="feedback" <?php selected( 'feedback', $widget_style ); ?>>Feedback Widget</option>
            </select>
        </p>
        <p>  
            <label for="<?php echo $this->get_field_id('resmio_colour'); ?>"><?php _e('Feedback widget colour:'); ?></label> 
            <select id="<?php echo $this->get_field_id('resmio_colour'); ?>" name="<?php echo $this->get_field_name('resmio_colour'); ?>">
                <option value="darkBlue" <?php selected( 'darkBlue', $resmio_colour ); ?>>Dark Blue</option>
                <option value="lightBlue" <?php selected( 'lightBlue', $resmio_colour ); ?>>Light Blue</option>
                <option value="yellow" <?php selected( 'yellow', $resmio_colour ); ?>>Yellow</option>
            </select>
        </p>
        <p><em>This only applies to the feedback widget.  If you set this whilst using any other widget, the setting will not be applied.</em></p>
        
        <p>  
            <label for="<?php echo $this->get_field_id('resmio_id'); ?>"><?php _e('Resmio ID:'); ?></label> 
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('resmio_id'); ?>" name="<?php echo $this->get_field_name('resmio_id'); ?>" value="<?php echo $resmio_id; ?>" />
        </p>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'LVK_Resmio_Widget' );
});