<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_pageposts_frontpage' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_pageposts_frontpage() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_pageposts_frontpage_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_pageposts_frontpage',
		'title'        => esc_html__( 'Front Page', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_frontpage', // The option key and admin menu page slug.
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
		'name' => __( 'Front Slider', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Show Slider', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_show',
        'type' => 'switch',
        'default' => 1,
		'desc' => __( 'If slides have been saved, enabling this will display the slider on the front page.', 'ccdclient-wp' ),
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Slider Animation', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_animation',
		'type' => 'select',
		'options' => array(
			'horizontal' => __( 'Horizontal (left to right)', 'ccdclient-wp' ),
			'vertical' => __( 'Vertical (top to bottom)', 'ccdclient-wp' ),
			'fade' => __( 'Fade', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Slider Speed', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_speed',
		'type' => 'text_small',
		'default' => '500',
		'desc' => __( 'The speed to animate each slide (in milliseconds)', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Slide Delay', 'ccdclient-wp' ),
		'id' => $prefix . 'slide_delay',
		'type' => 'text_small',
		'default' => '7000',
	) );

	$cmb->add_field( array(
		'name' => __( 'Show Navigation', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_shownav',
		'type' => 'switch',
        'default' => 1,
		'desc' => __( 'If selected, will show slider navigation.', 'ccdclient-wp' ),
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Show Arrows', 'ccdclient-wp' ),
		'id' => $prefix . 'slider_showarrows',
		'type' => 'switch',
        'default' => 1,
		'desc' => __( 'If selected, will show slider next/previous arrows.', 'ccdclient-wp' ),
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Hero Image', 'ccdclient-wp' ),
		'id' => $prefix . 'heroimage_title',
        'type' => 'title',
        'desc' => __( 'If no slides are used, or if the slider is switched off, this image will be displayed on the front page.'),
	) );

	$cmb->add_field( array(
		'name' => __( 'Select Image', 'ccdclient-wp' ),
		'id' => $prefix . 'heroimage',
		'type' => 'file',
		'preview_size' => 'medium',
		'options' => array(
			'url' => false,
		),
	) );
    
}