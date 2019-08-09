<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_pageposts_blogposts' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_pageposts_blogposts() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_pageposts_blogposts_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_pageposts_blogposts',
		'title'        => esc_html__( 'Blog Posts', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_blogposts', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Main Settings', 'ccdclient-wp' ), // Falls back to 'title' (above).
		'parent_slug'     => 'admin.php?page=ccdtheme_settings', // Make options page a submenu item of the themes menu.
		'capability'      => 'manage_options', // Cap required to view options-page.
		'position'        => 100, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		'save_button'     => esc_html__( 'Save Settings', 'ccdclient-wp' ), // The text for the options-page save button. Defaults to 'Save'.
	) );
	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
    */
    
    $cmb->add_field( array(
		'name' => __( 'Blog Archive', 'ccdclient-wp' ),
		'id' => $prefix . 'archive_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Archive Title', 'ccdclient-wp' ),
		'id' => $prefix . 'archive_pagetitle',
		'type' => 'text',
		'default' => 'Latest News',
	) );

	$cmb->add_field( array(
		'name' => __( 'Header Image', 'ccdclient-wp' ),
		'id' => $prefix . 'archive_heroimage',
		'type' => 'file',
		'preview_size' => 'medium',
		'options' => array(
			'url' => false,
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Guest Posts', 'ccdclient-wp' ),
		'id' => $prefix . 'guestposts_title',
		'type' => 'title',
		'desc' => __( 'Guest Posting will enable guest users to submit blog posts', 'which can be added to your latest news feed.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable Guest Posts', 'ccdclient-wp' ),
		'id' => $prefix . 'guestposts_enable',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
			'on' => __( 'Enable', 'ccdclient-wp' ),
			'off' => __( 'Disable', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Submit Posts page', 'ccdclient-wp' ),
		'id' => $prefix . 'guestposts_page',
		'type' => 'link_picker',
		'desc' => __( 'This page should contain details for how to submit a post.', 'ccdclient-wp' ),
	) );
    
}