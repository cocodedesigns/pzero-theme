
              <div class="singlePost singlePost-inner singlePost-nofi nofi">
                <div class="postElement postTitle">
                  <h1 class="post-title post-content"><?php the_title(); ?></h1>
                  <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
                </div>
                <div class="postElement postContent">
                  <div class="postExcerpt">
                    <p><?php echo end_with_sentence( get_the_excerpt(), 2 ); ?></p>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="read-more-link">Read More</a>
                </div>
              </div>