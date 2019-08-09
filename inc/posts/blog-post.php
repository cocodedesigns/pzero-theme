          <article <?php post_class( array('archivePost', 'archive-blogPost', 'blogPost', 'singleSpost', 'post', 'postMain') ) ?> id="post-<?php the_ID(); ?>">
            <?php 
              if ( has_post_thumbnail() ) {
                $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                $featImg = $fImg[0];
              ?>
              <div class="singlePost singlePost-inner singlePost-hasfi hasfi clearfix">
                <div class="postElement featuredImage postImage" style="background-image: url('<?php echo $fImg[0]; ?>'); --featWidth: <?php echo $fImg[1]; ?>; --featHeight: <?php echo ( $fImg[2] > $fImg[1] ? $fImg[1] : $fImg[2] ); ?>;">
                  <?php echo get_featured_image_copyright( get_post_thumbnail_id( get_the_ID() ) ); ?>
                </div>
                <div class="postElement postContent">
                  <div class="postTitle">
                    <h1 class="post-title post-content"><?php the_title(); ?></h1>
                    <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                  </div>
                  <div class="postExcerpt">
                    <p><?php echo setwordlimit_excerpt(25); ?></p>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
                </div>
              </div>
            <?php } else { ?>
              <div class="singlePost singlePost-inner singlePost-nofi nofi clearfix">
                <div class="postElement postContent">
                  <div class="postTitle">
                    <h1 class="post-title post-content"><?php the_title(); ?></h1>
                    <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                  </div>
                  <div class="postExcerpt">
                    <p><?php echo setwordlimit_excerpt(55); ?></p>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
                </div>
              </div>
            <?php }  ?>
          </article>