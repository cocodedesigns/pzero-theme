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
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-thumbs-up',
		'rewrite' => true,
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => 101,
		'supports' => array('excerpt'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'praise')
	  ); 
 
	register_post_type( 'testimonial' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "ccdtm_admin_init");
 
function ccdtm_admin_init(){
  add_meta_box("mb_ccdtm_content", "Testimonial", "ccdtm_content", "testimonial", "normal", "high");
}

function ccdtm_content(){
  ?>
  <style>
    .ccd-test-field{ padding: 6px 2px; box-sizing: border-box; }
    .ccd-test-field input, .ccd-test-field textarea{ border: solid 1px #ADADAD; line-height: 29px; padding: 3px 11px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; width: 100%; font-size: 16px; }
    .ccd-test-field textarea{ height: 200px; resize: none; }
    .ccd-test-field label{ font-weight: 700; }
    .ccd-test-half-width{ width: 50%; display: inline-block; margin: 0 -1px; }
  </style>
  <div class="ccd-test-full-width ccd-test-field">
    <label>Name to be displayed:</label>
	<input name="ccd_testimonial_person" value="<?php echo get_post_meta( get_the_ID(), 'ccd_testimonial_person', true ); ?>" type="text" />
  </div>
  <div class="ccd-test-half-width ccd-test-field">
    <label>Position:</label>
	<input name="ccd_testimonial_position" value="<?php echo get_post_meta( get_the_ID(), 'ccd_testimonial_position', true ); ?>" type="text" />
  </div>
  <div class="ccd-test-half-width ccd-test-field">
    <label>Company:</label>
	<input name="ccd_testimonial_company" value="<?php echo get_post_meta( get_the_ID(), 'ccd_testimonial_company', true ); ?>" type="text" />
  </div>
  <div class="ccd-test-full-width ccd-test-field">
    <label>Testimonial Content:</label>
    <textarea name="ccd_testimonial_content" id="ccd_testimonial_content"><?php echo get_post_meta( get_the_ID(), 'ccd_testimonial_content', true ); ?></textarea>
  </div>
  <?php
}

function testimonial_title_slug( $data , $postarr ) {
	if( $data['post_type'] == 'testimonial' ) {
		$person_name = $_POST['ccd_testimonial_person'];
		$company_name = $_POST['ccd_testimonial_company'];
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
 
  update_post_meta($post->ID, "ccd_testimonial_person", $_POST["ccd_testimonial_person"]);
  update_post_meta($post->ID, "ccd_testimonial_position", $_POST["ccd_testimonial_position"]);
  update_post_meta($post->ID, "ccd_testimonial_company", $_POST["ccd_testimonial_company"]);
  update_post_meta($post->ID, "ccd_testimonial_content", $_POST["ccd_testimonial_content"]);
}

?>