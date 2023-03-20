<?php 
/**
 * Search Results Page Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template applies to all pages without a specialised page template or a custom page template.
 * To create a specialised page template, save this as page-{slug}.php or page-{id}.php, as required.
 * 
 * For more information, check out
 * @link https://wordpress.org/documentation/article/create-a-search-page/
 */

  get_header();
?>
<section id="serp-title" class="serp-title single-title">
  <div class="container">
    <h1><?php echo _x( 'Search Results', 'search results archive title', 'zero-theme' ); ?></h1>
  </div> <!-- .container -->
</section> <!-- #serp-title -->

<section id="serp-page" class="single-page serp-page serp">
  <main id="page-content" class="container">
    <article class="serp-results">
      <div class="entry">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <article <?php post_class( array('search-result') ); // Lists all classes for the post and adds 'search-result' ?> id="result-<?php echo get_post_type() . '_' . get_the_ID(); ?>">
            <h2><a href="<?php the_permalink(); ?>" class="" rel="nofollow"><?php the_title(); ?></a></h2>
            <p class="postPermalink"><a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_permalink(); ?></a></p>
            <div class="entry">
              <?php the_excerpt(); ?>
            </div> <!-- .entry -->
          </article> <!-- result-{post_type}_{post_id} -->
        <?php endwhile; 
          blogPagination();
          else : ?>
          <h2>No posts found.</h2>
        <?php endif; ?>
      </div> <!-- .entry -->
    </article> <!-- .serp-results -->
  </main> <!-- #page-content -->
</section> <!-- #serp-page -->
<?php 
  get_footer(); 
?>
