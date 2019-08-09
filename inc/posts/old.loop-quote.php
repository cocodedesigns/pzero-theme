              <div class="quote-wrap" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/creative-apple-desk-office.jpg'); background-size: cover; padding: 85px 35px 55px; position: relative;">
                <div class="quote-top-border" style="position: absolute; left: 37px; top: 45px; right: 33px;">
                  <div class="quote-top-border-left" style="width: calc( 50% - 40px ); display: inline-block; vertical-align: top; height: 1px; margin: 40px -2px; background-color: #FFF;"></div>
                  <div class="quote-icon-wrap" style="display: inline-block; vertical-align: top; margin: 0 -2px; box-sizing: border-box; padding: 10px;">
                    <span class="quote-icon flaticon-right176" style="display: block; width: 60px; height: 60px; font-size: 30px; color: #FFF; text-align: center; line-height: 60px;">
                  </div>
                  <div class="quote-top-border-right" style="width: calc( 50% - 40px ); display: inline-block; vertical-align: top; height: 1px; margin: 40px -2px; background-color: #FFF;"></div>
                </div>
                <div class="quote-borders" style="border-left: solid 1px #FFF; border-bottom: solid 1px #FFF; border-right: solid 1px #FFF;">
                  <div class="quote-content" style="padding: 40px 20px 20px;">
                    <p>Quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote quote.</p>
                    <p class="quoted-by">-- <?php echo get_post_meta( get_the_ID(), 'ccd_quote_attr', true ); ?></p>
                  </div>
                </div>
              </div>
              <div class="post-content-wrap">
                <div class="post-content post-center-div">
                  <?php 
                  if ( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == 'quote') { the_content(); echo '<p class="quoted-by">-- '.get_post_meta( get_the_ID(), 'ccd_quote_attr', true ).'</p>'; }
                  elseif ( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == 'facebook' ) {
                    echo '<div class="fb-post" data-href="'.get_post_meta( get_the_ID(), 'ccd_quote_fburl', true ).'" data-width="750"></div>';
                  } elseif ( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == 'twitter' ) {
                    echo apply_filters( 'the_content', 'https://twitter.com/twitter/status/512695470469021698' );
                  } else { } ?>
                </div>
              </div>