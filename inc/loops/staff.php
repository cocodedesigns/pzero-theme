<?php
      $fImg = wp_get_attachment_image_src( get_post_meta( get_the_ID(), 'ccd_staff_photo_id', true ), 'author-image' );
      $featImg = $fImg[0];
?>
      <article class="single-piece staff-post staff-profile user-profile staff-member">
        <a href="<?php the_permalink(); ?>">
          <div class="profile-wrap">
            <div class="profile-image profile-picture" style="background-image: url('<?php echo $featImg; ?>');"></div>
            <div class="profile-data-wrap">
              <div class="profile-data">
                <h1><?php echo get_post_meta( get_the_ID(), 'ccd_staff_display_name', true ) ?></h1>
                <h2><?php echo get_post_meta( get_the_ID(), 'ccd_staff_jobtitle', true ) ?></h2>
              </div>
            </div>
          </div>
        </a>
      </article>