          <div class="single-post-divider"></div>
          <div class="post-meta-data post-center-div">
            <?php if ( get_post_meta( get_the_ID(), 'epf_post_source_url', true ) ) { ?>
            <p><span class="meta-icon flaticon-source2 icon-16"></span><span class="meta-content">Originally posted on <strong class="highlight-info"><?php if ( get_post_meta( get_the_ID(), 'epf_post_source_name', true ) != "" ) { echo '<a href="'.get_post_meta( get_the_ID(), 'epf_post_source_url', true ).'" target="_blank">'.get_post_meta( get_the_ID(), 'epf_post_source_name', true ).'</a>'; } else { echo '<a href="'.get_post_meta( get_the_ID(), 'epf_post_source_url', true ).'" target="_blank">'.get_post_meta( get_the_ID(), 'epf_post_source_name', true ).'</a>'; } ?></strong>.</span></p>
            <?php } else { } ?>
            <p><span class="meta-icon flaticon-weekly3 icon-16"></span><span class="meta-content">Posted on <strong class="highlight-info"><?php echo get_the_date('jS M y', '', ''); ?></strong></span></p>
            <div class="clear"></div>
            <p><span class="meta-icon flaticon-folder5 icon-16"></span><span class="meta-content">Posted under <strong class="highlight-info"><?php the_category(', ') ?></strong></span></p>
            <div class="clear"></div>
            <?php the_tags( '<p><span class="meta-icon flaticon-tagging icon-16"></span><span class="meta-content">Tagged with: <strong class="highlight-info">', ', ', '</strong></span></p>'); ?>
            <div class="clear"></div>
          </div>