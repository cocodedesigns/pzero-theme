<?php 
/**
 * Single Post Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template applies to all posts without a specialised post template or a custom post template.
 * To create a post template for a custom post type, save this as single-{post_type}.php.
 * An example can be found in single-portfolio.php, which works with the 'portfolio' custom post type in the PLUGIN.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/themes/template-files-section/post-template-files/
 */

  get_header();
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?>
  <section id="post-title" class="post-title">
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
          <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

        </section> <!-- .entry -->

        <section class="post-footer">
          <p>This entry was posted by <?php the_author() ?>
          on <time datetime="<?php the_time('Y-m-d')?>"><?php the_time('l, F jS, Y') ?></time>
          at <time><?php the_time() ?></time>
          and is filed under <?php the_category(', ') ?>.</p>
          <p>You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

          <?php if ( comments_open() && pings_open() ) {
            // Both Comments and Pings are open ?>
            You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

          <?php } elseif ( !comments_open() && pings_open() ) {
            // Only Pings are Open ?>
            Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

          <?php } elseif ( comments_open() && !pings_open() ) {
            // Comments are open, Pings are not ?>
            You can skip to the end and leave a response. Pinging is currently not allowed.

          <?php } elseif ( !comments_open() && !pings_open() ) {
            // Neither Comments, nor Pings are open ?>
            Both comments and pings are currently closed.

          <?php } edit_post_link('Edit this entry','','.'); ?>
          </p>
        </section>

        <section id="post-categories" class="taxonomy-section section-categories">
          <?php
            /**
             * Gets the categories for this post.
             * If no ID number is declared, the function uses this post's ID number.
             */
            $categories = get_the_category();
            if ( $categories ){
          ?>
            <h3 class="section-title title-categories">Posted under:</h3>
            <ul class="taxonomy-list caegories">
              <?php foreach( $categories as $category ) { ?>
                <li class="list-item category">
                  <a href="<?php echo get_category_link( $category->term_id ); ?>" class="item-link category-link" id="cat-<?php echo $category->term_id; ?>">
                    <?php echo $category->name; ?>
                  </a>
                </li> <!-- .list-item.category -->
              <?php } // Ends category foreach ?>
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
            if ( $tags ){
          ?>

            <h3 class="section-title title-tags">Tagged with:</h3>

            <ul class="taxonomy-list tags">
              <?php foreach( $tags as $tag ) { ?>
                <li class="list-item tag">
                  <a href="<?php echo get_tag_link( $tag->term_id ); ?>" class="item-link tag-link" id="tag-<?php echo $tag->term_id; ?>">
                    <?php echo $tag->name; ?>
                  </a>
                </li> <!-- .list-item.tag -->
              <?php } // Ends tag foreach ?>
            </ul> <!-- .taxonomy-list.tags -->

          <?php } else { } // Ends tag conditional ?>
        </section> <!-- #post-tags -->

        <section id="post-navigation" class="navigation post-links">
        </section> <!-- #post-navigation -->

        <section id="post-comments" class="comments">
          <?php comments_template(); ?>
        </section> <!-- #post-comments -->

      </article> <!-- .post-content -->

    </main> <!-- #post-content -->

    <aside id="blog-sidebar">
      <?php get_sidebar(); ?>
    </aside> <!-- #blog-sidebar -->

  </section> <!-- #post-{post_id} -->
<?php 
  endwhile; endif; 
  get_footer(); 
?>