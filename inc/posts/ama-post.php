          <article <?php post_class( array('archive-post', 'archive-ama-post', 'ama-post', 'single-ama', 'ama', 'post-main') ) ?> id="ama-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>">
              <div class="postWrap">
                <div class="postContent">
                  <h2 clas="postTitle"><?php the_title(); ?></h2>
                  <p class="postMeta">Asked on <?php echo get_the_date(); if ( get_post_meta( get_the_ID(), '_ccdclient_ama_name', true ) ) { ?> by <?php echo get_post_meta( get_the_ID(), '_ccdclient_ama_name', true ); } else { }  ?></p>
                </div>
              </div>
            </a>
          </article>