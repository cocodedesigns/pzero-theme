<?php 
/**
 * Blog Archive Template (single column, without sidebar)
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.3
 * 
 * This is a catch-all archive template for any archive pages that do not have a specialised template or a custom post template.
 * You can find out more about the Template Hierarchy at
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * To create a post archive for a custom post type, save this as archive-{post_type}.php.
 * An example can be found in archive-portfolio.php, which works with the 'portfolio' custom post type in the PLUGIN.
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
    <div class="container row">
      <main id="archive-content" class="blog-posts">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php 
          /**
           * Loads a reusable section of code from within your child theme.
           * If the template part is not within your child theme, it will look within the parent theme.
           * 
           * @link https://developer.wordpress.org/reference/functions/get_template_part/
           * 
           * @param string $slug      The slug name for the generic template. Required.
           * @param string $name      The name of the specialised template.
           * @param array $args       Additional arguments to be passed through to the template.
           * 
           * The function looks for the file {$slug}-{$name}.php.
           * In this instance, it looks for inc/parts/post-archive.php
           */
            get_template_part( 'inc/parts/post', 'archive' ); ?>
        <?php endwhile; // Stops looping through the posts in WP_Query ?>
          <?php blog_archive_pagination(); ?>
        <?php else : // If there are no posts in the loop ?>
          404
        <?php endif; // Ends the loop ?>
      </main> <!-- #archive-content -->
    </div> <!-- .container -->
  </section> <!-- #blog-archive -->
<?php get_footer(); ?>