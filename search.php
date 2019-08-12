<?php get_header(); ?>
  <section id="pageTitle" class="archiveTitle pageTitle">
    <div class="container">
      <h1>Search Results</h1>
    </div>
  </section>
  <div id="container" class="searchArchive pageContainer container">
    <section class="mainContent" id="searchArchive">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="search-<?php the_ID(); ?>" <?php post_class() ?>>
          <div class="postTitle">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </div>
          <div class="postPermalink">
            <p><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
          </div>
          <div class="postExcerpt"><?php echo wpautop( get_the_excerpt() ); ?></div>
				  <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
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
