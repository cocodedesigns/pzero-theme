<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_contactinfo' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_contactinfo() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_contactinfo_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_contactinfo',
		'title'        => esc_html__( 'Contact Information', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_contactinfo', // The option key and admin menu page slug.
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
		'name' => __( 'Contact Information', 'ccdclient-wp' ),
		'id' => $prefix . 'contactinfo_title',
		'type' => 'title',
	) );
	
	$cmb->add_field( array(
		'name' => __( 'Address', 'ccdclient-wp' ),
		'id' => $prefix . 'contactinfo_address',
		'type' => 'address',
		'desc' => __( 'This address will be geocoded on the front page to give a map. If you do not put an address in here', 'no map will be rendered.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Telephone number', 'ccdclient-wp' ),
		'id' => $prefix . 'contactinfo_tel',
		'type' => 'tel_int',
	) );

	$cmb->add_field( array(
		'name' => __( 'Email address', 'ccdclient-wp' ),
		'id' => $prefix . 'contactinfo_email',
		'type' => 'text_email',
		'default' => get_option('admin_email'),
	) );

	$cmb->add_field( array(
		'name' => __( 'Social Media', 'ccdclient-wp' ),
		'id' => $prefix . 'sns_title',
		'type' => 'title',
		'desc' => __( 'These options will appear in multiple sections, not just the title bar of your site.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Facebook URL', 'ccdclient-wp' ),
		'id' => $prefix . 'sns_facebook',
		'type' => 'text_url',
		'desc' => __( 'This should be your full Facebook URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Twitter URL', 'ccdclient-wp' ),
		'id' => $prefix . 'sns_twitter',
		'type' => 'text_url',
		'desc' => __( 'This should be your full Twitter URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
		'protocols' => array( 'http', 'https' ),
	) );
    
    $cmb->add_field( array(
        'name' => __( 'YouTube URL', 'ccdclient-wp' ),
        'id' => $prefix . 'sns_youtube',
        'type' => 'text_url',
        'desc' => __( 'This should be your full YouTube URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
        'protocols' => array( 'http', 'https' ),
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'Google Plus URL', 'ccdclient-wp' ),
        'id' => $prefix . 'sns_googleplus',
        'type' => 'text_url',
        'desc' => __( 'This should be your full Google Plus URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
        'protocols' => array( 'http', 'https' ),
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'LinkedIn URL', 'ccdclient-wp' ),
        'id' => $prefix . 'sns_linkedin',
        'type' => 'text_url',
        'desc' => __( 'This should be your full LinkedIn URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
        'protocols' => array( 'http', 'https' ),
    ) );
    
    $cmb->add_field( array(
        'name' => __( 'Instagram URL', 'ccdclient-wp' ),
        'id' => $prefix . 'sns_instagram',
        'type' => 'text_url',
        'desc' => __( 'This should be your full Instagram URL, including http:// or https://, as the field checks for a valid URL.', 'ccdclient-wp' ),
        'protocols' => array( 'http', 'https' ),
    ) );

	$cmb->add_field( array(
		'name' => __( 'Instagram User ID', 'ccdclient-wp' ),
		'id' => $prefix . 'sns_instagram_id',
		'type' => 'text',
		'desc' => __( 'Your User ID will be used in any widgets. To find your user ID, you can use <a href="https://smashballoon.com/instagram-feed/find-instagram-user-id/" target="_blank">Smash Balloon\'s free service</a>. (opens in a new window)', 'ccdclient-wp' ),
	) );
    
}

function ccdClient_getAddress( $field = 0 ){
	$address_array = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_contactinfo_address' );
	if ( $field ){
		$address = $address_array[$field];
	} else {
		$address = '';
		foreach( $address_array as $address_line ){
			if ( $address_line != "" && $address_line !== "X" ){
				$address .= $address_line . ', ';
			}
		}
		if ( count( $address_array ) > 0 ) { $address = substr($address,0,-2); }
	}
	return $address;
}