<?php
global $ccd_options;
class CCD_Title_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_title_widget',
            __( 'Title Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_title_widget',
                'description' => __( 'Adds an title information box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-welcome-widgets-menus'
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
        
        $Ptit    = $instance['Ptit'];
        $Stit    = $instance['Stit'];
        $bgID    = $instance['bgID'];
        $over    = $instance['over'];
        $wid     = $args['widget_id'];
        
        if ( $over == "dark" || $over == "light" ){ $cc = "has-fi override-bgcheck background--" . $over; } else { $cc = "has-fi bgc-image no-override"; }
        
        if ( $bgID == 0 || !$bgID ) { $class = "no-fi"; $featImg = ""; } 
        else { $class = $cc; $att = wp_get_attachment_image_src( $bgID, 'large' ); $featImg = $att[0]; }
        
        echo $before_widget;
        ?>
    <div id="<?php echo $wid; ?>" class="title-widget <?php echo $class; ?>" style="background-image: url('<?php echo $featImg ?>');">
      <div class="title-widget-wrap-outer">
        <div class="title-widget-wrap-inner">
          <div class="title-widget-outer bgc-target">
            <h1 class="title page-title title-bar"><?php echo $Ptit; ?></h1>
            <h2 class="subtitle"><?php echo $Stit; ?></h2>
          </div>
        </div>
      </div>
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

        $instance['Ptit']  = strip_tags( $new_instance['Ptit'] );
        $instance['Stit']  = strip_tags( $new_instance['Stit'] );
        $instance['bgID']  = strip_tags( $new_instance['bgID'] );
        $instance['over']  = strip_tags( $new_instance['over'] );
         
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
     
        $Ptit    = esc_attr( $instance['Ptit'] );
        $Stit    = esc_attr( $instance['Stit'] );
        $bgID    = esc_attr( $instance['bgID'] );
        $over    = esc_attr( $instance['over'] );
        
        ?>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $bgID ) { $img = wp_get_attachment_image_src( $bgID, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('bgID'); ?>" value="<?php echo $bgID; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 400px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
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
        <p>
            <label for="<?php echo $this->get_field_id('Ptit'); ?>"><?php _e('Main Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('Ptit'); ?>" name="<?php echo $this->get_field_name('Ptit'); ?>" type="text" value="<?php echo $Ptit; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Stit'); ?>"><?php _e('Sub Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('Stit'); ?>" name="<?php echo $this->get_field_name('Stit'); ?>" type="text" value="<?php echo $Stit; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('over'); ?>"><?php _e('Force Light / Dark image:'); ?></label> 
            <select id="<?php echo $this->get_field_id('over'); ?>" name="<?php echo $this->get_field_name('over'); ?>">
                <option value="0" <?php selected( '0', $over ); ?>>No override</option>
                <option value="dark" <?php selected( 'dark', $over ); ?>>Dark image</option>
                <option value="light" <?php selected( 'light', $over ); ?>>Light image</option>
            </select>
        </p>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Title_Widget' );
});