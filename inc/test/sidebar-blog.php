<?php if ( cmb2_get_option( 'ccdtheme_settings_blogposts', '_ccdclient_themesettings_pageposts_blogposts_blog_show_sidebar' ) == "1" ){ ?>
<div id="sidebar" class="clearfix">
  <div id="sidebarColA" class="sidebarCol colA">
    <?php
      the_widget( 
        'CCD_Recent_Posts_Widget', 
        array( 
          'title'   => 'From The Blog', 
          'wcount'  => 2, 
          'noPostsText' => cmb2_get_option( 'ccdtheme_settings_sitefooter', '_ccdclient_themesettings_sitefooter_posts_widget_text' ) 
        ), 
        array( 
          'before_title' => '<h6>', 
          'after_title' => '</h6>' 
        )
      ); 
    ?>
  </div>
  <div id="sidebarColB" class="sidebarCol colB">
    <?php
      the_widget( 
        'CCD_Recent_Comments_Widget', 
        array( 
          'title' => 'From The Comments', 
          'wcount' => 2 
        ), 
        array( 
          'before_title' => '<h6>', 
          'after_title' => '</h6>' 
        )
      ); 
    ?>
  </div>
  <div id="sidebarColC" class="sidebarCol colC">
    <?php
      the_widget( 
        'CCD_Archive_Widget', 
        array( 
          'title'   => 'From The Archive'
        ), 
        array( 
          'before_title' => '<h6>', 
          'after_title' => '</h6>' 
        )
      ); 
    ?>
  </div>
</div>
<?php } else { } ?>