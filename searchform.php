<?php 
/**
 * Search Form Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * Inserts a search form whenever the get_search_form() function is called.
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div>
		<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'search label', 'zero-theme' ); ?></label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
		<button type="submit" id="searchsubmit">
      <?php echo esc_attr_x( 'Search', 'submit button', 'zero-theme' ); ?>
    </button>
	</div>
</form>