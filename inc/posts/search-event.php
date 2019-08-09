<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $featImg = $fImg[0];
    $classes = "featured-image has-fi";
  } else { $classes = "no-fi"; }
?>
<article <?php post_class( array('archive-event', 'archive-event-post', 'event-post', 'single-event', 'event', 'event-main', 'clearfix', 'search-result', 'search-' . get_post_type() . '-post', 'single-' . get_post_type(), get_post_type(), 'post-search') ) ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
  <p class="post-type search-label"><?php $obj = get_post_type_object( get_post_type() ); echo $obj->labels->singular_name; ?></p>
  <div class="event-wrap clearfix">
    <div class="event-thumbnail" style="background-image: url('<?php if ( has_post_thumbnail() ) { $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); echo $fImg[0]; } else { /* This will be the default image */ } ?>');">
      <div class="event-tickets">
      <?php
        $types = get_the_terms( get_the_ID(), 'event-type' );
        foreach ($types as $type) {
          echo '<p class="tickets-'.$type->slug.'">' . $type->name.'</p>';
        }
      ?>
      </div>
    </div>
    <div class="event-details">
      <div class="event-name event-row">
        <h2><?php $tl = 30; if ( strlen( get_the_title() ) > $tl ) { echo substr( get_the_title(), 0, ( $tl - 6 ) ) . ' [...]'; } else { the_title(); } ?></h2>
      </div>
      <div class="event-meta event-row clearfix">
        <div class="event-time">
          <p>
            <span class="far fa-calendar-alt"></span>
            <?php echo date( 'F j, Y', $start_tstamp ); ?>
          </p>
        </div>
        <div class="event-location">
          <?php if ( get_post_meta( get_the_ID(), '_ccdclient_eventdetails_location_name', true ) ) { ?><p>
            <span class="fas fa-map-marker-alt"></span>
            <?php echo get_post_meta( get_the_ID(), '_ccdclient_eventdetails_location_name', true ); ?>
          </p><?php } else { } ?>
        </div>
      </div>
      <?php if ( strlen( get_the_excerpt() ) > 0 ){ ?>
      <div class="event-description event-row"><p><?php if ( strlen( get_the_excerpt() ) > 140 ) { echo substr( get_the_excerpt(), 0, 134 ) . ' [...]'; } else { get_the_excerpt(); } ?></p></div>
      <?php } ?>
      <div class="event-link event-row"><p><a href="<?php the_permalink(); ?>" class="read-more-link">Read more</a></p></div>
    </div>
  </div>
</article>
