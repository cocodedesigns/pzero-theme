<?php 
/**
 * Sidebar Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This template inserts a sidebar whenever the get_sidebar( function is called.
 * To create a specialised sidebar, save this as sidebar-{filename}.php and use get_sidebar('filename') to insert it.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/get_sidebar/
 */
?>
<div id="sidebar" class="site-sidebar">

	<?php if (dynamic_sidebar('sidebar-widgets')) : else :
		/**
		 * These widgets will appear if you don't apply any widgets in the admin area.
		 */	
	?>

		<div class="widget search_form" id="widget-search_form">
			<h6 class="widget-title">Search</h6>
			<div class="widget-content">
				<?php get_search_form(); ?>
			</div> <!-- .widget-content -->
		</div> <!-- #widget-search_form -->

		<div class="widget page_list" id="widget-page_list">
			<h6 class="widget-title">Pages</h6>
			<div class="widget-content">
				<ul class="widget-list page-list">
					<?php wp_list_pages('title_li='); ?>
				</ul> <!-- .page-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-page_list -->

		<div class="widget post_archive" id="widget-post_archive">
			<h6 class="widget-title">Monthly Archives</h6>
			<div class="widget-content">
				<ul class="widget-list archive-list">
					<?php wp_get_archives('type=monthly'); ?>
				</ul> <!-- .archive-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-post_archive -->

		<div class="widget blog_categories" id="widget-blog_categories">
			<h6 class="widget-title">Categories</h6>
			<div class="widget-content">
				<ul class="widget-list category-list">
					<?php wp_list_categories('show_count=1&title_li='); ?>
				</ul> <!-- .category-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_categories -->

		<div class="widget blog_bookmarks" id="widget-blog_bookmarks">
			<h6 class="widget-title">Bookmarks</h6>
			<div class="widget-content">
				<?php wp_list_bookmarks(); ?>
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_bookmarks -->

		<div class="widget blog_meta" id="widget-blog_meta">
			<h6 class="widget-title">Meta</h6>
			<div class="widget-content">
				<ul class="widget-list meta-links">
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul> <!-- .meta-links -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_meta -->

		<div class="widget blog_subscribe" id="widget-blog_subscribe">
			<h6 class="widget-title">Subscribe</h6>
			<div class="widget-content">
				<ul class="widget-list subscribe-links">
					<li><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
					<li><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></li>
				</ul> <!-- .subscribe-links -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_subscribe -->

	<?php endif; ?>
	
</div>