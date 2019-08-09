<?php

class Delicate_ImageBox_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'delicate_icb__widget',
            __( '&quot;Cookie&quot; Info Box', 'ccd_widget' ),
            array(
                'classname'   => 'delicate_icb_widget',
                'description' => __( 'Creates an information box with a cookie image.', 'ccd_widget' ),
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
        
        $att_id     = $instance['att_id'];
        $title      = $instance['title'];
        $content    = $instance['content'];
        
        $att_med    = wp_get_attachment_image_src( $att_id, 'large' );
        echo $before_widget;
        ?>
        <div class="delicate-cupcake-box" id="<?php echo $atts['widget_id']; ?>">
          <div class="delicate-cupcake-icon delicate-cupcake-element">
            <div class="delicate-cupcake-image" style="background-image: url('<?php echo $att_med[0]; ?>');"></div>
          </div>
          <div class="delicate-cupcake-content delicate-cupcake-element">
            <h2 class="delicate-cupcake-title"><?php echo $title; ?></h2>
            <?php echo wpautop( $content ); ?>
          </div>
          <div class="clear"></div>
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
         
        $instance['title']   = strip_tags( $new_instance['title'] );
        $instance['att_id']  = strip_tags( $new_instance['att_id'] );
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
     
        $title      = esc_attr( $instance['title'] );
        $att_id     = esc_attr( $instance['att_id'] );
        $content    = esc_attr( $instance['content'] );
        ?>
        <div id="slide-upload" class="delicate-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $att_id ) { $img = wp_get_attachment_image_src( $att_id, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('att_id'); ?>" value="<?php echo $att_id; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 180px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.delicate-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.delicate-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
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
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Description:'); ?></label> 
            <textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'Delicate_ImageBox_Widget' );
});