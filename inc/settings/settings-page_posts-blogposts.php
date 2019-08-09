<?php

include_once PLUGIN_DIR . '/functions/related-posts.php';
include_once PLUGIN_DIR . '/widgets/recent-comments.php';
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
		'name' => __( 'Blog Settings', 'ccdclient-wp' ),
		'id' => $prefix . 'blog_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Enable Blog Sidebar', 'ccdclient-wp' ),
		'id' => $prefix . 'blog_show_sidebar',
		'type' => 'switch',
		'default' => 0,
		'label' => array(
			'on' => __( 'Enable', 'ccdclient-wp' ),
			'off' => __( 'Disable', 'ccdclient-wp' ),
		),
	) );
    
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
  
  $c = wp_count_posts();
  $count = $c->publish;
  
  if ( $count >= 15 ){

    $cmb->add_field( array(
      'name' => __( 'Related Posts', 'ccdclient-wp' ),
      'id' => $prefix . 'relatedposts_title',
      'type' => 'title',
      'desc' => __( 'Related posts will only appear once you have fifteen posts or more in your blog.  You can disable this control here.', 'ccdclient-wp' ),
    ) );

    $cmb->add_field( array(
      'name' => __( 'Enable Related Posts', 'ccdclient-wp' ),
      'id' => $prefix . 'related_enable',
      'type' => 'switch',
      'default' => 0,
      'label' => array(
        'on' => __( 'Enable', 'ccdclient-wp' ),
        'off' => __( 'Disable', 'ccdclient-wp' ),
      ),
    ) );
    
  }

	$cmb->add_field( array(
		'name' => __( 'Recent Comments widget', 'ccdclient-wp' ),
		'id' => $prefix . 'recentcomments_title',
		'type' => 'title',
		'desc' => __( 'These settings will reflect the content for the Recent Comments widget as it appears on the site, when no comments are available.  It will not modify the configuration as it appears in the Appearance section.  When comments are available, this content will be ignored.', 'ccdclient-wp' ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Widget Title', 'ccdclient-wp' ),
		'id' => $prefix . 'recentcomments_widget_title',
		'type' => 'text',
		'default' => 'It\'s oh so quiet ...',
	) );

	$cmb->add_field( array(
		'name' => __( 'Widget Image', 'ccdclient-wp' ),
		'id' => $prefix . 'recentcomments_widget_image',
		'type' => 'file',
		'preview_size' => 'thumbnail',
		'options' => array(
			'url' => false,
		),
	) );

  $cmb->add_field( array(
    'name' => __( 'Content', 'ccdclient-wp' ),
    'id' => $prefix . 'recentcomments_widget_content',
    'type' => 'wysiwyg',
    'default' => '<p>Join in with the conversation in my <a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">blog</a>.</p>',
    'options' => array(
      'textarea_rows' => '3',
      'media_buttons' => false,
      'wpautop' => true,
      'teeny' => true,
      'drag_drop_upload' => false,
      'editor_height' => '100px',
    ),
	) );

	$cmb->add_field( array(
		'name' => __( 'Infinite Scroll', 'ccdclient-wp' ),
		'id' => $prefix . 'infinite_title',
		'type' => 'title',
		'desc' => __( 'These settings will toggle infinite scroll functionality in the theme on the main blog page, and on the individual archive pages.', 'ccdclient-wp' ),
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