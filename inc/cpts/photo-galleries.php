<?php

global $post;

// Galleries custom post type
add_action('init', 'ccdClient_gallery'); 
function ccdClient_gallery() {
 	$labels = array(
		'name' => _x('Photo Galleries', 'post type general name'),
		'singular_name' => _x('Photo Gallery', 'post type singular name'),
		'add_new' => _x('Add New', 'post type item'),
		'add_new_item' => __('Add New Gallery'),
		'edit_item' => __('Edit Gallery'),
		'new_item' => __('New Gallery'),
		'view_item' => __('View Gallery'),
		'search_items' => __('Search Galleries'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-camera',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 24,
		'supports' => array('title', 'thumbnail'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => 'galleries',
  ); 
	register_post_type( 'gallery' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "ccdClient_gallery_admin_init");
function ccdClient_gallery_admin_init(){
  add_meta_box("mb_ccdClient_gallery_scode", "Gallery Shortcode", "ccdClient_gallery_scode", "gallery", "side", "high");
}

function ccdClient_gallery_scode(){
    if ( get_post_type( $post->ID ) == "gallery" && get_post_status( $post->ID ) == "publish" ) { ?>
<p>To embed this gallery into your post, copy this shortcode:</p>
<input readonly value="[showgal id=&quot;<?php echo get_the_ID(); ?>&quot; width=&quot;800&quot; count=&quot;4&quot;]" style="width: 100%;" />
<?php } else { ?>
<p>Please publish this post to generate a shortcode for it.</p>
<?php } ?>
<?php
}

add_action( 'cmb2_init', '_mb_ccdClient_addPhotoGallery' );
function _mb_ccdClient_addPhotoGallery() {

	$prefix = '_ccdclient_gallery_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'photo_gallery',
		'title'        => __( 'Photo Gallery', 'ccdClient-wp' ),
		'object_types' => array( 'gallery' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Gallery Images', 'ccdClient-wp' ),
		'id' => $prefix . 'photos',
		'type' => 'file_list',
		'preview_size' => 'thumbnail',
	) );
  
	$cmb2 = new_cmb2_box( array(
		'id'           => $prefix . 'gallery_meta',
		'title'        => __( 'Gallery Meta', 'ccdClient-wp' ),
		'object_types' => array( 'gallery' ),
		'context'      => 'side',
		'priority'     => 'core',
	) );

	$cmb2->add_field( array(
		'name' => __( 'Description', 'ccdClient-wp' ),
		'id' => $prefix . 'description',
		'type' => 'textarea_small',
	) );

}

// Gallery widget

class CCD_Gallery_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccdClient_gallery_widget',
            __( 'Photo Gallery Widget', 'ccdClient_widget' ),
            array(
                'classname'   => 'ccdClient_gallery_widget',
                'description' => __( 'Inserts a photo gallery widget to display gallery images within a post.', 'ccdClient_widget' ),
                'panels_groups' => array('ccdClient_widgets'),
                'panels_icon'   => 'dashicons dashicons-format-gallery'
            )
        );
       
        load_plugin_textdomain( 'ccdClient_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
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
        
        $count     = $instance['count'];
        $width     = $instance['width'];
        $id        = $instance['id'];
         
        echo $before_widget;
        echo do_shortcode('[showgal id="'.$id.'" count="'.$count.'" width="'.$width.'"]');
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

        $instance['count']  = strip_tags( $new_instance['count'] );
        $instance['width']  = strip_tags( $new_instance['width'] );
        $instance['id']     = strip_tags( $new_instance['id'] );
         
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
     
        $count    = esc_attr( $instance['count'] );
        $width    = esc_attr( $instance['width'] );
        $id       = esc_attr( $instance['id'] );
        
        $gal_args = array(
            'post_type'           => 'gallery',
            'posts_per_page'      => -1,
            'ignore_sticky_posts' => 1,
            'order'               => 'ASC',
            'orderby'             => 'title',
        );
        $gq = new WP_Query( $gal_args );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Gallery:'); ?></label> 
            <select name="<?php echo $this->get_field_name('id'); ?>" id="<?php echo $this->get_field_id('id'); ?>">
              <?php if ( $gq->have_posts() ) : while ( $gq->have_posts() ) : $gq->the_post(); ?>
              <option <?php selected( $id, get_the_ID() ); ?> value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
              <?php endwhile; endif; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of photos:'); ?></label> 
            <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php if ( $count >= 4 ) { echo '4'; } else { echo $count; } ?>" min="1" max="4" />
            <em><?php _e('The maximum width is currently set to 800px.'); ?></em>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width (in px):'); ?></label> 
            <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="number" value="<?php if ( $width >= 900 ) { echo '900'; } elseif ( $width <= 500 ) { echo '500'; } else { echo $width; } ?>" min="500" max="900" />
        </p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Gallery_Widget' );
});

// Gallery shortcode

function ccdClient_gallery_shortcode( $atts, $content = null ){
    
    // Set default attributes
    $atts = ( shortcode_atts( array(
            'id'        => '',
            'count'     => '4',
            'width'     => '800'
        ), $atts, 'showgal' ) );
    
    // Get gallery information from ID
    $ga = array(
        'post_type'      => 'gallery',
        'posts_per_page' => 1,
        'post_id'        => $id,
    );
    
    $gal = new WP_Query( $ga );
    
    $gimg = rwmb_meta( 'ccdClient_gallery_photos_photos', array( 'type' => 'image_advanced' ), $atts['id'] );
    $i = 0;
    $galleryimages = '';
    if ( $atts['count'] >= 3 ) { $ih = '200px'; } else { $ih = '300px'; }
    $width = ($atts['width']-(3*2*$atts['count'])+6-28);
    foreach ( $gimg as $img ){
      if ( $i != $atts['count'] ){
        $ti = wp_get_attachment_image_src( $img['ID'], 'large' );
        $i++;
        $galleryimages .= '<li id="photo-'.$img['ID'].'" style="background-image: url('.$ti[0].'); width: calc('.$width.'px/'.$atts['count'].'); height: '.$ih.';"></li>';
      }
      else { }
    }
    
    // Create gallery preview
    $galbox = '<div class="gallerybox gallery-preview-wrap" style="width: '.$atts['width'].'px;">
          <div class="gallery-preview-inner">
            <div class="gallery-preview">
              <h2 class="gallery-title">'.get_the_title($atts['id']).'</h2>
              <div class="galelry-thumbnails">
                <ul>
                  '.$galleryimages.'
                </ul>
              </div>
              <div class="gallery-meta">
               <p>Posted on <em>'.get_the_date('F j, Y', $atts['id']).'</em></p>
              </div>
              <div class="gallery-description">
                <p>'.( strlen( get_post_meta( $atts['id'], 'ccdClient_gallery_desc', true ) ) > 30 ? substr( get_post_meta( $atts['id'], 'ccdClient_gallery_desc', true ), 0, 296 ) . ' ...' : get_post_meta( $atts['id'], 'ccdClient_gallery_desc', true ) ).'</p>
              </div>
              <a href="'.get_the_permalink($atts['id']).'" class="block-link view-more-link">View gallery</a>
            </div>
            <div class="clear"></div>
          </div>
    </div>';
    return $galbox;
    
    // Create counter wrap
    $countbox = '<div class="counterbox counterbox-wrap">
          <div class="number-count-widget-wrap">
            <div class="number-count-widget">
              <div class="count"><h2>'.$atts['count'].'</h2></div>
              <div class="description"><p>'.$atts['desc'].'</p></div>
            </div>
            <div class="clear"></div>
          </div>
        </div>';
    return $countbox;
}
add_shortcode( 'showgal', 'ccdClient_gallery_shortcode' );
