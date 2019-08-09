      <ul id="share-links">
        <li id="share"></li>
        <li id="facebook"><a title="Facebook" href="http://facebook.com/dialog/feed?link=<?php urlencode(the_permalink()); ?>" data-name="<?php the_title(); ?>" data-picture="<?php echo $image_url; ?>" data-caption="I just read <?php the_title(); ?> at <?php the_permalink(); ?>" data-redir="<?php bloginfo('template_url'); ?>/closeDialog.html">Facebook</a></li>
        <li id="twitter"><a title="Tweet" href="http://twitter.com/intent/tweet?url=<?php urlencode(the_permalink()); ?>" data-tweet="<?php the_title(); ?>" data-via="WeAreCCD_UK">Twitter</a></li>
        <li id="googleplus"><a title="Google+" href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>">Google+</a></li>
        <li id="share-url">[SHARE URL]</li>
      </ul>