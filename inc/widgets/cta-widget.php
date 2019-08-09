<?php
global $ccd_options;
class CCD_CTA_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_cta_widget',
            __( 'Call To Action Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_cta_widget',
                'description' => __( 'Adds a call to action box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-megaphone'
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
        
        global $ccd_options;
        
        extract( $args );
        
        if ( !$args['widget_id'] ){
            $wID = 'cta-'.rand();
        } else { 
            $wID = $args['widget_id'];
        }
        
        $ctaTitle    = $instance['ctaTitle'];
        $ctaDescr    = $instance['ctaDescr'];
        $ctaImage    = $instance['ctaImage'];
        $ctaBgclr    = $instance['ctaBgclr'];
        $ctaLtext    = $instance['ctaLtext'];
        $ctaLiurl    = $instance['ctaLiurl'];
        $over        = $instance['over'];
        
        if ( $over == "dark" || $over == "light" ){ $cc = "has-image has-fi override-bgcheck"; $cci = 'lose-control ';
            if ( $ctaImage ){ $cci .= "background--" . $over; } else { $cci .= $over . '--color'; }
        } else { $cc = "has-image has-fi no-override "; 
            if ( $ctaImage ){ $cc .= ''; $cci = ''; } else { $cc .= 'no-image'; $cci = 'clrc-target'; }
        }
        
        if ( $ctaImage ) { 
            if ( is_numeric( $ctaImage ) ) { 
                $attID = wp_get_attachment_image_src( $ctaImage, 'large' );
                $bgImg = $attID[0];
            }
            else {
                $bgImg = $ctaImage;
            }
            $bg = 'background-image: url(\''.$bgImg.'\');'; $Bgclr = '#000'; $class = $cc;
        }
        else { 
          if ( !$ctaBgclr ) { $Bgclr = $ccd_options['ccd-color-accent']; }
          else { $Bgclr = $ctaBgclr; }
          $bg = 'background-color: '.$Bgclr.';';
          $class = $cc;
        }
        
        echo $before_widget;

        echo '
          <div class="cta-widget cta-outer-wrap" id="'.$wID.'">
            <div class="cta-inner-wrap ' . $class . '" style="'.$bg.'">
              <div class="cta-data">
                <div class="cta-data-content '.$cci.'">
                  <h2 class="cta-name target">'.$ctaTitle.'</h2>
                  <p class="cta-desc target">'.$ctaDescr.'</p>
                  <a href="'.$ctaLiurl.'" class="cta-link target">'.$ctaLtext.'</a>
                </div>
              </div>
            </div>
          </div>
        ';
        
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

        $instance['ctaTitle'] = strip_tags( $new_instance['ctaTitle'] );
        $instance['ctaDescr'] = strip_tags( $new_instance['ctaDescr'] );
        $instance['ctaBgclr'] = strip_tags( $new_instance['ctaBgclr'] );
        $instance['ctaImage'] = strip_tags( $new_instance['ctaImage'] );
        $instance['ctaLiurl'] = strip_tags( $new_instance['ctaLiurl'] );
        $instance['ctaLtext'] = strip_tags( $new_instance['ctaLtext'] );
        $instance['over']     = strip_tags( $new_instance['over'] );
         
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

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
     
        $ctaTitle = strip_tags( $instance['ctaTitle'] );
        $ctaDescr = strip_tags( $instance['ctaDescr'] );
        $ctaBgclr = strip_tags( $instance['ctaBgclr'] );
        $ctaImage = strip_tags( $instance['ctaImage'] );
        $ctaLiurl = strip_tags( $instance['ctaLiurl'] );
        $ctaLtext = strip_tags( $instance['ctaLtext'] );
        $over     = strip_tags( $instance['over'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('ctaTitle'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ctaTitle'); ?>" name="<?php echo $this->get_field_name('ctaTitle'); ?>" type="text" value="<?php echo $ctaTitle; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ctaDescr'); ?>"><?php _e('Content:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ctaDescr'); ?>" name="<?php echo $this->get_field_name('ctaDescr'); ?>" type="text" value="<?php echo $ctaDescr; ?>" />
        </p>
        <style>
.title-image{ width: 400px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element{ float: left; height: 215px; box-sizing: border-box; }
.ccd-image-divider{ width: 31px; }
.ccd-image-divider .ccd-id-bar{ width: 1px; height: 75px; background-color: #000; margin: 0 auto; }
.ccd-image-divider .ccd-id-label{ height: 30px; line-height: 30px; text-align: center; }
.ccd-color-picker{ padding: 55px 100px 90px; }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery(document).ready(function($) { 
            $('.color-picker').wpColorPicker();
    }); 
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
        <p>Select image or colour:</p>
        <p><em>Image will take priority over colour.</em></p>
        <div class="ccd-image-clr">
          <div id="slide-upload" class="ccd-image-clr-element">
            <div class="uploaded image title-image tab-content <?php if ( $ctaImage ) { $img = wp_get_attachment_image_src( $ctaImage, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
              <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
                <span class="upload-label">Upload Image</span></a>
            </div>
            <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('ctaImage'); ?>" value="<?php echo $ctaImage; ?>" readonly>
            <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
          </div>
          <div class="ccd-image-clr-element ccd-image-divider">
            <div class="ccd-id-bar"></div>
            <div class="ccd-id-label">or</div>
            <div class="ccd-id-bar"></div>
          </div>
          <div class="ccd-image-clr-element ccd-color-picker">
            <p>
                <label for="<?php echo $this->get_field_id( 'ctaBgclr' ); ?>" style="display:block;"><?php _e( 'Background Colour:' ); ?></label> 
                <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'ctaBgclr' ); ?>" name="<?php echo $this->get_field_name( 'ctaBgclr' ); ?>" type="text" value="<?php echo esc_attr( $ctaBgclr ); ?>" />
            </p>
          </div>
          <div class="clear"></div>
        </div>
        <p>
            <label for="<?php echo $this->get_field_id('over'); ?>"><?php _e('Force Light / Dark image:'); ?></label> 
            <select id="<?php echo $this->get_field_id('over'); ?>" name="<?php echo $this->get_field_name('over'); ?>">
                <option value="0" <?php selected( '0', $over ); ?>>No override</option>
                <option value="dark" <?php selected( 'dark', $over ); ?>>Dark image</option>
                <option value="light" <?php selected( 'light', $over ); ?>>Light image</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ctaLtext'); ?>"><?php _e('Link Text:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ctaLtext'); ?>" name="<?php echo $this->get_field_name('ctaLtext'); ?>" type="text" value="<?php echo $ctaLtext; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ctaLiurl'); ?>"><?php _e('Link URL:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('ctaLiurl'); ?>" name="<?php echo $this->get_field_name('ctaLiurl'); ?>" type="text" value="<?php echo $ctaLiurl; ?>" />
        </p>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_CTA_Widget' );
});