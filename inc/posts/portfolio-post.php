              <article <?php post_class( array('archiveProject', 'archiveProject-post', 'projectPost', 'singleProject', 'project', 'projectMain') ) ?> id="project-<?php echo get_the_ID(); ?>">
                <a href="<?php the_permalink(); ?>" class="projectWrap">
                  <?php if ( has_post_thumbnail() ) { $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' ); } else { $fImg = null; } ?>
                  <div class="projectImage" style="background-image: url('<?php echo ( $fImg[0] ? $fImg[0] : '' ); ?>'); --imageWidth: <?php echo ( $fImg[1] ? $fImg[1] : '40' ); ?>; --imageHeight: <?php echo ( $fImg[2] ? $fImg[2] : '15' ); ?>;">
                    <div class="projectInfo">
                      <div class="projectInfo-container">
                        <?php if ( getPrimaryCat( 'project-scope', get_the_ID() ) ){ ?>
                        <p><?php echo getPrimaryCat( 'project-scope', get_the_ID() ); ?></p>
                        <?php } else {} ?>
                        <h2><?php the_title(); ?></h2>
                      </div>
                    </div>
                  </div>
                </a>
              </article>