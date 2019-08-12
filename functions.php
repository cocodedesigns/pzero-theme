<?php

$mytheme = wp_get_theme();

// Get WordPress Admin Notification script
require_once STYLESHEETPATH . '/inc/functions/wpan/bootstrap.php';
// Display notification for theme
wp_admin_notification( 
  'notification-id', // Set your unique notification ID
  __(
    '<strong>Thanks for using Cocode Zero as your base theme.</strong><br /> You can use this to create your own custom theme, whether it is a free theme, or you wish to use it commercially.  We have included a number of plugins for you, including <strong>WP Admin Notification</strong> from Askupa Software, <strong>TGM Plugin Activation</strong>, and <strong>Plugin Update Checker</strong> from YahnisElsts.',
    'zero-theme'
  ), 
  'info', // Notification type - acceptable values are 'success', 'error', 'info' or 'warning'
  true // Makes your notification dismissable via a link. Change to false if your want your notification persistant
);

$mytheme_debug = var_export( $mytheme, true );
wp_admin_notification( 
  'wp-get-theme-dump', // Set your unique notification ID
  $mytheme_debug, 
  'info', // Notification type - acceptable values are 'success', 'error', 'info' or 'warning'
  false // Makes your notification dismissable via a link. Change to false if your want your notification persistant
);

// Get Plugin Update Library
require_once STYLESHEETPATH . '/inc/functions/ptuc/plugin-update-checker.php';
// Update Theme
if ( is_admin() ){
  // Check for updates to theme
  $checkTheme = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/user-name/repo-name/', // This can be any public repo on GitHub, or any file on your own server.
    __FILE__,
    'cocode-zero'
  );
}
// Get TGM Plugin Activation Script
require_once STYLESHEETPATH . '/inc/functions/tgmpa/tgmpa.php';

// Get Custom Comments Form script
include_once STYLESHEETPATH . '/inc/functions/comments.php';
// Get blog pagination script - blog_archive_pagination()
include_once STYLESHEETPATH . '/inc/functions/page-nav.php';

// Load Sidebars, including Footer Sidebars
include_once STYLESHEETPATH . '/inc/functions/sidebars.php';

// Load scripts and stylesheets into the theme
function zeroTheme_loadScriptsStyles(){
  // Main Stylesheet
  wp_enqueue_style('main-css', get_stylesheet_directory_uri().'/css/main.css');
  // Fonts (from Google Fonts)
  wp_enqueue_style('google-fonts-css', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800,800i&display=swap');
  // Load FontAwesome (locally)
  wp_enqueue_style('fontawesome-css', get_stylesheet_directory_uri() . '/fontawesome/css/all.min.css', array(), '5.10.1');
  // Load FontAwesome (remotely)
  /*
  To have an active URL, you will need to have an account with FontAwesome.  To register for FREE, visit https://fontawesome.com/start and get your free FontAwesome kit.  Once you have the right code, uncomment the 'wp_enqueue_script' function, replace the script URL with your own, and save the file.
  
  You should use only one copy of FontAwesome to avoid conflicts, so if you use the remote copy, REMOVE the local copy from your theme.
  
  If you are using a specific version of FontAwesome, it is recommended to change the '0.0.0' variable at the end of the function to your version number (eg. '5.10.1').  This will make further development easier.
  */
  // wp_enqueue_script('fontawesome-js', 'https://kit.fontawesome.com/MY-KIT-ID-NUMBER.js', array(), '0.0.0');
  // Masonry
  wp_enqueue_script('masonry-js', get_stylesheet_directory_uri() . '/js/masonry.pkgd.min.js');
  // ImageLoaded
  wp_enqueue_script('imagesloaded-js', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js');
  // Media sheets
  wp_enqueue_style('desktop-css', get_stylesheet_directory_uri().'/css/desktop.css', array(), '', 'only screen and (min-width: 1025px)');
  wp_enqueue_style('tablet-css', get_stylesheet_directory_uri().'/css/tablet.css', array(), '', 'only screen and (min-width: 801px) and (max-width: 1024px)');
  wp_enqueue_style('mobile-css', get_stylesheet_directory_uri().'/css/mobile.css', array(), '', 'only screen and (max-width: 800px)');
}
add_action('wp_enqueue_scripts', 'zeroTheme_loadScriptsStyles');

// Clean up the <head>
function zeroTheme_removeHeadLinks() {
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
add_action('after_setup_theme', 'zeroTheme_removeHeadLinks');

add_filter( 'wp_title', 'zeroTheme_homeTitle' );
 
/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function zeroTheme_homeTitle( $title ){
  if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
    $title = __( 'Home', 'textdomain' ) . ' | ' . get_bloginfo( 'blogname' );
  }
  return $title;
}

function zeroTheme_loadAdminScriptsStyles(){
    wp_enqueue_style('admin_styles', get_stylesheet_directory_uri() . '/css/adminstyles.css');
}

add_action('admin_enqueue_scripts','zeroTheme_loadAdminScriptsStyles');

add_filter( 'avatar_defaults', 'zeroTheme_defaultAvatar' );
function zeroTheme_defaultAvatar($avatar_defaults) {
    $myavatar = get_stylesheet_directory_uri() . '/images/my-default-avatar.png';
    $avatar_defaults[$myavatar] = "Default Avatar";
    return $avatar_defaults;
}

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

// Add menu support
if(function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'header_menu'  => __('Header Menu'),
        )
    );
}

//Add Excerpts support to Pages as well as Posts
add_action( 'init', 'zeroTheme_addExcerptsToPages' );
function zeroTheme_addExcerptsToPages() {
     add_post_type_support( 'page', 'excerpt' );
}

// Change the link URL for the logo on the login page
add_filter( 'login_headerurl', 'zeroTheme_customLoginLogoUrl' );
function zeroTheme_customLoginLogoUrl(){
  return get_bloginfo( 'url' );
}

// Remove the shaking animation on the login page when there is an error
function zeroTheme_customLoginHead(){
  remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'zeroTheme_customLoginHead');