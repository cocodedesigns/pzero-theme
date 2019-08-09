<?php

class CCD_Counter_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_counter_widget',
            __( 'Counter Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_counter_widget',
                'description' => __( 'Creates an Icon Box widget for use on the home page or individual pages.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-marker'
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
        
        $count    = $instance['count'];
        $desc     = $instance['desc'];
        $format   = $instance['format'];
         
        echo $before_widget;
        echo do_shortcode('[countup id="'.$args['widget_id'].'" count="'.$count.'" desc="'.$desc.'" format="'.$format.'"]');
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

        $instance['count']  = strip_tags( $new_instance['count'] );
        $instance['desc']   = htmlentities( $new_instance['desc'] );
        $instance['format'] = $new_instance['format'];
         
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
     
        $count   = esc_attr( $instance['count'] );
        $desc    = esc_html( $instance['desc'] );
        $format  = $instance['format'];
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $count; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Content:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo $desc; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format:'); ?></label>
            <select name="<?php echo $this->get_field_name('format'); ?>" id="<?php echo $this->get_field_id('format'); ?>">
                <option value="number" <?php selected( 'number', $format ); ?>>Number / Integer (default)</option>
                <option value="currency" <?php selected( 'currency', $format ); ?>>Currency (GBP)</option>
                <option value="percentage" <?php selected( 'precentage', $format ); ?>>Percentage</option>
            </select>
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Counter_Widget' );
});

function ccd_count_shortcode( $atts, $content = null ){
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'id'        => uniqid('num_'),
            'count'     => '',
            'desc'      => '',
            'format'    => 'number'
        ), $atts, 'countup' ) );
    
    if ( $atts['format'] == 'percentage' ){ $count = number_format( $atts['count'], 0, '.', ',' ) . '%'; }
    elseif ( $atts['format'] == 'currency' ){ $count = '&pound;' . str_replace(".00", "", (string)number_format ( $atts['count'], 2, ".", "," ) ); }
    else { $count = number_format( $atts['count'], 0, '.', ',' ); }
    
    // Create counter wrap
    $countbox = '<div class="counterbox counterbox-wrap clrc-target bgc-target" id="'.$atts['id'].'">
          <div class="number-count-widget-wrap">
            <div class="number-count-widget">
              <div class="count fillmytext"><h2>'.$count.'</h2></div>
              <div class="description"><p>'.$atts['desc'].'</p></div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        <script>
          $(\'#'.$atts['id'].' .fillmytext\').textfill({
            minFontPixels: 14,
            maxFontPixels: 70,
            innerTag: \'h2\'
          });
        </script>';
    return $countbox;
}
add_shortcode( 'countup', 'ccd_count_shortcode' );