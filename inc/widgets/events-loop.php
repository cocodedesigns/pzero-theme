<?php wp_enqueue_style('ocp-events-widget', get_template_directory_uri().'/inc/cpt/events.css'); if ( is_front_page() ) { $count = $ocp_options['ocp-home-events-no']; } ?>

    <ul id="ocp_events_list" class="ocp-events-list">
      <?php
        $event_args = array(
          'post_type' => 'event',
          'posts_per_page' => $count,
          'ignore_sticky_posts' => 1,
          'order' => 'ASC',
          'orderby' => 'meta_value',
          'meta_key' => 'ocp_events_startdate',
          'meta_query' => array(
//            'relation' => 'AND',
            0 => array(
              'key' => 'ocp_events_startdate',
              'compare' => '>=',
              'value' => date( 'Y-m-d' ),
              'type' => 'DATE'
            ),
/*            1 => array(
              'key' => 'ocp_events_enddate',
              'compare' => '>',
              'value' => date( 'Y-m-d' ),
              'type' => 'DATE'
            ), */
          )
        );
        $event_query = new WP_Query( $event_args );
        if  ( $event_query->have_posts() ) : while ( $event_query->have_posts() ) : $event_query->the_post();
        $startdate = get_post_meta( get_the_ID(), 'ocp_events_startdate', true );
        $startdate = explode( '-', $startdate );
        $startdate = strtotime($startdate[1].'/'.$startdate[2].'/'.$startdate[0]);
      ?>
        <li class="event" id="event_<?php echo get_the_ID(); ?>">
          <a href="<?php the_permalink(); ?>" class="event-meta clear">
            <div class="event-date">
              <span class="month"><?php echo date( 'M', $startdate ); ?></span>
              <span class="date"><?php echo date( 'd', $startdate ); ?></span>
            </div>
            <div class="event-info">
              <h3 class="event-title"><?php the_title(); ?></h3>
              <div class="event-time event-data"><span class="flaticon-clock96 icon-16"></span> <span class="event-details"><?php
                if ( get_post_meta( get_the_ID(), 'ocp_events_allday', true) ) { echo 'All day'; } else { echo get_post_meta( get_the_ID(), 'ocp_events_starthour', true ).':'.get_post_meta( get_the_ID(), 'ocp_events_startmin', true ).' - '.get_post_meta( get_the_ID(), 'ocp_events_endhour', true ).':'.get_post_meta( get_the_ID(), 'ocp_events_endmin', true ); } ?></span></div>
              <div class="event-location event-data"><span class="flaticon-pin71 icon-16"></span> <span class="event-details"><?php echo get_post_meta( get_the_ID(), 'ocp_events_location', true ); ?></span></div>
            </div>
            <div class="clear"></div>
          </a>
        </li>
      <?php endwhile; wp_reset_postdata(); else : ?>
        <li class="event" id="no-events">
          <div class="event-meta">
            <div class="event-info">
              <h3>There are no forthcoming events.</h3>
            </div>
          </div>
        </li>
      <?php endif; ?>
    </ul>