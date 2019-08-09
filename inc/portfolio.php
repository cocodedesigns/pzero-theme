<?php
add_action('init', 'ccd_portfolio');
 
function ccd_portfolio() {
 
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'ccd_portfolio item'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
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
		'menu_icon' => 'dashicons-media-document',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 35,
		'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'work')
	  ); 
 
	register_post_type( 'portfolio' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "ccdport_admin_init");
 
function ccdport_admin_init(){
  add_meta_box("mb_ccdport_details", "Project Details", "ccdport_details", "portfolio", "normal", "high");
  add_meta_box("mb_ccdport_client", "Client", "ccdport_client", "portfolio", "side", "high");
  add_meta_box("mb_ccdport_status", "Project status", "ccdport_status", "portfolio", "side", "high");
}

add_filter( 'rwmb_meta_boxes', 'wys_gallery_images' );
function wys_gallery_images( $meta_boxes ) {
    $prefix = 'wys_gallery_photos_';
    $meta_boxes[] = array(
        'id'         => 'wys_gallery_photos',
        'title'      => __( 'Project Images', 'wys-wp' ),
        'post_types' => array('portfolio'),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'id'   => "{$prefix}photos",
                'name' => __( 'Images', 'wys-wp' ),
                'type' => 'image_advanced',
            ),
        ),
    );
    return $meta_boxes;
}

add_action( 'admin_enqueue_scripts', 'ccdport_add_datepicker' );
function ccdport_add_datepicker(){
  wp_enqueue_script( 'jquery-ui-datepicker' );
  wp_enqueue_style('jquery-datepicker-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
function ccdport_details(){
  global $post;
?>
  <p><label>Preview URL: <strong>http://</strong>
    <input type="text" size="35" name="preview_url" value="<?php echo get_post_meta(get_the_ID(), 'preview_url', true); ?>" /></p>
<?php
}

function ccdport_status(){
  global $post;
  $custom = get_post_custom($post->ID);
  $project_status = $custom['project_status'][0];
?>
  <select name="project_status">
    <option <?php selected( 'Published', $project_status ); ?>>Published</option>
    <option <?php selected( 'In Development', $project_status ); ?>>In Development</option>
    <option <?php selected( 'Now offline', $project_status ); ?>>Now offline</option>
    <option <?php selected( 'Decommissioned', $project_status ); ?>>Decommissioned</option>
    <option <?php selected( 'Archived version', $project_status ); ?>>Archived version</option>
  </select>
  <p><label>Publish date:</label>
    <input id="publishDate" type="text" size="15" class="DatePicker" name="publish_date" value="<?php echo get_post_meta(get_the_ID(), 'publish_date', true); ?>" /></p>
  <script>
    jQuery(document).ready(function() {
      jQuery('input.DatePicker').datepicker({
        dateFormat : 'dd-mm-yy'
      });
    });
  </script>
<?php
}

function ccdport_client(){
  global $post;
  $custom = get_post_custom($post->ID);
  $client = $custom['project_client'][0];
  $name = $custom['client_name'][0];
  $args = array(
    'post_type' => 'clients',
    'posts_per_page' => -1,
    'orderby' => 'name',
    'order' => 'ASC'
  );
?>
  <p><label>Client name</label></p>
  <input type="text" name="client_name" value="<?php echo $name; ?>" />
  <p><label>Organisation</label>
  <input type="text" name="project_client" value="<?php echo $client; ?>" /></p>
<?php
}

add_action('save_post', 'ccdport_save_details');

function ccdport_save_details(){
  global $post;
 
  update_post_meta($post->ID, "preview_url", $_POST["preview_url"]);
  update_post_meta($post->ID, "publish_date", $_POST["publish_date"]);
  update_post_meta($post->ID, "client_name", $_POST["client_name"]);
  update_post_meta($post->ID, "project_client", $_POST["project_client"]);
  update_post_meta($post->ID, "project_status", $_POST["project_status"]);
}
?>