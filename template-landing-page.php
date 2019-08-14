<?php 
/*
Template Name: Landing Page Template
Template Post Type: page
*/

get_header(); ?>
  <div id="landing-page-container" class="landing-page-container">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="so-content">
      <div class="title-padding"></div>
      <div class="container">
        <div id="landing-page-<?php the_ID(); ?>" <?php post_class( array('entry', 'landing-page', 'landing-page-wrap', 'post', 'post-wrap', 'outer-wrap', 'padded', 'page-wrapper' ) ); ?>>
          <div class="page-content <?php echo ( siteorigin_panels_render( $post_id = $page_data->ID ) ? 'uses-siteorigin' : 'standard-page' ); ?>">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
<?php get_footer(); ?>
