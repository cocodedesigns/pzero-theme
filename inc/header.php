<?php

/**
 * Load scripts and stylesheets into the front end of the theme
 * Files loaded here will not be loaded in the wp-admin area
 */
function myTheme_loadScriptsStyles(){

  // jQuery
  wp_enqueue_script( 'jquery' );
  // Main Stylesheet
  wp_enqueue_style('main', get_stylesheet_directory_uri().'/css/main.css');

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