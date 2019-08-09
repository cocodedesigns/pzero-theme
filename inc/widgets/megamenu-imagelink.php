<?php

class CCD_MM_ImageLink_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_mm_imagelink__widget',
            __( 'Image Link (for Mega Menu)', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_icb_widget',
                'description' => __( 'Creates an image link to a page.  Designed for WR MegaMenu.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-format-image'
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
        
        $attid = $instance['attid'];
        $title = $instance['title'];
        $link  = $instance['link'];
        
        $att = wp_get_attachment_image_src( $attid, 'thumbnail' );
        echo $before_widget;
        ?>
        <div class="mm-image-link-widget">
          <a href="<?php the_permalink( $link ); ?>" class="il-link" title="<?php echo $title; ?>">
            <div class="il-image"><img src="<?php echo $att[0]; ?>" style="max-width: <?php echo $att[1]; ?>px;"></div>
            <h2 class="il-title"><?php echo $title; ?></h2>
          </a>
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
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['link']  = strip_tags( $new_instance['link'] );
        $instance['attid'] = strip_tags( $new_instance['attid'] );
         
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
     
        $title   = esc_attr( $instance['title'] );
        $link    = esc_attr( $instance['link'] );
        $attid   = esc_attr( $instance['attid'] );
        ?>
        <style>
.title-image{ width: 215px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element{ height: 215px; box-sizing: border-box; }
.ccd-image-divider{ width: 31px; }
.ccd-image-divider .ccd-id-bar{ width: 1px; height: 75px; background-color: #000; margin: 0 auto; }
.ccd-image-divider .ccd-id-label{ height: 30px; line-height: 30px; text-align: center; }
.ccd-color-picker{ padding: 55px 100px 90px; }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery('.upload-button').click(function(e) {
      e.preventDefault();
      var widget_button = jQuery(this);
      var custom_uploader = wp.media({
        title: 'Select Title Image',
        button: {
            text: 'Select Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).parent().addClass('hasimage').css('background-image', 'url('+attachment.sizes.full.url+')');
        jQuery(widget_button).parent().next().val(attachment.id);
      })
      .open();
    });
    jQuery('.remove-image').click(function(e) {
        e.preventDefault();
        jQuery(this).prev().prev().removeClass('hasimage').css('background-image', '');
        jQuery(this).prev().val('');
    });
        </script>
          <div id="slide-upload" class="ccd-image-clr-element">
            <div class="uploaded image title-image <?php if ( $attid ) { $img = wp_get_attachment_image_src( $attid, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
              <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
                <span class="upload-label">Upload Image</span></a>
            </div>
            <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('attid'); ?>" value="<?php echo $attid; ?>" readonly>
            <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
          </div>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Page:'); ?></label> 
          <?php wp_dropdown_pages( array (
            'name'              => $this->get_field_name('link'),
            'id'                => $this->get_field_id('link'),
            'show_option_none'  => 'Select Page',
            'show_option_none'  => 0
          ) ); ?>
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_MM_ImageLink_Widget' );
});