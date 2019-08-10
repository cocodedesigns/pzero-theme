<?php
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
    		'name' => 'Footer Sidebar 1',
    		'id'   => 'footer-sidebar-one',
    		'description'   => 'Footer Sidebar One',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
        ));
        register_sidebar(array(
    		'name' => 'Footer Sidebar 2',
    		'id'   => 'footer-sidebar-two',
    		'description'   => 'Footer Sidebar Two',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
        ));
        register_sidebar(array(
    		'name' => 'Footer Sidebar 3',
    		'id'   => 'footer-sidebar-three',
    		'description'   => 'Footer Sidebar Three',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
        ));
        register_sidebar(array(
    		'name' => 'Footer Sidebar 4',
    		'id'   => 'footer-sidebar-four',
    		'description'   => 'Footer Sidebar Four',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2 class="widget-title">',
    		'after_title'   => '</h2>'
        ));
    }