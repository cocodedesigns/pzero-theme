<?php
/**
 * Sidebar Registration
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * All of the registered sidebars are saved in here.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 * 
 * @param array register_sidebar $args is needed for each new sidebar.
 * 
 * @param string name										The name or title of the sidebar displayed in the Widgets interface. 
 * 																			Default 'Sidebar $instance'.
 * @param string id											The unique identifier by which the sidebar will be called.
 * 																			Default 'sidebar-$instance'
 * @param string description						Description of the sidebar, displayed in the Widgets interface.
 * 																			Defaults to an empty string.
 * @param string class									Extra CSS class to assign to the sidebar in the Widgets interface.
 * @param string before_widget					HTML content to prepend to each widget's HTML output when assigned to this sidebar.
 * 																			Receives the widget's ID attribute as %1$s and class name as %2$s. 
 * 																			Default is an opening list item element.
 * @param string after_widget						HTML content to append to each widget's HTML output when assigned to this sidebar.
 * 																			Default is a closing list item element.
 * @param string before_title						HTML content to prepend to the sidebar title when displayed.
 * 																			Default is an opening h2 element.
 * @param string after_title						HTML content to append to the sidebar title when displayed.
 * 																			Default is a closing h2 element.
 * @param string before_sidebar					HTML content to prepend to the sidebar when displayed.
 * 																			Receives the $id argument as %1$s and $class as %2$s.
 * 																			Outputs after the 'dynamic_sidebar_before' action.
 * 																			Default to an empty string.
 * @param string after_sidebar					HTML content to append to the sidebar when displayed.
 * 																			Outputs before the 'dynamic_sidebar_after' action.
 * 																			Default to an empty string.
 * @param bool show_in_rest							Whether to show this sidebar publicly in the REST API.
 * 																			Defaults to only showing the sidebar to administrator users.
 */

    if ( function_exists( 'register_sidebar' ) ) {

			register_sidebar( array(
				'name' 						=> 'Sidebar Widgets',
				'id'   						=> 'sidebar-widgets',
				'description'   	=> 'These are widgets for the sidebar.  These will appear on the blog pages.',
				'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				'after_widget'  	=> '</div>',
				'before_title'  	=> '<h2 class="widget-title">',
				'after_title'   	=> '</h2>'
			) );

			register_sidebar( array(
				'name' 						=> 'Footer Sidebar 1',
				'id'   						=> 'footerbar-one',
				'description'   	=> 'Footer Sidebar One',
				'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				'after_widget'  	=> '</div>',
				'before_title'  	=> '<h2 class="widget-title">',
				'after_title'   	=> '</h2>',
				'before_sidebar'	=> '<div class="footerbar-wrap">',
				'after_sidebar'		=> '</div>'
			) );

			register_sidebar( array(
				'name' 						=> 'Footer Sidebar 2',
				'id'   						=> 'footerbar-two',
				'description'   	=> 'Footer Sidebar Two',
				'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				'after_widget'  	=> '</div>',
				'before_title'  	=> '<h2 class="widget-title">',
				'after_title'   	=> '</h2>',
				'before_sidebar'	=> '<div class="footerbar-wrap">',
				'after_sidebar'		=> '</div>'
			) );

			register_sidebar( array(
				'name' 						=> 'Footer Sidebar 3',
				'id'   						=> 'footerbar-three',
				'description'   	=> 'Footer Sidebar Three',
				'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				'after_widget'  	=> '</div>',
				'before_title'  	=> '<h2 class="widget-title">',
				'after_title'   	=> '</h2>',
				'before_sidebar'	=> '<div class="footerbar-wrap">',
				'after_sidebar'		=> '</div>'
			) );

			register_sidebar( array(
				'name' 						=> 'Footer Sidebar 4',
				'id'   						=> 'footerbar-four',
				'description'   	=> 'Footer Sidebar Four',
				'before_widget' 	=> '<div id="%1$s" class="widget %2$s">',
				'after_widget'  	=> '</div>',
				'before_title'  	=> '<h2 class="widget-title">',
				'after_title'   	=> '</h2>',
				'before_sidebar'	=> '<div class="footerbar-wrap">',
				'after_sidebar'		=> '</div>'
			) );
    }