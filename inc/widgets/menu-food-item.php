<?php
global $db_options;
class LVK_Food_Item_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'lvk_food_item_widget',
            __( 'Menu Item Widget', 'ccd_widget' ),
            array(
                'classname'   => 'lvk_food_item_widget',
                'description' => __( 'Displays an item from your restaurant\'s menu', 'ccd_widget' ),
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
        
        $photo_thumb = wp_get_attachment_image_src( $instance['photo_id'], 'thumbnail' );
        
        echo $before_widget;
        
        ?>
        <div id="<?php echo $wID; ?>" class="menu-item food-item menu-food-item <?php if ( $instance['featured'] != "no" ) { echo 'food-item-highlighted'; } else { echo 'food-item-standard'; } ?> <?php if ( $instance['photo_id'] ) { echo 'food-item-hasimage'; } else { echo 'food-item-noimage'; } ?>">
          <div class="food-item-wrap">
            <div class="food-item-image" <?php if ( $instance['photo_id'] ) { ?>style="background-image: url('<?php echo $photo_thumb[0]; ?>');"<?php } ?>></div>
            <div class="food-item-content">
              <div class="food-item-name-wrap">
                <h2><?php echo $instance['product_name']; ?></h2>
                <p>&pound;<?php echo number_format($instance['price'],2,'.',','); ?></p>
              </div>
              <div class="food-item-description">
                <?php if ( $instance['description'] ) { echo wpautop( $instance['description'] ); } ?>
              </div>
              <div class="food-item-footer">
                <div class="food-item-warnings">
                  <?php if ( $instance['is_vegan'] ) { ?>
                  <span class="food-item-label food-is-vegan" title="Suitable for vegans">V</span>
                  <?php } else { }
                  if ( $instance['is_spicy'] ) { ?>
                  <span class="food-item-label food-is-spicy" title="Spicy">S</span>
                  <?php } else { }
                  if ( $instance['is_nuts'] ) { ?>
                  <span class="food-item-label food-is-nuts" title="Contains nuts">N</span>
                  <?php } else { }
                  if ( $instance['is_gluten'] ) { ?>
                  <span class="food-item-label food-is-glutenfree" title="Gluten free">G</span>
                  <?php } else { } ?>
                </div>
                <div class="food-item-featured"><?php if ( $instance['featured'] != "no" ) { ?><span><?php echo $instance['featured']; ?></span><?php } else { } ?></div>
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
     
        $widget_style  = $instance['widget_style'];
        $resmio_colour = $instance['ctaImage'];
        $resmio_id     = strip_tags( $instance['resmio_id'] );
        
        ?>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $instance['photo_id'] ) { $img = wp_get_attachment_image_src( $instance['photo_id'], 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('photo_id'); ?>" value="<?php echo $instance['photo_id']; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 178px; border: solid 1px #CCC; }
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
            <label for="<?php echo $this->get_field_id('product_name'); ?>"><?php _e('Product Name:'); ?></label> 
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('product_name'); ?>" name="<?php echo $this->get_field_name('product_name'); ?>" value="<?php echo $instance['product_name']; ?>" />
        </p>
        <p>  
            <label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('Price:'); ?></label> 
            <input type="number" id="<?php echo $this->get_field_id('price'); ?>" name="<?php echo $this->get_field_name('price'); ?>" value="<?php echo $instance['price']; ?>" step="0.01" />
        </p>
        <p>  
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label> 
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" value="<?php echo $instance['description']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('featured'); ?>"><?php _e('Is this a featured item?'); ?></label> 
            <select id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>">
                <option value="no" <?php selected( 'no', $instance['featured'] ); ?>>No</option>
                <option value="New" <?php selected( 'New', $instance['featured'] ); ?>>New</option>
                <option value="Recommended" <?php selected( 'Recommended', $instance['featured'] ); ?>>Recommended</option>
            </select>
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'is_vegan' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'is_vegan' ); ?>" name="<?php echo $this->get_field_name( 'is_vegan' ); ?>" /> <label for="<?php echo $this->get_field_id( 'is_vegan' ); ?>">Suitable for vegans</label></p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'is_spicy' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'is_spicy' ); ?>" name="<?php echo $this->get_field_name( 'is_spicy' ); ?>" /> <label for="<?php echo $this->get_field_id( 'is_spicy' ); ?>">Spicy</label></p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'is_nuts' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'is_nuts' ); ?>" name="<?php echo $this->get_field_name( 'is_nuts' ); ?>" /> <label for="<?php echo $this->get_field_id( 'is_nuts' ); ?>">Contains nuts</label></p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'is_gluten' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'is_gluten' ); ?>" name="<?php echo $this->get_field_name( 'is_gluten' ); ?>" /> <label for="<?php echo $this->get_field_id( 'is_gluten' ); ?>">Gluten free</label></p>
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'LVK_Food_Item_Widget' );
});