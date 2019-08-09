<?php
  if ( cmb2_get_option( 'ccdtheme_settings_blogposts', '_ccdclient_themesettings_pageposts_blogposts_guestposts_enable' ) == 1 ){ // If guests can blog
    $gb_link = cmb2_get_option( 'ccdtheme_settings_blogposts', '_ccdclient_themesettings_pageposts_blogposts_guestposts_page' );
    $gb_url = $gb_link['url'];
    if ( get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_displayname', true ) ){ // This is a guest blog
      $auth_name = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_displayname', true );
      $auth_desc = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_description', true ) . '<p class="authorBox-authorGuestNotice">' . $auth_name . ' is a guest blogger. ' . ( $gb_url ? 'If you would like to be a guest blogger on a future post, check out our <a href="'. $gb_url . '">Guest Blog information page</a>.' : '' ) . '</p>';
      if ( get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_photo', true ) ){ // If image already defined
        $auth_photo = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_photo', true );
      } else {
        $auth_photo = get_avatar_url( get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_email', true ), array( 'size' => 256, 'default' => 'avatar_default', 'force_default' => false ) );
      }
      $auth_site = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_website', true );
      $auth_sns_facebook = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_facebook', true );
      $auth_sns_twitter = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_twitter', true );
      $auth_sns_googleplus = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_googleplus', true );
      $auth_sns_linkedin = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_linkedin', true );
      $auth_sns_youtube = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_youtube', true );
      $auth_sns_instagram = get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_sns_instagram', true );
    } else { // This isn't a guest blog
      $auth_name = get_the_author_meta('display_name');
      $auth_desc = get_the_author_meta('_ccdClient_userProfile_biocontent');
      $auth_photo = get_avatar_url( get_the_author_meta('ID'), array(256,'avatar_default',true) );
      $auth_site = get_the_author_meta('user_url');
      $auth_sns_facebook = get_the_author_meta('_ccdClient_userProfile_facebookurl');
      $auth_sns_twitter = get_the_author_meta('_ccdClient_userProfile_twitterurl');
      $auth_sns_googleplus = get_the_author_meta('_ccdClient_userProfile_googleplusurl');
      $auth_sns_linkedin = get_the_author_meta('_ccdClient_userProfile_linkedinurl');
      $auth_sns_youtube = get_the_author_meta('_ccdClient_userProfile_youtubeurl');
      $auth_sns_instagram = get_the_author_meta('_ccdClient_userProfile_instagramurl');
    }
  } else { // Guests can't blog
    $auth_name = get_the_author_meta('display_name');
    $auth_desc = get_the_author_meta('_ccdClient_userProfile_biocontent');
    $auth_photo = get_avatar_url( get_the_author_meta('ID'), array(256,'avatar_default',true) );
    $auth_site = get_the_author_meta('user_url');
    $auth_sns_facebook = get_the_author_meta('_ccdClient_userProfile_facebookurl');
    $auth_sns_twitter = get_the_author_meta('_ccdClient_userProfile_twitterurl');
    $auth_sns_googleplus = get_the_author_meta('_ccdClient_userProfile_googleplusurl');
    $auth_sns_linkedin = get_the_author_meta('_ccdClient_userProfile_linkedinurl');
    $auth_sns_youtube = get_the_author_meta('_ccdClient_userProfile_youtubeurl');
    $auth_sns_instagram = get_the_author_meta('_ccdClient_userProfile_instagramurl');
  }
  if ( $auth_sns_facebook || $auth_sns_twitter || $auth_sns_googleplus || $auth_sns_linkedin || $auth_sns_youtube || $auth_sns_instagram ){ $has_sns = true; }
?>

<div class="ccdClient-authorBox authorBox-container clearfix">
  <div class="authorBox-heading clearfix">
    <h2 class="authorBox-authorHeading">About <?php echo $auth_name; ?></h2>
    <?php if ( $auth_site != "" ){ ?>
    <p class="authorBox-authorLink"><span class="fa fa-link"></span> <a href="<?php echo $auth_site; ?>" target="_blank"><?php echo $auth_site; ?></a></p>
    <?php } ?>
  </div>
  <div class="authorBox-contentBox clearfix">
    <div class="authorBox-boxPhoto">
      <div class="authorBox-authorPhoto" style="background-image: url('<?php echo $auth_photo; ?>');" title="<?php echo $auth_name; ?>"></div>
    </div>
    <div class="authorBox-boxContent">
      <?php echo wpautop( $auth_desc ); ?>
    </div>
  </div>
  <?php if ( $has_sns === true ){ ?>
  <div class="authorBox-contentSocial clearfix">
    <div class="authorBox-contentSocial">
      <h3 class="authorBox-authorSocial-label">Follow me on:</h3>
    </div>
    <ul class="authorBox-authorSocial-networks clearfix">
      <?php if ( $auth_sns_facebook != "" ){ ?>
      <li class="authorBox-authorSocial-facebook authorBox-authorSocial-network"><a href="<?php echo $auth_sns_facebook; ?>" class="authorBox-authorSocial-link"><span class="fab fa-facebook-f"></span> <span class="authorBox-authorSocial-networkName">Facebook</span></a></li>
      <?php } else { }
      if ( $auth_sns_twitter != "" ){ ?>
      <li class="authorBox-authorSocial-twitter authorBox-authorSocial-network"><a href="<?php echo $auth_sns_twitter; ?>" class="authorBox-authorSocial-link"><span class="fab fa-twitter"></span> <span class="authorBox-authorSocial-networkName">Twitter</span></a></li>
      <?php } else { }
      if ( $auth_sns_googleplus != "" ){ ?>
      <li class="authorBox-authorSocial-googleplus authorBox-authorSocial-network"><a href="<?php echo $auth_sns_googleplus; ?>" class="authorBox-authorSocial-link"><span class="fab fa-google-plus-g"></span> <span class="authorBox-authorSocial-networkName">Google+</span></a></li>
      <?php } else { }
      if ( $auth_sns_linkedin != "" ){ ?>
      <li class="authorBox-authorSocial-linkedin authorBox-authorSocial-network"><a href="<?php echo $auth_sns_linkedin; ?>" class="authorBox-authorSocial-link"><span class="fab fa-linkedin-in"></span> <span class="authorBox-authorSocial-networkName">LinkedIn</span></a></li>
      <?php } else { }
      if ( $auth_sns_youtube != "" ){ ?>
      <li class="authorBox-authorSocial-youtube authorBox-authorSocial-network"><a href="<?php echo $auth_sns_youtube; ?>" class="authorBox-authorSocial-link"><span class="fab fa-youtube"></span> <span class="authorBox-authorSocial-networkName">YouTube</span></a></li>
      <?php } else { }
      if ( $auth_sns_instagram != "" ){ ?>
      <li class="authorBox-authorSocial-instagram authorBox-authorSocial-network"><a href="<?php echo $auth_sns_instagram; ?>" class="authorBox-authorSocial-link"><span class="fab fa-instagram"></span> <span class="authorBox-authorSocial-networkName">Instagram</span></a></li>
      <?php } else { } ?>
    </ul>
  </div>
  <?php } ?>
</div>