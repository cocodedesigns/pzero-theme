<?php

// Stories custom post type

add_action('init', 'wys_sliders');

function wys_sliders() {
 
	$labels = array(
		'name' => _x('Front Slider', 'post type general name'),
		'singular_name' => _x('Front Slider', 'post type singular name'),
		'add_new' => _x('Add New', 'post type item'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-slides',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 102,
		'supports' => false,
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => false,
	  ); 
 
	register_post_type( 'slider' , $args );
	flush_rewrite_rules();
}

add_action("admin_init", "wys_slide_admin_init");
function wys_slide_admin_init(){
  add_meta_box("mb_wys_slides", "Slides", "wys_slides_display", "slider", "normal", "high");
}
add_action( 'admin_enqueue_scripts', 'wys_slides_scripts' );
function wys_slides_scripts(){
    global $post_type;
    if ( $post_type == "slider" ){
        wp_enqueue_style('slider-css-styles', get_template_directory_uri().'/inc/cpt/slides.css');
    }
}

function wys_slides_display(){
    $source = get_post_meta( get_the_ID(), 'selected_source', true );
    $image = get_post_meta( get_the_ID(), 'wys_slider_image', true );
    $video = get_post_meta( get_the_ID(), 'video_preview', true );
    $title = get_post_meta( get_the_ID(), 'wys_slider_title', true );
    $caption = get_post_meta( get_the_ID(), 'wys_slider_caption', true );
    $link = get_post_meta( get_the_ID(), 'wys_slider_link', true );
    $target = get_post_meta( get_the_ID(), 'wys_link_target', true );
?>
<script>
function resetItAll(){
    // Clear fields
    jQuery('#image-url').val('');
    jQuery('#video-url').val('');
    jQuery('#wys-slider-image').val('');
    jQuery('#video-preview').val('');
    
    // Clear Uploaded Image
    jQuery('#slide-upload').removeClass('hasimage');
    jQuery('#slide-upload').css('background-image', 'none');
    
    // Clear Image by URL
    jQuery('#slide-url').removeClass('hasimage');
    jQuery('#slide-url').css('background-image', 'none');
    jQuery('#slide-url .replace-image').hide();
    jQuery('#slide-url .form-wrap').show();
    
    // Clear Video
    jQuery('#slide-video').removeClass('hasimage');
    jQuery('#slide-video').css('background-image', 'none');
    jQuery('#slide-video .replace-video').hide();
    jQuery('#slide-video .form-wrap').show();
}
(function($){
    $.fn.extend({
        limiter: function(elem){
            $(this).on('keyup focus', function(){
               setCount(this, elem); 
            });
            function setCount(src, elem){
                var chars = src.value.length;
                var limit = $(src).attr('maxlength');
                if ( chars > limit ){
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                var charsRemaining = limit - chars;
                if ( charsRemaining <= (limit*.2) ) { var charsLeft = '<span class="charlimit-warning">'+charsRemaining+'</span>'; } else { var charsLeft = charsRemaining; }
                $(elem).html( charsLeft + '/' + limit );
            }
            setCount($(this)[0], elem);
        }
    });
})(jQuery);
jQuery(document).ready(function($){
	jQuery('.image-src a').click(function(e){
        e.preventDefault();
		var tab = $(this).data('tab');
		jQuery('.image-src a').removeClass('selected');
		jQuery('.tab-content').removeClass('show-tab');

		$(this).addClass('selected');
		jQuery("#slide-"+tab).addClass('show-tab');
        jQuery('#selected-source').val(tab);
	});
    jQuery('#upload-image').click(function(e) {
      e.preventDefault();
      var custom_uploader = wp.media({
        title: 'Select Slider Image',
        button: {
            text: 'Select Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        resetItAll();
        jQuery('#slide-upload').addClass('hasimage');
        jQuery('#slide-upload').css('background-image', 'url('+attachment.sizes.large.url+')');
        jQuery('#wys-slider-image').val(attachment.id);
      })
      .open();
    });
    jQuery('#fetch-image').click(function(e){
        e.preventDefault();
        var imagesrc = jQuery('#image-url').val();
        jQuery("<img>", {
            src: imagesrc,
            error: function(){
                jQuery('.error-msg .error-text').html('The URL you provided is not a valid image.');
                jQuery('.error-msg').show(0, function(){
                    jQuery('#fetch-image').click(function(){
                        jQuery('.error-msg').fadeOut(300);
                    });
                    jQuery('.error-msg').delay(7000).fadeOut(300);
                });
            },
            load: function(){
                resetItAll();
                jQuery('#slide-url').addClass('hasimage');
                jQuery('#slide-url').css('background-image', 'url('+imagesrc+')');
                jQuery('#wys-slider-image').val(imagesrc);
                jQuery('#slide-url .form-wrap').hide();
                jQuery('#slide-url .replace-image').show();
            }
        });
    });
    jQuery('#replace-image').click(function(e){
        e.preventDefault();
        jQuery('#image-url').val('').focus();
        jQuery('#slide-url .replace-image').hide();
        jQuery('#slide-url .form-wrap').show();
    });
    jQuery('#link-target').click(function(e){
        e.preventDefault();
        $(this).toggleClass('selected');
        if ( $(this).hasClass('selected') ) {
            jQuery('#wys-link-target').val('1');
        } else {
            jQuery('#wys-link-target').val('0');
        }
    });
    jQuery('#slide-title').limiter('#slide-title-limit');
    jQuery('#slide-caption').limiter('#slide-caption-limit');
});
</script>
<div class="wys-slides">
  <div class="slide" id="slide">
    <div class="body">
      <div class="slide-image-wrap">
        <div class="error-msg" style="display: none;">
          <span class="dashicons dashicons-warning"></span>
          <span class="error-text">This is an error message.</span>
        </div>
        <div id="slide-upload" class="uploaded image tab-content <?php if ( $source == 'upload' && $image ) { $imgid = wp_get_attachment_image_src( $image, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$imgid[0].');'; } if ( !$source ) { echo 'show-tab'; } ?>">
          <a href="#upload" class="upload" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
            Upload Image</a>
        </div>
        <div id="slide-url" class="from-url image tab-content <?php if ( $source == 'url' && $image ) { echo 'hasimage show-tab" style="background-image: url('.$image.');'; } ?>">
          <div class="form-wrap" <?php if ( $source == 'url' && $image ) { echo 'style="display: none;"'; } ?>>
            <label>Image URL</label>
            <input type="url" class="image-url" id="image-url" value="<?php if ( $source == 'url' && $image ) { echo $image; } ?>" />
            <input type="button" name="fetch-image" id="fetch-image" value="Get Image" />
          </div>
          <div class="replace-image hasimage" <?php if ( $source == 'url' && !$image ) { echo 'style="display: none;"'; } ?>>
            <a href="#replace-image" id="replace-image" class="upload"><span class="icon dashicons dashicons-controls-repeat"></span>
              Replace Image</a>
          </div>
        </div>
        <div id="slide-video" class="video image tab-content <?php if ( $source == 'video' && $image ) { echo 'hasimage show-tab" style="background-image: url('.$video.');'; } ?>">
          <div class="form-wrap" <?php if ( $source == 'video' && $image ) { echo 'style="display: none;"'; } ?>>
            <label>Video URL <span>Youtube or Vimeo only</span></label>
            <input type="url" class="video-url" id="video-url" value="<?php if ( $source == 'video' && $image ) { echo $video; } ?>" />
            <input type="button" name="fetch-video" id="fetch-video" value="Get Video" />
          </div>
          <div class="replace-video hasimage" <?php if ( $source == 'video' && !$image ) { echo 'style="display: none;"'; } ?>>
            <a href="#replace-video" id="replace-video" class="upload"><span class="icon dashicons dashicons-controls-repeat"></span>
              Replace Video</a>
          </div>
        </div>
        <div class="image-src">
          <a href="#upload-image" class="first <?php if ( $source == "upload" || !$source ) { echo 'selected'; } ?>" data-tab="upload"><span class="dashicons dashicons-upload"></span>
            Upload</a>
          <a href="#from-url" class="last <?php if ( $source == "url" ) { echo 'selected'; } ?>" data-tab="url"><span class="dashicons dashicons-admin-links"></span>
            From URL</a>
        </div>
      </div>
      <div class="slide-display-data">
        <div class="row slide-title">
          <div class="field">
            <label>
              Slide Title
              <span class="notes" id="slide-title-limit"></span>
            </label>
            <input type="text" class="slide-title" name="wys_slider_title" id="slide-title" maxlength="50" placeholder="Enter Title" value="<?php echo $title; ?>" />
          </div>
        </div>
        <div class="row slide-caption">
          <div class="field">
            <label>
              Slide Caption
              <span class="notes" id="slide-caption-limit"></span>
            </label>
            <textarea class="slide-caption" name="wys_slider_caption" maxlength="140" id="slide-caption"><?php echo $caption; ?></textarea>
          </div>
        </div>
        <div class="row slide-link">
          <div class="field">
            <label>
              Slide Link
              <span class="notes">eg. http://www.google.com</span>
            </label>
            <input type="text" class="slide-link" name="wys_slider_link" value="<?php echo $link; ?>" />
          </div>
          <a href="#new-tab" id="link-target" class="link-target <?php if ( $target == "1" ) { echo 'selected'; } else { } ?>" title="Open link in new tab"><span class="icon dashicons dashicons-external"></span></a>
        </div>
        <input type="hidden" class="wys-link-target" id="wys-link-target" name="wys_link_target" value="<?php if ( !$target ) { echo '0'; } else { echo $target; } ?>" />
        <input type="hidden" id="selected-source" name="selected_source" value="<?php if ( !$source ) { echo 'upload'; } else { echo $source; } ?>" />
        <input type="hidden" id="wys-slider-image" name="wys_slider_image" value="<?php echo $image; ?>" />
        <input type="hidden" id="video-preview" name="video_preview" value="<?php echo $video; ?>" />
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php
}

add_action('save_post', 'wys_slides_save_details');

function wys_slides_save_details(){
  global $post;

  update_post_meta($post->ID, "video_preview", $_POST["video_preview"]);
  update_post_meta($post->ID, "wys_slider_image", $_POST["wys_slider_image"]);
  update_post_meta($post->ID, "selected_source", $_POST["selected_source"]);
  update_post_meta($post->ID, "wys_link_target", $_POST["wys_link_target"]);
  update_post_meta($post->ID, "wys_slider_link", $_POST["wys_slider_link"]);
  update_post_meta($post->ID, "wys_slider_caption", strip_tags($_POST["wys_slider_caption"]));
  update_post_meta($post->ID, "wys_slider_title", strip_tags($_POST["wys_slider_title"]));
  
}