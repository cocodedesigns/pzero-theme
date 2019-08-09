<?php

class ccd_ColumnBox_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_tb__widget',
            __( 'Text in Columns Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_column_widget',
                'description' => __( 'Creates an Text box widget for use on the home page or individual pages.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-text'
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
        $cols       = $instance['cols'];
         
        echo $before_widget;
        echo do_shortcode('[columnbox format="widget" title="'.$title.'" cols="'.$cols.'"]'.$content.'[/columnbox]');
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
        $instance['cols']    = strip_tags( $new_instance['cols'] );
         
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
        $cols       = esc_attr( $instance['cols'] );
        
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
            <label for="<?php echo $this->get_field_id('cols'); ?>"><?php _e('Page:'); ?></label> 
          <?php 
            $query = new WP_Query( 'post_type=page&showposts=-1' );
            if ( $query->have_posts() ) {
                echo '<select name="'.$this->get_field_name('cols').'" id="'.$this->get_field_id('cols').'" style="width: 250px;">';
                echo '<option value="0" '.selected( $cols, '0' ).'>Select page</option>';
                while ( $query->have_posts() ){
                    $query->the_post();
                    echo '<option value="'.get_the_ID().'" '.selected( $cols, get_the_ID() ).'>'.get_the_title().'</option>';
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
     register_widget( 'ccd_ColumnBox_Widget' );
});

function ccd_columnbox_shortcode( $atts, $content = null ){
    
    // Queue script_loader_src
    wp_enqueue_script( 'columnbox-script', get_template_directory_uri() . '/js/columnbox.js' );
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'format'    => 'box', // widget || box || heading
            'title'     => '',
            'cols'      => ''
        ), $atts, 'columnbox' ) );
    
    // Set null cols (no URL = no display)
    if ( $atts['cols'] == "" || $atts['cols'] == '0' ) { $tbcols = ''; } else { $tbcols = '<a href="'.get_permacols($atts['cols']).'" target="_blank" class="service-cols view-more-cols">View</a>'; }
    
    $title = explode("||", $atts['title']);
    if ($title[1] != "") { $wtitle = '<h6 class="wtitle">'.$title[0].'</h6><h4 class="wtitle">'.$title[1].'</h4>'; } else { $wtitle = '<h4 class="wtitle">'.$title[0].'</h4>'; }
    
    // Create tb wrap
    $columnbox = '<div class="columnbox columnbox-wrap">';
    if ( $atts['format'] == 'widget' ) { // If tb is in widget
        $columnbox .= '
    <div class="columnbox-widget">
      <div class="tb-widget-wrap">
        <div class="tb-content tb-element">
          <div class="tb-name">'.$wtitle.'</div>
          <div class="tb-blurb"><p>'.$content.'</p></div>
          '.$tbcols.'
        </div>
        <div class="clear"></div>
      </div>
    </div>
        ';
    } else {
    }
    $columnbox .= '</div>';
    return $columnbox;
}
add_shortcode( 'columnbox', 'ccd_columnbox_shortcode' );