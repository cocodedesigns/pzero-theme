<?php 
  $facebook = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_facebook' );
  $twitter = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_twitter' );
  $googleplus = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_googleplus' );
  $instagram = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_instagram' );
  $youtube = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_youtube' );
  $linkedin = cmb2_get_option( 'ccdtheme_settings_contactinfo', '_ccdclient_themesettings_contactinfo_sns_linkedin' );
  $rss = cmb2_get_option( 'ccdtheme_settings_sitefooter', '_ccdclient_themesettings_sitefooter_show_rss' );
?>
            <ul class="social-networks-links">
              <?php if ( $facebook != "" ) { ?><li class="facebook"><a href="<?php echo $facebook; ?>"><span class="network-icon fab fa-facebook"></span> Facebook</a></li><?php } ?>
              <?php if ( $twitter != "" ) { ?><li class="twitter"><a href="<?php echo $twitter; ?>"><span class="network-icon fab fa-twitter"></span> Twitter</a></li><?php } ?>
              <?php if ( $googleplus != "" ) { ?><li class="googleplus"><a href="<?php echo $googleplus; ?>"><span class="network-icon fab fa-google-plus"></span> Google+</a></li><?php } ?>
              <?php if ( $instagram != "" ) { ?><li class="instagram"><a href="<?php echo $instagram; ?>"><span class="network-icon fab fa-instagram"></span> Instagram</a></li><?php } ?>
              <?php if ( $linkedin != "" ) { ?><li class="linkedin"><a href="<?php echo $linkedin; ?>"><span class="network-icon fab fa-linkedin"></span> LinkedIn</a></li><?php } ?>
              <?php if ( $youtube != "" ) { ?><li class="youtube"><a href="<?php echo $youtube; ?>"><span class="network-icon fab fa-youtube-play"></span> YouTube</a></li><?php } ?>
              <?php if ( $rss == 1 ) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><span class="network-icon fas fa-rss"></span> RSS</a></li><?php } ?>
            </ul>
