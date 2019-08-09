<?php
  if ( has_post_thumbnail() ) {
    $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $featImg = $fImg[0];
    ?>
    <div class="featured-image post-image" style="background-image: url('<?php echo $featImg; ?>');"></div>
    <?php
  }
?>
<?php include TEMPLATEPATH . '/inc/meta.php'; ?>
<div id="post-content">
  <div class="post-content post-entry entry">
  <?php
    if ( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) != 'select' ) {
      // Check if background image
      if ( get_post_meta( get_the_ID(), 'ccd_quote_img', true ) ) {
        $back = get_post_meta( get_the_ID(), 'ccd_quote_img', true );
      } else { $back = '#DFDFDF'; }
      // If it is a quote
      if ( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == "quote" ){
      echo do_shortcode( '[showquote back="'.$back.'" name="'.get_post_meta( get_the_ID(), 'ccd_quote_attr', true ).'"]'.wpautop( get_post_meta( get_the_ID(), 'ccd_quote_text', true ) ).'[/showquote]' );
      // If it's an embedded quote
      } else { ?>
      <div class="quote-wrap quote-embedded quote-embed-<?php echo get_post_meta( get_the_ID(), 'ccd_quote_format', true ); ?>">
        <?php
        // If it's from Facebook
        if( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == "facebook" ){ $embednet = 'Facebook'; $embedsrc = get_post_meta( get_the_ID(), 'ccd_quote_fburl', true ); $embedicon = 'flaticon-facebook12'; }
        // If it's from Twitter
        elseif( get_post_meta( get_the_ID(), 'ccd_quote_format', true ) == "twitter" ){ $embednet = 'Twitter'; $embedsrc = get_post_meta( get_the_ID(), 'ccd_quote_twurl', true ); $embedicon = 'flaticon-social-1'; }
        // Otherwise
        else { $embedsrc = ''; $embedicon = ''; }
        // Run the embed process
        echo apply_filters( 'the_content', $embedsrc ); ?>
        <p class="social-embed-icon"><a href="<?php echo $embedsrc; ?>" target="_blank"><span class="embed-icon-icon <?php echo $embedicon; ?>"></span> <span class="embed-icon-text-label"><span class="embed-icon-text-label-inner">View on <?php echo $embednet; ?></span></span></a></p>
      </div>
      <?php }
    } ?>
    <?php the_content(); ?>
  </div>
</div>
