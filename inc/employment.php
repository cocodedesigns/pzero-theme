<?php
add_action('init', 'eve_employment');
 
function eve_employment() {
 
	$labels = array(
		'name' => _x('Employment', 'post type general name'),
		'singular_name' => _x('Job', 'post type singular name'),
		'add_new' => _x('Add New', 'eve_employment item'),
		'add_new_item' => __('Add New Job'),
		'edit_item' => __('Edit Job'),
		'new_item' => __('New Job'),
		'view_item' => __('View Job'),
		'search_items' => __('Search Jobs'),
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
		'rewrite' => array('slug' => 'employment')
	  ); 
 
	register_post_type( 'employment' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "eveemp_admin_init");
 
function eveemp_admin_init(){
  add_meta_box("mb_eveemp_details", "Employment Details", "eveemp_details", "employment", "normal", "high");
}

add_action( 'admin_enqueue_scripts', 'eveemp_add_datepicker' );
function eveemp_add_datepicker(){
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-datepicker-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
function eveemp_details(){
  global $post;
?>
  <p><label>Employer:</label>
    <input type="text" size="35" name="eveemp_employer" value="<?php echo get_post_meta(get_the_ID(), 'eveemp_employer', true); ?>" /></p>
  <p><label>Job Title:</label>
    <input type="text" size="35" name="eveemp_jobtitle" value="<?php echo get_post_meta(get_the_ID(), 'eveemp_jobtitle', true); ?>" /></p>
  <p><label>Date started:</label>
    <input type="text" size="15" name="eveemp_start" value="<?php echo get_post_meta(get_the_ID(), 'eveemp_start', true); ?>" class="datePicker" />
    <label>Date finished:</label>
    <input type="text" size="15" name="eveemp_end" value="<?php echo get_post_meta(get_the_ID(), 'eveemp_end', true); ?>" class="datePicker" /></p>
  <p><label>Job Description</label></p>
  <script>
    jQuery(document).ready(function() {
      jQuery('input.datePicker').datepicker({
        dateFormat : 'dd-mm-yy'
      });
    });
  </script>
<?php
  wp_editor(get_post_meta(get_the_ID(), 'eveemp_details', true), 'eveemp_details', array(
    'wpautop' => true,
    'textarea_rows' => 5,
    'teeny' => true,
    'quicktags' => true,
    //'tinymce' => false,
    'media_buttons' => false
  ) );

}

function eveemp_slug( $data , $postarr ) {
	if( $data['post_type'] == 'employment' ) {
		$eveemp_employer = $_POST['eveemp_employer'];
		$eveemp_jobtitle = $_POST['eveemp_jobtitle'];
		$new_title = $eveemp_jobtitle.', '.$eveemp_employer;
		// Set slug date
		$post_id = $postarr['ID'];
		// $post_slug = sanitize_title_with_dashes($post_date, '', $context = 'save');
		$data['post_title'] = $new_title;
		$data['post_name'] = $post_id;  
	}
	return $data;
}
add_filter( 'wp_insert_post_data' , 'eveemp_slug' , '99', 2 );

add_action('save_post', 'eveemp_save_details');

function eveemp_save_details(){
  global $post;
 
  update_post_meta($post->ID, "eveemp_employer", $_POST["eveemp_employer"]);
  update_post_meta($post->ID, "eveemp_jobtitle", $_POST["eveemp_jobtitle"]);
  update_post_meta($post->ID, "eveemp_start", $_POST["eveemp_start"]);
  update_post_meta($post->ID, "eveemp_end", $_POST["eveemp_end"]);
  update_post_meta($post->ID, "eveemp_details", $_POST["eveemp_details"]);
}
?>