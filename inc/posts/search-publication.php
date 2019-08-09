<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $featImg = $fImg[0];
    $classes = "featured-image has-fi";
  } else { $classes = "no-fi"; }
?>
<article <?php post_class( array('clearfix', 'search-result', 'search-' . get_post_type() . '-post', 'single-' . get_post_type(), get_post_type(), 'post-search') ) ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
  <p class="post-type search-label"><?php $obj = get_post_type_object( get_post_type() ); echo $obj->labels->singular_name; ?></p>
  <div class="publication clearfix">
    <div class="single-publication" id="publication-<?php the_ID(); ?>">
      <div class="publication-wrap clearfix">
        <div class="publication-cover-wrap publication-element">
          <div class="publication-cover" style="background-image: url('<?php 
            if ( has_post_thumbnail() ) {
                $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
                echo $fImg[0];
            } else {
                echo get_template_directory_uri()."/images/no-publication-preview.jpg";
            } ?>');"></div>
          <?php /*<div class="publication-link">
            <?php echo do_shortcode( '[button link="' . attachment_url_to_postid( get_post_meta( get_the_ID(), '_ccdclient_publication_file', true ) ) . '" style="custom" icon="fas fa-download" action="download" text="Download"]' ); ?>
          </div> */ ?>
        </div>
        <div class="publication-details publication-element">
          <h2 class="publication-title"><?php
            if ( strlen( get_the_title() ) > 40 ) { echo substr( get_the_title(), 0, 36 ) . ' ...'; } else { echo get_the_title(); }
          ?></h2>
          <h3 class="publication-author"><?php
            $author = get_post_meta( get_the_ID(), '_ccdclient_publication_authors', true );
            if ( strlen( $author ) > 40 ) { echo substr( $author, 0, 36 ) . ' ...'; } else { echo $author; }
          ?></h3>
          <p class="publication-meta"><?php 
            if ( get_post_meta( get_the_ID(), '_ccdclient_publication_publisher', true ) ) { echo get_post_meta( get_the_ID(), '_ccdclient_publication_publisher', true ); } else { }
            if ( get_post_meta( get_the_ID(), '_ccdclient_publication_publisher', true ) && get_post_meta( get_the_ID(), '_ccdclient_publication_year', true ) ) { echo ', '; } else { }
            if ( get_post_meta( get_the_ID(), '_ccdclient_publication_year', true ) ) { echo get_post_meta( get_the_ID(), '_ccdclient_publication_year', true ); } else { }
          ?></p>
          <?php
            $string = strip_tags( get_the_content() );
            if ( strlen( get_the_title() ) > 40 && strlen ( $author ) > 40 ){ }
            elseif ( ( strlen( get_the_title() ) > 40 || strlen( $author ) > 40 ) && strlen( $string ) > 100 ){ echo wpautop( substr( $string, 0, 96 ) . ' ...' ); }
            elseif ( ( strlen( get_the_title() ) <= 40 || strlen( $author ) <= 40 ) && strlen( $string ) > 150 ) { echo wpautop( substr( $string, 0, 146 ) . ' ...' ); } else { echo wpautop( $string ); }
          ?>
        </div>
      </div>
    </div>
  </div>
  <a href="<?php the_permalink(); ?>" class="read-more-link block-link">View <?php echo $obj->labels->singular_name; ?></a>
</article>