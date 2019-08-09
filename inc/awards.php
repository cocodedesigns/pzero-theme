<?php
add_action('init', 'eve_awards');
 
function eve_awards() {
 
	$labels = array(
		'name' => _x('Awards', 'post type general name'),
		'singular_name' => _x('Award', 'post type singular name'),
		'add_new' => _x('Add New', 'eve_awards item'),
		'add_new_item' => __('Add New Award'),
		'edit_item' => __('Edit Award'),
		'new_item' => __('New Award'),
		'view_item' => __('View Award'),
		'search_items' => __('Search Awards'),
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
        'supports' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => false,
		'can_export' => true,
		'show_in_menu' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'awards')
	  ); 
 
	register_post_type( 'award' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "eveawa_admin_init");
 
function eveawa_admin_init(){
  add_meta_box("mb_eveawa_details", "Award Details", "eveawa_details", "award", "normal", "high");
}

add_action( 'admin_enqueue_scripts', 'eveawa_add_datepicker' );
function eveawa_add_datepicker(){
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-datepicker-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
function eveawa_details(){
  global $post;
  $eveawa_details = get_post_meta( get_the_ID(), 'eveawa_details', true );
?>
  <p><label>Awarding Body / Organisation:</label>
    <input type="text" size="35" name="eveawa_body" value="<?php echo get_post_meta(get_the_ID(), 'eveawa_body', true); ?>" /></p>
  <p><label>Award Name:</label>
    <input type="text" size="35" name="eveawa_name" value="<?php echo get_post_meta(get_the_ID(), 'eveawa_name', true); ?>" /></p>
  <p><label>Date awarded:</label>
    <input type="text" size="15" name="eveawa_date" value="<?php echo get_post_meta(get_the_ID(), 'eveawa_start', true); ?>" class="datePicker" /></p>
  <p><label>Award Description</label></p>
  <script>
    jQuery(document).ready(function() {
      jQuery('input.datePicker').datepicker({
        dateFormat : 'dd-mm-yy'
      });
    });
  </script>
<?php
  wp_editor($eveawa_details, 'eveawa_details', array(
    'wpautop' => true,
    'textarea_rows' => 5,
    'teeny' => true,
    'quicktags' => true,
    //'tinymce' => false,
    'media_buttons' => false
  ) );

}

add_action('wp_insert_post', 'eveawa_slug');
function eveawa_slug( $post_id ) {

       // Making sure this runs only when a 'eduation' post type is created
       $cpt = 'award';
       if ( $cpt != $_POST['post_type'] ) {
          return;
       }


       wp_update_post( array(
        'ID' => $post_id,
        'post_name' => $post_id // slug
       ));

}

add_action('save_post', 'eveawa_save_details');

function eveawa_save_details(){
  global $post;
 
  update_post_meta($post->ID, "eveawa_body", $_POST["eveawa_body"]);
  update_post_meta($post->ID, "eveawa_name", $_POST["eveawa_name"]);
  update_post_meta($post->ID, "eveawa_date", $_POST["eveawa_date"]);
  update_post_meta($post->ID, "eveawa_details", $_POST["eveawa_details"]);
}
?>