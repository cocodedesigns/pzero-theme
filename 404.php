<?php get_header(); ?>
  <div id="container" class="pageContainer errorPage container">
    <section class="mainContent" id="errorPage" <?php post_class() ?>>
      <div class="postContent">
        <div class="errorPage-icon">
          <span class="fas fa-exclamation-triangle"></span>
        </div>
        <h1 class="page-title">Error 404 - Page Not found</h1>
        <div class="entry">
          <p>Seems the page you were looking for can’t be found on our site.  It’s either been deleted, the URL might be wrong, or you might have clicked on the wrong link.</p>
          <p>Check the URL or use the menu above to try again.  You can also use the search form below.  If you still can’t find the page you’re looking for, get in touch with us and let us know which URL you are typing so we can fix it on our side.</p>
        </div>
        <div id="errorSearch">
          <?php echo get_search_form(); ?>
        </div>
        <p class="errorPage-errorCode">HTTP_ERROR_404</p>
      </div>
    </section>
    <?php // get_sidebar(); ?>
  </div>
<?php get_footer(); ?>