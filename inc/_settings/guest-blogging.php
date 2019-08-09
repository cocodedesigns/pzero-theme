<?php
add_action( 'cmb2_init', 'ccdClient_guestBlog_details' );
function ccdClient_guestBlog_details() {

	$prefix = '_ccdclient_guestblog_details_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'ccdClient_guestBlogger_details',
		'title'        => __( 'Guest Blogger Details', 'ccd-wp' ),
		'object_types' => array( 'post' ),
		'context'      => 'side',
		'priority'     => 'default',
	) );
	$cmb->add_field( array(
		'name' => __( 'Display Name', 'ccd-wp' ),
		'id' => $prefix . 'displayname',
		'type' => 'text',
		'desc' => __( 'This name will be displayed on the blog posts', 'ccd-wp' ),
	) );
	$cmb->add_field( array(
		'name' => __( 'Email Address', 'ccd-wp' ),
		'id' => $prefix . 'email',
		'type' => 'text_email',
		'desc' => __( 'This email address will not be displayed, but will be used to generate a Gravatar, if a photo is not included.', 'ccd-wp' ),
	) );
	$cmb->add_field( array(
		'name' => __( 'Photo', 'ccd-wp' ),
		'id' => $prefix . 'photo',
		'type' => 'file',
		'desc' => __( 'If an image is declared here, it will override the Gravatar generated from the email address', 'ccd-wp' ),
		'preview_size' => 'thumbnail',
		'options' => array(
			'url' => false,
		),
	) );
    $cmb->add_field( array(
		'name' => __( 'Description', 'ccd-wp' ),
		'id' => $prefix . 'description',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Show Profile URLs', 'ccd-wp' ),
		'id' => $prefix . 'show_profile_urls',
		'type' => 'select',
		'options' => array(
			'0' => __( 'Select', 'ccd-wp' ),
			'on' => __( 'Show', 'ccd-wp' ),
			'off' => __( 'Hide', 'ccd-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Website URL', 'ccd-wp' ),
		'id' => $prefix . 'website',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Facebook', 'ccd-wp' ),
		'id' => $prefix . 'sns_facebook',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Twitter', 'ccd-wp' ),
		'id' => $prefix . 'sns_twitter',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Google+', 'ccd-wp' ),
		'id' => $prefix . 'sns_googleplus',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'LinkedIn', 'ccd-wp' ),
		'id' => $prefix . 'sns_linkedin',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'YouTube', 'ccd-wp' ),
		'id' => $prefix . 'sns_youtube',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Instagram', 'ccd-wp' ),
		'id' => $prefix . 'sns_instagram',
		'type' => 'text_url',
		'protocols' => array( 'https', 'http' ),
		'attributes' => array(
			'data-conditional-id' => $prefix . 'show_profile_urls',
			'data-conditional-value' => 'on'
		),
	) );

}