<div id="post-content">
  <div class="post-content post-entry entry">
  <?php if ( get_post_meta( get_the_ID(), 'ccd_link_thumb', true ) == "yes" ) { ?>
      <div class="post-element featured-image post-image" style="background-image: url('http://s.wordpress.com/mshots/v1/<?php echo urlencode( get_post_meta( get_the_ID(), 'ccd_link_url', true ) ); ?>?w=1024');"></div>
      <?php } ?><p><a href="<?php echo get_post_meta(get_the_ID(), 'ccd_link_url', true); ?>" target="_blank" class="read-more-link link-post post-link-button link-button"><span class="icon flaticon-link23"></span><span class="link-name">Visit <?php
    if ( get_post_meta( get_the_ID(), 'ccd_link_title', true ) ) { echo get_post_meta( get_the_ID(), 'ccd_link_title', true ); }
    else { echo get_post_meta( get_the_ID(), 'ccd_link_url', true ); } ?></span></a></p>
    <?php the_content(); ?>
  </div>
</div>
