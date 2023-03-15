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
      <h1>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ 
          if ( is_category() ) { 
            echo sprintf( __( 'Archive for the &#8216;%s&#8217; category', 'my cat' ), single_cat_title('', false) );
          }
          /* If this is a tag archive */ 
          elseif( is_tag() ) {
            echo sprintf( __( 'Posts tagged &#8216;%s&#8217;', 'my tag' ), single_tag_title('', false) );
          }
          /* If this is a daily archive */
          elseif ( is_day() ) {
            echo sprintf( __( 'Archive for %s', 'my date' ), get_the_time('F jS, Y') );
          }
          /* If this is a monthly archive */
          elseif ( is_month() ) {
            echo sprintf( __( 'Archive for %s', 'my date' ), get_the_time('F, Y') );
          }
          /* If this is a yearly archive */
          elseif ( is_year() ) {
            echo sprintf( __( 'Archive for %s', 'my date' ), get_the_time('Y') );
          }
          /* If this is an author archive */
          elseif ( is_author() ) {
            echo sprintf( __( 'Archive for %s', 'my author' ), get_the_author() );
          }
          /* If this is a paged archive */
          elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
            echo __( 'Blog archives' );
          } ?>
      </h1>
    </div> <!-- .container -->
  </section> <!-- #archive-title -->
  <section id="blog-archive" class="blog-archive archive-page">
    <div class="container">
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