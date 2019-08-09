<?php
add_action('init', 'eve_education');
 
function eve_education() {
 
	$labels = array(
		'name' => _x('Education', 'post type general name'),
		'singular_name' => _x('Course', 'post type singular name'),
		'add_new' => _x('Add New', 'eve_education item'),
		'add_new_item' => __('Add New Course'),
		'edit_item' => __('Edit Course'),
		'new_item' => __('New Course'),
		'view_item' => __('View Course'),
		'search_items' => __('Search Courses'),
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
		'rewrite' => array('slug' => 'education')
	  ); 
 
	register_post_type( 'education' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "eveedu_admin_init");
 
function eveedu_admin_init(){
  add_meta_box("mb_eveedu_details", "Course Details", "eveedu_details", "education", "normal", "high");
}

add_action( 'admin_enqueue_scripts', 'eveedu_add_datepicker' );
function eveedu_add_datepicker(){
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-datepicker-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
function eveedu_details(){
  global $post;
  $eveedu_details = get_post_meta( get_the_ID(), 'eveedu_details', true );
?>
  <p><label>School:</label>
    <input type="text" size="35" name="eveedu_school" value="<?php echo get_post_meta(get_the_ID(), 'eveedu_school', true); ?>" /></p>
  <p><label>Course Title:</label>
    <input type="text" size="35" name="eveedu_course" value="<?php echo get_post_meta(get_the_ID(), 'eveedu_course', true); ?>" />
    <label>Level:</label>
    <input type="text" size="15" name="eveedu_level" value="<?php echo get_post_meta(get_the_ID(), 'eveedu_level', true); ?>" />
</p>
  <p><label>Date started:</label>
    <input type="text" size="15" name="eveedu_start" value="<?php echo get_post_meta(get_the_ID(), 'eveedu_start', true); ?>" class="datePicker" />
    <label>Date finished:</label>
    <input type="text" size="15" name="eveedu_end" value="<?php echo get_post_meta(get_the_ID(), 'eveedu_end', true); ?>" class="datePicker" /></p>
  <p><label>Course Description</label></p>
  <script>
    jQuery(document).ready(function() {
      jQuery('input.datePicker').datepicker({
        dateFormat : 'dd-mm-yy'
      });
    });
  </script>
<?php
  wp_editor($eveedu_details, 'eveedu_details', array(
    'wpautop' => true,
    'textarea_rows' => 5,
    'teeny' => true,
    'quicktags' => true,
    //'tinymce' => false,
    'media_buttons' => false
  ) );

}

function eveedu_slug( $data , $postarr ) {
	if( $data['post_type'] == 'education' ) {
		$eveedu_school = $_POST['eveedu_school'];
		$eveedu_course = $_POST['eveedu_course'];
        $eveedu_level = $_POST['eveedu_level'];
		$new_title = $eveedu_course.' ('.$eveedu_level.'), '.$eveedu_school;
		// Set slug date
		$post_id = $postarr['ID'];
		// $post_slug = sanitize_title_with_dashes($post_date, '', $context = 'save');
		$data['post_title'] = $new_title;
		$data['post_name'] = $post_id;  
	}
	return $data;
}
add_filter( 'wp_insert_post_data' , 'eveedu_slug' , '99', 2 );

add_action('save_post', 'eveedu_save_details');

function eveedu_save_details(){
  global $post;
 
  update_post_meta($post->ID, "eveedu_school", $_POST["eveedu_school"]);
  update_post_meta($post->ID, "eveedu_course", $_POST["eveedu_course"]);
  update_post_meta($post->ID, "eveedu_level", $_POST["eveedu_level"]);
  update_post_meta($post->ID, "eveedu_start", $_POST["eveedu_start"]);
  update_post_meta($post->ID, "eveedu_end", $_POST["eveedu_end"]);
  update_post_meta($post->ID, "eveedu_details", $_POST["eveedu_details"]);
}
?>