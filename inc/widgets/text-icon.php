<?php

class ccd_IconBox_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_icb__widget',
            __( 'Icon Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_icb_widget',
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
        
        $title      = $instance['title'];
        $content    = $instance['content'];
        $icon       = $instance['icon'];
        $link       = $instance['link'];
        $link_text  = $instance['link_text'];
         
        echo $before_widget;
        echo do_shortcode('[iconbox format="widget" icon="'.$icon.'" title="'.$title.'" link="'.$link.'" link_text="'.$link_text.'"]'.$content.'[/iconbox]');
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
        $instance['content']   = strip_tags( $new_instance['content'] );
        $instance['icon']      = strip_tags( $new_instance['icon'] );
        $instance['link']      = strip_tags( $new_instance['link'] );
        $instance['link_text'] = strip_tags( $new_instance['link_text'] );
         
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
        $content    = esc_attr( $instance['content'] );
        $icon       = esc_attr( $instance['icon'] );
        $link       = esc_attr( $instance['link'] );
        $link_text = ( $instance['link_text'] ) ? esc_attr( $instance['link_text'] ) : 'Learn More';
        
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
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Page:'); ?></label> 
          <?php wp_dropdown_pages( array (
            'name'              => $this->get_field_name('link'),
            'id'                => $this->get_field_id('link'),
            'show_option_none'  => 'Select Page',
            'option_none_value' => 0
          ) ); ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_text'); ?>"><?php _e('Link Text:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_text'); ?>" name="<?php echo $this->get_field_name('link_text'); ?>" type="text" value="<?php echo $link_text; ?>" />
        </p>
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'ccd_IconBox_Widget' );
});

function ccd_iconbox_shortcode( $atts, $content = null ){
    
    // Queue script_loader_src
    wp_enqueue_script( 'iconbox-script', get_template_directory_uri() . '/js/iconbox.js' );
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'format'    => 'box', // widget || box || heading
            'icon'      => '', // Info
            'title'     => '',
            'link'      => '',
            'link_text' => ''
        ), $atts, 'iconbox' ) );
    
    $link_text = ( $atts['link_text'] ) ? $atts['link_text'] : 'Learn More';
    
    // Set null link (no URL = no display)
    if ( $atts['link'] == "" || $atts['link'] == '0' ) { $iblink = ''; } else { $iblink = '<a href="'.get_permalink($atts['link']).'" class="service-link view-info-link icb-link">'.$link_text.'<span class="icb-link-icon fa fa-angle-right"></span></a>'; }
    
    // Create iCB wrap
    $iconbox = '<div class="iconbox iconbox-wrap iconbox-'.$atts['format'].'">';
    if ( $atts['format'] == 'widget' ) { // If ICB is in widget
        $iconbox .= '
    <div class="iconbox-widget">
      <div class="icb-widget-wrap">
        <div class="icb-icon-wrap icb-element"><span class="icb-icon '.$atts['icon'].'"></span></div>
        <div class="icb-content icb-element">
          <div class="icb-name"><h3>'.$atts['title'].'</h3></div>
          '.( $content ? "<div class=\"icb-blurb\"><p>$content</p></div>" : "" ).'
        </div>
        '.$iblink.'
        <div class="clear"></div>
      </div>
    </div>
        ';
    } elseif ( $atts['format'] == 'list' ){
        $iconbox .= '
    <div class="iconlist-widget">
      <div class="icl-widget-wrap">
        <div class="icl-icon-wrap"><span class="icl-icon '.$atts['icon'].'"></span></div>
        <div class="icl-content icl-element clrc-target">
          <div class="icl-name"><h3>'.urldecode($atts['title']).'</h3></div>
        </div>
        '.( $content ? "<div class=\"icb-blurb clrc-target\"><p>$content</p></div>" : "" ).'
        <div class="clear"></div>
      </div>
    </div>
        ';
    } elseif ( $atts['format'] == 'line' || $atts['format'] == 'contact'){
        $iconbox .= '
    <div class="iconline-widget">
      <div class="icli-widget-wrap">
        <div class="icli-icon-wrap"><span class="icli-icon '.$atts['icon'].'"></span></div>
        <div class="icli-content icli-element clrc-target">
          <div class="icli-name"><h3>'.urldecode($atts['title']).'</h3></div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
        ';
    } else {
    }
    $iconbox .= '</div>';
    return $iconbox;
}
add_shortcode( 'iconbox', 'ccd_iconbox_shortcode' );