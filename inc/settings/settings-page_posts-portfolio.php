<?php
/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'ccdClient_themeSettings_page_cpts_portfolio' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function ccdClient_themeSettings_page_cpts_portfolio() {
	/**
	 * Registers options page menu item and form.
     */

  $prefix = '_ccdclient_themesettings_cpts_portfolio_';

	$cmb = new_cmb2_box( array(
		'id'           => 'ccdClient_themeSettings_page_cpts_portfolio',
		'title'        => esc_html__( 'Portfolio', 'ccdclient-wp' ),
		'object_types' => array( 'options-page' ),
		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */
		'option_key'      => 'ccdtheme_settings_cpts_portfolio', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Main Settings', 'ccdclient-wp' ), // Falls back to 'title' (above).
		'parent_slug'     => 'admin.php?page=ccdtheme_settings', // Make options page a submenu item of the themes menu.
		'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 100, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		'save_button'     => esc_html__( 'Save Settings', 'ccdclient-wp' ), // The text for the options-page save button. Defaults to 'Save'.
	) );
	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
		*/
		
		$v = get_option( 'ccdtheme_settings_cpts_portfolio', false );

  	$cmb->add_field( array(
  		'name' => __( 'Archive Settings', 'ccdclient-wp' ),
  		'id' => $prefix . 'archive',
  		'type' => 'title',
  	) );

    $cmb->add_field( array(
  		'name' => __( 'Archive Title', 'ccdclient-wp' ),
  		'id' => $prefix . 'archivetitle',
  		'type' => 'text',
  		'default' => 'Our Work',
  	) );

  	$cmb->add_field( array(
  		'name' => __( '&quot;No Projects&quot; Content', 'ccdclient-wp' ),
  		'id' => $prefix . 'noposts',
  		'type' => 'title',
  		'desc' => __( 'If there are no posts available, this content will be used instead.', 'ccdclient-wp' ),
  	) );

  	$cmb->add_field( array(
  		'name' => __( '&quot;No Projects&quot; Title', 'ccdclient-wp' ),
  		'id' => $prefix . 'noposts_title',
  		'type' => 'text',
  	) );

  	$cmb->add_field( array(
  		'name' => __( '&quot;No Projects&quot; Text', 'ccdclient-wp' ),
  		'id' => $prefix . 'noposts_content',
  		'type' => 'wysiwyg',
  		'options' => array(
  			'wpautop' => true,
  			'editor_height' => '300px',
  			'drag_drop_upload' => false,
  			'media_buttons' => false,
  			'tinymce' => true,
  		),
  	) );

  	$cmb->add_field( array(
  		'name' => __( 'Single Project Content', 'ccdclient-wp' ),
  		'id' => $prefix . 'singleposts',
  		'type' => 'title',
  	) );

  	$cmb->add_field( array(
  		'name' => __( '&quot;View Project&quot; Link Label', 'ccdclient-wp' ),
  		'id' => $prefix . 'singlepost_viewlink_label',
  		'type' => 'text',
      'default' => 'View Project',
  	) );

  	$cmb->add_field( array(
  		'name' => __( '&quot;Hire Us&quot; Call To Action', 'ccdclient-wp' ),
  		'id' => $prefix . 'ctasettings',
  		'type' => 'title',
      'desc' => __( 'This Call To Action widget will appear on both the archive page and the single page.', 'ccdclient-wp'),
  	) );

  	$cmb->add_field( array(
  		'name' => __( 'Main Title', 'ccdclient-wp' ),
  		'id' => $prefix . 'cta_h1',
  		'type' => 'text',
      'default' => 'Want to hire us?',
  	) );

  	$cmb->add_field( array(
  		'name' => __( 'Secondary Title', 'ccdclient-wp' ),
  		'id' => $prefix . 'cta_h2',
  		'type' => 'text',
      'default' => 'Click the button to find out more.',
  	) );

  	$cmb->add_field( array(
  		'name' => __( 'Button Link', 'ccdclient-wp' ),
  		'id' => $prefix . 'cta_url',
  		'type' => 'link_picker',
  		'desc' => __( 'This page should contain details for how to hire Cocode Designs.', 'ccdclient-wp' ),
  	) );
  
    $cmb->add_field( array(
      'name' => __( 'Background style', 'ccdclient-wp' ),
      'id' => $prefix . 'cta_bg_style',
      'type' => 'select',
      'options' => array(
        'i' => __( 'Use background image', 'ccdclient-wp' ),
        'c' => __( 'Use solid colour', 'ccdclient-wp' ),
      ),
	) );
		
		if ( $v['_ccdclient_themesettings_cpts_portfolio_cta_bg_style'] == "i" ){

			$cmb->add_field( array(
				'name' => __( 'Background Image', 'ccdclient-wp' ),
				'id' => $prefix . 'cta_bg_image',
				'type' => 'file',
				'preview_size' => 'medium',
				'options' => array(
					'url' => false,
				),
			) );
  
			$cmb->add_field( array(
				'name'    => __( 'Background Colour', 'ccdclient-wp' ),
				'id' => $prefix . 'cta_clr_overlay',
				'type'    => 'colorpicker',
				'default' => 'rgba(0,0,0,.4)',
				'options' => array(
					'alpha' => true, // Make this a regular rgb color picker.
				),
			) );
		
		} else {
  
			$cmb->add_field( array(
				'name'    => __( 'Background Colour', 'ccdclient-wp' ),
				'id' => $prefix . 'cta_clr_bg',
				'type'    => 'colorpicker',
				'default' => '#000000',
				'options' => array(
					'alpha' => false, // Make this a regular rgb color picker.
				),
			) );

		}
  
    $cmb->add_field( array(
      'name'    => __( 'Text Colour', 'ccdclient-wp' ),
      'id' => $prefix . 'cta_clr_text',
      'type'    => 'colorpicker',
      'default' => '#FFFFFF',
      'options' => array(
        'alpha' => false, // Make this a regular rgb color picker.
      ),
    ) );
  
    $cmb->add_field( array(
      'name' => __( 'Layout Style', 'ccdclient-wp' ),
      'id' => $prefix . 'cta_style',
      'type' => 'select',
      'options' => array(
        'wide' => __( 'Wide (more discreet)', 'ccdclient-wp' ),
        'tall' => __( 'Tall (more prominant)', 'ccdclient-wp' ),
      ),
    ) );

		$cmb->add_field( array(
			'name' => __( 'Infinite Scroll', 'ccdclient-wp' ),
			'id' => $prefix . 'infinite_title',
			'type' => 'title',
			'desc' => __( 'These settings will toggle infinite scroll functionality in the theme on the portfolio archive page.', 'ccdclient-wp' ),
		) );
	
		$cmb->add_field( array(
			'name' => __( 'Enable Infinite Scroll', 'ccdclient-wp' ),
			'id' => $prefix . 'infinite_scroll',
			'type' => 'switch',
			'default' => 0,
			'label' => array(
				'on' => __( 'Enable', 'ccdclient-wp' ),
				'off' => __( 'Disable', 'ccdclient-wp' ),
			),
		) );

}
