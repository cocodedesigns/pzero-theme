<?php
global $db_options;
class LVK_Food_Title_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'lvk_food_title_widget',
            __( 'Menu Group Title Widget', 'ccd_widget' ),
            array(
                'classname'   => 'lvk_food_title_widget',
                'description' => __( 'Displays a title (with optional background image) for your restaurant\'s menu', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-exerpt-view'
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
        
        global $db_options;
        
        extract( $args );
        
        $wID = $args['widget_id'];
        
        $photo = wp_get_attachment_image_src( $instance['photo_id'], 'large' );
        
        echo $before_widget;
        ?>
        <div id="<?php echo $wID; ?>" class="menu-title food-title menu-food-title <?php if ( $instance['photo_id'] ) { echo 'food-title-hasimage'; } else { echo 'food-title-noimage'; } ?>">
          <div class="title-wrap" <?php if ( $instance['photo_id'] ) { ?>style="background-image: url('<?php echo $photo[0]; ?>');"<?php } ?>>
            <div class="title-inner">
              <h2><?php echo $instance['title']; ?></h2>
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
        
        ?>
        <p>  
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $instance['photo_id'] ) { $img = wp_get_attachment_image_src( $instance['photo_id'], 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('photo_id'); ?>" value="<?php echo $instance['photo_id']; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 500px; border: solid 1px #CCC; }
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
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'LVK_Food_Title_Widget' );
});