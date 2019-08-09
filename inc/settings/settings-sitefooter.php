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
  

  $sfs = get_option( 'ccdtheme_settings_sitefooter', false );
  
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
      'name' => __( 'Number of Sidebars', 'ccdclient-wp' ),
      'id' => $prefix . 'footer_countbars',
      'type' => 'select',
      'default' => '4',
      'options' => array(
          '2' => __( 'Two', 'ccdclient-wp' ),
          '3' => __( 'Three', 'ccdclient-wp' ),
          '4' => __( 'Four', 'ccdclient-wp' ),
      ),
  ) );

  $cmb->add_field( array(
		'name' => __( '&quot;About Us&quot; Widget', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_aboutus_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( '&quot;About Us&quot; title', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_about_title',
		'type' => 'text',
		'default' => 'About ' . get_option('blogname'),
	) );

	$cmb->add_field( array(
		'name' => __( '&quot;About Us&quot; Logo', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_about_logo',
		'type' => 'file',
		'preview_size' => 'medium',
		'options' => array(
			'url' => false,
		),
	) );

	$cmb->add_field( array(
		'name' => __( '&quot;About Us&quot; text', 'ccdclient-wp' ),
		'id' => $prefix . 'widget_about_text',
    'type' => 'wysiwyg',
    'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac est eros. Curabitur at tortor justo. Duis sit amet libero risus, pretium dictum magna. Pellentesque rhoncus pharetra facilisis. Quisque ac nunc et dolor consequat gravida. Nam nec urna libero, sit amet tempus mi. Phasellus id velit.</p>',
    'options' => array(
      'wpautop' => true,
      'editor_height' => '120px',
      'drag_drop_upload' => false,
      'media_buttons' => false,
      'tinymce' => true,
      'teeny' => true,
    ),
	) );

  $cmb->add_field( array(
		'name' => __( 'Secondary Footer (Copyright Section)', 'ccdclient-wp' ),
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
		'name' => __( 'Privacy Notice Settings', 'ccdclient-wp' ),
		'id' => $prefix . 'privacy_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Show privacy link in footer', 'ccdclient-wp' ),
		'id' => $prefix . 'show_privacy_link',
		'type' => 'switch',
    'default'  => 0,
    'desc' => 'If this is enabled, a text link will appear in the footer which will default to &quot;<code>View our Privacy Policy</code>&quot;.  You can change the default text below.',
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

  $cmb->add_field( array(
    'name' => __( 'Privacy Policy page', 'ccdclient-wp' ),
    'id' => $prefix . 'privacy_policypage',
    'type' => 'link_picker',
    'desc' => 'If the link text is left blank, the text will default to &quot;<code>View our Privacy Policy</code>&quot;.  If the link URL is left blank, the link will not be displayed.'
  ) );

  $cmb->add_field( array(
    'name' => __( 'Mailchimp Signup Form', 'ccdclient-wp' ),
    'id' => $prefix . 'mailchimp_title',
    'type' => 'title',
  ) );

  $cmb->add_field( array(
    'name' => __( 'Form title', 'ccdclient-wp' ),
    'id' => $prefix . 'mailchimp_formtitle',
    'type' => 'text',
    'default' => 'Sign up to our newsletter',
  ) );

  $cmb->add_field( array(
    'name' => __( 'Form text', 'ccdclient-wp' ),
    'id' => $prefix . 'mailchimp_formtext',
    'type' => 'wysiwyg',
    'default' => '<p>Enter your email address to subscribe to our free newsletter.  We promise not to SPAM your email address.</p>',
    'options' => array(
      'wpautop' => true,
      'editor_height' => '120px',
      'drag_drop_upload' => false,
      'media_buttons' => false,
      'tinymce' => true,
      'teeny' => true,
    ),
  ) );

	$cmb->add_field( array(
		'name' => __( 'Show First and Last name fields', 'ccdclient-wp' ),
		'id' => $prefix . 'mailchimp_show_name',
		'type' => 'switch',
    'default'  => 0,
		'label' => array(
			'on' => __( 'Show', 'ccdclient-wp' ),
			'off' => __( 'Hide', 'ccdclient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Placeholder Text (Email Address)', 'ccdclient-wp' ),
		'id' => $prefix . 'mailchimp_placeholder_email',
		'type' => 'text',
		'default' => 'Email Address',
    'desc' => '',
	) );
  
  if ( $sfs['_ccdclient_themesettings_sitefooter_mailchimp_show_name'] == '1' ){

    $cmb->add_field( array(
      'name' => __( 'Placeholder Text (First Name)', 'ccdclient-wp' ),
      'id' => $prefix . 'mailchimp_placeholder_fname',
      'type' => 'text',
      'default' => 'First Name',
      'desc' => '',
    ) );

    $cmb->add_field( array(
      'name' => __( 'Placeholder Text (Last Name)', 'ccdclient-wp' ),
      'id' => $prefix . 'mailchimp_placeholder_lname',
      'type' => 'text',
      'default' => 'Last Name',
      'desc' => '',
    ) );
    
  }

	$cmb->add_field( array(
		'name' => __( '&quot;Subscribe&quot; / Submit Button Text', 'ccdclient-wp' ),
		'id' => $prefix . 'mailchimp_submit_label',
		'type' => 'text',
		'default' => 'Subscribe',
    'desc' => '',
	) );
  
  $cmb->add_field( array(
    'name'    => __( '&quot;Subscribe&quot; / Submit Button Icon', 'ccdclient-wp' ),
    'id'      => $prefix . 'mailchimp_submit_icon',
    'type'    => 'fontawesome_icon',
    'default' => 'fa-check',
  ) );

	$cmb->add_field( array(
		'name' => __( 'Mailing List ID', 'ccdclient-wp' ),
		'id' => $prefix . 'mailchimp_list_id',
		'type' => 'text_small',
		'default' => '',
    'desc' => '',
	) );

  $cmb->add_field( array(
    'name' => __( 'Privacy Notification', 'ccdclient-wp' ),
    'id' => $prefix . 'mailchimp_privacy',
    'type' => 'wysiwyg',
    'default' => '<p>We will not share your email address with any third parties. We value your privacy.  You can read our Privacy Policy here.</p>',
    'desc' => 'This content will appear below the newsletter subscription form. It is recommended that a link to the Privacy Policy is included.',
    'options' => array(
      'wpautop' => true,
      'editor_height' => '120px',
      'drag_drop_upload' => false,
      'media_buttons' => false,
      'tinymce' => true,
      'teeny' => true,
    ),
  ) );

}
