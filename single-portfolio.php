<?php 
/**
 * Custom Post Type ('portfolio') - Single Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template applies to all pages without a specialised page template or a custom page template.
 * To create a specialised page template, save this as page-{slug}.php or page-{id}.php, as required.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 */

  get_header();
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>
  <section id="project-title" class="project-title page-title single-title">
    <div class="container">
      <h1 class="title"><?php the_title(); ?></h1>
    </div> <!-- .container -->
  </section> <!-- #project-title -->

  <section id="project-<?php the_ID(); ?>" class="single-project page-container">

    <div class="container row">

      <main id="page-content" <?php post_class( array('col-8') ); // Lists all classes for the post, and adds the 'col-8' CSS class ?>>

        <?php if ( has_post_thumbnail() ) {
          /**
           * @var $featured - Returns attachment source as an array, based on an ID number.
           *                  get_post_thumbnail_id( get_the_ID() ) gets the ID of the featured image linked to the post ID.
           *                  $featured[0] - Image URL
           *                  $featured[1] - Image width in pixels
           *                  $featured[2] - Image height in pixels
           */
          $featured = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        ?>
        <figure class="featured-image">
          <img src="<?php echo $featured[0]; ?>" width="<?php echo $featured[1]; ?>" height="<?php echo $featured[2]; ?>" />
        </figure> <!-- .featured-content -->
        <?php } ?>

        <article class="project-content">
          <div class="entry">
            <?php the_content(); ?>
          </div> <!-- .entry -->
        </article> <!-- .project-content -->

      </main> <!-- #page-content -->

      <aside id="project-sidebar" class="col-4">
        <?php if ( !empty( get_post_meta( get_the_ID(), 'client_name', true ) ) ){ ?>
        <!-- Client information -->
        <h6 class="project-meta meta-title client">Client:</h6>
        <p class="project-meta meta-data client"><?php echo get_post_meta( get_the_ID(), 'client_name', true ); ?></p>
        <?php } ?>

        <?php if ( !empty( get_post_meta( get_the_ID(), 'client_url', true ) ) ){ ?>
        <!-- Website link -->
        <h6 class="project-meta meta-title website">Website:</h6>
        <p class="project-meta meta-data website"><a href="<?php echo get_post_meta( get_the_ID(), 'client_url', true ); ?>" 
          target="<?php echo get_post_meta( get_the_ID(), 'is_external', true ); ?>" 
          rel="<?php if ( get_post_meta( get_the_ID(), 'nofollow', true ) === '1' ){
            echo 'nofollow,';
          }
          if ( get_post_meta( get_the_ID(), 'noindex', true ) === '1' ) {
            echo 'noindex';
          } ?>"><?php echo get_post_meta( get_the_ID(), 'client_url', true ); ?></a></p>
        <?php } ?>

        <!-- Services custom taxonomy -->
        <h6 class="project-meta meta-title services">Services:</h6>
        <p class="project-meta meta-data services">
          <?php 
            $services_arr = get_the_terms( get_the_ID(), 'project_services' );
            $services = join(', ', wp_list_pluck($services_arr, 'name'));
            echo $services;
          ?>
        </p>
      </aside> <!-- #project-sidebar -->

    </div>

  </section> <!-- #project-{page_id} -->
<?php 
  endwhile; endif; 
  get_footer(); 
?>