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
  <div class="videoPreview clearfix">
    <div class="videoPreview-image">
      <div class="featuredImage" style="background-image: url('<?php echo $featImg; ?>');">                  
        <div class="video-play-button">
          <span class="fa fa-play"></span>
        </div>
      </div>
    </div>
    <div class="videoPreview-content">
      <?php echo wpautop( setwordlimit_meta( 60, get_post_meta( get_the_ID(), 'ccdClient_video_description', true ) ) ); ?>
    </div>
  </div>
  <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
</article>