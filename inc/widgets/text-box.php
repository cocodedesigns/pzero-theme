<?php

class ccd_TextBox_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_tb__widget',
            __( 'Text Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_text_widget',
                'description' => __( 'Creates an Text box widget for use on the home page or individual pages.', 'ccd_widget' ),
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
        $link       = $instance['link'];
         
        echo $before_widget;
        echo do_shortcode('[textbox format="widget" title="'.$title.'" link="'.$link.'"]'.$content.'[/textbox]');
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
         
        $instance['title']   = strip_tags( $new_instance['title'] );
        $instance['content'] = strip_tags( $new_instance['content'] );
        $instance['link']    = strip_tags( $new_instance['link'] );
         
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
        $link       = esc_attr( $instance['link'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>Separating the title with <span style="color: #54301A; font-weight: 900;">||</span> will create a title with two lines in this style.</p>
        <p><span style="color: #54301A; font-size: 15px; display: block; font-style: italic;">This</span> <span style="color: #202020; font-size: 20px; font-weight: 700; display: block;">Title is separated</span></p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Page:'); ?></label> 
          <?php 
            $query = new WP_Query( 'post_type=page&showposts=-1' );
            if ( $query->have_posts() ) {
                echo '<select name="'.$this->get_field_name('link').'" id="'.$this->get_field_id('link').'" style="width: 250px;">';
                echo '<option value="0" '.selected( $link, '0' ).'>Select page</option>';
                while ( $query->have_posts() ){
                    $query->the_post();
                    echo '<option value="'.get_the_ID().'" '.selected( $link, get_the_ID() ).'>'.get_the_title().'</option>';
                }
                echo '</select>';
            } else {
            }
          ?>
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'ccd_TextBox_Widget' );
});

function ccd_textbox_shortcode( $atts, $content = null ){
    
    // Queue script_loader_src
    wp_enqueue_script( 'textbox-script', get_template_directory_uri() . '/js/textbox.js' );
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'format'    => 'box', // widget || box || heading
            'title'     => '',
            'link'      => ''
        ), $atts, 'textbox' ) );
    
    // Set null link (no URL = no display)
    if ( $atts['link'] == "" || $atts['link'] == '0' ) { $tblink = ''; } else { $tblink = '<a href="'.get_permalink($atts['link']).'" target="_blank" class="service-link view-more-link">View</a>'; }
    
    $title = explode("||", $atts['title']);
    if ($title[1] != "") { $wtitle = '<h6 class="wtitle">'.$title[0].'</h6><h4 class="wtitle">'.$title[1].'</h4>'; } else { $wtitle = '<h4 class="wtitle">'.$title[0].'</h4>'; }
    
    // Create tb wrap
    $textbox = '<div class="textbox textbox-wrap">';
    if ( $atts['format'] == 'widget' ) { // If tb is in widget
        $textbox .= '
    <div class="textbox-widget">
      <div class="tb-widget-wrap">
        <div class="tb-content tb-element">
          <div class="tb-name">'.$wtitle.'</div>
          <div class="tb-blurb"><p>'.$content.'</p></div>
          '.$tblink.'
        </div>
        <div class="clear"></div>
      </div>
    </div>
        ';
    } else {
    }
    $textbox .= '</div>';
    return $textbox;
}
add_shortcode( 'textbox', 'ccd_textbox_shortcode' );