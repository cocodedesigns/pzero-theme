<?php

/**
 * Load scripts and stylesheets into the front end of the theme
 * Files loaded here will not be loaded in the wp-admin area
 */
function myTheme_loadScriptsStyles(){

  // Main Stylesheet
  wp_enqueue_style('main', get_stylesheet_directory_uri().'/css/main.css');

  // Fonts (from Google Fonts)
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800,800i&display=swap');

  // Load FontAwesome (remotely) - See DOCS for how to enable FontAwesome
  // wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/MY-KIT-ID.js', array(), '0.0.0');

  // Media sheets
  // If you want to use one stylesheet for your site, you can remove these additional CSS files.
  wp_enqueue_style('desktop', get_stylesheet_directory_uri().'/css/desktop.css', array(), '', 'only screen and (min-width: 1025px)');
  wp_enqueue_style('tablet', get_stylesheet_directory_uri().'/css/tablet.css', array(), '', 'only screen and (min-width: 801px) and (max-width: 1024px)');
  wp_enqueue_style('mobile', get_stylesheet_directory_uri().'/css/mobile.css', array(), '', 'only screen and (max-width: 800px)');

}
add_action('wp_enqueue_scripts', 'myTheme_loadScriptsStyles');

/**
 * Load scripts and styles within the wp-admin area
 * Files loaded here will not be loaded in the front end of the theme
 */
function myTheme_loadAdminScriptsStyles(){
  wp_enqueue_style('admin_styles', get_stylesheet_directory_uri() . '/css/admin.css');
}
add_action('admin_enqueue_scripts','myTheme_loadAdminScriptsStyles');

/**
 * Remove functions from <head> that could be exploited
 */
remove_action('wp_head', 'rsd_link'); // Remove Really Simple Discovery link
remove_action('wp_head', 'wp_generator'); // Remove WordPress version

remove_action('wp_head', 'feed_links', 2); // Remove RSS feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // Removes all extra RSS feed links

remove_action('wp_head', 'index_rel_link'); // Remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // Remove wlwmanifest.xml (needed to support windows live writer)

remove_action('wp_head', 'start_post_rel_link', 10, 0); // Remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Remove the relational links for the posts adjacent to the curent post
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
      
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); // 
remove_action( 'wp_print_styles', 'print_emoji_styles' );
      
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink