<?php
global $sr_options;
class SR_Product_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'sr_product_widget',
            __( '[SR] Product Widget', 'sr_widget' ),
            array(
                'classname'   => 'sr_product_widget',
                'description' => __( 'Adds an product information box.', 'sr_widget' )
                )
        );
       
        load_plugin_textdomain( 'sr_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
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
        
        $pname    = $instance['pname'];
        $pcomm    = $instance['pcomm'];
        $pimid    = $instance['pimid'];
        
        $attID = wp_get_attachment_image_src( $pimid, 'large' );
        
        echo $before_widget;
        echo '
        <div class="product-widget product-outer-wrap">
          <div class="product-inner-wrap">
            <div class="product-image" style="background-image: url(\''.$attID[0].'\')"></div>
            <div class="product-data">
              <h2 class="product-name">'.$pname.'</h2>
              <p class="product-owner">Designed for: <em>'.$pcomm.'</em></p>
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

        $instance['pname'] = strip_tags( $new_instance['pname'] );
        $instance['pcomm'] = strip_tags( $new_instance['pcomm'] );
        $instance['pimid'] = strip_tags( $new_instance['pimid'] );
         
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
     
        $pname   = esc_attr( $instance['pname'] );
        $pcomm   = esc_attr( $instance['pcomm'] );
        $pimid   = esc_attr( $instance['pimid'] );
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('pname'); ?>"><?php _e('Product Name:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pcomm'); ?>" name="<?php echo $this->get_field_name('pname'); ?>" type="text" value="<?php echo $pname; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pcomm'); ?>"><?php _e('Commissioned for:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pcomm'); ?>" name="<?php echo $this->get_field_name('pcomm'); ?>" type="text" value="<?php echo $pcomm; ?>" />
        </p>
        <?php if ( !$pimid ) { echo '<img class="custom_media_image" src="" />'; } else { $attID = wp_get_attachment_image_src( $pimid, 'medium' ); echo '<img class="custom_media_image" src="'.$attID[0].'" />'; } ?>
        <a href="#" class="custom_media_upload">Select Image</a>
        <input class="custom_media_id" type="hidden" name="<?php echo $this->get_field_name('pimid'); ?>" value="<?php echo $pimid; ?>" />
        <script>
jQuery('.custom_media_upload').click(function(e) {
    e.preventDefault();
    var widget_button = jQuery(this);

    var custom_uploader = wp.media({
        title: 'Select Image',
        button: {
            text: 'Insert Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).prev().attr('src', attachment.sizes.thumbnail.url);
        jQuery(widget_button).next().val(attachment.id);
    })
    .open();
});
        </script>
     
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'SR_Product_Widget' );
});