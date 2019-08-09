<?php 

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Theme Settings', 'Theme Settings', 'manage_options', 'admin.php?page=ccdtheme_settings', 'ccdClient_themeSettings_indexPage', 'dashicons-forms', 100  );
	add_submenu_page( 'admin.php?page=ccdtheme_settings', 'Theme Changelog', 'CHANGELOG', 'manage_options', 'admin.php?page=ccdtheme_settings_changelog', 'ccdClientThemeSettings_page_changelog' ); 
}

include_once TEMPLATEPATH . '/inc/settings/settings-main.php';
include_once TEMPLATEPATH . '/inc/settings/settings-apikeys.php';
include_once TEMPLATEPATH . '/inc/settings/settings-contactinfo.php';
// include_once TEMPLATEPATH . '/inc/settings/settings-siteheader.php';
include_once TEMPLATEPATH . '/inc/settings/settings-sitefooter.php';
include_once TEMPLATEPATH . '/inc/settings/settings-page_posts-search.php';
include_once TEMPLATEPATH . '/inc/settings/settings-page_posts-frontpage.php';
include_once TEMPLATEPATH . '/inc/settings/settings-page_posts-blogposts.php';
// include_once TEMPLATEPATH . '/inc/settings/settings-page_posts-pages.php';
include_once TEMPLATEPATH . '/inc/settings/settings-page_posts-errorpage.php';

function ccdClient_themeSettings_indexPage(){
	?>
	<div class="wrap">
		<img src="<?php echo get_template_directory_uri(); ?>/inc/settings/reqs/cocodeLogo-redux.png" style="width: 320px; height: auto;" />
		<div class="parsedownContent">
			<?php
				$Parsedown = new Parsedown();
				$md = file_get_contents( TEMPLATEPATH . '/README.md' );
				echo $Parsedown->text($md);
			?>
		</div>
	</div>
	<?php
}

function ccdClientThemeSettings_page_changelog(){
	?>
	<div class="wrap">
		<div class="parsedownContent">
			<?php
				$Parsedown = new Parsedown();
				$md = file_get_contents( TEMPLATEPATH . '/CHANGELOG.md' );
				echo $Parsedown->text($md);
			?>
		</div>
	</div>
	<?php
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
 function ccdclient_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'myprefix_options', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'myprefix_options', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}