<?php get_header(); ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <section id="pageTitle" class="archiveTitle pageTitle">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div>
  </section>
  <div id="container" class="pageContainer container">
    <section class="mainContent" id="blogPost">
        <article id="post-<?php the_ID(); ?>" <?php post_class() ?>>
          <div class="featuredImage postImage">
          </div>
          <div class="postContent">
            <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
            <div class="entry">
              <?php the_content(); ?>
            </div>
            <div class="postTax postCats">
              <?php
                $cats = get_the_category();
                if ( $cats ){
              ?>
                <h3 class="taxTitle categoriesTitle">Posted under:</h3>
                <ul class="taxList categoriesList categories"><?php
                foreach( $cats as $cat ) {
                    echo '<li class="taxItem categoryItem category"><a href="' . get_category_link( $cat->term_id ) . '" class="categoryLink taxLink" id="cat-' . $cat->term_id . '">' . $cat->name . '</a></li>';
                }
                ?></ul>
              <?php } else { } ?>
            </div>
            <div class="postTax postTags">
              <?php
                $tags = get_the_tags();
                if ( $tags ){
              ?>
                <h3 class="taxTitle tagsTitle">Tagged with:</h3>
                <ul class="taxList tagsList tags"><?php
                foreach( $tags as $tag ) {
                    echo '<li class="taxItem tagItem tag"><a href="' . get_tag_link( $tag->term_id ) . '" class="tagLink taxLink" id="tag-' . $tag->term_id . '">' . $tag->name . '</a></li>';
                }
                ?></ul>
              <?php } else { } ?>
            </div>
            <section id="postNav">
            
            </section>
            <section id="postComments">
              <?php comments_template(); ?>
            </section>
          </div>
        </article>
    </section>
    <?php get_sidebar(); ?>
  </div>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>