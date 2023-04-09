<?php 
/**
 * 404 Page Not Found Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template applies to all pages without a specialised page template or a custom page template.
 * To create a specialised page template, save this as page-{slug}.php or page-{id}.php, as required.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/themes/functionality/404-pages/
 */

  get_header();
?>
  <section id="error-page" class="error-page container">
    <main id="page-content" <?php post_class() ?>>
      <section class="title-section">
        <h1 class="page-title"><?php _e( 'Error 404 - Page Not found', 'zero-theme' ); ?></h1>
      </section> <!-- .title-section -->
      <section class="page-content">
        <article class="entry">
          <p><?php _e( 'Seems the page you were looking for can\'t be found on our site.  It\'s either been deleted, the URL might be wrong, or you might have clicked on the wrong link.', 'zero-theme' ); ?></p>
          <p><?php _e( 'Check the URL or use the menu above to try again.  You can also use the search form below.  If you still can\'t find the page you\'re looking for, get in touch with us and let us know which URL you are typing so we can fix it on our side.', 'zero-theme' ); ?></p>
        </article> <!-- .entry -->
        <section id="error-search" class="searchbox error-search">
          <?php echo get_search_form(); ?>
        </section> <!-- #error-search -->
      </section> <!-- .page-content -->
    </main> <!-- #page-content -->
  </section> <!-- #error-page -->
<?php get_footer(); ?>