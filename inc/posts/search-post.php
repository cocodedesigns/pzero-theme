<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $featImg = $fImg[0];
  } else {  }
?>
<article <?php post_class( array('clearfix', 'search-result', 'search-' . get_post_type() . '-post', 'single-' . get_post_type(), get_post_type(), 'post-search') ) ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
  <p class="post-type search-label"><?php $obj = get_post_type_object( get_post_type() ); echo $obj->labels->singular_name; ?></p>
  <div class="clearfix post-wrap">
    <?php if ( has_post_thumbnail() ) { ?><div class="featured-image" style="background-image: url('<?php echo $featImg; ?>')"></div><?php } ?>
    <div class="searchContent">
      <h2><?php the_title(); ?></h2>
      <div class="searchMeta">
        <?php include TEMPLATEPATH . '/inc/meta.php'; ?>
      </div>
      <div class="searchEntry">
        <p><?php echo setwordlimit_excerpt(25); ?></p>
      </div>
      <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
    </div>
  </div>
</article>