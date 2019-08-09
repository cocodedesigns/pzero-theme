<?php

if ( is_admin() ) {
  
  $mytheme = wp_get_theme();
  
  // Load WordPress Plugin file and activate Cocode Xtended plugin
  plugin_activation('cocode-xtended/cocode-xtended.php');
  
  // Load Plugin and Theme Update Checker
  if ( !file_exists( PLUGIN_DIR . '/updater/ptuc/plugin-update-checker.php' ) ){
    require dirname(__FILE__) . '/ptuc/plugin-update-checker.php';
  } else { 
    // File already loaded in plugin
  }

  // Load TGM Plugin Activation
  if ( !file_exists( PLUGIN_DIR . '/updater/tgm/class-tgm-plugin-activation.php' ) ){
    require_once dirname(__FILE__) . '/tgm/class-tgm-plugin-activation.php';
  } else { 
    // File already loaded in plugin
  }
  require_once dirname(__FILE__) . '/tgm.php';
  
  // Load notificatoin script
  if ( !file_exists( PLUGIN_DIR . '/wpan/bootsrap.php' ) ){
    require_once TEMPLATEPATH . '/inc/wpan/bootstrap.php'; // Get notification script
  } else { 
    // File already loaded in plugin
  }
  
  // Display notification for theme
  wp_admin_notification( 'notice-ccdClient-'.$mytheme->get('TextDomain').'-'.str_replace('.','-',$mytheme->get('Version')) , __('<strong>Thanks for installing version '.$mytheme->get('Version').' of '.$mytheme->get('Name').', your custom built theme from Cocode Designs.</strong><br />  Make sure you take a look at your <a href="'.admin_url('admin.php?page=ccdtheme_settings').'">Theme Settings</a> to change any options that you need to. <ston','ccdClient-wp'), 'info', true);
}

function plugin_activation($plugin){ 
  if ( !function_exists( 'activate_plugin' ) ){ require_once ABSPATH . 'wp-admin/includes/plugin.php'; } 
  if ( !is_plugin_active( $plugin ) ){ activate_plugin( $plugin ); } 
}