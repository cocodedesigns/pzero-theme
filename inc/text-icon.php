<?php

class WC_IconBox_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'wc_icb__widget',
            __( '[WC] Iconbox Widget', 'wc_widget' ),
            array(
                'classname'   => 'wc_icb_widget',
                'description' => __( 'A basic text widget to demo the Tutsplus series on creating your own widgets.', 'wc_widget' )
                )
        );
       
        load_plugin_textdomain( 'wc_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
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
         
        $title      = $instance['title'];
        $content    = $instance['content'];
        $icon       = $instance['icon'];
        $link       = $instance['link'];
         
        echo $before_widget;
        echo do_shortcode('[iconbox format="widget" icon="'.$icon.'" title="'.$title.'" link="'.$link.'"]'.$content.'[/iconbox]');
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
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['content'] = strip_tags( $new_instance['content'] );
        $instance['link'] = strip_tags( $new_instance['link'] );
        $instance['icon'] = strip_tags( $new_instance['icon'] );
         
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
     
        $icon       = esc_attr( $instance['icon'] );
        $title      = esc_attr( $instance['title'] );
        $content    = esc_attr( $instance['content'] );
        $link       = esc_attr( $instance['link'] );
        ?>
         
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon:'); ?></label>
            <select id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>">
                <?php 
                    $icons = array( 'almsgiving', 'article2', 'blogging', 'deadlines', 'employing', 'family25', 'hand-1', 'heart36', 'info28', 'loving4', 'man252', 'pc6', 'pen38', 'phone325', 'plate7', 'suitcase54', 'users6' );
                    foreach ( $icons as $option ) {
                        echo '<option value="'.$option.'" '.selected( $icon, $option, false ).'>'.$option.'</option>';
                    }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('URL:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'WC_IconBox_Widget' );
});

function wc_iconbox_shortcode( $atts, $content = null ){
    $atts = ( shortcode_atts( array(
            'format'    => 'widget', // widget || box || heading
            'icon'      => '', // Info
            'title'     => '',
            'link'      => ''
        ), $atts, 'iconbox' ) );
    
    // Set null link (no URL = no display)
    if ( $atts['label'] == "" ) { $iblabel = ''; } else { $iblabel = $atts['label']; }
    if ( $atts['link'] == "" ) { $iblink = ''; } else { $iblink = '<a href="'.$atts['link'].'" target="_blank">View</a>'; }
    
    // Create iCB wrap
    $iconbox = '<div class="iconbox iconbox-wrap">';
    if ( $atts['format'] == 'widget' ) { // If ICB is in widget
        $iconbox .= '
    <div class="service-widget" id="service-one">
      <div class="service-widget-wrap">
        <div class="service-image"><span class="service-icon flaticon-'.$atts['icon'].'"></span></div>
        <div class="service-name"><h3>'.$atts['title'].'</h3></div>
        <div class="service-blurb"><p>'.$content.'</p></div>
        '.$iblink.'
      </div>
    </div>
        ';
    } else {
    }
    $iconbox .= '</div>';
    return $iconbox;
}
add_shortcode( 'iconbox', 'wc_iconbox_shortcode' );