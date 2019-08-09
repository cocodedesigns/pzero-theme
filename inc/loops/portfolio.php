<?php
      if ( has_post_thumbnail() ) {
          $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
          $featImg = $fImg[0];
      }
?>
      <article <?php post_class( array( 'single-project', 'portfolio-widget' ) ); ?> id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo $featImg; ?>');">
          <div class="project-data">
            <div class="project-title"><p><?php the_title(); ?></p></div>
            <span class="project-button view-project block-link flaticon-magnifier13"></span>
          </div>
        </a>
      </article>