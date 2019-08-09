<?php

class CCD_Contact_Info_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_contact_info_widget',
            __( 'Contact Info Widget', 'ccd_widget' ),
            array(
                'classname'   => 'cd_contact_info_widget',
                'description' => __( 'Creates an Icon Box widget for use on the home page or individual pages.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-phone'
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
        
        global $db_options;
        
        $item = $instance['item'];
        
        if ( $item == "web" ){ $icon = 'fi fi-web'; $title = '<a href="'.get_bloginfo('url').'">'.get_bloginfo('url').'</a>'; }
        elseif ( $item == "email" ){ $icon = 'fi fi-mail'; $title = '<a href="mailto:'.$db_options['db-contact-email'].'">'.$db_options['db-contact-email'].'</a>'; }
        elseif ( $item == "tel" ){ $icon = 'fi fi-telephone'; $title = '<a href="tel:'.$db_options['db-contact-tel'].'">'.$db_options['db-contact-tel'].'</a>'; }
        elseif ( $item == "addr" ){ $icon = 'fi fi-home'; $title = $db_options['db-contact-address']; }
        // Social networks
        elseif ( $item == "facebook" ){ $icon = 'flaticon flaticon-facebook12'; $title = '<a href="'.$db_options['db-contact-facebook'].'">'.$db_options['db-contact-facebook'].'</a>'; }
        elseif ( $item == "twitter" ){ $icon = 'flaticon flaticon-social-1'; $title = '<a href="'.$db_options['db-contact-twitter'].'">'.$db_options['db-contact-twitter'].'</a>'; }
        elseif ( $item == "youtube" ){ $icon = 'flaticon flaticon-youtube13'; $title = '<a href="'.$db_options['db-contact-twitter'].'">'.$db_options['db-contact-twitter'].'</a>'; }
        elseif ( $item == "google" ){ $icon = 'flaticon flaticon-google109'; $title = '<a href="'.$db_options['db-contact-googleplus'].'">'.$db_options['db-contact-googleplus'].'</a>'; }
        elseif ( $item == "instagram" ){ $icon = 'flaticon flaticon-social-media'; $title = '<a href="'.$db_options['db-contact-instagram'].'">'.$db_options['db-contact-instagram'].'</a>'; }
        elseif ( $item == "behance" ){ $icon = 'flaticon flaticon-behance-logo'; $title = '<a href="'.$db_options['db-contact-behance'].'">'.$db_options['db-contact-behance'].'</a>'; }
        elseif ( $item == "dribble" ){ $icon = 'flaticon flaticon-dribbble-logo'; $title = '<a href="'.$db_options['db-contact-dribble'].'">'.$db_options['db-contact-dribble'].'</a>'; }
        elseif ( $item == "pinterest" ){ $icon = 'flaticon flaticon-pinterest'; $title = '<a href="'.$db_options['db-contact-pinterest'].'">'.$db_options['db-contact-pinterest'].'</a>'; }
         
        echo $before_widget;
        echo do_shortcode('[iconbox format="contact" icon="'.$icon.'" title="'.urlencode($title).'"][/iconbox]');
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
         
        $instance['item']     = strip_tags( $new_instance['item'] );
         
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
     
        $item = esc_attr( $instance['item'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('item'); ?>"><strong><?php _e('Item to display:'); ?></strong></label>
            <select class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>">
              <option value="0" <?php selected( '0', $item ); ?>>Select an item to display</option>
              <option value="web" <?php selected( 'web', $item ); ?>>Website Address</option>
              <option value="email" <?php selected( 'email', $item ); ?>>Email Address</option>
              <option value="tel" <?php selected( 'tel', $item ); ?>>Telephone Number</option>
              <option value="addr" <?php selected( 'addr', $item ); ?>>Address</option>
              <option value="facebook" <?php selected( 'facebook', $item ); ?>>Facebook Address</option>
              <option value="twitter" <?php selected( 'twitter', $item ); ?>>Twitter Address</option>
              <option value="youtube" <?php selected( 'youtube', $item ); ?>>YouTube Address</option>
              <option value="google" <?php selected( 'google', $item ); ?>>Google+ Address</option>
              <option value="instagram" <?php selected( 'instagram', $item ); ?>>Instagram Address</option>
              <option value="behance" <?php selected( 'behance', $item ); ?>>Behance Address</option>
              <option value="dribble" <?php selected( 'dribble', $item ); ?>>Dribble Address</option>
              <option value="pinterest" <?php selected( 'pinterest', $item ); ?>>Pinterest Address</option>
            </select>
        </p>
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Contact_Info_Widget' );
});