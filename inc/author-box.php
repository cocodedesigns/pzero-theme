<?php
    $auth_name = get_the_author_meta('display_name');
    $auth_desc = get_the_author_meta('_ccdClient_userProfile_biocontent');
    $auth_photo = get_avatar_url( get_the_author_meta('ID'), array(256,'avatar_default',true) );
    $auth_site = get_the_author_meta('user_url');
?>

<div class="ccdClient-authorBox authorBox-container clearfix">
  <div class="authorBox-heading clearfix">
    <h2 class="authorBox-authorHeading">About <?php echo $auth_name; ?></h2>
    <?php if ( $auth_site != "" ){ ?>
    <p class="authorBox-authorLink"><span class="fa fa-link"></span> <a href="<?php echo $auth_site; ?>" target="_blank"><?php echo $auth_site; ?></a></p>
    <?php } ?>
  </div>
  <div class="authorBox-contentBox clearfix">
    <div class="authorBox-boxPhoto">
      <div class="authorBox-authorPhoto" style="background-image: url('<?php echo $auth_photo; ?>');" title="<?php echo $auth_name; ?>"></div>
    </div>
    <div class="authorBox-boxContent">
      <?php echo wpautop( $auth_desc ); ?>
    </div>
  </div>
</div>