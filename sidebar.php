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
			<div class="widget-content">
				<?php get_search_form(); ?>
			</div> <!-- .widget-content -->
		</div> <!-- #widget-search_form -->

		<div class="widget page_list" id="widget-page_list">
			<h6 class="widget-title"><span class="icon fa-solid fa-sitemap"></span> 
				Pages</h6>
			<div class="widget-content">
				<ul class="widget-list page-list">
					<?php wp_list_pages('title_li='); ?>
				</ul> <!-- .page-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-page_list -->

		<div class="widget post_archive" id="widget-post_archive">
			<h6 class="widget-title"><span class="icon fa-solid fa-calendar-days"></span>
				Monthly Archives</h6>
			<div class="widget-content">
				<ul class="widget-list archive-list">
					<?php wp_get_archives('type=monthly'); ?>
				</ul> <!-- .archive-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-post_archive -->

		<div class="widget blog_categories" id="widget-blog_categories">
			<h6 class="widget-title"><span class="icon fa-solid fa-hashtag"></span>
				Categories</h6>
			<div class="widget-content">
				<ul class="widget-list category-list">
					<?php wp_list_categories('show_count=1&title_li='); ?>
				</ul> <!-- .category-list -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_categories -->

		<div class="widget blog_meta" id="widget-blog_meta">
			<h6 class="widget-title"><span class="icon fa-solid fa-link"></span>
				Meta</h6>
			<div class="widget-content">
				<ul class="widget-list meta-links">
					<?php if ( !is_user_logged_in() ) { ?>
					<li class="loginout-link"><a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>">
						<span class="icon fa-solid fa-right-to-bracket"></span>
						<span class="label"><?php echo _x( 'Log in', 'login link', 'zero-theme' ); ?></span></a></li>
						<?php if ( get_option( 'users_can_register' ) ) { ?>
						<li class="register-link"><a href="<?php echo esc_url( wp_registration_url() ); ?>">
							<span class="icon fa-solid fa-user-plus"></span>
							<span class="label"><?php echo _x( 'Register', 'register link', 'zero-theme' ); ?></span></a></li>
						<?php } ?>
					<?php } else { ?>
						<?php if ( current_user_can( 'read' ) ){ ?>
						<li class="wpadmin-link"><a href="<?php echo admin_url(); ?>">
							<span class="icon fa-solid fa-gauge-high"></span>
							<span class="label"><?php echo _x( 'Dashboard', 'wp-admin dashboard link', 'zero-theme' ); ?></span></a></li>
						<?php } ?>
					<li class="loginout-link"><a href="<?php echo esc_url( wp_logout_url( get_permalink() ) ); ?>">
						<span class="icon fa-solid fa-right-from-bracket"></span>
						<span class="label"><?php echo _x( 'Log out', 'logout link', 'zero-theme' ); ?></span></a></li>
					<?php } ?>
					<li class="wporg-link"><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">
						<span class="icon fa-brands fa-wordpress-simple"></span> 
						<span class="label">WordPress</span></a></li>
					<?php wp_meta(); ?>
				</ul> <!-- .meta-links -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_meta -->

		<div class="widget blog_subscribe" id="widget-blog_subscribe">
			<h6 class="widget-title"><span class="icon fa-solid fa-rss"></span>
				Subscribe</h6>
			<div class="widget-content">
				<ul class="widget-list subscribe-links">
					<li><a href="<?php bloginfo('rss2_url'); ?>">
						<span class="icon fa-solid fa-square-rss"></span>
						<span class="label">Entries (RSS)</span></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url'); ?>">
						<span class="icon fa-solid fa-square-rss"></span>
						<span class="label">Comments (RSS)</span></a></li>
				</ul> <!-- .subscribe-links -->
			</div> <!-- .widget-content -->
		</div> <!-- #widget-blog_subscribe -->

	<?php endif; ?>
	
</div>