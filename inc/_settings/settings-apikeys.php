<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_apikeys' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_apikeys() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_apikeys_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_apikeys',
		'title'        => esc_html__( 'API Keys', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_apikeys', // The option key and admin menu page slug.
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
		'name' => __( 'Google Analytics', 'ccdclient-wp' ),
		'id' => $prefix . 'ga_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable Google Analytics on your site', 'ccdclient-wp' ),
		'id' => $prefix . 'ga_enable',
		'type' => 'switch',
		'default' => 1,
		'desc' => __( 'If you have another plugin which controls Google Analytics, or if this theme is causing issues with Google Analytics, disable this setting.', 'ccdclient-wp' ),
		'label' => array(
			'on' => __( 'Enable', 'ccdclient-wp' ),
			'off' => __( 'Disable', 'ccdclient-wp' ),
		),
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Property ID', 'ccdclient-wp' ),
		'id' => $prefix . 'ga_propertyid',
		'type' => 'text',
		'default' => 'UA-XXXXX-X',
		'desc' => 'Your Google Analytics ID should look something like <code><strong>UA-XXXXX-X</strong></code>.',
	) );

    $cmb->add_field( array(
		'name' => __( 'Google API keys', 'ccdclient-wp' ),
		'id' => $prefix . 'gconsole_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Google Client ID', 'ccdclient-wp' ),
		'id' => $prefix . 'gconsole_clientid',
		'type' => 'text',
		'default' => 'xxx.apps.googleusercontent.com',
	) );

	$cmb->add_field( array(
		'name' => __( 'Google Client Email', 'ccdclient-wp' ),
		'id' => $prefix . 'gconsole_email',
		'type' => 'text',
		'default' => 'xxx@developer.gserviceaccount.com',
	) );

	$cmb->add_field( array(
		'name' => __( 'Google Client Secret', 'ccdclient-wp' ),
		'id' => $prefix . 'gconsole_clientsecret',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Google API Key', 'ccdclient-wp' ),
		'id' => $prefix . 'gconsole_apikey',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Facebook API', 'ccdclient-wp' ),
		'id' => $prefix . 'facebook_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Facebook App ID', 'ccdclient-wp' ),
		'id' => $prefix . 'facebook_appid',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Facebook API Key', 'ccdclient-wp' ),
		'id' => $prefix . 'facebook_apikey',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Twitter API', 'ccdclient-wp' ),
		'id' => $prefix . 'twitter_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Customer Key', 'ccdclient-wp' ),
		'id' => $prefix . 'twitter_custkey',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Customer Secret', 'ccdclient-wp' ),
		'id' => $prefix . 'twitter_custsecret',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Access Token', 'ccdclient-wp' ),
		'id' => $prefix . 'twitter_acctoken',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Access Token Secret', 'ccdclient-wp' ),
		'id' => $prefix . 'twitter_accsecret',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Instagram API', 'ccdclient-wp' ),
		'id' => $prefix . 'instagram_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Access Token', 'ccdclient-wp' ),
		'id' => $prefix . 'instagram_accesstoken',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Client ID', 'ccdclient-wp' ),
		'id' => $prefix . 'instagram_clientid',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Client Secret', 'ccdclient-wp' ),
		'id' => $prefix . 'instagram_clientsecret',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'MapQuest API', 'ccdclient-wp' ),
		'id' => $prefix . 'mapquest_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Consumer Key', 'ccdclient-wp' ),
		'id' => $prefix . 'mapquest_consumerkey',
		'type' => 'text',
		'default' => 'lx7nc1hmc7fskzdglzjodc66j8y6rp5y',
	) );

	$cmb->add_field( array(
		'name' => __( 'Consumer Secret', 'ccdclient-wp' ),
		'id' => $prefix . 'mapquest_secret',
		'type' => 'text',
		'default' => 'nvnh9p569arzz5vg',
	) );
    
}