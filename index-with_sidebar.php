<?php 
/**
 * Blog Index Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This is a catch-all template for any pages that do not have a specialised template.
 * You can find out more about the Template Hierarchy at
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * Typically, index.php contains your blog archive template (content that could also be displayed in a home.php file).
 * However, it is used for any content that does not have a specific template.
 */

  get_header();
?>
  <section id="archive-title" class="archive-title page-title">
    <div class="container">
      <h1><?php echo _x( 'Latest News', 'latest news archive title', 'zero-theme' ); ?></h1>
    </div> <!-- .container -->
  </section> <!-- #archive-title -->
  <section id="blog-archive" class="blog-archive archive-page">
    <div class="container row">
      <main id="archive-content" class="blog-posts col-8">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php get_template_part( 'inc/parts/post', 'archive' ); ?>
        <?php endwhile; // Stops looping through the posts in WP_Query ?>
          <?php blogPagination(); ?>
        <?php else : // If there are no posts in the loop ?>
          404
        <?php endif; // Ends the loop ?>
      </main> <!-- #archive-content -->
      <aside id="blog-sidebar" class="col-4">
        <?php get_sidebar(); ?>
      </aside> <!-- #blog-sidebar -->
    </div> <!-- .container -->
  </section> <!-- #blog-archive -->
<?php get_footer(); ?>