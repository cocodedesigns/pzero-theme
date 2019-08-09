<div id="modelProfile" class="clearfix">
  <div id="modelProfile-meta">
    <div id="modelProfile-slider" class="unslider slider-wrapper unslider-no-arrows unslider-no-nav">
        <?php 
          $slides = get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_slider_photos', true );
        ?>
      <ul id="modelProfile-sliderPhotos">
        <?php 
          if ( get_post_meta( get_the_ID(), 'ccd_model_photo_id', true ) ) { ?>
          <li id="slide-00" class="photoSlider" style="background-image: url('<?php 
          $img = wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'ccd_model_photo_id', true ), 'large' );
          echo $img[0]; ?>');"></li>
        <?php } else { } 
        if ( $slides ){
          foreach ( $slides as $sid=>$slide ){
        ?>
          <li id="slide-<?php echo $sid; ?>" class="photoSlider" style="background-image: url('<?php 
          $slide = wp_get_attachment_image_src($sid, 'large');
          echo $slide[0];
          ?>');"></li>
        <?php
          }
        } else { }
        ?>
      </ul>
    </div>
    <script>
      $(document).ready(function(){
        $('#modelProfile-slider').unslider({
            speed: 600,  //  The speed to animate each slide (in milliseconds)
            delay: 7000, //  The delay between slide animations (in milliseconds)
            fluid: true,  //  Support responsive design. May break non-responsive designs
            animation: '<?php echo cmb2_get_option( 'ccdtheme_settings_frontpage', '_ccdclient_themesettings_pageposts_frontpage_slider_animation' ); ?>',
            arrows: false,
            keys: false,
            nav: false,
            autoplay: true
        });
      });
    </script>
    <div id="modelProfile-metaData">
      <div id="metaData-nationality" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Nationality</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_nationality', true ); ?></p>
      </div>
      <div id="metaData-dob" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Date of Birth</p>
        <p class="modelProfile-metaData"><?php echo date( 'j F Y', strtotime( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_dob', true ) ) ); ?></p>
      </div>
      <div id="metaData-age" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Age</p>
        <p class="modelProfile-metaData"><?php
      $currDate = time();
      $ageDate = strtotime( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_dob', true ) );
      $diff = abs( $currDate - $ageDate );

      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

      echo $years;
    ?></p>
      </div>
      <div id="metaData-height" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Height</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_height', true ); ?>cm
          (<?php
            $cm = get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_height', true );
            $inches = $cm/2.54;
            $feet = intval($inches/12);
            $inches = $inches%12;
            printf('%d ft %d ins', $feet, $inches);
          ?>)</p>
      </div>
      <div id="metaData-weight" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Weight</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_weight', true ); ?>kgs</p>
      </div>
      <div id="metaData-occupation" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Occupation</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_occupation', true ); ?></p>
      </div>
      <div id="metaData-bust" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Bust (Bra size)</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_bust', true ); ?>
        <?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_bra_size', true ) ){ ?>
          (<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_bra_size', true ); ?>)
        <?php } ?></p>
      </div>
      <div id="metaData-waist" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Waist</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_waist', true ); ?></p>
      </div>
      <div id="metaData-hips" class="modelProfile-metaItem clearfix">
        <p class="modelProfile-metaLabel">Hips</p>
        <p class="modelProfile-metaData"><?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_hips', true ); ?></p>
      </div>
    </div>
  </div>
  <div id="modelProfile-content">
    <?php echo wpautop( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_description', true ) ); ?>
  </div>
  <div id="modelProfile-networks" class="clearfix">
    <h3>Find <?php echo get_post_meta( get_the_ID(), 'ccd_model_firstname', true ); ?> on:</h3>
    <ul class="modelProfile-linksList">
      <?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_website', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-website">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_website', true ); ?>" target="_blank">
            <span class="fas fa-desktop"></span> <?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_website', true ); ?></a>
        </li>
      <?php } else { }
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_facebook', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-facebook">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_facebook', true ); ?>" target="_blank">
            <span class="fab fa-facebook"></span> Facebook</a>
        </li>
      <?php } else { } 
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_twitter', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-twitter">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_twitter', true ); ?>" target="_blank">
            <span class="fab fa-twitter"></span> Twitter</a>
        </li>
      <?php } else { } 
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_googleplus', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-google-plus">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_googleplus', true ); ?>" target="_blank">
            <span class="fab fa-google-plus"></span> Google+</a>
        </li>
      <?php } else { }
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_tumblr', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-tumblr">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_tumblr', true ); ?>" target="_blank">
            <span class="fab fa-tumblr"></span> Tumblr</a>
        </li>
      <?php } else { }
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_linkedin', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-linkedin">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_linkedin', true ); ?>" target="_blank">
            <span class="fab fa-linkedin"></span> LinkedIn</a>
        </li>
      <?php } else { } 
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_instagram', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-instagram">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_instagram', true ); ?>" target="_blank">
            <span class="fab fa-instagram"></span> Instagram</a>
        </li>
      <?php } else { } 
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_youtube', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-youtube">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_youtube', true ); ?>" target="_blank">
            <span class="fab fa-youtube"></span> YouTube</a>
        </li>
      <?php } else { } 
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_behance', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-behance">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_behance', true ); ?>" target="_blank">
            <span class="fab fa-behance"></span> Behance</a>
        </li>
      <?php } else { }
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_pinterest', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-pinterest">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_pinterest', true ); ?>" target="_blank">
            <span class="fab fa-pinterest-p"></span> Pinterest</a>
        </li>
      <?php } else { }
      if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_dribble', true ) ){ ?>
        <li class="modelProfile-snsLink snsLink-dribble">
          <a href="<?php echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_sns_dribble', true ); ?>" target="_blank">
            <span class="fab fa-dribbble"></span> Dribble</a>
        </li>
      <?php } else { }  ?>
    </ul>
  </div>
  <?php
    $photos = get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_gallery_photos', true );
    if ( count( $photos ) < 3 ) { }
    else {
  ?>
  <div id="modelProfile-photos" class="clearfix">
    <?php
      if ( count( $photos ) == 3 ) { $count = 'three'; }
      elseif ( count( $photos ) == 4 ) { $count = 'four'; }
      elseif ( count( $photos ) == 5 ) { $count = 'five'; }
      else { $count = 'six'; }
    ?>
    <ul id="modelPhotos" class="photoCount-<?php echo $count; ?> clearfix">
      <?php
        $i = 0;
        foreach ( $photos as $pid=>$photo ){
          if ( $i < 6 ){
      ?>
        <li id="photo-<?php echo $pid; ?>" class="modelPhoto">
          <a href="<?php echo $photo; ?>" style="background-image: url('<?php 
          $photo = wp_get_attachment_image_src($pid, 'large');
          echo $photo[0];
          ?>');" title="<?php
              ?>" data-featherlight="image"></a>
        </li>
      <?php
            $i++;
          }
        }
      ?>
    </ul>
  </div>
  <?php
    }
  ?>
</div>