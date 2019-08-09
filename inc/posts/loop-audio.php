<div class="single-post-wrap singlePost-loop">
  <?php
    if ( has_post_thumbnail() || get_post_meta( get_the_ID(), 'ccd_audio_track', true ) != "" ) {
      $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    ?>
    <div class="featured-image post-image featuredImage" style="background-image: url('<?php echo $fImg[0]; ?>'); --featWidth: <?php echo $fImg[1]; ?>; --featHeight: <?php echo $fImg[2]; ?>;">
    </div>
    <div class="embed-container musicEmbed">
      <?php echo wp_oembed_get( get_post_meta( get_the_ID(), 'ccd_audio_track', true ) ); ?>
    </div>
  <?php } ?>
  <div id="postMeta" class="container clearfix">
    <div class="postMeta-item" id="postMeta-postedUnder">
      <?php 
        $cats = get_the_category();
        $primary = get_post_meta( get_the_ID(), 'epc_primary_category', true );
        // Check if there are categories.
        if ( $cats && $cats[0]->term_id != "1" ){ ?>
      <p class="posted-under titleMeta">Posted under:</p>
      <p class="posted-under titleMetaInfo"><?php 
        $cat = ''; // I have this set in some shortcodes
        if (!isset($cat) || $cat == '') {
          if ( class_exists('WPSEO_Primary_Term') ) {
            // Show the post's 'Primary' category, if this Yoast feature is available, & one is set. category can be replaced with custom terms
            $primary = new WPSEO_Primary_Term( 'category', get_the_id() );
            $primary = $primary->get_primary_term();
            $term    = get_term( $primary );
            if ( is_wp_error( $term ) ) {
                $cats = get_the_terms( get_the_ID(), 'category' );
                $cat = $cats[0];
            } else {
                $cat = $term;
            }
          } else {
            $cats = get_the_terms( get_the_ID(), 'category' );
            $cat = $cats[0];
          }
        }
        echo '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( 'View all posts in %s' ), $cat->name ) . '">' . $cat->name . '</a>';
      ?></p>
      <?php } ?>
    </div>
    <div class="postMeta-item" id="postMeta-postedOn">
      <p class="titleMeta posted-on">Posted:</p>
      <p class="posted-on titleMetaInfo"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) )?></p>
    </div>
    <?php if ( strtotime( get_the_time('Y-m-d') ) !== strtotime( get_post_modified_time('Y-m-d') ) ){ ?>
    <div class="postMeta-item" id="postMeta-modifiedOn">
      <p class="titleMeta modified-on">Modified:</p>
      <p class="modified-on titleMetaInfo"><?php echo timeago( get_gmt_from_date(get_post_modified_time('Y-m-d G:i:s')) )?></p>
    </div>
    <?php } else { } ?>
  </div>
  <div class="post-content-wrap singlePost-loopContent">
    <div class="post-content loopContent">
      <?php the_content(); ?>
    </div>
  </div>
</div>