<div class="post-meta clearfix">
  <div class="post-meta-date">
    <p><span class="fa fa-calendar"></span>
      Posted on <a href="<?php the_permalink(); ?>"><?php echo get_the_date('F j, Y', '', ''); ?></a> by <?php the_author_posts_link(); ?></p>
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
</div>