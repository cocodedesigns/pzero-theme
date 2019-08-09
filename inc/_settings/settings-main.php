<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_main' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_main() {
	/**
	 * Registers options page menu item and form.
     */
     
    $prefix = '_ccdclient_themesettings_main_';
	$cmb = new_cmb2_box( array(
		'id'           => 'ccdclient_themesettings_page_main',
		'title'        => esc_html__( 'Main Settings', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_main', // The option key and admin menu page slug.
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
		'name' => __( 'Responsive Settings', 'ccdclient-wp' ),
		'id' => $prefix . 'responsive_title',
		'type' => 'title',
		'desc' => __( 'These settings control whether responsive settings are applied to your document.  If they are not applied, then the site will be designed to work on your computer only.')
	) );

    $cmb->add_field( array(
		'name' => __( 'Responsive Template', 'ccdclient-wp' ),
		'id' => $prefix . 'responsive',
		'type' => 'switch',
		'desc' => __( 'If this is disabled, only the desktop theme will be activated.', 'ccdclient-wp' ),
        'default'  => 1,
		'label' => array(
			'on' => __( 'Enable', 'ccdclient-wp' ),
			'off' => __( 'Disable', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Desktop Width', 'ccdclient-wp' ),
		'id' => $prefix . 'desktop_width',
		'type' => 'text_small',
		'default' => '1024',
		'desc' => __( 'The minimum width (in pixels) before the template switches to Desktop mode. Once the browser window drops below this width.', 'Tablet mode is activated.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Tablet Width', 'ccdclient-wp' ),
		'id' => $prefix . 'tablet_width',
		'type' => 'text_small',
		'default' => '800',
		'desc' => __( 'The minimum width (in pixels) before the template switches to Tablet mode. Once the browser window drops below this width.', 'Mobile mode is activated.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'SEO Settings', 'ccdClient-wp' ),
		'id' => $prefix . 'seo_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable SEO?', 'ccdClient-wp' ),
		'id' => $prefix . 'gs_enable',
		'type' => 'switch',
		'desc' => __( 'If enabled, search engine optimisation functions will be applied to the site.', 'ccdClient-wp' ),
		'default' => 1,
		'labels' => array(
			'on' => __( 'Enable', 'ccdClient-wp' ),
			'off' => __( 'Disable', 'ccdClient-wp' ),
		),
	) );
}