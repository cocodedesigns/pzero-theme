<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_patreon' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_patreon() {
	/**
	 * Registers options page menu item and form.
     */

  $prefix = '_ccdclient_themesettings_patreon_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_patreon',
		'title'        => esc_html__( 'Patreon', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_patreon', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Main Settings', 'ccdclient-wp' ), // Falls back to 'title' (above).
		'parent_slug'     => 'admin.php?page=ccdtheme_settings', // Make options page a submenu item of the themes menu.
		'capability'      => 'manage_options', // Cap required to view options-page.
		'position'        => 100, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		'save_button'     => esc_html__( 'Save Settings', 'ccdclient-wp' ), // The text for the options-page save button. Defaults to 'Save'.
	) );
  

  $sds = get_option( 'ccdtheme_settings_patreon', false );
  
	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
     */

  $cmb->add_field( array(
		'name' => __( 'Activate Patreon', 'ccdclient-wp' ),
		'id' => $prefix . 'display_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable Patreon', 'ccdclient-wp' ),
		'id' => $prefix . 'activate',
    'type' => 'switch',
    'default'  => 0,
		'label' => array(
			'on' => __( 'Enable', 'ccdclient-wp' ),
			'off' => __( 'Disable', 'ccdclient-wp' ),
		),
	) );
  
  if ( $sds['_ccdclient_themesettings_patreon_activate'] == '1' ){
    
    $cmb->add_field( array(
      'name' => __( 'Donation Page', 'ccdclient-wp' ),
      'id' => $prefix . 'page_title',
      'type' => 'title',
    ) );
    
    $cmb->add_field( array(
      'name' => __( 'Select Page', 'ccdclient-wp' ),
      'id' => $prefix . 'page_link',
      'type' => 'link_picker',
      'split_values' => true,
      'desc' => 'Select the main page for the Donation section.'
    ) );
    
    $cmb->add_field( array(
      'name' => __( 'Status', 'ccdclient-wp' ),
      'id' => $prefix . 'page_status',
      'type' => 'select',
      'options' => array(
        '0' => __( 'Off', 'ccdclient-wp' ),
        'live' => __( 'Live (public can see)', 'ccdclient-wp' ),
        'test' => __( 'Testing (only site administrators can see)', 'ccdclient-wp' ),
      ),
    ) );
    
  }

}
