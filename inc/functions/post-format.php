<?php

add_theme_support( 'post-formats', array( 'audio', 'image', 'video'  ) );

function mb_ccdblog_postformat() {
    add_meta_box( 'ccdblog_postformat', 'Post Format Details', 'cb_ccdblog_postformat', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'mb_ccdblog_postformat' );

function cb_ccdblog_postformat( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'no_ccdblog_postformat', 'ccdblog_postformat_nonce' );

	// Use get_post_meta() to retriccd an existing value from the database and use the value for the form.

    ?>
    <style>
    #ccd_quote_img_preview{ background-color: #000; background-size: cover; background-position: center center; overflow: hidden; }
    #ccd_quote_img_preview a{ height: 60px; display: block; color: #383838; text-decoration: none; padding: 112px 0; background-color: rgba(0,0,0,.4); transition: all ease .3s; opacity: 0; text-align: center; }
    #ccd_quote_img_preview a:hover{ opacity: 1; }
    #ccd_quote_img_preview span.dashicons{ font-size: 30px; display: inline-block; text-align: center; height: 60px; width: 60px; line-height: 60px; background-color: #FFF; border-radius: 50%; }
    </style>
    <div id="post-format-0" class="ccd_post_tab">
      <h2>Standard Post Settings</h2>
      <p>There are no additional settings for 'Standard' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-aside" class="ccd_post_tab">
      <h2>Aside Post Settings</h2>
      <p>There are no additional settings for 'Aside' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-audio" class="ccd_post_tab">
      <h2>Audio Post Settings</h2>
      <p>Select service to play:
        <select id="ccd_audio_player_select" name="ccd_audio_player">
          <option value="0">Select</option>
          <option value="soundcloud" <?php selected( get_post_meta( get_the_ID(), 'ccd_audio_player', true), 'soundcloud'); ?> >Soundcloud</option>
          <option value="spotify" <?php selected( get_post_meta( get_the_ID(), 'ccd_audio_player', true), 'spotify'); ?> >Spotify</option>
        </select>
        <label id="ccd_audio_url_label">Track URL:</label>
        <input type="text" size="35" id="ccd_audio_track" name="ccd_audio_track" value="<?php echo get_post_meta( get_the_ID(), 'ccd_audio_track', true); ?>" /></p>
    </div>
    <div id="post-format-chat" class="ccd_post_tab">
      <h2>Chat Post Settings</h2>
      <p>There are no additional settings for 'Chat' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-link" class="ccd_post_tab">
      <h2>Link Post Settings</h2>
      <p><label>Site Title: </label>
        <input type="text" size="35" name="ccd_link_title" value="<?php echo get_post_meta( get_the_ID(), 'ccd_link_title', true); ?>" /></p>
      <p><label>Link URL: </label>
        <input type="url" size="35" name="ccd_link_url" value="<?php echo get_post_meta( get_the_ID(), 'ccd_link_url', true); ?>" /><br />
        <em>All links will open in a new tab or window.</em></p>
      <p><input type="checkbox" name="ccd_link_thumb" value="yes" <?php checked( get_post_meta( get_the_ID(), 'ccd_link_thumb', true ), 'yes' ); ?> />
        <label>Show preview thumbnail?</label><br />
        <em>Preview thumbnails are powered by <strong>Wordpres MShots</strong>.</em></p>
    </div>
    <div id="post-format-image" class="ccd_post_tab">
      <h2>Image Post Settings</h2>
      <p>There are no additional settings for 'Image' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-gallery" class="ccd_post_tab">
      <h2>Gallery Post Settings</h2>
      <p>There are no additional settings for 'Gallery' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-quote" class="ccd_post_tab">
        <script>
          jQuery(document).ready(function($){
            $('#ccd_quote_img_preview a').click(function(e) {
              e.preventDefault();
              var custom_uploader = wp.media({
                title: 'Select Photo',
                button: {
                    text: 'Add Photo'
                },
                multiple: false  // Set this to true to allow multiple files to be selected
              })
              .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $('#ccd_quote_img_preview').css('background-image', 'url('+attachment.sizes.thumbnail.url+')');
                $('#ccd_quote_img').val(attachment.id);
              })
              .open();
            });
          })
        </script>
      <h2>Quote Post Settings</h2>
      <p><label>What type of quote is this?</label>
        <select name="ccd_quote_format" id="ccd_quote_format">
          <option value="quote" <?php selected( get_post_meta( get_the_ID(), 'ccd_quote_format', true), 'quote'); ?> >Quote</option>
          <option value="facebook" <?php selected( get_post_meta( get_the_ID(), 'ccd_quote_format', true), 'facebook'); ?> >Facebook</option>
          <option value="twitter" <?php selected( get_post_meta( get_the_ID(), 'ccd_quote_format', true), 'twitter'); ?> >Twitter</option>
        </select>
      <div id="quote_details" class="ccd_quote_details">
        <div class="quote-image" style="display: inline-block; margin: 0 -2px; width: 30%; height: 340px; vertical-align: top;">
          <p>Quote photo</p>
          <div style="height: 295px;">
            <?php if ( get_post_meta( get_the_ID(), 'ccd_quote_img', true ) ) { ?><div id="ccd_quote_img_preview" style="background-image: url('<?php echo wp_get_attachment_thumb_url( get_post_meta( get_the_ID(), 'ccd_quote_img', true ) ); ?>')"><a href="#load_image"><span class="dashicons-search dashicons"></span></a></div><?php } else { ?><div id="ccd_quote_img_preview" style=""><a href="#load_image"><span class="dashicons-search dashicons"></span></a></div><?php } ?>
            <input id="ccd_quote_img" type="hidden" name="ccd_quote_img" value="<?php echo get_post_meta( get_the_ID(), 'ccd_quote_img', true ); ?>" />
          </div>
        </div>
        <div class="quote-content" style="display: inline-block; margin: 0 -2px; width: 70%; height: 340px; vertical-align: top; box-sizing: border-box; padding-left: 12px;">
          <p><label>What did they say?</label></p>
          <textarea name="ccd_quote_text" style="width: 100%; height: 200px;"><?php echo get_post_meta( get_the_ID(), 'ccd_quote_text', true ); ?></textarea>
          <p><label>Who said this originally?</label></p>
          <p><input type="text" size="35" name="ccd_quote_attr" value="<?php echo get_post_meta( get_the_ID(), 'ccd_quote_attr', true ); ?>" style="width: 100%;" /></p>
        </div>
      </div>
      <p id="facebook_details" class="ccd_quote_details" style="display: none;"><label>Facebook URL:</label>
        <input type="text" size="35" name="ccd_quote_fburl" value="<?php echo get_post_meta( get_the_ID(), 'ccd_quote_fburl', true ); ?>" /></p>
      <p id="twitter_details" class="ccd_quote_details" style="display: none;"><label>Twitter URL:</label>
        <input type="text" size="35" name="ccd_quote_twurl" value="<?php echo get_post_meta( get_the_ID(), 'ccd_quote_twurl', true ); ?>" /></p>
    </div>
    <div id="post-format-video" class="ccd_post_tab">
      <h2>Video Post Settings</h2>
      <p><label>Video source:</label>
        <select name="ccd_video_source" id="ccd_video_source">
          <option value="0">Select</option>
          <option value="youtube" <?php selected( get_post_meta( get_the_ID(), 'ccd_video_source', true), 'youtube'); ?> >YouTube</option>
          <option value="vimeo" <?php selected( get_post_meta( get_the_ID(), 'ccd_video_source', true), 'vimeo'); ?> >Vimeo</option>
        </select>
        <label id="ccd_video_url_label">URL:</label>
        <input type="text" size="35" name="ccd_video_url" id="ccd_video_url" value="<?php echo get_post_meta( get_the_ID(), 'ccd_video_url', true ); ?>" /></p>
    </div>
    <div id="post-source">
      <h2>Post Source</h2>
      <p>If this post came from another website, enter the source information here.</p>
      <p><label>Website Title:</label>
        <input type="text" size="25" name="ccd_post_source_name" value="<?php echo get_post_meta( get_the_ID(), 'ccd_post_source_name', true ); ?>" />
        <label>Website URL: <strong>http://</strong></label>
        <input type="text" name="ccd_post_source_url" size="35" value="<?php echo get_post_meta( get_the_ID(), 'ccd_post_source_url', true ); ?>" /></p>
    </div>
    <script>
      function ccd_getTab(){
        jQuery('div.ccd_post_tab').hide(); // Hide all tabs
        var pfrButt = jQuery('#post-formats-select input[name=post_format]'); // Find Post Format radio buttons
        var pfrButtFil = pfrButt.filter(':checked').attr('id'); // Filter for active radio button
        jQuery('div#'+pfrButtFil+'.ccd_post_tab').show(); // Show tab for radio button
      }
      ccd_getTab();

      jQuery('#post-formats-select input[name=post_format]').change( function(){
        ccd_getTab();
      });

      jQuery('#ccd_quote_format').change(function(){
        jQuery('.ccd_quote_details').hide().filter('#'+jQuery(this).val()+'_details').show();
      });
      jQuery(document).ready(function(){
          var qf = jQuery('#ccd_quote_format').val();
          jQuery('.ccd_quote_details').hide().filter('#'+qf+'_details').show();
      });
    </script>

<?php
}

/* When the post is saved, saves our custom data.
   @param int $post_id The ID of the post being saved. */
function mb_ccdblog_post_meta_save( $post_id ) {
    // We need to verify this came from our screen and with proper authorization, because the save_post action can be triggered at other times.
	// Check if our nonce is set.
	if ( ! isset( $_POST['ccdblog_postformat_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['ccdblog_postformat_nonce'], 'no_ccdblog_postformat' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

	/* OK, it's safe for us to save the data now. */

	// Update the meta field in the database.
	update_post_meta( $post_id, 'ccd_audio_player', $_POST['ccd_audio_player'] );
	update_post_meta( $post_id, 'ccd_audio_track', sanitize_text_field( $_POST['ccd_audio_track'] ) );
	update_post_meta( $post_id, 'ccd_link_url', sanitize_text_field( $_POST['ccd_link_url'] ) );
	update_post_meta( $post_id, 'ccd_link_thumb', sanitize_text_field( $_POST['ccd_link_thumb'] ) );
	update_post_meta( $post_id, 'ccd_link_title', sanitize_text_field( $_POST['ccd_link_title'] ) );
    update_post_meta( $post_id, 'ccd_quote_format', $_POST['ccd_quote_format'] );
	update_post_meta( $post_id, 'ccd_quote_attr', sanitize_text_field( $_POST['ccd_quote_attr'] ) );
	update_post_meta( $post_id, 'ccd_quote_text', sanitize_text_field( $_POST['ccd_quote_text'] ) );
	update_post_meta( $post_id, 'ccd_quote_img', sanitize_text_field( $_POST['ccd_quote_img'] ) );
    update_post_meta( $post_id, 'ccd_quote_fburl', sanitize_text_field( $_POST['ccd_quote_fburl'] ) );
    update_post_meta( $post_id, 'ccd_quote_twurl', sanitize_text_field( $_POST['ccd_quote_twurl'] ) );
	update_post_meta( $post_id, 'ccd_video_source', $_POST['ccd_video_source'] );
	update_post_meta( $post_id, 'ccd_video_url', sanitize_text_field( $_POST['ccd_video_url'] ) );
    update_post_meta( $post_id, 'ccd_post_source_name', sanitize_text_field( $_POST['ccd_post_source_name'] ) );
    update_post_meta( $post_id, 'ccd_post_source_url', sanitize_text_field( $_POST['ccd_post_source_url'] ) );
}

add_action( 'save_post', 'mb_ccdblog_post_meta_save' );
