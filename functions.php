<?php

/**
 * Get base theme information, as defined in style.css.  
 * You can then call them using @param $mytheme->get()
 */
$mytheme = wp_get_theme();

if ( is_admin() ){

  /**
   * Get Plugin Update Checker script - thanks to YahnisElsts for this.
   * Get the latest version from https://github.com/YahnisElsts/plugin-update-checker
   * Only runs when logged in to wp-admin
   */
  require_once STYLESHEETPATH . '/inc/functions/puc/plugin-update-checker.php';
  $checkTheme = Puc_v4_Factory::buildUpdateChecker(
	  $mytheme->get('ThemeURI'), // This can be any public repo on GitHub, or any file on your own server, defaults to the Theme URI value in style.css
    __FILE__,
    $mytheme->get('TextDomain'), // Uses the 'Text Domain' string as defined in style.css
  );
  // Enables releases via GitHub
  $checkTheme->getVcsApi()->enableReleaseAssets();
  
  /**
   * Call TGM Plugin Activation script - thanks to the TGMPA team for this
   * Get the latest version from https://github.com/TGMPA/TGM-Plugin-Activation
   * Only runs when logged in to wp-admin
   */
  require_once STYLESHEETPATH . '/inc/functions/tgmpa/tgmpa.php';

  /**
   * Call the notification script and display a notification - thanks to Askupa Software for this 
   * Get the latest verison from https://github.com/askupasoftware/wp-admin-notification
   * Only runs when logged in to wp-admin
   */
  require_once STYLESHEETPATH . '/inc/functions/wpan/bootstrap.php';
  // Display notification for theme
  wp_admin_notification( 
    'notification-id', // Set your unique notification ID
    __('<strong>Thanks for using <em>Project Zero from Cocode Designs</em> as your base theme.</strong><br /> You can use this to create your own custom theme, whether it is a free theme, or you wish to use it commercially.  We have included a number of plugins for you, including <strong>WP Admin Notification</strong> from Askupa Software, <strong>TGM Plugin Activation</strong>, and <strong>Plugin Update Checker</strong> from YahnisElsts.','zero-theme'), 
    'info', // Notification type - acceptable values are 'success', 'error', 'info' or 'warning'
    true // Makes your notification dismissable via a link. Change to false if your want to make your notification persistant
  );

}

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
  /*
  To use FontAwesome in your theme from a remote CDN, you will need to have an account with FontAwesome.  To register for FREE, visit https://fontawesome.com/start and get your free FontAwesome kit.  Once you have the right code, uncomment the 'wp_enqueue_script' function, replace the script URL with your own, and save the file.
  
  You should use only one copy of FontAwesome to avoid conflicts, so if you use the remote copy, REMOVE the local copy from your theme.
  
  If you are using a specific version of FontAwesome, it is recommended to change the '0.0.0' variable at the end of the function to your version number (eg. '5.10.1').  This will make further development easier.
  */

  // Media sheets
  // If you want to use one stylesheet for your site, you can remove these additional CSS files.
  wp_enqueue_style('desktop-css', get_stylesheet_directory_uri().'/css/desktop.css', array(), '', 'only screen and (min-width: 1025px)');
  wp_enqueue_style('tablet-css', get_stylesheet_directory_uri().'/css/tablet.css', array(), '', 'only screen and (min-width: 801px) and (max-width: 1024px)');
  wp_enqueue_style('mobile-css', get_stylesheet_directory_uri().'/css/mobile.css', array(), '', 'only screen and (max-width: 800px)');

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
function myTheme_removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('template_redirect', 'rest_output_link_header', 11, 0);
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('rest_api_init', 'wp_oembed_register_route');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
}
add_action('after_setup_theme', 'myTheme_removeHeadLinks');

/**
 * Set a default avatar for the theme
 */
function myTheme_defaultAvatar($avatar_defaults) {
    $myavatar = get_stylesheet_directory_uri() . '/images/my-default-avatar.png';
    $avatar_defaults[$myavatar] = "Default Avatar";
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'myTheme_defaultAvatar' );

/**
 * Enable Custom Logo and Post Thumbnails (Featured Images)
 */
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
  add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );
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
 * Get blog pagination script - calls the blogPagination() function
 */
include_once STYLESHEETPATH . '/inc/functions/page-nav.php';

/**
 * Load sidebars, including footer sidebars
 */
include_once STYLESHEETPATH . '/inc/functions/sidebars.php';

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