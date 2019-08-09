<?php
add_action('init', 'ccd_testimonials');
 
function ccd_testimonials() {
 
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New', 'ccd_testimonials item'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonials'),
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
		'menu_icon' => 'dashicons-heart',
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 36,
		'supports' => array(''),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'praise')
	  ); 
 
	register_post_type( 'testimonial' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "ccdtm_admin_init");
 
function ccdtm_admin_init(){
  add_meta_box("mb_ccdtm_credit", "Credit to", "ccdtm_credit", "testimonial", "normal", "high");
  add_meta_box("mb_ccdtm_content", "Testimonial", "ccdtm_content", "testimonial", "normal", "high");
}

function ccdtm_credit(){
  global $post;
  $custom = get_post_custom($post->ID);
  $tm_person = $custom['tm_person'][0];
  $tm_company = $custom['tm_company'][0];
  $tm_email = $custom['tm_email'][0];
?>
  <p>
    <label>Name to be displayed:</label>
	<input name="tm_person" value="<?php echo $tm_person; ?>" type="text" />
  </p>
  <p>
    <label>Company to be displayed:</label>
	<input name="tm_company" value="<?php echo $tm_company; ?>" type="text" />
  </p>
  <p>
    <label>Email:</label>
    <input name="tm_email" value="<?php echo $tm_email; ?>" type="text" />
  </p>
<?php
}

function ccdtm_content(){
  global $post;
  $custom = get_post_custom($post->ID);
  $tm_messsage = $custom['tm_messsage'][0];

  wp_editor($tm_messsage, 'tm_messsage', array(
    'wpautop' => true,
    'textarea_rows' => 10,
    'teeny' => true,
    'quicktags' => true,
    //'tinymce' => false,
    'media_buttons' => false
  ) );
}

function testimonial_title_slug( $data , $postarr ) {
	if( $data['post_type'] == 'testimonial' ) {
		$person_name = $_POST['tm_person'];
		$company_name = $_POST['tm_company'];
		$new_title = "$person_name" . ', ' . "$company_name";
		// Set slug date
		$post_date = date('Ymd-His');
		// $post_slug = sanitize_title_with_dashes($post_date, '', $context = 'save');
		$post_slugsan = sanitize_title($post_date);
		$data['post_title'] = $new_title;
		$data['post_name'] = $post_slugsan;  
	}
	return $data;
}
add_filter( 'wp_insert_post_data' , 'testimonial_title_slug' , '99', 2 );

add_action('save_post', 'ccdtm_save_details');

function ccdtm_save_details(){
  global $post;
 
  update_post_meta($post->ID, "tm_person", $_POST["tm_person"]);
  update_post_meta($post->ID, "tm_company", $_POST["tm_company"]);
  update_post_meta($post->ID, "tm_message", $_POST["tm_messsage"]);
  update_post_meta($post->ID, "tm_email", $_POST["tm_email"]);
}

?>