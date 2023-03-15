<?php 
/**
 * Template Name: Custom Page Template
 * Template Post Type: page
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.3
 * 
 * You can use any file name for custom page templates, as long as the headers above are used.
 * However, using the format template-{template_name}.php may help distinguish these files from others in your theme.
 * Or not. I'm not the boss of you.
 * 
 * DO NOT use page- as a template prefix, as WordPress uses this as a specialised page template. 
 * page-{slug}.php and page-{id}.php would be assigned to pages with that specific slug or ID instead of the custom template.
 * That's not me telling you, that's WordPress.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <section id="page-title" class="page-title">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <section id="page-<?php the_ID(); ?>" class="single-page container">
    <div id="page-content" <?php post_class() ?>>
      <article class="post-content">
        <div class="entry">
          <?php the_content(); ?>
        </div>
      </article>
    </div>
  </section>
<?php 
  endwhile; endif; 
  get_footer(); 
?>