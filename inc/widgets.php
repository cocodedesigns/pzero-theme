<?php

$dPath = TEMPLATEPATH . '/inc/widgets';

include( $dPath . '/text-icon.php' );
include( $dPath . '/image-link.php' );
include( $dPath . '/list-icon.php' );
include( $dPath . '/contact-item.php' );
include( $dPath . '/map.php' );
include( $dPath . '/dedo_download.php' );
include( $dPath . '/styled-title.php' );
include( $dPath . '/testimonial-widget.php' );
include( $dPath . '/cta-widget.php' );
include( $dPath . '/archive-widget.php' );
include( $dPath . '/recent-posts.php' );
include( $dPath . '/recent-posts-withpreview.php' );
include( $dPath . '/recent-comments.php' );
include( $dPath . '/number-box.php' );
include( $dPath . '/quote-widget.php' );
include( $dPath . '/opening-hours.php' );
include( $dPath . '/resmio-widgets.php' );
include( $dPath . '/menu-food-item.php' );
include( $dPath . '/menu-food-title.php' );

function mytheme_add_widget_tabs( $tabs ){
    $tabs[] = array(
        'title'     => __('Theme Specific Widgets', 'ccd_widgets'),
        'filter'    => array(
            'groups'    => array('ccd_widgets')
        )
    );
    return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'mytheme_add_widget_tabs', 20);
