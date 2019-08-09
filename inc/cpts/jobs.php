<?php

// Events custom post type

add_action('init', 'lvk_jobs');
 
function lvk_jobs() {
 
	$labels = array(
		'name' => _x('Vacancies', 'post type general name'),
		'singular_name' => _x('Vacancy', 'post type singular name'),
		'add_new' => _x('Add New', 'post type item'),
		'add_new_item' => __('Add New Vacancy'),
		'edit_item' => __('Edit Vacancy'),
		'new_item' => __('New Vacancy'),
		'view_item' => __('View Vacancy'),
		'search_items' => __('Search Vacancies'),
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
		'menu_icon' => 'dashicons-businessman',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 23,
		'supports' => array('title', 'editor', 'author', 'thumbnail'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'vacancies')
	  ); 
 
	register_post_type( 'job' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "lvk_jobs_admin_init");

function lvk_job_cats_taxonomy(){
    $labels = array(
        'name' => _x( 'Vacancy Categories', 'Vacancy Categories' ),
        'singular_name' => _x( 'Category', 'Vacancy Categories' ),
        'search_items' => __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category' ),
        'edit_item' => __( 'Edit Categories' ),
        'update_item' => __( 'Update Categories' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category' ),
        'menu_name' => __( 'Categories' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'job-cats' ),
    );
    register_taxonomy( 'job-cats', array( 'job' ), $args );
}
function lvk_job_types_taxonomy(){
    $labels = array(
        'name' => _x( 'Vacancy Types', 'Vacancy Types' ),
        'singular_name' => _x( 'Type', 'Vacancy Type' ),
        'search_items' => __( 'Search Types' ),
        'all_items' => __( 'All Types' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type' ),
        'edit_item' => __( 'Edit Types' ),
        'update_item' => __( 'Update Types' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type' ),
        'menu_name' => __( 'Types' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'job-types' ),
    );
    register_taxonomy( 'job-types', array( 'job' ), $args );
}
function lvk_job_tags_taxonomy(){
    $labels = array(
        'name' => _x( 'Vacancy Tags', 'Vacancy Tags' ),
        'singular_name' => _x( 'Tag', 'Vacancy Tags' ),
        'search_items' => __( 'Search Tags' ),
        'popular_items' => __( 'Popular Tags' ),
        'all_items' => __( 'All Tags' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Tags' ),
        'update_item' => __( 'Update Tags' ),
        'add_new_item' => __( 'Add New Tag' ),
        'new_item_name' => __( 'New Tag' ),
        'separate_items_with_commas' => __( 'Separate tags with commas' ),
        'add_or_remove_items' => __( 'Add or remove tags' ),
        'choose_from_most_used' => __( 'Choose from the most used tags' ),
        'menu_name' => __( 'Tags' ),
    );
    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'job-tags' ),
    );
    register_taxonomy( 'job-tags', array( 'job' ), $args );
}
add_action( 'init', 'lvk_job_cats_taxonomy', 0 );
add_action( 'init', 'lvk_job_types_taxonomy', 0 );
add_action( 'init', 'lvk_job_tags_taxonomy', 0 );

function lvk_hide_jobtypes_tax_metabox() {
	remove_meta_box( 'job-typesdiv', 'job', 'side' );
}
add_action( 'admin_menu', 'lvk_hide_jobtypes_tax_metabox' );

function lvk_jobs_admin_init(){
  add_meta_box("mb_lvk_jobs_details", "Job Details", "lvk_jobs_details", "job", "normal", "high");
}

add_action( 'admin_enqueue_scripts', 'lvk_jobs_add_datepicker' );
function lvk_jobs_add_datepicker(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_style( 'jquery-ui-css', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.css' );
  wp_enqueue_style('jquery-datepicker-style', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/theme.min.css');
//  wp_enqueue_script('jquery-datepicker-language', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/i18n/jquery-ui-i18n.min.js');
}
function lvk_jobs_details(){
  global $post;
?>
<style>
  label.event-data{ width: 150px; margin-right: 10px; display: inline-block; }
  p.event-hint{ padding-left: 160px; }
</style>
<p><label class="event-data" for="lvk_jobs_ref">Job Reference:</label>
  <input type="text" size="20" id="lvk_jobs_ref" name="lvk_jobs_ref" value="<?php echo get_post_meta( get_the_ID(), 'lvk_jobs_ref', true ); ?>" /></p>
<p><label class="event-data" for="lvk_jobs_deadline">Job Deadline:</label>
  <input type="text" size="20" class="datepicker pickdate" id="lvk_jobs_deadline" name="lvk_jobs_deadline" value="<?php echo get_post_meta( get_the_ID(), 'lvk_jobs_deadline', true ); ?>" /></p>
<p><label class="event-data" for="lvk_jobs_wages">Wages:</label>
  <span class="job-pre-input">&pound;</span> <input type="number" size="10" name="lvk_jobs_wages" id="lvk_jobs_wages" value="<?php echo get_post_meta( get_the_ID(), 'lvk_jobs_wages', true ); ?>" step="0.01" /> <span class="job-pre-input">per</span>
  <select name="lvk_jobs_wages_per" id="lvk_jobs_wages_per">
    <option value="0" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), '0' ); ?>>Select</option>
    <option value="h" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), 'h' ); ?>>Hour</option>
    <option value="d" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), 'd' ); ?>>Day</option>
    <option value="w" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), 'w' ); ?>>Week</option>
    <option value="m" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), 'm' ); ?>>Month</option>
    <option value="y" <?php selected( get_post_meta( get_the_ID(), 'lvk_jobs_wages_per', true ), 'y' ); ?>>Year</option>
  </select></p>
<p><label class="event-data" for="lvk_jobs_contract_type">Contract type:</label>
  <?php $tax_name = 'job-types';
    $taxonomy = get_taxonomy($tax_name);
    $type_IDs = wp_get_object_terms( $post->ID, 'job-types', array('fields' => 'ids') );
    wp_dropdown_categories('taxonomy='.$tax_name.'&hide_empty=0&orderby=name&name=lvk_job_types&show_option_none=Select type&selected='.$type_IDs[0]);
  ?></p>
<p><label class="event-data" for="lvk_jobs_hours">Contracted hours (per week):</label>
  <input type="text" id="lvk_jobs_hours" name="lvk_jobs_hours" size="10" value="<?php echo get_post_meta( get_the_ID(), 'lvk_jobs_hours', true ); ?>" /></p>
<script type="text/javascript">
  jQuery(document).ready(function($) {
//    $.datepicker.setDefaults($.datepicker.regional['en_GB']);
    $('.datepicker.pickdate').datepicker({
      dateFormat : 'yy-mm-dd',
    });
  });
</script>
<?php
}

add_action('save_post', 'lvk_jobs_save_details');

function lvk_jobs_save_details(){
  global $post;
  $genref = sanitize_title( dechex( time() ) );
  
  if ( $post->post_type == 'job' ) {
    if ( $_POST['lvk_jobs_ref'] ) { $jobs_args = array( 'ID' => $post->ID, 'post_name' => strtolower( sanitize_title( $_POST['lvk_jobs_ref'] ) ) ); $myref = strtoupper( $_POST['lvk_jobs_ref'] ); }
    else{ $jobs_args = array( 'ID' => $post->ID, 'post_name' => strtolower( $genref ) ); $myref = strtoupper( $genref ); }
	if ( ! wp_is_post_revision( $post->ID ) ){
		remove_action('save_post', 'lvk_jobs_save_details');
		wp_update_post( $jobs_args );
		add_action('save_post', 'lvk_jobs_save_details');
	}
  }

  update_post_meta($post->ID, "lvk_jobs_ref", $myref);
  update_post_meta($post->ID, "lvk_jobs_deadline", $_POST["lvk_jobs_deadline"]);
  update_post_meta($post->ID, "lvk_jobs_wages", $_POST["lvk_jobs_wages"]);
  update_post_meta($post->ID, "lvk_jobs_wages_per", $_POST["lvk_jobs_wages_per"]);
  update_post_meta($post->ID, "lvk_jobs_paypoint", $_POST["lvk_jobs_paypoint"]);
  update_post_meta($post->ID, "lvk_jobs_prorata", $_POST["lvk_jobs_prorata"]);
  update_post_meta($post->ID, "lvk_jobs_fulltime_pay", $_POST["lvk_jobs_fulltime_pay"]);
  update_post_meta($post->ID, "lvk_jobs_hours", $_POST["lvk_jobs_hours"]);
  update_post_meta($post->ID, "lvk_jobs_contract_length", $_POST["lvk_jobs_contract_length"]);
  update_post_meta($post->ID, "lvk_jobs_applyby", $_POST["lvk_jobs_applyby"]);
  update_post_meta($post->ID, "lvk_jobs_applyby_email", $_POST["lvk_jobs_applyby_email"]);
  update_post_meta($post->ID, "lvk_jobs_applyby_phone", $_POST["lvk_jobs_applyby_phone"]);
  update_post_meta($post->ID, "lvk_jobs_applyby_custom", $_POST["lvk_jobs_applyby_custom"]);
  $type_ID = $_POST['lvk_job_types'];
  $type = ( $type_ID > 0 ) ? get_term( $type_ID, 'job-types' )->slug : NULL;
  wp_set_object_terms(  $post->ID , $type, 'job-types' );
  
}
?>