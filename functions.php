<?php

/**
 * Get Plugin Update Checker script - thanks to @author YahnisElsts for this.
 * Get the latest version from @link https://github.com/YahnisElsts/plugin-update-checker
 * As of @version 5.0, this script MUST be called before any other function
 */
require_once STYLESHEETPATH . '/inc/functions/puc/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5p0\PucFactory;

/**
 * Get base theme information, as defined in style.css.  
 * You can then call them using @var $mytheme->get()
 */
$mytheme = wp_get_theme();

/**
 * Checks if you are currently in the wp-admin area
 */
if ( is_admin() ){

  /**
   * Runs the plugin-update-checker script called earlier
   * Only runs when logged in to wp-admin
   */
  $checkTheme = PucFactory::buildUpdateChecker(
	  $mytheme->get('ThemeURI'), // This can be any public repo on GitHub, or any file on your own server. Defaults to the Theme URI value in style.css
    __FILE__, // Full path to the main plugin file or functions.php.
    $mytheme->get('TextDomain'), // Uses the 'Text Domain' string as defined in style.css
  );
  // Enables releases via GitHub
  // $checkTheme->getVcsApi()->enableReleaseAssets();
  
  /**
   * Call TGM Plugin Activation script - thanks to the TGMPA team for this
   * Get the latest version from @link https://github.com/TGMPA/TGM-Plugin-Activation
   * Only runs when logged in to wp-admin
   */
  require_once STYLESHEETPATH . '/inc/functions/tgmpa/tgmpa.php';

  /**
   * Call the notification script and display a notification - thanks to Askupa Software for this 
   * Get the latest verison from @link https://github.com/askupasoftware/wp-admin-notification
   * Only runs when logged in to wp-admin
   */
  require_once STYLESHEETPATH . '/inc/functions/wpan/bootstrap.php';

  /**
   * Display notification for theme, using wp-admin-notification
   */
  wp_admin_notification( 
    'notification-id', // Set your unique notification ID
    __('<strong>Thanks for using <em>Project Zero from Cocode Designs</em> as your base theme.</strong><br /> You can use this to create your own custom theme, whether it is a free theme, or you wish to use it commercially.  We have included a number of plugins for you, including <strong>WP Admin Notification</strong> from Askupa Software, <strong>TGM Plugin Activation</strong>, and <strong>Plugin Update Checker</strong> from YahnisElsts.','zero-theme'), 
    'info', // Notification type - acceptable values are 'success', 'error', 'info' or 'warning'
    true // Makes your notification dismissable via a link. Change to false if your want to make your notification persistant
  );

}

/**
 * Contains functions to register and enqueue scripts for @filter wp_enqueue_scripts and 
 */
require_once STYLESHEETPATH . '/inc/header.php';

/**
 * Contains functions to manipulate the wp-json API
 */
require_once STYLESHEETPATH . '/inc/wp-json.php';

/**
 * Contains the 'portfolio' custom post type.  Contains custom taxonomies (categories and tags) and custom metabox, which are assigned to the post type.
 */
require_once STYLESHEETPATH . '/inc/custom-type.php';

/**
 * Contains the custom meta box.  Contains custom taxonomies (categories and tags) and custom metabox, which are assigned to the post type.
 */
require_once STYLESHEETPATH . '/inc/custom-metabox.php';

/**
 * Get blog pagination script - calls the blogPagination() function
 */
include_once STYLESHEETPATH . '/inc/functions/page-nav.php';

/**
 * Load sidebars, including footer sidebars
 */
include_once STYLESHEETPATH . '/inc/functions/sidebars.php';

/**
 * Set a default avatar for the theme
 * 
 * @param string $myavatar The URL of the avatar, as saved in the theme
 * @param string $avatar_defaults[$myavatar] Descriptive name of the avatar
 * @return array $avatar_defaults
 */
function myTheme_defaultAvatar($avatar_defaults) {
    $myavatar = get_stylesheet_directory_uri() . '/images/default-avatar.png';
    $avatar_defaults[$myavatar] = "Default Avatar";
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'myTheme_defaultAvatar' );

/**
 * Enable Custom Logo and Post Thumbnails (Featured Images)
 */
if ( function_exists('add_theme_support') ) {
	add_theme_support( 'post-thumbnails' );
}

/**
 * Fixes conflict with some jQuery scripts where `$` will not fire a script
 */
function myTheme_jqueryNoConflict(){
  ?>
  <script>$=jQuery.noConflict();</script>
  <?php
}
add_action('wp_head', 'myTheme_jqueryNoConflict');

/**
 * Ensures page <title> is displayed on pages and posts.
 */
add_filter( 'wp_title', 'myTheme_homeTitle' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function myTheme_homeTitle( $title ){
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Home', 'textdomain' ) . ' | ' . get_bloginfo( 'blogname' );
  }
  return $title;
}

/**
 * Add navigation menu support
 */
if(function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'header_menu'  => __('Header Menu'),
        )
    );
}