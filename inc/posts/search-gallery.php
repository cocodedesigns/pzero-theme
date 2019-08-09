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
  <div class="galleryMeta">
    <?php include TEMPLATEPATH . '/inc/meta.php'; ?>
  </div>
  <div class="galleryPreview clearfix">
    <?php
      $gimg = get_post_meta( get_the_ID(), '_ccdclient_gallery_photos', true );
      $i = 0;
      $galleryimages = '';
      if ( count( $gimg ) >= 3 ) { $classes = "fourUp"; $x = 4; } else { $classes = "lessUp"; $x = count( $gimg ); }
    ?>
    <ul class="photoGallery clearfix">
    <?php
      foreach ( $gimg as $key => $img ){
        if ( $i != $x ){
          $ti = wp_get_attachment_image_src( $key, 'large' );
          $i++;
          echo '<li id="photo-'.$key.'"><figure class="photoPreview" style="background-image: url('.$ti[0].');"></figure></li>';
        }
        else { }
      }
    ?>
    </ul>
  </div>
  <div class="gallery-description">
    <p><?php echo ( strlen( get_post_meta( get_the_ID(), 'ccdClient_gallery_desc', true ) ) > 30 ? substr( get_post_meta( get_the_ID(), 'ccdClient_gallery_desc', true ), 0, 296 ) . ' ...' : get_post_meta( get_the_ID(), 'ccdClient_gallery_desc', true ) ); ?></p>
  </div>
  <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
</article>