<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $featImg = $fImg[0];
    $classes = "featured-image has-fi";
  } else { $classes = "no-fi"; }
?>
<article <?php post_class( array('clearfix', 'search-result', 'search-' . get_post_type() . '-post', 'single-' . get_post_type(), get_post_type(), 'post-search') ) ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
  <p class="post-type search-label"><?php $obj = get_post_type_object( get_post_type() ); echo $obj->labels->singular_name; ?></p>
  <h2><?php the_title(); ?></h2>
  <article id="model-<?php the_ID(); ?>" <?php post_class( array('model', 'singleModel', 'archiveModel', 'archivePost', 'modelPost', 'clearfix') ); ?>>
    <div class="modelPost-photo modelPost-contentElement" style="background-image: url('<?php 
      $img = wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'ccd_model_photo_id', true ), 'large' );
      echo $img[0];
    ?>')">
      <a href="<?php the_permalink(); ?>"></a>
    </div>
    <div class="modelPost-content modelPost-contentElement">
      <div class="modelPost-excerpt">
        <?php echo wpautop( setwordlimit_meta( 60, get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_description', true ) ) ); ?>
      </div>
      <div class="modelPost-meta clearfix">
        <div class="modelPost-metaData metaData-height metaData-twoCol">
          <p class="modelPost-metaData-content"><?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_height', true ) ) { echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_height', true ) . ' cm'; } else { echo '--'; } ?></p>
          <p class="modelPost-metaData-label">Height</p>
        </div>
        <div class="modelPost-metaData metaData-weight metaData-twoCol">
          <p class="modelPost-metaData-content"><?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_weight', true ) ) { echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_weight', true ) . ' kgs'; } else { echo '--'; } ?></p>
          <p class="modelPost-metaData-label">Weight</p>
        </div>
        <div class="modelPost-metaData metaData-age metaData-oneCol">
          <p class="modelPost-metaData-content"><?php
            if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_dob', true ) ) {
              $currDate = time();
              $ageDate = strtotime( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_dob', true ) );
              $diff = abs( $currDate - $ageDate );

              $years = floor($diff / (365*60*60*24));
              $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
              $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

              echo $years; } else { echo '--'; } 
          ?></p>
          <p class="modelPost-metaData-label">Age</p>
        </div>
        <div class="modelPost-metaData metaData-bust metaData-oneCol">
          <p class="modelPost-metaData-content"><?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_bust', true ) ) { echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_bust', true ); } else { echo '--'; } ?></p>
          <p class="modelPost-metaData-label">Bust</p>
        </div>
        <div class="modelPost-metaData metaData-waist metaData-oneCol">
          <p class="modelPost-metaData-content"><?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_waist', true ) ) { echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_waist', true ); } else { echo '--'; } ?></p>
          <p class="modelPost-metaData-label">Waist</p>
        </div>
        <div class="modelPost-metaData metaData-hips metaData-oneCol">
          <p class="modelPost-metaData-content"><?php if ( get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_hips', true ) ) { echo get_post_meta( get_the_ID(), '_ccdClient_modelProfile_model_measurements_hips', true ); } else { echo '--'; } ?></p>
          <p class="modelPost-metaData-label">Hips</p>
        </div>
      </div>
      <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
    </div>
  </article>
</article>