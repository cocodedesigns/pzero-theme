<?php

function ccd_contact_link_shortcode( $atts ){

    // Set default attributes
    $atts = ( shortcode_atts( array(
            'id'        => uniqid('ccdClient_contactLink_'),
            'title'     => 'Jedi Name',
            'link'      => get_bloginfo('siteurl'),
            'display'   => 'Isambard King Kong Brunel',
            'icon'      => 'fas fa-jedi',
        ), $atts, 'contact_link' ) );

    $link = '
        <article id="' . $atts['id'] . '" class="ccdClient-contactLink contactLink clearfix">
          <div class="contactLink-wrap clearfix">
            <div class="contactLink-icon">
              <span class="' . $atts['icon'] . '"></span>
            </div>
            <div class="contactLink-info">
              <h2 class="contactLink-heading">' . $atts['title'] . '</h2>
              <p class="contactLink-linkText"><a href="' . $atts['link'] . '">' . $atts['display'] . '</a></p>
            </div>
          </div>
        </article>
    ';
    return $link;
}
add_shortcode( 'contact_link', 'ccd_contact_link_shortcode' );

?>
