<?php get_header(); ?>
  <section id="pageTitle" class="archiveTitle pageTitle">
    <div class="container">
      <h1>Latest News</h1>
    </div>
  </section>
  <div id="container" class="pageContainer container">
    <section class="mainContent" id="blogArchive">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
        <?php 
          if ( has_post_thumbnail() ) {
            $featured = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
          ?>
            <div class="featuredImage postImage" style="background-image: url('<?php echo $featured[0]; ?>'); --featWidth: <?php echo $featured[1]; ?>; --featHeight: <?php echo $featured[2]; ?>;">></div>
          <?php } ?>
          <div class="postContent">
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
            <div class="entry">
              <?php the_excerpt(); ?>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
        <?php zeroTheme_blogPagination(); ?>
      <?php else : ?>
        <h2>Not Found</h2>
      <?php endif; ?>
    </section>
    <?php get_sidebar(); ?>
  </div>
<?php get_footer(); ?>