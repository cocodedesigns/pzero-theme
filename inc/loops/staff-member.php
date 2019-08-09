<?php
  $img = wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'ccd_staff_photo_id', true ), 'large' );
  $desc = get_post_meta( get_the_ID(), 'ccd_staff_desc', false );
  $link = cmb2_get_option( 'ccdtheme_settings_cpts_staff', '_ccdclient_themesettings_cpts_staff_page_link_enable' );
?>
                            <li class="staff-profile ccdClient-staffProfile">
                              <article class="staffProfile-wrap" style="background-image: url('<?php echo $img[0]; ?>');">
                                <div class="staffProfile-linkWrap">
                                  <div class="staffProfile-linkContainer">
                                    <div class="staffProfile-linkOverlay"></div>
                                    <?php if ( $link == "on" ){ ?>
                                    <a href="<?php the_permalink(); ?>" class="staffProfile-linkButton" title="View <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?>'s profile">
                                      <span class="fa fa-arrow-right"></span>
                                    </a>
                                    <?php } else {
                                      if ( $link == "partial" && $desc != "" ){ ?>
                                    <a href="<?php the_permalink(); ?>" class="staffProfile-linkButton" title="View <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?>'s profile">
                                      <span class="fa fa-arrow-right"></span>
                                    </a>
                                    <?php } else { }
                                    } ?>
                                  </div>
                                </div>
                                <div class="staffProfile-info">
                                  <h3 class="staff-name"><?php the_title(); ?></h3>
                                  <p class="staff-role"><?php echo get_post_meta( get_the_ID(), 'ccd_staff_jobtitle', true ); ?></p>
                                  <ul class="staffProfile-linksList">
                                    <?php if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_website', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-website">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_website', true ); ?>" target="_blank" title="View <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?>'s personal website">
                                          <span class="fa fa-desktop"></span> <?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_website', true ); ?></a>
                                      </li>
                                    <?php } else { }
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_facebook', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-facebook">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_facebook', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Facebook">
                                          <span class="fa fa-facebook"></span> Facebook</a>
                                      </li>
                                    <?php } else { } 
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_twitter', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-twitter">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_twitter', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Twitter">
                                          <span class="fa fa-twitter"></span> Twitter</a>
                                      </li>
                                    <?php } else { } 
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_googleplus', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-google-plus">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_googleplus', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Google+">
                                          <span class="fa fa-google-plus"></span> Google+</a>
                                      </li>
                                    <?php } else { }
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_tumblr', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-tumblr">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_tumblr', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Tumblr">
                                          <span class="fa fa-tumblr"></span> Tumblr</a>
                                      </li>
                                    <?php } else { }
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_linkedin', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-linkedin">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_linkedin', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on LinkedIn">
                                          <span class="fa fa-linkedin"></span> LinkedIn</a>
                                      </li>
                                    <?php } else { } 
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_instagram', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-instagram">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_instagram', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Instagram">
                                          <span class="fa fa-instagram"></span> Instagram</a>
                                      </li>
                                    <?php } else { } 
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_youtube', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-youtube">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_youtube', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on YouTube">
                                          <span class="fa fa-youtube-play"></span> YouTube</a>
                                      </li>
                                    <?php } else { } 
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_behance', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-behance">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_behance', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Behance">
                                          <span class="fa fa-behance"></span> Behance</a>
                                      </li>
                                    <?php } else { }
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_pinterest', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-pinterest">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_pinterest', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Pinterest">
                                          <span class="fa fa-pinterest-p"></span> Pinterest</a>
                                      </li>
                                    <?php } else { }
                                    if ( get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_dribble', true ) ){ ?>
                                      <li class="staffProfile-snsLink snsLink-dribble">
                                        <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_staffProfile_staff_sns_dribble', true ); ?>" target="_blank" title="Find <?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?> on Dribble">
                                          <span class="fa fa-dribbble"></span> Dribble</a>
                                      </li>
                                    <?php } else { }  ?>
                                  </ul>
                                </div>
                              </article>
                            </li>