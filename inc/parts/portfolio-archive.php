<?php 
/**
 * Portfolio Template Part
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.3
 * 
 * This is a template part used in the 'portfolio' custom post type. Used in archive-portfolio.php.
 * You can find out more at
 * @link https://developer.wordpress.org/reference/functions/get_template_part/
 */
?>
<article id="project-<?php the_ID(); ?>" <?php post_class('col-4') ?>>
  <?php 
    if ( has_post_thumbnail() ) {
      $featured = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
  ?>
    <figure class="featured-image post-image" style="background-image: url('<?php echo $featured[0]; ?>');"></figure>
  <?php } else { ?>
    <figure class="featured-image no-image">
      <span class="fa-solid fa-code"></span>
    </figure> <!-- .featured-image.no-image -->
  <?php } ?>
  <div class="post-content">
    <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    <?php if ( !has_post_thumbnail() ) { // Hides post excerpt if there is a featured image ?>
    <div class="entry">
      <?php the_excerpt( __( 'Read the rest of this entry »', 'textdomain' ) ); ?>
    </div> <!-- .entry -->
    <?php } ?>
  </div> <!-- .post-content -->
</article> <!-- #project-{post_id} -->