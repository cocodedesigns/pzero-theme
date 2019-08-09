           <?php 
              if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'ccd_video_url', true ) != "" ) {
                  if ( has_post_thumbnail() ) {
                    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                    $featImg = $fImg[0];
                  }
              ?>
              <div class="single-post-inner single-post-hasfi hasfi">
                <div class="post-element featured-image post-image" style="background-image: url('<?php echo $featImg; ?>');">
                  <div class="embed-container">
                    <?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'ccd_video_url', true ) ); ?>
                  </div>
                </div>
                <div class="post-element post-content-wrap">
                  <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                  <h1 class="post-title post-content"><?php the_title(); ?></h1>
                  <div class="post-content">
                    <div class="post-excerpt">
                      <p><?php echo end_with_sentence( get_the_excerpt(), 2 ); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
                  </div>
                </div>
            <?php } else { include TEMPLATEPATH . '/inc/posts/index-no.php'; }  ?>
