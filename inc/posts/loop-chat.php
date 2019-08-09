           <?php if ( has_post_thumbnail() ) { ?>
              <div class="featured-image" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) ); ?>');">
                <div class="post-meta-data-wrap">
                  <div class="post-meta-data post-center-div">
                    <div class="post-format"></div>
                    <p><a href="<?php the_permalink(); ?>" class="read-more-link"><span class="icon flaticon-link23"></span><span class="link-name">Read More</span></a></p>
                  </div>
                </div>
              </div>
              <div class="post-content-wrap">
                <div class="post-content post-center-div">
                  <?php the_excerpt(); ?>
                </div>
              </div>
            <?php } else { ?>
              <div class="post-content-wrap">
                <div class="post-content post-center-div">
                  <div class="post-format"></div>
                  <?php the_excerpt(); ?>
                  <p><a href="<?php the_permalink(); ?>" class="read-more-link"><span class="icon flaticon-link23"></span><span class="link-name">Read More</span></a></p>
                </div>
              </div>
            <?php } ?>