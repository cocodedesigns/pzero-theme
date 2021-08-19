<?php get_header(); ?>
  <section id="pageTitle" class="archiveTitle pageTitle">
    <div class="container">
      <h1>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ 
          if (is_category()) { ?>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category<?php }
          /* If this is a tag archive */ 
          elseif( is_tag() ) { ?>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;<?php }
          /* If this is a daily archive */
          elseif (is_day()) { ?>Archive for <?php the_time('F jS, Y'); ?><?php }
          /* If this is a monthly archive */
          elseif (is_month()) { ?>Archive for <?php the_time('F, Y'); ?><?php }
          /* If this is a yearly archive */
          elseif (is_year()) { ?>Archive for <?php the_time('Y'); ?><?php }
          /* If this is an author archive */
          elseif (is_author()) { ?>Author Archive<?php }
          /* If this is a paged archive */
          elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>Blog Archives<?php } ?>
      </h1>
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
            <div class="featuredImage postImage" style="background-image: url('<?php echo $featured[0]; ?>');">></div>
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
        <?php blogPagination(); ?>
      <?php else : ?>
        <h2>Not Found</h2>
      <?php endif; ?>
    </section>
    <?php get_sidebar(); ?>
  </div>
<?php get_footer(); ?>