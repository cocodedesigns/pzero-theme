<?php
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function mb_inarablog_postformat() {
    add_meta_box( 'inarablog_postformat', 'Post Format Details', 'cb_inarablog_postformat', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'mb_inarablog_postformat' );

function cb_inarablog_postformat( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'no_inarablog_postformat', 'inarablog_postformat_nonce' );

	// Use get_post_meta() to retriinara an existing value from the database and use the value for the form.
  
    ?>
    <div id="post-format-0" class="eba_post_tab">
      <h2>Standard Post Settings</h2>
      <p>There are no additional settings for 'Standard' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-aside" class="eba_post_tab">
      <h2>Aside Post Settings</h2>
      <p>There are no additional settings for 'Aside' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-audio" class="eba_post_tab">
      <h2>Audio Post Settings</h2>
      <p>Select service to play: 
        <select id="epf_audio_player_select" name="epf_audio_player">
          <option value="0">Select</option>
          <option value="soundcloud" <?php selected( get_post_meta( get_the_ID(), 'epf_audio_player', true), 'soundcloud'); ?> >Soundcloud</option>
          <option value="spotify" <?php selected( get_post_meta( get_the_ID(), 'epf_audio_player', true), 'spotify'); ?> >Spotify</option>
        </select>
        <?php if ( get_post_meta( get_the_ID(), 'epf_audio_player', true ) == "0" || !get_post_meta( get_the_ID(), 'epf_audio_player', true ) ) { $cssDisplay = 'none'; } else { $cssDisplay = 'block'; } ?>
        <label id="epf_audio_url_label" style="display: <?php echo $cssDisplay; ?>;">Track URL:</label>
        <input type="text" size="35" id="epf_audio_track" style="display: <?php echo $cssDisplay; ?>;" name="epf_audio_track" value="<?php echo get_post_meta( get_the_ID(), 'epf_audio_track', true); ?>" /></p>
      <script>
        jQuery('#epf_audio_player_select').change(function(){
          if ( jQuery(this).val() == "0" ) {
            jQuery('#epf_audio_url_label').hide();
            jQuery('#epf_audio_track').hide();
          } else { 
            jQuery('#epf_audio_url_label').show();
            jQuery('#epf_audio_track').show();
          }
        });
      </script>
    </div>
    <div id="post-format-chat" class="eba_post_tab">
      <h2>Chat Post Settings</h2>
      <p>There are no additional settings for 'Chat' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-link" class="eba_post_tab">
      <h2>Link Post Settings</h2>
      <p><label>Link URL: <strong>http://</strong></label>
        <input type="text" size="35" name="epf_link_url" value="<?php echo get_post_meta( get_the_ID(), 'epf_post_url', true); ?>" /><br />
        <em>All links will open in a new tab or window.</em></p>
      <p><input type="checkbox" name="epf_link_thumb" value="yes" <?php checked( get_post_meta( get_the_ID(), 'epf_link_thumb', true ), 'yes' ); ?> />
        <label>Show preview thumbnail?</label><br />
        <em>Preview thumbnails are powered by <strong>Wordpres MShots</strong>.</em></p>
    </div>
    <div id="post-format-image" class="eba_post_tab">
      <h2>Image Post Settings</h2>
      <p>There are no additional settings for 'Image' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-gallery" class="eba_post_tab">
      <h2>Gallery Post Settings</h2>
      <p>There are no additional settings for 'Gallery' post types, so you can just go ahead and click <strong>Publish</strong> and publish your post.</p>
    </div>
    <div id="post-format-quote" class="eba_post_tab">
      <h2>Quote Post Settings</h2>
      <p><label>What type of quote is this?</label>
        <select name="epf_quote_format" id="epf_quote_format">
          <option value="quote" <?php selected( get_post_meta( get_the_ID(), 'epf_quote_format', true), 'quote'); ?> >Quote</option>
          <option value="facebook" <?php selected( get_post_meta( get_the_ID(), 'epf_quote_format', true), 'facebook'); ?> >Facebook</option>
          <option value="twitter" <?php selected( get_post_meta( get_the_ID(), 'epf_quote_format', true), 'twitter'); ?> >Twitter</option>
        </select>
      <p id="quote_details" class="epf_quote_details"><label>Who said this originally?</label>
        <input type="text" size="35" name="epf_quote_attr" value="<?php echo get_post_meta( get_the_ID(), 'epf_quote_attr', true ); ?>" /></p>
      <p id="facebook_details" class="epf_quote_details" style="display: none;"><label>Facebook URL:</label>
        <input type="text" size="35" name="epf_quote_fburl" value="<?php echo get_post_meta( get_the_ID(), 'epf_quote_fburl', true ); ?>" /></p>
      <p id="twitter_details" class="epf_quote_details" style="display: none;"><label>Twitter URL:</label>
        <input type="text" size="35" name="epf_quote_twurl" value="<?php echo get_post_meta( get_the_ID(), 'epf_quote_twurl', true ); ?>" /></p>
    </div>
    <div id="post-format-video" class="eba_post_tab">
      <h2>Video Post Settings</h2>
      <p><label>Video source:</label>
        <select name="epf_video_source" id="epf_video_source">
          <option value="0">Select</option>
          <option value="youtube" <?php selected( get_post_meta( get_the_ID(), 'epf_video_source', true), 'youtube'); ?> >YouTube</option>
          <option value="vimeo" <?php selected( get_post_meta( get_the_ID(), 'epf_video_source', true), 'vimeo'); ?> >Vimeo</option>
        </select>
        <label id="epf_video_url_label" style="display: none;">URL:</label>
        <input type="text" size="35" name="epf_video_url" id="epf_video_url" style="display: none;" value="<?php echo get_post_meta( get_the_ID(), 'epf_video_url', true ); ?>" /></p>
      <script>
        jQuery('#epf_video_source').change(function(){
          if ( jQuery(this).val() == "0" ) {
            jQuery('#epf_video_url_label').hide();
            jQuery('#epf_video_url').hide();
          } else { 
            jQuery('#epf_video_url_label').show();
            jQuery('#epf_video_url').show();
          }
        });
      </script>
    </div>
    <div id="post-source">
      <h2>Post Source</h2>
      <p>If this post came from another website, enter the source information here.</p>
      <p><label>Website Title:</label>
        <input type="text" size="25" name="epf_post_source_name" value="<?php echo get_post_meta( get_the_ID(), 'epf_post_source_name', true ); ?>" />
        <label>Website URL: <strong>http://</strong></label>
        <input type="text" name="epf_post_source_url" size="35" value="<?php echo get_post_meta( get_the_ID(), 'epf_post_source_url', true ); ?>" /></p>
    </div>
    <script>
      function eba_getTab(){
        jQuery('div.eba_post_tab').hide(); // Hide all tabs
        var pfrButt = jQuery('#post-formats-select input[name=post_format]'); // Find Post Format radio buttons
        var pfrButtFil = pfrButt.filter(':checked').attr('id'); // Filter for active radio button
        jQuery('div#'+pfrButtFil+'.eba_post_tab').show(); // Show tab for radio button
      }
      eba_getTab();
      
      jQuery('#post-formats-select input[name=post_format]').change( function(){
        eba_getTab();
      });
      
      jQuery('#epf_quote_format').change(function(){
        jQuery('.epf_quote_details').hide().filter('#'+jQuery(this).val()+'_details').show();
      });
    </script>

<?php
}

/* When the post is saved, saves our custom data.
   @param int $post_id The ID of the post being saved. */
function mb_inarablog_post_meta_save( $post_id ) {
    // We need to verify this came from our screen and with proper authorization, because the save_post action can be triggered at other times. 
	// Check if our nonce is set.
	if ( ! isset( $_POST['inarablog_postformat_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['inarablog_postformat_nonce'], 'no_inarablog_postformat' ) ) {
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
	update_post_meta( $post_id, 'epf_audio_player', $_POST['epf_audio_player'] );
	update_post_meta( $post_id, 'epf_audio_track', sanitize_text_field( $_POST['epf_audio_track'] ) );
	update_post_meta( $post_id, 'epf_link_url', sanitize_text_field( $_POST['epf_link_url'] ) );
	update_post_meta( $post_id, 'epf_link_thumb', sanitize_text_field( $_POST['epf_link_thumb'] ) );
    update_post_meta( $post_id, 'epf_quote_format', $_POST['epf_quote_format'] );
	update_post_meta( $post_id, 'epf_quote_attr', sanitize_text_field( $_POST['epf_quote_attr'] ) );
    update_post_meta( $post_id, 'epf_quote_facebook', sanitize_text_field( $_POST['epf_quote_facebook'] ) );
    update_post_meta( $psot_id, 'epf_quote_twitter', sanitize_text_field( $_POST['epf_quote_twitter'] ) );
	update_post_meta( $post_id, 'epf_video_source', $_POST['epf_video_source'] );
	update_post_meta( $post_id, 'epf_video_url', sanitize_text_field( $_POST['epf_video_url'] ) );
    update_post_meta( $post_id, 'epf_post_source_name', sanitize_text_field( $_POST['epf_post_source_name'] ) );
    update_post_meta( $post_id, 'epf_post_source_url', sanitize_text_field( $_POST['epf_post_source_url'] ) );
}

add_action( 'save_post', 'mb_inarablog_post_meta_save' );