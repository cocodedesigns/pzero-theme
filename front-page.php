<?php get_header();
  if ( cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_show' ) == 1 ){
    $slider_args = array(
      'post_type' => 'slider',
      'posts_per_page' => -1,
    );
    $slider_query = new WP_Query( $slider_args );
    if ( $slider_query->have_posts() ) : ?>
    <div id="slider-container">
      <div id="front-slider" class="unslider slider-wrapper <?php echo ( cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_showarrows' ) == 1 ? 'unslider-has-arrows' : 'unslider-no-arrows' ); ?> <?php echo ( cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_shownav' ) == 1 ? 'unslider-has-nav' : 'unslider-no-nav' ); ?>">
        <ul>
          <?php while ( $slider_query->have_posts() ) : $slider_query->the_post();
            $image = get_post_meta( get_the_ID(), 'ccdClient_slider_image', true );
            $link = '';
            $source = get_post_meta( get_the_ID(), 'selected_source', true );
          ?>
          <li <?php
          if ( $source == 'upload' ) {
            $img = wp_get_attachment_image_src( $image, 'large' ); echo 'class="uploadedimage image slide" style="background-image: url(\''.$img[0].'\');"'; }
          elseif ( $source == 'url' ) {
            }
          elseif ( $source == 'video' ) {
            }
          else {
            }
          ?>>
            <div class="slide-content">
              <div class="slide-content-wrapper">
                <div class="slide-content-outer">
                  <div class="slide-content-inner">
                    <div class="container">
                      <h1><?php the_title(); ?></h1>
                      <h2><?php echo get_post_meta( get_the_ID(), 'ccdClient_slider_caption', true ); ?></h2>
                      <?php if ( get_post_meta( get_the_ID(), 'ccdClient_slider_link', true ) ) { ?>
                        <a href="<?php echo get_post_meta( get_the_ID(), 'ccdClient_slider_link', true ); ?>" target="<?php echo ( get_post_meta( get_the_ID(), 'ccdClient_link_target', true ) == "1" ? '_blank' : '_self' ); ?>" class="slide-link">Read more</a>
                      <?php } else { } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
        </ul>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#front-slider').unslider({
            speed: <?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_speed' ); ?>,  //  The speed to animate each slide (in milliseconds)
            delay: <?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slide_delay' ); ?>, //  The delay between slide animations (in milliseconds)
            fluid: true,  //  Support responsive design. May break non-responsive designs
            animation: '<?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_animation' ); ?>',
            arrows: <?php echo ( cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_showarrows' ) == 1 ? 'true' : 'false' ); ?>,
            keys: false,
            nav: <?php echo ( cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_shownav' ) == 1 ? 'true' : 'false' ); ?>,
            autoplay: true
        });
      });
    </script>
    <?php else : ?>
    <div id="front-hero-image">
      <div id="front-slider" style="background-image: url('<?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_heroimage' ); ?>')"></div>
    </div>
    <?php endif; wp_reset_postdata();
  } else { ?>
    <div id="front-hero-image">
      <div id="front-slider" style="background-image: url('<?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_heroimage' ); ?>')"></div>
    </div>
  <?php } ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div id="front-content" class="container">
      <div class="entry">
        <?php the_content(); ?>
      </div>
    </div>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>
