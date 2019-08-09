<?php

function ccd_support_link_shortcode( $atts ){

    // Set default attributes
    $atts = ( shortcode_atts( array(
            'id'            => uniqid('ccdClient_supportLink_'),
            'title'         => 'Need support?',
            'link'          => get_bloginfo('siteurl') . '/support/',
            'buttontext'    => 'Contact Support',
            'icon'          => 'fa fa-life-ring',
        ), $atts, 'support_link' ) );

    $link = '
        <article id="' . $atts['id'] . '" class="ccdClient-supportLink supportLink-widget clearfix">
          <div class="supportLink-widgetIcon">
            <span class="' . $atts['icon'] . '"></span>
          </div>
          <div class="supportLink-widgetData">
            <div class="supportLink-dataHeading">
              <h3 class="supportLink-heading">' . $atts['title'] . '</h3>
            </div>
            <div class="supportLink-dataContent">
              <p><a href="' . $atts['link'] . '">' . $atts['buttontext'] . '</a></p>
            </div>
          </div>
        </article>
    ';
    return $link;
}
add_shortcode( 'support_link', 'ccd_support_link_shortcode' );

?>
