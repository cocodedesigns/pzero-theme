<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_sitefooter' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_sitefooter() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_sitefooter_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_sitefooter',
		'title'        => esc_html__( 'Site Footer', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_sitefooter', // The option key and admin menu page slug.
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
		'name' => __( 'Display Settings', 'ccdclient-wp' ),
		'id' => $prefix . 'display_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Show networks in footer', 'ccdclient-wp' ),
		'id' => $prefix . 'show_sns',
        'type' => 'switch',
        'default'  => 1,
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Show RSS Feed link', 'ccdclient-wp' ),
		'id' => $prefix . 'show_rss',
		'type' => 'switch',
        'default'  => 1,
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Show site login link in footer', 'ccdclient-wp' ),
		'id' => $prefix . 'show_login',
		'type' => 'switch',
        'default'  => 1,
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

    $cmb->add_field( array(
		'name' => __( 'Copyright Settings', 'ccdclient-wp' ),
		'id' => $prefix . 'copyright_title',
		'type' => 'title',
	) );
     
     $cmb->add_field( array(
		'name' => __( 'Copyright Notice', 'ccdclient-wp' ),
		'id' => $prefix . 'copyright',
		'type' => 'text',
		'default' => 'Copyright &copy; ' . get_option('blogname') . ' ' . date('Y') . '. All rights reserved.',
		'desc' => 'Use <code><strong>%y</strong></code> to add the current year. According to your server, the year is currently <code>'. date('Y').'</code>. If this is incorrect, please speak to your System Administrator.',
	) );

	$cmb->add_field( array(
		'name' => __( 'Footer Widgets', 'ccdclient-wp' ),
		'id' => $prefix . 'widgets_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( '"About Us" title', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_about_title',
		'type' => 'text',
		'default' => 'About ' . get_option('blogname'),
	) );

	$cmb->add_field( array(
		'name' => __( '"About Us" text', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_about_text',
		'type' => 'textarea',
		'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac est eros. Curabitur at tortor justo. Duis sit amet libero risus, pretium dictum magna. Pellentesque rhoncus pharetra facilisis. Quisque ac nunc et dolor consequat gravida. Nam nec urna libero, sit amet tempus mi. Phasellus id velit.',
	) );
    
    $cmb->add_field( array(
        'name' => __( 'Footer Widget #1', 'ccdclient-wp' ),
        'id' => $prefix . 'widget_left',
        'type' => 'select',
        'options' => array(
            'posts' => __( 'Recent News Posts (shows two most recent posts)', 'ccdclient-wp' ),
            'comments' => __( 'Recent Comments (shows two most recent comments)', 'ccdclient-wp' ),
            'twitter' => __( 'Recent Tweets (shows two most recent tweets)', 'ccdclient-wp' ),
            'instagram' => __( 'Recent Instagram Posts (shows six most recent photos)', 'ccdclient-wp' ),
        ),
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'Footer Widget #2', 'ccdclient-wp' ),
        'id' => $prefix . 'widget_right',
        'type' => 'select',
        'options' => array(
            'posts' => __( 'Recent News Posts (shows two most recent posts)', 'ccdclient-wp' ),
            'comments' => __( 'Recent Comments (shows two most recent comments)', 'ccdclient-wp' ),
            'twitter' => __( 'Recent Tweets (shows two most recent tweets)', 'ccdclient-wp' ),
            'instagram' => __( 'Recent Instagram Posts (shows six most recent photos)', 'ccdclient-wp' ),
        ),
    ) );
    
}