<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $featImg = $fImg[0];
    $classes = "featured-image has-fi";
  } else { $classes = "no-fi"; }
  $ancestors = get_post_ancestors( get_the_ID() );
?>
<article <?php post_class( array('clearfix', 'search-result', 'search-' . get_post_type() . '-post', 'single-' . get_post_type(), get_post_type(), 'post-search') ) ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
  <p class="post-type search-label"><?php $obj = get_post_type_object( get_post_type() ); echo $obj->labels->singular_name; ?></p>
  <h2><?php the_title(); ?></h2>
  <ul class="breadcrumbs">
    <li class="homeLink breadcrumbLink"><a href="<?php echo get_option('home'); ?>/"><span class="fas fa-home"></span></a></li>
  <?php 
    $ancestors = array_reverse( $ancestors );
    foreach ( $ancestors as $ancestor ){
      echo '<li class="breadcrumbLink"><a href="' . get_the_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li>';
    } ?>
  </ul>
  <div class="search-data clearfix <?php echo $classes; ?>">
    <?php if ( has_post_thumbnail() ) { ?><div class="featured-image" style="background-image: url('<?php echo $featImg; ?>')"></div><?php } ?>
    <div class="search-content">
      <div class="search-meta">
        <?php if ( get_post_type() == "event" ){ ?>
        <div class="event-time"><p><span class="fa fa-calendar"></span> <?php 
          $startdate = get_post_meta( get_the_ID(), 'ccdClient_events_startdate', true );
          $startdate = explode( '-', $startdate );
          $eventallday = get_post_meta( get_the_ID(), 'ccdClient_events_allday', true );
          if ( $eventallday == '1' ) { $starthour = '00'; $startmin = '00'; } else {
            $starthour = get_post_meta( get_the_ID(), 'ccdClient_events_starthour', true );
            $startmin = get_post_meta( get_the_ID(), 'ccdClient_events_startmin', true );
          }
          $startdatetime = strtotime($startdate[1].'/'.$startdate[2].'/'.$startdate[0].' '.$starthour.':'.$startmin.':00'); 

          echo date( 'F j, Y', $startdatetime ); ?></p></div>
        <?php
        } elseif ( get_post_type() == "post" ){
          // If blog post
          include TEMPLATEPATH . '/inc/meta.php';
        } else {
          // Else leave blank
        } ?>
      </div>
      <div class="entry">
        <p><?php echo setwordlimit_excerpt(25); ?></p>
      </div>
    </div>
  </div>
  <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
</article>