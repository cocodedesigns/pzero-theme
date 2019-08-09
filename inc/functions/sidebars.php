<?php
	$footerOps = get_option( 'ccdtheme_settings_sitefooter' );
	$countBars = $footerOps['_ccdclient_themesettings_sitefooter_footer_countbars'];

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.  These will appear on the blog pages.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
    	));
      register_sidebar(array(
    		'name' => 'Footer Menu 1',
    		'id'   => 'fm-one',
    		'description'   => 'Footer Menu One Sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
			));
			if ( $countBars > 1 || $countBars == "" ){

      register_sidebar(array(
    		'name' => 'Footer Menu 2',
    		'id'   => 'fm-two',
    		'description'   => 'Footer Menu Two Sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
			));
			
			}	else { }
			if ( $countBars > 2 || $countBars == "" ){

      register_sidebar(array(
    		'name' => 'Footer Menu 3',
    		'id'   => 'fm-three',
    		'description'   => 'Footer Menu Three Sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
			));
			
			} else { }
			if ( $countBars > 3  || $countBars == "" ){

      register_sidebar(array(
    		'name' => 'Footer Menu 4',
    		'id'   => 'fm-four',
    		'description'   => 'Footer Menu Four Sidebar',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
			));
			
			} else { }
    }