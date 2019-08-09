<?php

// Settings
include_once STYLESHEETPATH . '/inc/settings/settings-page_posts-ama.php';
// Metabox
include_once STYLESHEETPATH . '/inc/metaboxes/cpt_ama.php';
// Shortcode
include_once STYLESHEETPATH . '/inc/shortcodes/ama.php';

// Events custom post type

add_action('init', 'ccdClient_amas');

function ccdClient_amas() {

	$labels = array(
		'name' => _x('Ask Me Anything', 'post type general name'),
        'singular_name' => _x('Question', 'post type singular name'),
        'plural_name' => _x('Questions', 'post type plural name'),
		'add_new' => _x('Add New', 'post type item'),
        'add_new_item' => __('Add New Question'),
		'edit_item' => __('Edit Answer'),
		'new_item' => __('New Question'),
		'view_item' => __('View Answer'),
		'search_items' => __('Search Questions'),
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
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array('title', 'editor', 'excerpt','comments'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'ask-me-anything')
	  );

	register_post_type( 'ama' , $args );
	flush_rewrite_rules();
}

function ccdClient_ama_cats_taxonomy(){
    $labels = array(
        'name' => _x( 'Answer Categories', 'Event Categories' ),
        'singular_name' => _x( 'Category', 'Event Categories' ),
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
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'ama-cats' ),
    );
    register_taxonomy( 'ama-cats', array( 'ama' ), $args );
}
function ccdClient_ama_tags_taxonomy(){
    $labels = array(
        'name' => _x( 'Answer Tags', 'Event Tags' ),
        'singular_name' => _x( 'Tag', 'Event Tags' ),
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
        'show_admin_column' => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'ama-tags' ),
    );
    register_taxonomy( 'ama-tags', array( 'ama' ), $args );
}
add_action( 'init', 'ccdClient_ama_cats_taxonomy', 0 );
add_action( 'init', 'ccdClient_ama_tags_taxonomy', 0 );

/**
 * Register the form and fields for our front-end submission form
 */
function ccdClient_ama_register_frontEndForm() {
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_ama_frontEndForm',
		'object_types' => array( 'ama' ),
		'hookup'       => false,
		'save_fields'  => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'New Post Title', 'ccdClient-wp' ),
		'id'      => 'submitted_post_title',
		'type'    => 'text',
		'default' => __( 'Question', 'ccdClient-wp' ),
	) );

	$cmb->add_field( array(
		'default_cb' => 'ccdClient_ama_setDefaultValues',
		'name'       => __( 'Your Name', 'ccdClient-wp' ),
		'desc'       => __( 'Please enter your name for author credit on the new post.', 'ccdClient-wp' ),
		'id'         => 'submitted_author_name',
		'type'       => 'text',
	) );

	$cmb->add_field( array(
		'default_cb' => 'ccdClient_ama_setDefaultValues',
		'name'       => __( 'Your Email', 'ccdClient-wp' ),
		'desc'       => __( 'Please enter your email so we can contact you if we use your post.', 'ccdClient-wp' ),
		'id'         => 'submitted_author_email',
		'type'       => 'text_email',
	) );

}
add_action( 'cmb2_init', 'ccdClient_ama_register_frontEndForm' );

/**
 * Sets the ccdClient_ama_frontEndForm field values if form has already been submitted.
 *
 * @return string
 */
function ccdClient_ama_setDefaultValues( $args, $field ) {
	if ( ! empty( $_POST[ $field->id() ] ) ) {
		return $_POST[ $field->id() ];
	}

	return '';
}

/**
 * Gets the ccdClient_ama_frontEndForm cmb instance
 *
 * @return CMB2 object
 */
function ccdClient_ama_getFrontEndForm() {
	// Use ID of metabox in ccdClient_ama_register_frontEndForm
	$metabox_id = 'ccdClient_ama_frontEndForm';

	// Post/object ID is not applicable since we're using this form for submission
	$object_id  = 'fake-oject-id';

	// Get CMB2 metabox object
	return cmb2_get_metabox( $metabox_id, $object_id );
}

/**
 * Handle the ama_submissions shortcode
 *
 * @param  array  $atts Array of shortcode attributes
 * @return string       Form html
 */
function ccdClient_ama_formShortcode( $atts = array() ) {

	// Get CMB2 metabox object
	$cmb = ccdClient_ama_getFrontEndForm();

	// Get $cmb object_types
	$post_types = $cmb->prop( 'object_types' );

	// Current user
	$user_id = get_current_user_id();

	// Parse attributes
	$atts = shortcode_atts( array(
		'post_author' => $user_id ? $user_id : 1, // Current user, or admin
		'post_status' => 'pending',
		'post_type'   => reset( $post_types ), // Only use first object_type in array
	), $atts, 'ama_submissions' );

	/*
	 * Let's add these attributes as hidden fields to our cmb form
	 * so that they will be passed through to our form submission
	 */
	foreach ( $atts as $key => $value ) {
		$cmb->add_hidden_field( array(
			'field_args'  => array(
				'id'    => "atts[$key]",
				'type'  => 'hidden',
				'default' => $value,
			),
		) );
	}

	// Initiate our output variable
	$output = '';

	// Get any submission errors
	if ( ( $error = $cmb->prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
		// If there was an error with the submission, add it to our ouput.
		$output .= '<h3>' . sprintf( __( 'There was an error in the submission: %s', 'ccdClient-wp' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h3>';
	}

	// If the post was submitted successfully, notify the user.
	if ( isset( $_GET['post_submitted'] ) && ( $post = get_post( absint( $_GET['post_submitted'] ) ) ) ) {

		// Get submitter's name
		$name = get_post_meta( $post->ID, 'submitted_author_name', 1 );
		$name = $name ? ' '. $name : '';

		// Add notice of submission to our output
		$output .= '<h3>' . sprintf( __( 'Thank you%s, your new post has been submitted and is pending review by a site administrator.', 'ccdClient-wp' ), esc_html( $name ) ) . '</h3>';
	}

	// Get our form
	$output .= cmb2_get_metabox_form( $cmb, 'fake-oject-id', array( 'save_button' => __( 'Submit Post', 'ccdClient-wp' ) ) );

	return $output;
}
add_shortcode( 'ama_submissions', 'ccdClient_ama_formShortcode' );

/**
 * Handles form submission on save. Redirects if save is successful, otherwise sets an error message as a cmb property
 *
 * @return void
 */
function ccdClient_ama_handleSubmissions() {

	// If no form submission, bail
	if ( empty( $_POST ) || ! isset( $_POST['submit-cmb'], $_POST['object_id'] ) ) {
		return false;
	}

	// Get CMB2 metabox object
	$cmb = ccdClient_ama_getFrontEndForm();

	$post_data = array();

	// Get our shortcode attributes and set them as our initial post_data args
	if ( isset( $_POST['atts'] ) ) {
		foreach ( (array) $_POST['atts'] as $key => $value ) {
			$post_data[ $key ] = sanitize_text_field( $value );
		}
		unset( $_POST['atts'] );
	}

	// Check security nonce
	if ( ! isset( $_POST[ $cmb->nonce() ] ) || ! wp_verify_nonce( $_POST[ $cmb->nonce() ], $cmb->nonce() ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'security_fail', __( 'Security check failed.' ) ) );
	}

	// Check title submitted
	if ( empty( $_POST['submitted_post_title'] ) ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'New post requires a title.' ) ) );
	}

	// And that the title is not the default title
	if ( $cmb->get_field( 'submitted_post_title' )->default() == $_POST['submitted_post_title'] ) {
		return $cmb->prop( 'submission_error', new WP_Error( 'post_data_missing', __( 'Please enter a new title.' ) ) );
	}

	/**
	 * Fetch sanitized values
	 */
	$sanitized_values = $cmb->get_sanitized_values( $_POST );

	// Set our post data arguments
	$post_data['post_title']   = $sanitized_values['submitted_post_title'];
	unset( $sanitized_values['submitted_post_title'] );
	$post_data['post_content'] = $sanitized_values['submitted_post_content'];
    unset( $sanitized_values['submitted_post_content'] );
    $post_data['meta_input']['_ccdclient_ama_name'] = $sanitized_values['submitted_author_name'];
    unset( $sanitized_values['submitted_author_name'] );
    $post_data['meta_input']['_ccdclient_ama_email'] = $sanitized_values['submitted_author_email'];
	unset( $sanitized_values['submitted_author_email'] );

	// Create the new post
	$new_submission_id = wp_insert_post( $post_data, true );

	// If we hit a snag, update the user
	if ( is_wp_error( $new_submission_id ) ) {
		return $cmb->prop( 'submission_error', $new_submission_id );
	}

	$cmb->save_fields( $new_submission_id, 'post', $sanitized_values );

	/**
	 * Other than post_type and post_status, we want
	 * our uploaded attachment post to have the same post-data
	 */
	unset( $post_data['post_type'] );
	unset( $post_data['post_status'] );
	
	$ama_email = get_option('admin_email');
	$ama_subject = 'Someone asked something';
	$ama_message = '<p>' . $post_data['meta_input']['_ccdclient_ama_name'] . ' has asked you a question!  They want to know <br />';
	$ama_message .= '&quot;<strong>' . $post_data['post_title'] . '</strong>&quot;</p>';
	$ama_message .= '<p><a href="' . get_edit_post_link( $new_submission_id ) . '">Answer the question</a></p>';

	add_filter( 'wp_mail_content_type', 'set_html_content_type' );
	wp_mail( $ama_email, $ama_subject, $ama_message );
	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

	/*
	 * Redirect back to the form page with a query variable with the new post ID.
	 * This will help double-submissions with browser refreshes
	 */
	wp_redirect( get_post_type_archive_link( 'ama' ) . '?submitted' );
	exit;
}
add_action( 'cmb2_after_init', 'ccdClient_ama_handleSubmissions' );

function set_html_content_type() { return 'text/html'; }

add_filter( 'dashboard_glance_items', 'ccdClient_amaPublished_atAGlance' );
add_filter( 'dashboard_glance_items', 'ccdClient_amaWaiting_atAGlance' );

function ccdClient_amaPublished_atAGlance( $items = array() ) {
 
    $post_types = array( 'ama' );
     
    foreach( $post_types as $type ) {
 
        if( ! post_type_exists( $type ) ) continue;
 
        $num_posts = wp_count_posts( $type );
         
        if( $num_posts ) {
       
            $published = intval( $num_posts->publish );
            $post_type = get_post_type_object( $type );
             
            $text = _n( '%s ' . $post_type->labels->singular_name . ' Answered', '%s ' . $post_type->labels->plural_name . ' Answered', $published, 'ccdCient-wp' );
            $text = sprintf( $text, number_format_i18n( $published ) );
             
            if ( current_user_can( $post_type->cap->edit_posts ) ) {
				$output = sprintf( '<a href="edit.php?post_type=%1$s">%2$s</a>', $type, $text ) . "\n";
            } else {
                $output = sprintf( '<span>%2$s</span> ', $type, $text ) . "\n";
			}
			echo '<li class="post-count ' . $post_type->name . '-published-count">' . $output . '</li>';
        }
    }
     
    return $items;
}

function ccdClient_amaWaiting_atAGlance( $items = array() ) {
 
    $post_types = array( 'ama' );
     
    foreach( $post_types as $type ) {
 
        if( ! post_type_exists( $type ) ) continue;
 
        $num_posts = wp_count_posts( $type );
         
        if( $num_posts ) {
       
            $published = intval( $num_posts->pending );
            $post_type = get_post_type_object( $type );
             
            $text = _n( '%s ' . $post_type->labels->singular_name . ' Waiting', '%s ' . $post_type->labels->plural_name . ' Waiting', $published, 'ccdCient-wp' );
            $text = sprintf( $text, number_format_i18n( $published ) );
             
            if ( current_user_can( $post_type->cap->edit_posts ) ) {
                $output = sprintf( '<a href="edit.php?post_type=%1$s&post_status=pending">%2$s</a>', $type, $text ) . "\n";
            } else {
                $output = sprintf( '<span>%2$s</span> ', $type, $text ) . "\n";
            }
			echo '<li class="post-count ' . $post_type->name . '-pending-count">' . $output . '</li>';
        }
    }
     
    return $items;
}