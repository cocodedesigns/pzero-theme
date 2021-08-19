<?php get_header(); ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <section id="pageTitle" class="singleTitle pageTitle">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <div id="container" class="pageContainer container">
    <section class="mainContent" id="singlePage">
      <article id="page-<?php the_ID(); ?>" <?php post_class() ?>>
        <div class="featuredImage postImage">
        </div>
        <div class="postContent">
          <div class="entry">
            <?php the_content(); ?>
          </div>
        </div>
      </article>
    </section>
  </div>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>