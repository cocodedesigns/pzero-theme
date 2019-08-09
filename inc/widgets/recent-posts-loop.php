<?php wp_enqueue_style('ocp-posts-widget', get_template_directory_uri().'/inc/widgets/recent-posts.css'); if ( is_front_page() ) { $count = $ocp_options['ocp-home-posts-no']; } else { $count = $wcount; } ?>

    <ul id="ocp_posts_list" class="ocp-posts-list">
      <?php
        if( is_author() ) {
            $recent_args = array(
              'post_type' => 'post',
              'posts_per_page' => $count,
              'author' => get_the_author_meta( 'ID' )
            );
        }
        else {
            $recent_args = array(
              'post_type' => 'post',
              'posts_per_page' => $count
            );
        }
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
      ?>
        <li class="recent-posts" id="recent_<?php echo get_the_ID(); ?>">
          <a href="<?php the_permalink(); ?>" class="recent-meta clear">
            <div class="recent-date">
              <span class="month"><?php the_time('M') ?></span>
              <span class="date"><?php the_time('j') ?></span>
            </div>
            <div class="recent-info">
              <h3 class="recent-title"><?php the_title(); ?></h3>
            </div>
            <div class="clear"></div>
          </a>
        </li>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <li class="recent" id="no-posts">
          <div class="recent-meta">
            <div class="recent-info">
              <h3>There are no forthcoming posts.</h3>
            </div>
          </div>
        </li>
      <?php endif; ?>
    </ul>