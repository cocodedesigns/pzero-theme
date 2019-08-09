<?php
// Load jQuery
function scripts_styles(){
    global $post;
    
    $desktop    = cmb2_get_option( 'ccdtheme_settings_main', '_ccdclient_themesettings_main_desktop_width' );
    $tablet     = cmb2_get_option( 'ccdtheme_settings_main', '_ccdclient_themesettings_main_tablet_width' );
    $dttotab    = $desktop - 1;
    $tabtomob   = $tablet - 1;

    // Main Stylesheet
    wp_enqueue_style('main-css', get_template_directory_uri().'/css/main.css');
    // Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:300,400,700,900|Montserrat:300,300i,400,400i,600,600i,700,700i|Great+Vibes|Roboto+Condensed:700&display=swap');
    wp_enqueue_style('flaticon-font', get_template_directory_uri().'/font/flaticon.css');
    // 404 / Maintenance / DB Error Page
    wp_enqueue_style('fourohfour-css', get_template_directory_uri().'/css/404.css');
    // Masonty
    wp_enqueue_script('masonry-js', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
    // ImageLoaded (fix for Masonry)
    wp_enqueue_script('imagesloaded-js', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js');
    // Featherlight
    wp_enqueue_style('featherlight-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.9/release/featherlight.min.css', '', '1.7.9');
    wp_enqueue_script('featherlight-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.9/release/featherlight.min.js', array('jquery'), '1.7.9', true );
    // Featherlight Gallery Add-on
    wp_enqueue_style('featherlight-gallery-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.9/release/featherlight.gallery.min.css', '', '1.7.9');
    wp_enqueue_script('featherlight-gallery-js', '//cdn.rawgit.com/noelboss/featherlight/1.7.9/release/featherlight.gallery.min.js', array('jquery'), '1.7.9', true);
    wp_enqueue_script( 'detect-swipe', '//cdnjs.cloudflare.com/ajax/libs/detect_swipe/2.1.1/jquery.detect_swipe.min.js', array('jquery'), '2.1.1' );
    // Selectric
    wp_enqueue_script('selectric-js', get_template_directory_uri() . '/js/jquery.selectric.min.js');
    wp_enqueue_style('selectric-css', get_template_directory_uri() . '/css/selectric.css');
    // Validation Script
    wp_enqueue_script('validation-js', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), '1.19.0' );
    // Fixed Height Row
    wp_enqueue_script('fh-row-js', get_template_directory_uri() . '/js/fh-row.js');
    // Media sheets
    if ( cmb2_get_option( 'ccdtheme_settings_main', '_ccdclient_themesettings_main_responsive' ) == 1 ){
        wp_enqueue_style('desktop-css', get_template_directory_uri().'/css/desktop.css', array(), '', 'only screen and (min-width: '.$desktop.'px)');
        wp_enqueue_style('tablet-css', get_template_directory_uri().'/css/tablet.css', array(), '', 'only screen and (min-width: '.$tablet.'px) and (max-width: '.$dttotab.'px)');
        wp_enqueue_style('mobile-css', get_template_directory_uri().'/css/mobile.css', array(), '', 'only screen and (max-width: '.$tabtomob.'px)');
    } else {
        wp_enqueue_style('desktop-nr-css', get_template_directory_uri().'/css/desktop.css');
    }
    // Unslider (Front page only)
    if ( get_option( 'page_on_front' ) == get_the_ID() ) {
        wp_enqueue_script('unslider-js', get_template_directory_uri() . '/js/unslider.min.js');
    }
    // Mobile menu
    wp_enqueue_script( 'togglemenu-js', get_template_directory_uri() . '/js/togglemenu.js' );
    // Loader CSS
    wp_enqueue_style('loader-css', get_template_directory_uri().'/css/loader.css');
    // Prism JS - Code Preview
    wp_enqueue_style('prismjs-css', get_template_directory_uri() . '/css/prism.css', array(), '1.16.0');
    wp_enqueue_script('prismjs-js', get_template_directory_uri() . '/js/prism.js', array(), '1.16.0');
    // Infinite Scroll
    wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array('jquery'), '3.0.6');
}
add_action('wp_enqueue_scripts', 'scripts_styles');

// Clean up the <head>
function removeHeadLinks() {
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
add_action('after_setup_theme', 'removeHeadLinks');

function add_admin_styles(){
    wp_enqueue_style('admin_styles', get_template_directory_uri() . '/css/adminstyles.css');
}

add_action('admin_enqueue_scripts','add_admin_styles');
