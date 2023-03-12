
<?php
/**
 * Header Template
 * @package WordPress
 * @subpackage Project_Zero
 * @since 0.1
 * 
 * This file is called with get_header().
 * Save this file as header-{filename}.php to save a specialised footer. You can call it with get_header('filename').
 * 
 * For more information, check out
 * @link https://developer.wordpress.org/reference/functions/get_header/
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php
  /**
   * Adds meta robots on search.php
   */
  if ( is_search() ) { ?>
      <meta name="robots" content="noindex, nofollow" />
  <?php } ?>
  <?php 
  /**
   * Adds comment-reply script for singular pages (single.php, page.php, etc.)
   */
  if ( is_singular() ){
    wp_enqueue_script( 'comment-reply' );
  } 
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#252525" />
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div id="pagewrap">
    <header id="siteheader">
      <div class="container">
        <figure id="logo">
          <a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">
          <?php 
            $logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $logo_id , 'full' );
              
            if ( $logo ){
          ?>
            <img src="<?php echo $logo[0]; ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo $logo[1]; ?>" height="<?php echo $logo[2]; ?>" />
          <?php } else { ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/project-zero-logo.png" width="300" />
          <?php } ?>
          </a>
        </figure>
        <nav id="sitemenu">
          <div class="menu-container">
            <?php wp_nav_menu( array('theme_location' => 'header_menu', 'container_class' => 'menuwrap' ) ); ?>
          </div>
        </nav>
      </div>
    </header>
    <script>
    <main id="mainbody">
