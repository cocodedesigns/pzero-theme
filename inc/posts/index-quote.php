              <div class="single-post-inner single-post-nofi nofi">
                <div class="post-element featured-image post-image" style="background-image: url('<?php echo $featImg; ?>');"></div>
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
              </div>