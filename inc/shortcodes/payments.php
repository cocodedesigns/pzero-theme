<?php

$allcards = array(
        'amex'          => 'American Express',
        'applepay'      => 'Apple Pay',
        'cirrus'        => 'Cirrus',
        'discover'      => 'Discover',
        'dinersclub'    => 'Diners Club',
        'directdebit'   => 'Direct Debit',
        'googlewallet'  => 'Google Wallet',
        'jcb'           => 'JCB',
        'maestro'       => 'Maestro',
        'mastercard'    => 'MasterCard',
        'paypal'        => 'PayPal',
        'sage'          => 'Sage',
        'solo'          => 'Solo',
        'square'        => 'Square',
        'stripe'        => 'Stripe',
        'switch'        => 'Switch',
        'unionpay'      => 'UnionPay',
        'verisign'      => 'Verified by VeriSign',
        'visa'          => 'Visa',
        'worldpay'      => 'WorldPay',
);

include_once( TEMPLATEPATH . '/inc/settings/settings-sitepayments.php' ); // Settings

function ccd_payment_methods_shortcode( $atts ){
  
    global $allcards;
  
    $default = get_option( 'ccdtheme_settings_paymentmethods' );

    // Set default attributes
    $atts = ( shortcode_atts( array(
        'id'      => uniqid('ccdClient_imageButton_'),
        'title'   => $default['_ccdclient_themesettings_paymentmethods_titletext'],
        'theme'   => $default['_ccdclient_themesettings_paymentmethods_theme'],
        'cards'   => '',
    ), $atts, 'payment_methods' ) );
  
    if ( $atts['cards'] == "" ){
      $cards_arr = $default['_ccdclient_themesettings_paymentmethods_defaultmethods'];
    } else {
      $cards_arr = explode( ',', $atts['cards'] );
    }
  
    $cards = '<ul class="paymentMethods-cardIcons">';
  
    if ( $atts['cards'] == "allcards" || $atts['cards'] == "all" || !$cards_arr ){
      foreach ( $allcards as $key => $card ){
        $cards .= '<li class="paymentMethod-cardIcon cardIcon-' . $key . '" title="' . $card . '"></li>';
      }
    } else {
      foreach ( $cards_arr as $key => $card ){
        if ( array_key_exists( $card, $allcards ) ){
          $cards .= '<li class="paymentMethod-cardIcon cardIcon-' . $card . '" title="' . $allcards[$card] . '"></li>';
        }
      }
    }
  
    $cards .= '</ul>';

    $block = '
        <article id="' . $atts['id'] . '" class="ccdClient-paymentMethods paymentMethods paymentMethods-' . $atts['theme'] . 'Theme">
          <div class="paymentMethods-container">
            <h2 class="paymentMethods-heading">' . $atts['title'] . '</h2>
            <div class="paymentMethods-cardIconsContainer clearfix">
              ' . $cards . '
            </div>
          </div>
        </article>
    ';
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
    return $block;
}
add_shortcode( 'payment_methods', 'ccd_payment_methods_shortcode' );

?>
