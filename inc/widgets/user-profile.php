<?php
class CCD_User_Preview_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'CCD_User_Preview_Widget',
            __( 'User Profile', 'ccd_widget' ),
            array(
                'classname'   => 'CCD_User_Preview_Widget',
                'description' => __( 'Add a small user profile, with photograph', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-admin-users'
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
        
        $wID      = $args['widget_id'];
        $photo    = $instance['photo_id'];
        $title    = $instance['title'];
        $subti    = $instance['subtitle'];
        $content  = $instance['content'];

        echo $before_widget;
        
        $fImg = wp_get_attachment_image_src( $photo, 'full' );
        $featImg = $fImg[0];
        ?>
      <article class="single-piece staff-post staff-profile user-profile staff-member">
        <div class="profile-photo profile-image profile-picture hide-on-tablet hide-on-mobile" style="background-image: url('<?php echo $featImg; ?>'); width: <?php echo $fImg[1]; ?>px; height: <?php echo $fImg[2]; ?>px;"></div>
        <div class="profile-photo profile-image profile-picture hide-on-desktop hide-on-mobile" style="background-image: url('<?php echo $featImg; ?>'); width: <?php echo $fImg[1] / 1.3; ?>px; height: <?php echo $fImg[2] / 1.3; ?>px;"></div>
        <div class="profile-data profile-content hide-on-tablet hide-on-mobile" style="width: calc( 100% - <?php echo $fImg[1]; ?>px );">
          <h1 class="profile-title block-title"><?php echo $title; ?></h1>
          <h2 class="profile-subtitle block-subtitle"><?php echo $subti; ?></h2>
          <?php echo wpautop( do_shortcode( $content ) ); ?>
        </div>
        <div class="profile-data profile-content hide-on-desktop hide-on-mobile" style="width: calc( 100% - <?php echo $fImg[1] / 1.3; ?>px );">
          <h1 class="profile-title block-title"><?php echo $title; ?></h1>
          <h2 class="profile-subtitle block-subtitle"><?php echo $subti; ?></h2>
          <?php echo wpautop( do_shortcode( $content ) ); ?>
        </div>
        <div class="profile-data profile-content hide-on-desktop hide-on-tablet">
          <h1 class="profile-title block-title"><?php echo $title; ?></h1>
          <h2 class="profile-subtitle block-subtitle"><?php echo $subti; ?></h2>
          <?php echo wpautop( do_shortcode( $content ) ); ?>
        </div>
      </article>
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

        $instance['photo_id'] = strip_tags( $new_instance['photo_id'] );
        $instance['title']    = strip_tags( $new_instance['title'] );
        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
        $instance['content']  = strip_tags( $new_instance['content'] );
         
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
     
        $photo    = esc_attr( $instance['photo_id'] );
        $title    = esc_attr( $instance['title'] );
        $subti    = esc_attr( $instance['subtitle'] );
        $content  = esc_attr( $instance['content'] );
        
        ?>
        
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image user-image tab-content <?php if ( $photo ) { $img = wp_get_attachment_image_src( $photo, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('photo_id'); ?>" value="<?php echo $photo; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.user-image{ width: 250px; border: solid 1px #CCC; }
.user-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 400px; text-align: center; padding: 170px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.user-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.user-image :not(.image-src) a:hover{ color: #936FB1; }
.user-image.hasimage{ background-size: cover; background-position: center; }
.user-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.user-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery('.upload-button').click(function(e) {
      e.preventDefault();
      var widget_button = jQuery(this);
      var custom_uploader = wp.media({
        title: 'Select User Image',
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
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Main Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Sub Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo $subti; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
            <textarea name="<?php echo $this->get_field_name('content'); ?>" id="<?php echo $this->get_field_id('content'); ?>" class="widefat" rows="6"><?php echo $content; ?></textarea>
        </p>
        <?php 
    }
}

/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_User_Preview_Widget' );
});