<?php

function ccd_image_button_shortcode( $atts ){

    // Set default attributes
    $atts = ( shortcode_atts( array(
            'id'            => uniqid('ccdClient_imageButton_'),
            'image'         => '',
            'h1'            => '',
            'h2'            => '',
            'url'           => '',
        ), $atts, 'image_button' ) );
  
    $image = wp_get_attachment_image_src( $atts['image'], 'large' );

    $link = '
        <article id="' . $atts['id'] . '" class="ccdClient-imageButton imageButton" style="background-image: url(\''. $image[0] .'\');">
          <a href="' . ( is_numeric( $atts['url'] ) ? get_permalink( $atts['url'] ) : $atts['url'] ) . '" class="imageButton-link">
            <div class="imageButton-buttonText">
              <p class="imageButton-buttonText-h1">' . $atts['h1'] . '</p>
              <h2 class="imageButton-buttonText-h2">' . $atts['h2'] . '</h2>
            </div>
          </a>
        </article>
    ';
    return $link;
}
add_shortcode( 'image_button', 'ccd_image_button_shortcode' );

?>
