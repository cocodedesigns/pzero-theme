<div class="post-meta clearfix">
  <div class="post-meta-date">
    <p><span class="fa fa-calendar"></span>
      Posted on <a href="<?php the_permalink(); ?>"><?php echo get_the_date('F j, Y', '', ''); ?></a> by <?php
        if ( cmb2_get_option( 'ccdtheme_settings_blogposts', '_ccdclient_themesettings_pageposts_blogposts_guestposts_enable' ) == 1 ){
          if ( get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_displayname', true ) ){
            echo get_post_meta( get_the_ID(), '_ccdclient_guestblog_details_displayname', true ) . ' (Guest Blogger)';
          } else {
            the_author_posts_link();
          }
        } else {
          the_author_posts_link();
        }
      ?></p>
  </div>
  <div class="post-meta-comments">
    <p>
      <?php if ( comments_open() ){ ?>
      <span class="post-comments-enabled">
        <span class="fa fa-comment"></span>
        <?php
          $number = (int) get_comments_number( get_the_ID() );
          if ( $number > 0 ){
            $css_class = 'comments-link has-comment';
          } else {
            $css_class = 'comments-link no-comment';
          }
          comments_popup_link( 'Leave a comment', '1 comment', '% comments', '', '');
        ?>
      </span>
      <?php } else { ?>
      <span class="post-comments-disabled">
        <span class="fa fa-comment"></span>
        Comments disabled
      </span>
      <?php } ?>
    </p>
  </div>
    <?php /* $cat = get_the_category();
        if ( $cat ){ if ( $cat[0]->term_id != 1 ) { ?>
    <li><span class="post-meta-item post-meta-cats">
        <span class="post-meta-element-title">Posted in</span>
        <a href="<?php echo get_category_link( $cat[0]->term_id ); ?>" title="<?php echo sprintf( __( 'View all posts in %s' ), $cat[0]->name ) ?>"><?php echo $cat[0]->name; ?></a>
      </span></li>
    <?php } } */ ?>
</div>