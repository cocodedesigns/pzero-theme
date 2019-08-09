<?php

add_action( 'cmb2_admin_init', 'ccdClient_userProfile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function ccdClient_userProfile_metabox() {
	$prefix = '_ccdClient_userProfile_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'User Profile Metabox', 'ccdClient-wp' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
	$cmb_user->add_field( array(
		'name'     => __( 'User Avatar', 'ccdClient-wp' ),
		'id'       => $prefix . 'avatar_title',
		'type'     => 'title',
		'on_front' => false,
	) );
	$cmb_user->add_field( array(
		'name'    => __( 'Avatar', 'ccdClient-wp' ),
		'desc'    => __( 'field description (optional)', 'ccdClient-wp' ),
		'id'      => $prefix . 'avatar',
        'type'    => 'file',
        'desc'    => __('This file should be square, ideally 512px x 512px)', 'ccdClient-wp'),
        'preview_size' => 'thumbnail',
        'options' => array(
            'url' => false,
        ),
	) );
	$cmb_user->add_field( array(
		'name'     => __( 'Social Networks', 'ccdClient-wp' ),
		'id'       => $prefix . 'sns_title',
		'type'     => 'title',
		'on_front' => false,
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Facebook URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'facebookurl',
        'type' => 'text_url',
		'desc' => __( 'This should be your full Facebook URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Twitter URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'twitterurl',
		'type' => 'text_url',
		'desc' => __( 'This should be your full Twitter URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Google+ URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'googleplusurl',
		'type' => 'text_url',
		'desc' => __( 'This should be your full Google+ URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Linkedin URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'linkedinurl',
		'type' => 'text_url',
		'desc' => __( 'This should be your full LinkedIn URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name' => __( 'YouTube URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'youtubeurl',
		'type' => 'text_url',
		'desc' => __( 'This should be your full YouTube URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Instagram URL', 'ccdClient-wp' ),
		'id'   => $prefix . 'instagramurl',
		'type' => 'text_url',
		'desc' => __( 'This should be your full Instagram URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
	$cmb_user->add_field( array(
		'name'     => __( 'Biography', 'ccdClient-wp' ),
		'id'       => $prefix . 'bio_title',
		'type'     => 'title',
		'on_front' => false,
	) );
	$cmb_user->add_field( array(
		'name' => __( 'Biography', 'ccdClient-wp' ),
		'id'   => $prefix . 'biocontent',
		'type' => 'wysiwyg',
        'options' => array(
            'wpautop' => true,
            'editor_height' => '300px',
            'drag_drop_upload' => false,
            'media_buttons' => false,
            'tinymce' => true,
        ),
	) );
}

function ccdClient_userProfile_changeGravatar($url, $id_or_email, $args) {
    $custom_avatar = get_user_meta($id_or_email, '_ccdClient_userProfile_avatar', true);
    if ($custom_avatar) 
        $url = $custom_avatar;
    
    return $url;
}
add_filter('get_avatar_url', 'ccdClient_userProfile_changeGravatar', 10, 3);

function ccdClient_userProfile_changeFields( $user ){
    // Unset fields you don’t need
    unset( $user['twitter'] );
    unset( $user['facebook'] );
    unset( $user['description'] );
    unset( $user['googleplus'] );

    return $user;
}
add_filter('user_contactmethods', 'ccdClient_userProfile_changeFields');

//remove the bio
function remove_plain_bio($buffer) {
    $titles = array('#<h2>'._x('About Yourself','gravatar').'</h2>#','#<h2>'._x('About the user','gravatar').'</h2>#');
    $buffer=preg_replace($titles,'<h2>'._x('Account Management','gravatar').'</h2>',$buffer,1);
    $biotable='#<h2>'._x('Account Management','gravatar').'</h2>.+?<table.+?/tr>#s';
    $buffer=preg_replace($biotable,'<h2>'._x('Gravatar','gravatar').'</h2> <table class="form-table">',$buffer,1);
    return $buffer;
}
function profile_admin_buffer_start() { ob_start("remove_plain_bio"); }
function profile_admin_buffer_end() { ob_end_flush(); }
add_action('admin_head', 'profile_admin_buffer_start');
add_action('admin_footer', 'profile_admin_buffer_end');