           <?php 
              if ( has_post_thumbnail() ) {
                $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                $featImg = $fImg[0];
              ?>
              <div class="singlePost singlePost-inner singlePost-hasfi hasfi">
                <div class="postElement postTitle">
                  <h1 class="post-title post-content"><?php the_title(); ?></h1>
                  <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                </div>
                <div class="postElement featuredImage postImage" style="background-image: url('<?php echo $fImg[0]; ?>'); --featWidth: <?php echo $fImg[1]; ?>; --featHeight: <?php echo $fImg[2]; ?>;">
                  <?php echo get_featured_image_copyright( get_post_thumbnail_id( get_the_ID() ) ); ?>
                </div>
                <div class="postElement postContent">
                  <div class="postExcerpt">
                    <p><?php echo end_with_sentence( get_the_excerpt(), 2 ); ?></p>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
                </div>
              </div>
            <?php } else { include TEMPLATEPATH . '/inc/posts/index-no.php'; }  ?>