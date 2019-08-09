<?php
add_action('init', 'ccd_slider');
 
function ccd_slider() {
 
	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'ccd_Slides item'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/icons/plugins/slider.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => false
	  ); 
 
	register_post_type( 'slider' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "ccds_admin_init");
 
function ccds_admin_init(){
  add_meta_box("mb_ccds_details", "Slide Description", "ccds_details", "slider", "normal", "high");
  add_meta_box("mb_ccds_link", "Slide Link", "ccds_link", "slider", "normal", "high");
}

function ccds_details(){
  global $post;
  $custom = get_post_custom($post->ID);
  $description = $custom['slide_details'][0];

  wp_editor($description, 'slide_details', array(
    'wpautop' => true,
    'textarea_rows' => 5,
    'teeny' => true,
    'quicktags' => true,
    'tinymce' => false,
    'media_buttons' => false
  ) );
}

function ccds_link(){
  ?>
    <p>
      <label><strong>Slide link:</strong> http://</label>
      <input type="text" name="slide_link" value="<?php echo get_post_meta( get_the_ID(), 'slide_link', true ); ?>" size="35" /><br />
      <label><strong>Target:</strong></label>
      <select name="slide_target">
        <option value="_self" <?php selected( '_self', get_post_meta( get_the_ID(), 'slide_link', true ) ); ?>>This window</option>
        <option value="_blank" <?php selected( '_blank', get_post_meta( get_the_ID(), 'slide_link', true ) ); ?>>New window</option>
        <option value="_parent" <?php selected( '_parent', get_post_meta( get_the_ID(), 'slide_link', true ) ); ?>>Parent window</option>
      </select>
    </p>
  <?php
}

add_action('save_post', 'ccds_save_details');

function ccds_save_details(){
  global $post;
 
  update_post_meta($post->ID, "slide_details", $_POST["slide_details"]);
  update_post_meta($post->ID, "slide_link", $_POST["slide_link"]);
  update_post_meta($post->ID, "slide_target", $_POST["slide_target"]);
}

?>