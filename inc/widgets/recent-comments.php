<?php

add_action( 'widgets_init', 'ccd_recent_comments_widget' );


function ccd_recent_comments_widget() {
	register_widget( 'CCD_Recent_Comments_Widget' );
}

class CCD_Recent_Comments_Widget extends WP_Widget {

	function CCD_Recent_Comments_Widget() {
		$widget_ops = array( 'classname' => 'recent-comments', 'description' => __('Widget to display recent comments', 'recent-comments'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-format-chat' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recent-comments-widget' );
		
		$this->WP_Widget( 'recent-comments-widget', __('Recent Comments Widget', 'recent-comments'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		if ( $instance['wcount'] >= 5 ) { $wcount = 5; } else { $wcount = $instance['wcount']; }
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;


// function bg_recent_comments($no_comments = 5, $comment_len = 80, $avatar_size = 48) {
	$comments_query = new WP_Comment_Query();
	$comments = $comments_query->query( array( 'number' => $wcount ) );	
?>
    <div class="ccd-comments-list ccd-comments-list-wrap ccd-recent-comments">
      <?php if ( $comments ) : foreach ( $comments as $comment ) : ?>
        <div class="ccd-recent-comments ccd-comments-list-comment recent-comment" id="recent_<?php get_the_ID(); ?>">
          <div class="ccd-comment-gravatar">
            <p><?php echo get_avatar( $comment->comment_author_email, 60 ); ?></p>
          </div>
          <div class="ccd-comment-display">
            <p class="recent-comment-text"><?php if ( strlen( strip_tags( $comment->comment_content ) ) > 80 ) { echo strip_tags( substr( $comment->comment_content, 0, 80 ) ) . '...'; } else { echo strip_tags( $comment->comment_content ); } ?></p>
            <hr class="recent-comment-hr"></hr>
            <p class="recent-comment-author"><span class="author-name"><?php echo get_comment_author( $comment->comment_ID ); ?></span> on <a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>"><?php echo get_the_title( $comment->comment_post_ID ); ?></a>
          </div>
        </div>
      <?php endforeach; else : ?>
        <div class="ccd-recent-comments ccd-comments-list-comment recent-comment" id="recent_<?php get_the_ID(); ?>">
          <div class="ccd-comment-gravatar">
            <p class="no-comment"><img src="<?php echo get_template_directory_uri(); ?>/images/noun_16703_cc.png" width="60" height="60" /></p>
          </div>
          <div class="ccd-comment-display">
            <p class="recent-comment-text"><strong>It's oh so quiet ...</strong></p>
            <hr class="recent-posts-hr"></hr>
            <p class="recent-comment-text">Join in with the conversation in my <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">blog</a> or my <a href="<?php echo get_post_type_archive_link( 'portfolio' ); ?>">portfolio</a>.</p>
          </div>
        </div>
    <?php
	endif; ?>
    </div>
    <div class="clear"></div>
    <?php
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['wcount'] = strip_tags( $new_instance['wcount'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Recent Comments', 'recent-comments'), 'wcount' => __('5', 'recent-comments'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'recent-comments'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'wcount' ); ?>"><?php _e('Number of events shown:', 'recent-comments'); ?></label>
			<input id="<?php echo $this->get_field_id( 'wcount' ); ?>" name="<?php echo $this->get_field_name( 'wcount' ); ?>" value="<?php echo $instance['wcount']; ?>" type="number" min="0" max="10" style="width:100%;" />
		</p>

	<?php
	}
}
