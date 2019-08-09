<?php if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy') ) {
    if ( function_exists( 'sharing_display' ) ) {
        sharing_display( '', true );
    }

    if ( class_exists( 'Jetpack_Likes' ) ) {
        $custom_likes = new Jetpack_Likes;
        echo $custom_likes->post_likes( '' );
    }
} else { ?>
    <div class="share-post-links post-center-div share-this">
      <?php if ( is_singular( 'post' ) ){ ?>
          <h2 class="share-this-title">Share this post</h2>
      <?php } elseif ( is_singular( 'event' ) ){ ?>
          <h2 class="share-this-title">Share this event</h2>
      <?php } elseif ( is_singular( 'job' ) ){ ?>
          <h2 class="share-this-title">Share this advert</h2>
      <?php } else{ ?>
          <h2 class="share-this-title">Share this</h2>
      <?php } ?>
      <ul class="share-buttons share-networks">
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['facebook'] == '1' ){ ?>
        <li class="share-button share-network facebook"><a href="http://www.facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-facebook"></span>
          <span class="share-label">Facebook</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['twitter'] == '1' ){ ?>
        <li class="share-button share-network twitter"><a href="http://twitter.com/home?status=<?php if ( strlen( get_the_title() ) > 103 ) { $title = substr( get_the_title(), 0, 100 ) . '...'; } else { $title = get_the_title(); } echo urlencode( $title . ' | ' . get_permalink() ); ?>" rel="shadowbox"><span class="share-icon fab fa-twitter"></span>
          <span class="share-label">Twitter</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['googleplus'] == '1' ){ ?>
        <li class="share-button share-network googleplus"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>" rel="shadowbox"><span class="share-icon fab fa-google-plus"></span>
          <span class="share-label">Google+</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['whatsapp'] == '1' ){ ?>
        <li class="share-button share-network whatsapp"><a href="whatsapp://send?text=<?php echo urlencode( get_permalink() ); ?>" data-action="share/whatsapp/share"><span class="share-icon fab fa-whatsapp"></span>
          <span class="share-label">Whatsapp</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['pinterest'] == '1' ){ ?>
        <?php if ( has_post_format( 'image' ) ) { ?>
          <li class="share-button share-network pinterest"><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php /* echo urlencode( catch_that_image() ); */ ?>&url=<?php echo urlencode( get_permalink() ); ?>&is_video=false&description=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-pinterest-p"></span>
            <span class="share-label">Pinterest</span></a></li>
        <?php } elseif ( is_attachment() ) { ?>
          <li class="share-button share-network pinterest"><a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo urlencode( wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) ); ?>&url=<?php echo urlencode( get_permalink() ); ?>&is_video=false&description=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-pinterest-p"></span>
            <span class="share-label">Pinterest</span></a></li>
        <?php } else { } ?>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['linkedin'] == '1' ){ ?>
        <li class="share-button share-network linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>&source=<?php echo urlencode( get_bloginfo('url') ); ?>" rel="shadowbox"><span class="share-icon fab fa-linkedin"></span>
          <span class="share-label">LinkedIn</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['stumbleupon'] == '1' ){ ?>
        <li class="share-button share-network stumbleupon"><a href="http://www.stumbleupon.com/submit?url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-stumbleupon"></span>
          <span class="share-label">StumbleUpon</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['reddit'] == '1' ){ ?>
        <li class="share-button share-network reddit"><a href="http://www.reddit.com/submit?url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-reddit-alien"></span>
          <span class="share-label">Reddit</span></a></li>
        <?php } ?>
        <?php if ( $ccdClient_options['ccdClient-share-showlinks']['tumblr'] == '1' ){ ?>
        <?php if ( has_post_format( 'link' ) ) { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share/link?url=<?php echo urlencode( get_permalink() ); ?>&name=<?php echo urlencode( get_the_title() ); ?>&description=<?php echo urlencode( the_excerpt() ); ?>" rel="shadowbox"><span class="share-icon fab fa-tumblr"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } elseif ( has_post_format( 'quote' ) ) { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share/quote?quote=<?php echo urlencode( get_the_content() ); ?>&source=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-tumblr"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } else { ?>
          <li class="share-button share-network tumblr"><a href="http://www.tumblr.com/share?v=3&u=<?php echo urlencode( get_permalink() ); ?>&t=<?php echo urlencode( get_the_title() ); ?>" rel="shadowbox"><span class="share-icon fab fa-tumblr"></span>
            <span class="share-label">Tumblr</span></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
    <script>
      $('.share-buttons .share-button a').click(function(e){
        e.preventDefault();
        window.open($(this).attr('href'), 'sharePU', 'width=650,height=450,scrollbars=auto');
      });
    </script>
<?php } ?>