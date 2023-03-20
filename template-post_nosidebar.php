<?php 
/**
 * Template Name: No Sidebar
 * Template Post Type: post
 * 
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.3
 * 
 * You can use any file name for custom post templates, as long as the headers above are used.
 * However, using the format template-{template_name}.php may help distinguish these files from others in your theme.
 * Or not. I'm not the boss of you.
 * 
 * DO NOT use single- as a template prefix, as WordPress uses this for custom post types. 
 * single-{post_type}.php would be assigned to pages with that specific post_type instead of the default post template.
 * That's not me telling you, that's WordPress.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-page-templates-for-specific-post-types
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <section id="post-title" class="page-title">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div> <!-- .container -->
  </section> <!-- #post-title -->

  <section id="post-<?php the_ID(); ?>" class="single-post container">
    <main id="post-content" <?php post_class() ?>>

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

      <article class="post-content">
          
        <section class="post-meta">
          <?php include ( STYLESHEETPATH . '/inc/meta.php' ); ?>
        </section> <!-- .post-meta -->

        <section class="entry">
          
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

        </section> <!-- .entry -->

        <section id="post-categories" class="taxonomy-section section-categories">
          <?php
            /**
             * Gets the categories for this post.
             * If no ID number is declared, the function uses this post's ID number.
             */
            $categories = get_the_category();

            /**
             * Checks if the number of terms in @param array $categories is more than 0 before displaying the results.
             * Excludes queries where there is only one category AND the category is 'Uncategorised' (term_id 1).
             */
            if ( count( $categories ) > 0 && !( count( $categories ) == 1 && $categories[0]->term_id == 1 ) ){
          ?>
            <h3 class="section-title title-categories">Posted under:</h3>

            <ul class="taxonomy-list categories">
              <?php foreach( $categories as $category ) {
                if ( $category->term_id != 1 ){ // Checks if the category is NOT 'Uncategorised' (term_id 1) ?>
                <li class="list-item category">
                  <a href="<?php echo get_category_link( $category->term_id ); ?>" class="item-link category-link" id="cat-<?php echo $category->term_id; ?>">
                    <?php echo $category->name; ?>
                  </a>
                </li> <!-- .list-item.category -->
              <?php } // Ends 'Uncategorised' conditional
              } // Ends category foreach ?>
            </ul> <!-- .taxonomy-list -->

          <?php } else { } // Ends category conditional ?>
        </section> <!-- #post-categories -->

        <section id="post-tags" class="taxonomy-section section-tags">
          <?php
            /**
             * Gets the tags for this post.
             * If no ID number is declared, the function uses this post's ID number.
             */
            $tags = get_the_tags();

            /**
             * Checks if the @param array $tags exists.
             */
            if ( !empty( $tags ) && count( $tags ) > 0 ){
          ?>

            <h3 class="section-title title-tags">Tagged with:</h3>

            <ul class="taxonomy-list tags">
              <?php foreach( $tags as $tag ) { ?>
                <li class="list-item tag">
                  <a href="<?php echo get_tag_link( $tag->term_id ); ?>" class="item-link tag-link" id="tag-<?php echo $tag->term_id; ?>" title="<?php echo $tag->name; ?>">
                    <?php echo $tag->name; ?>
                  </a>
                </li> <!-- .list-item.tag -->
              <?php } // Ends tag foreach ?>
            </ul> <!-- .taxonomy-list.tags -->

          <?php } else { } // Ends tag conditional ?>
        </section> <!-- #post-tags -->

        <section id="post-navigation" class="navigation post-links">
          <div class="previous_link"><?php previous_post_link('Previous link: %link') ?></div>
          <div class="next_link"><?php next_post_link('Next link: %link') ?></div>
        </section> <!-- #post-navigation -->

        <section id="post-comments" class="comments">
          <?php comments_template(); ?>
        </section> <!-- #post-comments -->

      </article> <!-- .post-content -->

    </main> <!-- #post-content -->

  </section> <!-- #post-{post_id} -->
<?php 
  endwhile; endif; 
  get_footer(); 
?>