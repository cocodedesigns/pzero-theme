<?php

// staff custom post type

add_action('init', 'ccd_staff');
 
function ccd_staff() {
 
	$labels = array(
		'name' => _x('Staff', 'post type general name'),
		'singular_name' => _x('Member', 'post type singular name'),
		'add_new' => _x('Add New', 'post type item'),
		'add_new_item' => __('Add New Member'),
		'edit_item' => __('Edit Member'),
		'new_item' => __('New Member'),
		'view_item' => __('View Member'),
		'search_items' => __('Search Directory'),
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
		'menu_icon' => 'dashicons-networking',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 71,
		'supports' => array(''),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'about/our-team')
	  ); 
 
	register_post_type( 'staff' , $args );
	flush_rewrite_rules();
}

function ccd_staff_cats_taxonomy(){
    $labels = array(
        'name' => _x( 'Departments', 'Departments' ),
        'singular_name' => _x( 'Department', 'Departments' ),
        'search_items' => __( 'Search Departments' ),
        'all_items' => __( 'All Departments' ),
        'parent_item' => __( 'Parent Department' ),
        'parent_item_colon' => __( 'Parent Department' ),
        'edit_item' => __( 'Edit Department' ),
        'update_item' => __( 'Update Department' ),
        'add_new_item' => __( 'Add New Department' ),
        'new_item_name' => __( 'New Department' ),
        'menu_name' => __( 'Departments' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'about/our-team/department' ),
    );
    register_taxonomy( 'staff-cats', array( 'staff' ), $args );
}
add_action( 'init', 'ccd_staff_cats_taxonomy', 0 );

add_action("admin_init", "ccd_staff_admin_init");

function ccd_staff_admin_init(){
  add_meta_box("mb_ccd_staff_details", "Staff Details", "ccd_staff_details", "staff", "normal", "high");
}

function ccd_staff_admin_scripts(){
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
    
    wp_enqueue_style( 'freshslider-css', get_template_directory_uri().'/css/freshslider.min.css' );
    wp_enqueue_script( 'freshslider-js', get_template_directory_uri().'/js/freshslider.min.js' );
}
add_action('admin_enqueue_scripts', 'ccd_staff_admin_scripts');

add_action( 'admin_enqueue_scripts', 'load_flaticon');
function load_flaticon(){
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/fonts/flaticon.css' );
}

function ccd_staff_details(){
    
    global $ccd_options;
?>
  <style>
    #ccd_staff_profile{ position: relative; }
    .ccd_staff_photo{ position: absolute; top: 0; left: 0; z-index: 1; }
    #ccd_staff_photo_preview{ width: 120px; height: 120px; background-color: #000; background-size: cover; background-position: center center; overflow: hidden; }
    #ccd_staff_photo_preview a{ display: block; color: #383838; text-decoration: none; padding: 30px 30px 80px 30px; background-color: rgba(0,0,0,.4); transition: all ease .3s; opacity: 0; }
    #ccd_staff_photo_preview a:hover{ opacity: 1; }
    #ccd_staff_photo_preview span.dashicons:before{ font-size: 30px; display: inline-block; text-align: center; height: 60px; width: 60px; line-height: 60px; background-color: #FFF; border-radius: 50%; }
    .ccd_staff_data{ margin: 0 0 0 131px; min-height: 120px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
    .ccd_staff_field input, .ccd_staff_field select{ border: solid 1px #ADADAD; line-height: 29px; padding: 3px 11px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; width: 100%; font-size: 14px; }
    .ccd_staff_field_main input{ line-height: 62px; font-size: 30px; }
    .ccd_staff_field_sub{ min-height: 37px; padding-top: 3px; padding-bottom: 1px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
    .ccd_staff_field_subduo{ float: left; width: 50%; }
    .ccd_staff_field_sub input, .ccd_staff_field_sub select{ line-height: 34px; font-size: 16px; }
    .ccd_staff_field_thin .ccd-social-icon{ width: 44px; text-align: left; font-size: 16px; line-height: 36px; float: left; display: block; height: 36px; box-sizing: border-box; padding-left: 8px; }
    .ccd_staff_field_thin input, .ccd_staff_field_thin select{ line-height: 28px; font-size: 14px; width: calc( 100% - 46px ); float: left; }
    .ccd_staff_field select{ height: 42px; }
    .ccd_staff_jobtitle{ padding-right: 2px; }
    .ccd_staff_unit{ padding-left: 2px; }
    .ccd-tabs{ margin: 15px 0px 0; padding: 0px; list-style: none; }
    .ccd-tabs .tab-link{ background: none; color: #222; display: inline-block; padding: 10px 15px; cursor: pointer; margin: 0; }
    .ccd-tabs .tab-link.current{ background: #ededed; color: #222; }
    .tab-content{ display: none; background: #ededed; padding: 15px; }
    .tab-content.current{ display: inherit; }
    .ccd-tab-twocol{ width: calc( 50% - 7px ); float: left; box-sizing: border-box; }
    #ccd-tab-skills textarea{ width: 100%; height: 250px; resize: none; font-size: 16px; box-sizing: border-box; line-height: 25px; padding: 7px; }
    .ccd-tab-separator{ float: left; width: 14px; height: 10px; }
  </style>
  <div id="ccd_staff_profile">
    <div class="ccd_staff_photo">
      <?php if ( get_post_meta( get_the_ID(), 'ccd_staff_photo_id', true ) ) { ?><div id="ccd_staff_photo_preview" style="background-image: url('<?php echo wp_get_attachment_thumb_url( get_post_meta( get_the_ID(), 'ccd_staff_photo_id', true ) ); ?>')"><a href="#load_image"><span class="dashicons-search dashicons"></span></a></div><?php } else { ?><div id="ccd_staff_photo_preview" style=""><a href="#load_image"><span class="dashicons-search dashicons"></span></a></div><?php } ?>
      <input id="ccd_staff_photo_id" type="hidden" name="ccd_staff_photo_id" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_photo_id', true ); ?>" />
      <p><strong>Public / Private</strong></p>
      <p><input type="radio" name="ccd_staff_public" value="1" <?php checked( get_post_meta( get_the_ID(), 'ccd_staff_public', true ), '1' ); ?> /> Public<br />
        <input type="radio" name="ccd_staff_public" value="0" <?php checked( get_post_meta( get_the_ID(), 'ccd_staff_public', true ), '0' ); ?> /> Private</p>
    </div>
    <div class="ccd_staff_data">
      <div class="ccd_staff_field ccd_staff_field_main ccd_staff_name"><input type="text" name="ccd_staff_display_name" id="ccd_staff_display_name" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_display_name', true ); ?>" placeholder="Name (to be displayed)" /></div>
      <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subduo ccd_staff_firstname"><input type="text" name="ccd_staff_firstname" id="ccd_staff_firstname" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_firstname', true ); ?>" placeholder="First Name (will be displayed)" /></div>
      <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subduo ccd_staff_surname"><input type="text" name="ccd_staff_surname" id="ccd_staff_surname" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_surname', true ); ?>" placeholder="Surname (will be used to sort staff)" /></div>
      <div class="clear"></div>
      <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subduo ccd_staff_jobtitle"><input type="text" name="ccd_staff_jobtitle" id="ccd_staff_jobtitle" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_jobtitle', true ); ?>" placeholder="Job title" /></div>
      <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subduo ccd_staff_email"><input type="email" name="ccd_staff_email" id="ccd_staff_email" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_email', true ); ?>" placeholder="Email address" /></div>
      <div style="clear: both;"></div>
      <div class="ccd_tabs_container clear">
        <ul class="ccd-tabs">
          <li class="ccd-tab tab-link current" data-tab="ccd-tab-about">About</li>
          <li class="tab-link" data-tab="ccd-tab-interests">Interests</li>
          <li class="tab-link" data-tab="ccd-tab-skills">Skills &amp; Achievements</li>
          <li class="tab-link" data-tab="ccd-tab-scales">Measurements</li>
          <li class="tab-link" data-tab="ccd-tab-contact">Contact Details</li>
        </ul>
        <div id="ccd-tab-about" class="tab-content current">
          <?php
            $desc = get_post_meta( get_the_ID(), 'ccd_staff_desc', false );
            $descargs = array(
                'media_buttons'     => false,
                'textarea_name'     => 'ccd_staff_desc',
                'editor_height'     => 400,
                'teeny'             => true,
                'drag_drop_upload'  => true
            );
            wp_editor( $desc[0], 'ccd_staff_desc', $descargs );
          ?>
        </div>
        <div id="ccd-tab-interests" class="tab-content">
          <?php
            $ints = get_post_meta( get_the_ID(), 'ccd_staff_interests', false );
            $intsargs = array(
                'media_buttons'     => false,
                'textarea_name'     => 'ccd_staff_interests',
                'editor_height'     => 400,
                'teeny'             => true,
                'drag_drop_upload'  => true
            );
            wp_editor( $ints[0], 'ccd_staff_interests', $intsargs );
          ?>
        </div>
        <div id="ccd-tab-skills" class="tab-content">
          <div class="ccd-tab-twocol ccd-tab-element">
            <p><strong>Skills</strong></p>
            <p><em>Enter a new skill on a new line.</em></p>
            <textarea name="ccd_staff_skills" id="ccd_staff_skills" class="ccd_staff_skills"><?php echo get_post_meta( get_the_ID(), 'ccd_staff_skills', true ); ?></textarea>
          </div>
          <div class="ccd-tab-separator ccd-tab-element">
          </div>
          <div class="ccd-tab-twocol ccd-tab-element">
            <p><strong>Achievements</strong></p>
            <p><em>Enter a new skill on a new line.</em></p>
            <textarea name="ccd_staff_achievements" id="ccd_staff_achievements" class="ccd_staff_achievements"><?php echo get_post_meta( get_the_ID(), 'ccd_staff_achievements', true ); ?></textarea>
          </div>
          <div class="clear"></div>
        </div>
        <div id="ccd-tab-scales" class="tab-content">
          <div class="ccd-scale-wrap">
            <div class="ccd-scale-title ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo"><input type="text" name="ccd_staff_scales_one_title" id="ccd_staff_scales_one_title" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_one_title', true ); ?>" placeholder="Measurement Heading" /></div>
            <div class="ccd-scale-input"><input type="hidden" name="ccd_staff_scales_one_value" id="ccd_staff_scales_one_value" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_one_value', true ); ?>" /><div id="uv1" class="uv"></div></div>
          </div>
          <div class="ccd-scale-wrap">
            <div class="ccd-scale-title ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo"><input type="text" name="ccd_staff_scales_two_title" id="ccd_staff_scales_two_title" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_two_title', true ); ?>" placeholder="Measurement Heading" /></div>
            <div class="ccd-scale-input"><input type="hidden" name="ccd_staff_scales_two_value" id="ccd_staff_scales_two_value" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_two_value', true ); ?>" /><div id="uv2" class="uv"></div></div>
          </div>
          <div class="ccd-scale-wrap">
            <div class="ccd-scale-title ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo"><input type="text" name="ccd_staff_scales_three_title" id="ccd_staff_scales_three_title" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_three_title', true ); ?>" placeholder="Measurement Heading" /></div>
            <div class="ccd-scale-input"><input type="hidden" name="ccd_staff_scales_three_value" id="ccd_staff_scales_three_value" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_three_value', true ); ?>" /><div id="uv3" class="uv"></div></div>
          </div>
          <div class="ccd-scale-wrap">
            <div class="ccd-scale-title ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo"><input type="text" name="ccd_staff_scales_four_title" id="ccd_staff_scales_four_title" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_four_title', true ); ?>" placeholder="Measurement Heading" /></div>
            <div class="ccd-scale-input"><input type="hidden" name="ccd_staff_scales_four_value" id="ccd_staff_scales_four_value" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_scales_four_value', true ); ?>" /><div id="uv4" class="uv"></div></div>
          </div>
          
          <script>
            var mbtabw  = $('.tab-content.current').width();
            console.log(mbtabw);
            var mbtabp  = parseInt($('.ccd-scale-input').css('padding-left')) + parseInt($('.ccd-scale-input').css('padding-right'));
            // var mbtabp  = parseInt($('.ccd-scale-input').css('padding-left')) + parseInt($('.ccd-scale-input').css('padding-right')) + parseInt($('.tab-content').css('padding-left')) + parseInt($('.tab-content').css('padding-right'));
            console.log(mbtabp);
            var uvw = mbtabw - mbtabp;
            $('.uv').width(uvw);
          
            var uvone   = $('#ccd_staff_scales_one_value').val();
            var uvtwo   = $('#ccd_staff_scales_two_value').val();
            var uvthree = $('#ccd_staff_scales_three_value').val();
            var uvfour  = $('#ccd_staff_scales_four_value').val();
            $("#uv1").freshslider({ step: 1, value: uvone, min: 0, max: 100, unit: '%', onchange: function( value ){ $('#ccd_staff_scales_one_value').val(value); } });
            $("#uv2").freshslider({ step: 1, value: uvtwo, min: 0, max: 100, unit: '%', onchange: function( value ){ $('#ccd_staff_scales_two_value').val(value); } });
            $("#uv3").freshslider({ step: 1, value: uvthree, min: 0, max: 100, unit: '%', onchange: function( value ){ $('#ccd_staff_scales_three_value').val(value); } });
            $("#uv4").freshslider({ step: 1, value: uvfour, min: 0, max: 100, unit: '%', onchange: function( value ){ $('#ccd_staff_scales_four_value').val(value); } });
          </script>
        </div>
        <div id="ccd-tab-contact" class="tab-content">
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_author_posts">
            <p><strong>Select author profile:</strong></p>
            <select name="ccd_staff_author_posts">
              <option value="0">None</option>
              <?php
                $staffusers = get_users();
                usort($staffusers, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
                foreach( $staffusers as $user ){
                    echo '<option value="'.$user->ID.'" ' . selected( get_post_meta( get_the_ID(), 'ccd_staff_author_posts', true ), $user->ID ) . '> '.$user->first_name.' '.$user->last_name.'</option>';
                }
              ?>
            </select>
          </div>
          <p><strong>Enter social network URLs:</strong></p>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_facebook"><span class="ccd-social-icon flaticon-facebook12"></span> <input type="url" name="ccd_staff_contact_facebook" id="ccd_staff_contact_facebook" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_facebook', true ); ?>" placeholder="Facebook URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_twitter"><span class="ccd-social-icon flaticon-social"></span> <input type="url" name="ccd_staff_contact_twitter" id="ccd_staff_contact_twitter" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_twitter', true ); ?>" placeholder="Twitter URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_googleplus"><span class="ccd-social-icon flaticon-google109"></span> <input type="url" name="ccd_staff_contact_googleplus" id="ccd_staff_contact_googleplus" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_googleplus', true ); ?>" placeholder="Google Plus URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_tumblr"><span class="ccd-social-icon flaticon-logotype1"></span> <input type="url" name="ccd_staff_contact_tumblr" id="ccd_staff_contact_tumblr" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_tumblr', true ); ?>" placeholder="Tumblr URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_youtube"><span class="ccd-social-icon flaticon-youtube13"></span> <input type="url" name="ccd_staff_contact_youtube" id="ccd_staff_contact_youtube" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_youtube', true ); ?>" placeholder="YouTube URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_instagram"><span class="ccd-social-icon flaticon-social-media"></span> <input type="url" name="ccd_staff_contact_instagram" id="ccd_staff_contact_instagram" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_instagram', true ); ?>" placeholder="Instagram URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_behance"><span class="ccd-social-icon flaticon-behance-logo"></span> <input type="url" name="ccd_staff_contact_behance" id="ccd_staff_contact_behance" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_behance', true ); ?>" placeholder="Behance URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_pinterest"><span class="ccd-social-icon flaticon-pinterest"></span> <input type="url" name="ccd_staff_contact_pinterest" id="ccd_staff_contact_pinterest" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_pinterest', true ); ?>" placeholder="Pinterest URL" /></div>
          <div class="ccd_staff_field ccd_staff_field_sub ccd_staff_field_subsolo ccd_staff_field_thin ccd_staff_contact_dribble"><span class="ccd-social-icon flaticon-dribbble-logo"></span> <input type="url" name="ccd_staff_contact_dribble" id="ccd_staff_contact_dribble" value="<?php echo get_post_meta( get_the_ID(), 'ccd_staff_contact_dribble', true ); ?>" placeholder="Dribble URL" /></div>
        </div>
      </div><!-- container -->
      <div class="clear"></div>
    </div>
    <div style="clear: both;"></div>
  </div>
  <script>
  jQuery(document).ready(function($){
    $('#ccd_staff_photo_preview a').click(function(e) {
      e.preventDefault();
      var custom_uploader = wp.media({
        title: 'Select Staff Photo',
        button: {
            text: 'Add Photo'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        $('#ccd_staff_photo_preview').css('background-image', 'url('+attachment.sizes.thumbnail.url+')');
        $('#ccd_staff_photo_id').val(attachment.id);
      })
      .open();
    });	
    $('ul.ccd-tabs li').click(function(){
      var tab_id = $(this).attr('data-tab');
      $('ul.ccd-tabs li').removeClass('current');
      $('.tab-content').removeClass('current');
      $(this).addClass('current');
      $("#"+tab_id).addClass('current');
    })
  })
</script>
<?php
}

add_action('save_post', 'ccd_staff_save_details');
function ccd_staff_save_details(){
  global $post;
 
  update_post_meta($post->ID, "ccd_staff_photo_id", $_POST["ccd_staff_photo_id"]);
  update_post_meta($post->ID, "ccd_staff_display_name", $_POST["ccd_staff_display_name"]);
  update_post_meta($post->ID, "ccd_staff_firstname", $_POST["ccd_staff_firstname"]);
  update_post_meta($post->ID, "ccd_staff_surname", $_POST["ccd_staff_surname"]);
  update_post_meta($post->ID, "ccd_staff_jobtitle", $_POST["ccd_staff_jobtitle"]);
  update_post_meta($post->ID, "ccd_staff_email", $_POST["ccd_staff_email"]);
  update_post_meta($post->ID, "ccd_staff_desc", $_POST["ccd_staff_desc"]);
  update_post_meta($post->ID, "ccd_staff_interests", $_POST["ccd_staff_interests"]);
  update_post_meta($post->ID, "ccd_staff_public", $_POST["ccd_staff_public"]);
  update_post_meta($post->ID, "ccd_staff_author_posts", $_POST["ccd_staff_author_posts"]);
  update_post_meta($post->ID, "ccd_staff_contact_behance", $_POST["ccd_staff_contact_behance"]);
  update_post_meta($post->ID, "ccd_staff_contact_dribble", $_POST["ccd_staff_contact_dribble"]);
  update_post_meta($post->ID, "ccd_staff_contact_facebook", $_POST["ccd_staff_contact_facebook"]);
  update_post_meta($post->ID, "ccd_staff_contact_googleplus", $_POST["ccd_staff_contact_googleplus"]);
  update_post_meta($post->ID, "ccd_staff_contact_tumblr", $_POST["ccd_staff_contact_tumblr"]);
  update_post_meta($post->ID, "ccd_staff_contact_instagram", $_POST["ccd_staff_contact_instagram"]);
  update_post_meta($post->ID, "ccd_staff_contact_pinterest", $_POST["ccd_staff_contact_pinterest"]);
  update_post_meta($post->ID, "ccd_staff_contact_twitter", $_POST["ccd_staff_contact_twitter"]);
  update_post_meta($post->ID, "ccd_staff_contact_youtube", $_POST["ccd_staff_contact_youtube"]);
  update_post_meta($post->ID, "ccd_staff_scales_one_title", $_POST["ccd_staff_scales_one_title"]);
  update_post_meta($post->ID, "ccd_staff_scales_two_title", $_POST["ccd_staff_scales_two_title"]);
  update_post_meta($post->ID, "ccd_staff_scales_three_title", $_POST["ccd_staff_scales_three_title"]);
  update_post_meta($post->ID, "ccd_staff_scales_four_title", $_POST["ccd_staff_scales_four_title"]);
  update_post_meta($post->ID, "ccd_staff_scales_one_value", $_POST["ccd_staff_scales_one_value"]);
  update_post_meta($post->ID, "ccd_staff_scales_two_value", $_POST["ccd_staff_scales_two_value"]);
  update_post_meta($post->ID, "ccd_staff_scales_three_value", $_POST["ccd_staff_scales_three_value"]);
  update_post_meta($post->ID, "ccd_staff_scales_four_value", $_POST["ccd_staff_scales_four_value"]);
  update_post_meta($post->ID, "ccd_staff_achievements", $_POST["ccd_staff_achievements"]);
  update_post_meta($post->ID, "ccd_staff_skills", $_POST["ccd_staff_skills"]);
}

function set_staff_post_title( $data , $postarr ) {
    if( $data[ 'post_type' ] === 'staff' ) {
        // get the staff name from _POST or from post_meta
        $staff_name = ( ! empty( $_POST[ 'ccd_staff_display_name' ] ) ) ? $_POST[ 'ccd_staff_display_name' ] : get_post_meta( $postarr[ 'ID' ], 'ccd_staff_display_name', true );
        // if the name is not empty, we want to set the title
        if( $staff_name !== '' ) {
            $data[ 'post_title' ] = $staff_name;
            $data[ 'post_name' ]  = sanitize_title( $staff_name );
        }
    }
    return $data;
}
add_filter( 'wp_insert_post_data' , 'set_staff_post_title' , '99', 2 );