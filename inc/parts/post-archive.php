<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
  <?php 
    if ( has_post_thumbnail() ) {
      $featured = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
  ?>
    <figure class="featured-image post-image" style="background-image: url('<?php echo $featured[0]; ?>');"></figure>
  <?php } ?>
  <div class="post-content">
    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <?php include (STYLESHEETPATH . '/inc/meta.php' ); ?>
    <div class="entry">
      <?php the_excerpt( __( 'Read the rest of this entry »', 'textdomain' ) ); ?>
    </div> <!-- .entry -->
  </div> <!-- .post-content -->
</article> <!-- #post-{post_id} -->