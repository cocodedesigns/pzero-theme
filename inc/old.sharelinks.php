    <div class="share-post-links post-center-div" id="share-post">
      <p><strong>Share this post</strong></p>
      <ul class="share-buttons share-networks">
        <li class="share-button share-network facebook"><a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-facebook12"></span>
          <span class="share-label">Facebook</span></a></li>
        <li class="share-button share-network twitter"><a href="http://twitter.com/home?status=<?php if ( strlen( get_the_title() ) > 103 ) { $title = substr( get_the_title(), 0, 100 ) . '...'; } else { $title = get_the_title(); } echo urlencode( $title . ' | ' . get_permalink() ); ?>" rel="shadowbox"><span class="share-icon flaticon-social"></span>
          <span class="share-label">Twitter</span></a></li>
        <li class="share-button share-network googleplus"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" rel="shadowbox"><span class="share-icon flaticon-google109"></span>
          <span class="share-label">Google+</span></a></li>
        <?php if ( has_post_format( 'image' ) ) { ?>
          <li class="share-button share-network pinterest"><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo urlencode( catch_that_image() ); ?>&url=<?php echo urlencode( get_permalink() ); ?>&is_video=false&description=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-social40"></span>
            <span class="share-label">Pinterest</span></a></li>
        <?php } elseif ( is_attachment() ) { ?>
          <li class="share-button share-network pinterest"><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo urlencode( wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ); ?>&url=<?php echo urlencode( get_permalink() ); ?>&is_video=false&description=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-social40"></span>
            <span class="share-label">Pinterest</span></a></li>
        <?php } else { } ?>
        <li class="share-button share-network linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>&source=<?php echo urlencode( get_bloginfo('url') ); ?>" rel="shadowbox"><span class="share-icon flaticon-linkedin11"></span>
          <span class="share-label">LinkedIn</span></a></li>
        <li class="share-button share-network stumbleupon"><a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-stumbleupon"></span>
          <span class="share-label">StumbleUpon</span></a></li>
        <li class="share-button share-network reddit"><a href="http://www.reddit.com/submit?url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-reddit1"></span>
          <span class="share-label">Reddit</span></a></li>
        <?php if ( has_post_format( 'link' ) ) { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share/link?url=<?php echo urlencode( get_permalink() ); ?>&name=<?php echo urlencode( get_the_title() ); ?>&description=<?php echo urlencode( the_excerpt() ); ?>" rel="shadowbox"><span class="share-icon flaticon-logotype1"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } elseif ( has_post_format( 'quote' ) ) { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share/quote?quote=<?php echo urlencode( get_the_content() ); ?>&source=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-logotype1"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } else { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon flaticon-logotype1"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } ?>
      </ul>
    </div>
    <script>
      $('.share-buttons .share-button a').click(function(e){
        e.preventDefault();
        window.open($(this).attr('href'), 'sharePU', 'width=650,height=450,scrollbars=auto');
      });
    </script>