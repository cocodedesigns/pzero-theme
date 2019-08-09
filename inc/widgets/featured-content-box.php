<?php

class CCD_FeatCon_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_featcon__widget',
            __( 'Featured Content Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_featcon_widget',
                'description' => __( 'Adds featured content to the page.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-welcome-view-site'
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
        
        $size       = $instance['size'];
        $Dicon      = $instance['Dicon'];
        $icon       = $instance['icon'];
        $image      = $instance['image'];
        $title      = $instance['title'];
        $href       = $instance['href'];
        $content    = $instance['content'];
         
        echo $before_widget;
        echo do_shortcode('[featured title="'.$title.'" icon="'.$icon.'" image="'.$image.'" href="'.$href.'" size="'.$size.'"]'.$content.'[/featured]');
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
        
        $instance['size'] = strip_tags( $new_instance['size'] );
        $instance['icon'] = strip_tags( $new_instance['icon'] );
        $instance['Dicon'] = strip_tags( $new_instance['Dicon'] );
        $instance['image'] = strip_tags( $new_instance['image'] );
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['href'] = strip_tags( $new_instance['href'] );
        $instance['content'] = strip_tags( $new_instance['content'] );
         
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
     
        $size = $instance['size'];
        $Dicon = $instance['Dicon'];
        $icon = $instance['icon'];
        $image = $instance['image'];
        $title = $instance['title'];
        $href = $instance['href'];
        $content = $instance['content'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Widget Size:'); ?></label> 
            <select class="this-drop-down-menu" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>">
              <option>Select</option>
              <option value="small" <?php selected( $size, 'small' ); ?>>Small (Icon on left)</option>
              <option value="medium" <?php selected( $size, 'medium' ); ?>>Medium (Icon on top)</option>
              <option value="large" <?php selected( $size, 'large' ); ?>>Large (No icon, full width)</option>
              <option value="image" <?php selected( $size, 'image' ); ?>>Image (Image on left, full width)</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Icon:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $icon; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
        </p> 
        <a href="#" class="custom_media_upload">Upload</a>
        <?php if ( !$image ) { echo '<img class="custom_media_image" src="" />'; } else { $attID = wp_get_attachment_image_src( $image, 'thumbnail' ); echo '<img class="custom_media_image" src="'.$attID[0].'" />'; } ?>
        <input class="<?php echo $this->get_field_id('image'); ?>" type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" readonly>
        <script>
jQuery('.custom_media_upload').click(function(e) {
    e.preventDefault();
    var widget_button = jQuery(this);

    var custom_uploader = wp.media({
        title: 'Select Preview Image',
        button: {
            text: 'Insert Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).next().attr('src', attachment.sizes.thumbnail.url);
        jQuery(widget_button).next().next().val(attachment.id);
    })
    .open();
});
        </script>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Page:'); ?></label> 
          <?php wp_dropdown_pages( array(
            'name'              => $this->get_field_name('link'),
            'id'                => $this->get_field_id('link'),
            'class'             => 'this-drop-down-menu',
            'show_option_none'  => 'No Page',
            'selected'          => $link
          ) ); ?>
          <style>
            .this-drop-down-menu{ width: 250px; }
          </style>
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_FeatCon_Widget' );
});

function ccd_featured_shortcode( $atts, $content = null ){
    
    // Queue script_loader_src
//    wp_enqueue_script( 'featured-script', get_template_directory_uri() . '/inc/widgets/featcon.js' );
    wp_enqueue_style( 'featured-css', get_template_directory_uri() . '/inc/widgets/featcon.css' );
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'size'      => 'small', // small || medium || large || image
            'icon'      => 'objective', // image || objective || value || none || custom (flaticon-)
            'image'     => '', // custom URL || image ID || no value
            'title'     => '', // custom value || no value
            'href'      => '' // custom value || page ID || no value
            /* 'image' and 'href' only apply when 'size' is set to 'large' or 'image' */
        ), $atts, 'featured' ) );
    
    // Set null link (no URL = no display)
    if ( $atts['label'] == "" ) { $iblabel = ''; } else { $iblabel = $atts['label']; }
    if ( $atts['link'] == "" ) { $iblink = ''; } else { $iblink = '<a href="'.get_permalink($atts['link']).'" class="service-link block-link">View more</a>'; }
    $attimg = wp_get_attachment_image_src( $atts['attid'], 'large' );
    
    if ( in_array( $atts['size'], array( 'medium', 'large', 'image' ) ) ) { $size = $atts['size']; } else { $size = 'small'; }
    if ( $atts['icon'] == "objective" ) { $icon = 'flaticon-checklist5'; } elseif ( $atts['icon'] == "value" ) { $icon = 'flaticon-heart316'; } elseif ( $atts['icon'] == "image" ) { $icon = 'image-preview'; } elseif ( $atts['icon'] == "none" ) { $icon = 'no-icon'; } else { $icon = 'flaticon-'.$atts['icon']; }
    if ( $atts['image'] != "" && ( $atts['size'] == "large" || $atts['size'] == "image" ) ) { $image = wp_get_attachment_image_src( $atts['image'], 'large' ); $img = $image[0]; } else { $image = '0'; }
    if ( $atts['title'] != "" && $atts['title'] != $content ) { $title = '<h2 class="featured-title">' . $atts['title'] . '</h2>'; } else { $title = ''; }
    if ( $atts['href'] != "" && $atts['large'] ) { /* Check if has HTTP */ } else { $href = ''; }
    
    // Create wrap
    $featured = '<div class="featured-content featured-wrap">';
     if ( $size == "large" ) {
        $featured .= '
          <div class="featured-icon-box featured-large featured-inner" style="background-image: url(' . $img . ');">
            <div class="featured-text">
              ' . $title . '
              <p>' . $content . '</p>
            </div>
          </div>
        ';
    } elseif ( $size == "image" ) {
        $featured .= '
          <div class="featured-icon-box featured-image featured-inner">
            <div class="featured-icon"></div>
            <div class="featured-text">
              ' . $title . '
              <p>' . $content . '</p>
            </div>
          </div>
        ';
    } else {
        $featured .= '
          <div class="featured-icon-box featured-' . $size . ' featured-inner">
            <div class="featured-icon"><span class="flaticon ' . $icon . '"></span></div>
            <div class="featured-text">
              ' . $title . '
              <p>' . $content . '</p>
            </div>
          </div>
        ';
     }
    $featured .= '</div>';
    
    return $featured;
}
add_shortcode( 'featured', 'ccd_featured_shortcode' );