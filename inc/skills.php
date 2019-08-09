<?php
add_action('init', 'eve_skills');
 
function eve_skills() {
 
	$labels = array(
		'name' => _x('Skills', 'post type general name'),
		'singular_name' => _x('Skill', 'post type singular name'),
		'add_new' => _x('Add New', 'eve_skills item'),
		'add_new_item' => __('Add New Skill'),
		'edit_item' => __('Edit Skill'),
		'new_item' => __('New Skill'),
		'view_item' => __('View Skill'),
		'search_items' => __('Search Skills'),
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
        'supports' => array( 'title' ),
		'capability_type' => 'page',
		'hierarchical' => true,
		'menu_position' => false,
		'can_export' => true,
		'show_in_menu' => false,
		'has_archive' => true,
		'rewrite' => array('slug' => 'skills')
	  ); 
 
	register_post_type( 'skill' , $args );
	flush_rewrite_rules();
}

add_action('admin_enqueue_scripts', 'dragdealer_scripts');
function dragdealer_scripts(){
    wp_enqueue_script( 'dragdealer-js', get_template_directory_uri() . '/js/dragdealer.js' );
    wp_enqueue_style( 'dragdealer-css', get_template_directory_uri() . '/css/dragdealer.css' );
}

add_action("admin_init", "eveski_admin_init");
 
function eveski_admin_init(){
  add_meta_box("mb_eveski_details", "Skill Details", "eveski_details", "skill", "normal", "high");
}

function eveski_details(){
  global $post;
?>
  <p><label>Skill type</label>
    <select name="eveski_type" id="eveski_type">
      <option value="0">Select</option>
      <option value="bar" <?php selected( get_post_meta( get_the_ID(), 'eveski_type', true), 'bar'); ?> >Progress Bar (eg. I am [50]% good at [flipping coins])</option>
      <option value="val" <?php selected( get_post_meta( get_the_ID(), 'eveski_type', true), 'val'); ?> >Number value (eg. I can type [10] [wpm], I have [50] [years] experience in being awesome.)</option>
      <option value="cert" <?php selected( get_post_meta( get_the_ID(), 'eveski_type', true), 'cert'); ?> >Qualified / Certified (eg. I am a certified [hottie])</option>
      <option value="rating" <?php selected( get_post_meta( get_the_ID(), 'eveski_type', true), 'rating'); ?> >Star Rating (1-5) (eg. I am a [5] star [girlfriend])</option>
      <option value="cando" <?php selected( get_post_meta( get_the_ID(), 'eveski_type', true), 'cando'); ?> >Other (eg. I can do [anything I want to])</option>
    </select></p>
  <div id="eveski_bar_options" class="eveski_options">
    <h2>Progress Bar Options</h2>
    <p><label>How competent are you to do this? <?php if ( get_post_meta( get_the_ID(), 'eveski_value', true ) ) { echo '<strong>You originally said you were ' . get_post_meta( get_the_ID(), 'eveski_value', true ) . '% competent in this.  Do you want to change it?'; } else { } ?></label></p>
    <div id="skill-slider" class="dragdealer">
      <div class="handle red-bar">
        <span class="value"></span>%
      </div>
    </div>
    <script>
      new Dragdealer('skill-slider', {
        <?php if ( get_post_meta( get_the_ID(), 'eveski_value', true ) ) { echo 'x: 0.'.get_post_meta( get_the_ID(), 'eveski_value', true ).',
        '; } else { } ?>
        animationCallback: function(x, y) {
          var theVal = Math.round(x * 100);
          jQuery('#skill-slider .value').text(theVal);
          jQuery('input[name=eveski_value]').val(theVal);
        }
      });
    </script>
    <input type="hidden" name="eveski_value" value="<?php echo get_post_meta(get_the_ID(), 'eveski_value', true); ?>" /></p>
  </div>
  <div id="eveski_val_options" class="eveski_options">
    <h2>Number value Options</h2>
    <p><label>What are you measuring? (eg. wpm, years, months)</label>
      <input type="text" name="eveski_mment" value="<?php echo get_post_meta( get_the_ID(), 'eveski_mment', true ); ?>" size="20" /></p>
    <p><label>What is the value?</label>
      <input type="text" name="eveski_numvalue" value="<?php echo get_post_meta( get_the_ID(), 'eveski_numvalue', true ); ?>" size="10" /></p>
  </div>
  <div id="eveski_cert_options" class="eveski_options">
    <h2>Qualified / Certified Options</h2>
    <p>There are no other options for this.</p>
  </div>
  <div id="eveski_rating_options" class="eveski_options">
    <h2>Star Rating Options</h2>
    <p><label>How good are you at this?</label>
      <select name="eveski_rating">
        <option value="0">Select</option>
        <option value="1" <?php selected( get_post_meta( get_the_ID(), 'eveski_rating', true ), '1' ); ?> >1 (I can do it, but I've just started)</option>
        <option value="2" <?php selected( get_post_meta( get_the_ID(), 'eveski_rating', true ), '2' ); ?> >2</option>
        <option value="3" <?php selected( get_post_meta( get_the_ID(), 'eveski_rating', true ), '3' ); ?> >3</option>
        <option value="4" <?php selected( get_post_meta( get_the_ID(), 'eveski_rating', true ), '4' ); ?> >4</option>
        <option value="5" <?php selected( get_post_meta( get_the_ID(), 'eveski_rating', true ), '5' ); ?> >5 (I'm a self-confessed expert in this!)</option>
      </select>
  </div>
  <div id="eveski_cando_options" class="eveski_options">
    <h2>Other Skill</h2>
    <p>There are no other options for this.</p>
  </div>
    <script>
      function eveski_getTab(){
        jQuery('div.eveski_options').hide();
        var skiOp = jQuery('select#eveski_type').val();
        jQuery('#eveski_'+skiOp+'_options').show();
      }
      eveski_getTab();
      
      jQuery('#eveski_type').change(function(){
        eveski_getTab();
      });
    </script>
<?php

}

function eveski_slug( $data , $postarr ) {
	if( $data['post_type'] == 'skill' ) {
		// Set slug date
		$post_id = $postarr['ID'];
		// $post_slug = sanitize_title_with_dashes($post_date, '', $context = 'save');
		$data['post_name'] = $post_id;  
	}
	return $data;
}
add_filter( 'wp_insert_post_data' , 'eveski_slug' , '99', 2 );

add_action('save_post', 'eveski_save_details');

function eveski_save_details(){
  global $post;
 
  update_post_meta($post->ID, "eveski_type", $_POST["eveski_type"]);
  update_post_meta($post->ID, "eveski_value", $_POST["eveski_value"]);
  update_post_meta($post->ID, "eveski_mment", $_POST["eveski_mment"]);
  update_post_meta($post->ID, "eveski_numvalue", $_POST["eveski_numvalue"]);
  update_post_meta($post->ID, "eveski_rating", $_POST["eveski_rating"]);
}

add_filter('manage_edit-skill_columns', 'add_new_skill_columns');

function add_new_skill_columns($columns) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Skill',
        'value' => 'Competency'
    );
    
    return $columns;
}

    // Add to admin_init function
add_action('manage_skill_posts_custom_column', 'manage_skill_columns', 10, 2);
 
function manage_skill_columns($column, $post_id) {
    global $post;
    switch ($column) {
 
    case 'value':
        if ( get_post_meta( get_the_ID(), 'eveski_type', true ) == "bar" ) {
            $value = get_post_meta( get_the_ID(), 'eveski_value', true );
            if ( empty( $value ) ) {
                echo '<div style="background-color: #FFF; border: solid 1px #000; height: 12px; margin-bottom: 7px;"><div style="background-color: #000; width: 0%; height: 12px;"></div></div>Value not defined';
            } else {
                echo '<div style="background-color: #FFF; border: solid 1px #000; height: 12px; margin-bottom: 7px;"><div style="background-color: #000; width: ' . $value . '%; height: 12px;"></div></div>' . $value . '%'; 
            }
        } elseif ( get_post_meta( get_the_ID(), 'eveski_type', true ) == "val" ) {
            echo get_post_meta( get_the_ID(), 'eveski_numvalue', true ) . ' ' . get_post_meta( get_the_ID(), 'eveski_mment', true );
        } elseif ( get_post_meta( get_the_ID(), 'eveski_type', true ) == "cert" ) {
            echo 'Qualified / Certified';
        } elseif ( get_post_meta( get_the_ID(), 'eveski_type', true ) == "rating" ) {
            if ( get_post_meta( get_the_ID(), 'eveski_rating', true ) == "5" ){
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
            } elseif ( get_post_meta( get_the_ID(), 'eveski_rating', true ) == "4" ){
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
            } elseif ( get_post_meta( get_the_ID(), 'eveski_rating', true ) == "3" ){
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
            } elseif ( get_post_meta( get_the_ID(), 'eveski_rating', true ) == "2" ){
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
            } elseif ( get_post_meta( get_the_ID(), 'eveski_rating', true ) == "1" ){
                echo '<span class="dashicons dashicons-star-filled"></span>';
            } else {
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
                echo '<span class="dashicons dashicons-star-filled"></span>';
            }
        } else {
            echo 'Skilled';
        }
        break;
        
    default:
        break;
    } // end switch
}   
?>