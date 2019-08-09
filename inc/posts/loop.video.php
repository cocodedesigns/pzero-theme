           <?php 
              if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'ccd_video_url', true ) != "" ) {
                  if ( has_post_thumbnail() ) {
                    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                    $featImg = $fImg[0];
                  }
              ?>
              <div class="single-post-inner single-post-hasfi hasfi">
                <div class="post-element post-content">
                  <div class="post-element featured-image post-image" style="background-image: url('<?php echo $featImg; ?>');">
                    <div class="embed-container">
                      <?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'ccd_video_url', true ) ); ?>
                    </div>
                  </div>
                  <?php the_content(); ?>
                </div>
            <?php } else { include TEMPLATEPATH . '/inc/posts/loop-no.php'; }  ?>
