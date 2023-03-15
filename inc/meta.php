<div class="postMeta clearfix">
  <div class="postMeta-date metaElement">
    <p>Posted on <a href="<?php the_permalink(); ?>"><?php echo get_the_date('F j, Y', '', ''); ?></a> by <?php the_author_posts_link(); ?></p>
  </div>
  <div class="postMeta-comments metaElement">
    <p>
      <?php if ( comments_open() ){ ?>
      <span class="postComments-enabled">
        <?php
          $number = (int) get_comments_number( get_the_ID() );
          if ( $number > 0 ){
            $css_class = 'commentsLink hasComment';
          } else {
            $css_class = 'commentsLink noComment';
          }
          comments_popup_link( 'Leave a comment', '1 comment', '% comments', '', '');
        ?>
      </span>
      <?php } else { ?>
      <span class="postComments-disabled">
        Comments disabled
      </span>
      <?php } ?>
    </p>
  </div>
</div>