<?php

  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );  
  
  // Shortcodes
  include_once( PLUGIN_DIR . '/shortcodes/map.php' ); // Map
  include_once( PLUGIN_DIR . '/shortcodes/alertMsg.php' ); // Alert message
  include_once( PLUGIN_DIR . '/shortcodes/icon-box.php' ); // Icon Box
  include_once( PLUGIN_DIR . '/shortcodes/titleBanner.php' ); // Title Banner
  include_once( PLUGIN_DIR . '/shortcodes/button.php' ); // Button
  include_once( STYLESHEETPATH . '/inc/shortcodes/contact-link.php' );
  
  // Custom post types
  include_once( PLUGIN_DIR . '/cpts/slides.php' ); // Front Slider
  include_once( PLUGIN_DIR . '/cpts/models.php' ); // Model Profiles
  include_once( PLUGIN_DIR . '/cpts/events.php' ); // Model Profiles
  include_once( PLUGIN_DIR . '/cpts/media.php' ); // Media Galleries
  include_once( STYLESHEETPATH . '/inc/cpts/ama.php' ); // Ask Me Anything

  // Settings
  include_once( STYLESHEETPATH . '/inc/settings/settings-patreon.php' ); // Patreon page
  include_once( STYLESHEETPATH . '/inc/settings/user-model-fields.php' ); // Profile fields for users
  
  // Widgets
  // Text
  include_once( PLUGIN_DIR . '/widgets/title-widget.php' );
  include_once( PLUGIN_DIR . '/widgets/text-icon.php' );
  include_once( PLUGIN_DIR . '/widgets/line-icon.php' );
  include_once( PLUGIN_DIR . '/widgets/list-icon.php' );
  include_once( PLUGIN_DIR . '/widgets/image-box.php' );
  include_once( PLUGIN_DIR . '/widgets/bulleted-list.php' );
  include_once( STYLESHEETPATH . '/inc/widgets/quote-widget.php' );
  include_once( PLUGIN_DIR . '/widgets/counter-widget.php' );
  include_once( PLUGIN_DIR . '/widgets/featured-content-box.php' );
  include_once( PLUGIN_DIR . '/widgets/featured-page-widget.php' );
  // Images
  include_once( PLUGIN_DIR . '/widgets/image-link.php' );
  // Blog Related
  include_once( PLUGIN_DIR . '/widgets/recent-comments.php' );
  include_once( PLUGIN_DIR . '/widgets/recent-posts.php' );
  include_once( STYLESHEETPATH . '/inc/widgets/recent-posts-withpreview.php' );
  include_once( PLUGIN_DIR . '/widgets/archive-widget.php' );
  // Other
  include_once( PLUGIN_DIR . '/widgets/map.php' );
  include_once( PLUGIN_DIR . '/widgets/contact-item.php' );
  include_once( PLUGIN_DIR . '/widgets/contact-details.php' );
  include_once( PLUGIN_DIR . '/widgets/cta-widget.php' );

  // Like Button
  include_once( PLUGIN_DIR . '/functions/like-button.php' );
  
  // Install into SiteOrigin Page Builder
  if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
      function ccdClient_add_widget_tabs( $tabs ){
          $tabs[] = array(
              'title'     => __('Theme Specific Widgets', 'ccd_widgets'),
              'filter'    => array(
                  'groups'    => array('ccd_widgets')
              )
          );
          return $tabs;
      }
      add_filter('siteorigin_panels_widget_dialog_tabs', 'ccdClient_add_widget_tabs', 20);
  }

?>