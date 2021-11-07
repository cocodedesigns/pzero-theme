
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php if (is_search()) { ?>
      <meta name="robots" content="noindex, nofollow" />
  <?php } ?>
  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#252525" />
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div id="pageWrap">
    <header id="siteHeader">
      <div class="container">
        <div id="headerLogo">
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
        </div>
        <nav id="siteMenu">
          <div class="menuContainer">
            <?php wp_nav_menu( array('theme_location' => 'header_menu', 'container_class' => 'menuWrap' ) ); ?>
          </div>
        </nav>
        <div id="menutoggle">
          <a href="#openmenu"><span class="fas fa-bars"></span></a>
        </div>
      </div>
    </header>
    <script>
      $(document).ready(function(){
          $('#menutoggle a, #toggle_touchClose').click(function(e){
              e.preventDefault();
              $('header nav').toggleClass('show');
          });
      });
    </script>
    <main id="mainBody">
