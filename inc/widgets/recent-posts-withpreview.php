<?php

class CCD_Recent_Posts_Preview_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'recent-posts-preview-widget',
            __('Recent Posts Widget (with Preview)', 'recent-posts'),
            array(
                'classname'   => 'recent-posts',
                'description' => __('Widget to display recent posts, with preview images', 'recent-posts'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-editor-ul'
                ),
            array( 
                'width' => 300, 
                'height' => 350, 
                'id_base' => 'recent-posts-preview-widget'
                )
        );

        load_plugin_textdomain( 'ccd_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;
		echo do_shortcode( '[title h1="' . $instance['title'] . '" h2="' . $instance['subtitle'] . '" align="center" size="small" showbar="false"]' );
?>
    <div class="ccd-posts-preview-grid ccd-posts-grid ccd-posts-widget ccd-posts-preview-list-wrap ccd-recent-posts-withpreview ccd-recentposts-layout-<?php echo ( $instance['style'] != "" ? $instance['style'] : '2c3r' ); ?> clearfix">
      <?php
				if ( $instance['style'] == "3c1r" || $instance['style'] == "1c3r" ) { $ppp = 3; }
				elseif ( $instance['style'] == "2c2r" ) { $ppp = 4; }
				else { $ppp = 6; }

        $recent_args = array(
          'post_type' => 'post',
          'posts_per_page' => $ppp
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
        if ( has_post_thumbnail() ) {
            $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' );
            $featImg = $fImg[0];
            $styles = "background-image: url('".$featImg."');";
        } else {
            // $styles = "background-image: url('".get_stylesheet_directory_uri()."/images/default-blog-thumb.png');";
        }

				if ( $instance['style'] == "1c3r" ) {
        ?>
          <?php get_template_part( 'inc/posts/blog', 'post'); ?>
				<?php
				} else {
        ?>
      <article class="single-post widget-preview widget-post <?php if ( has_post_thumbnail() ) { echo 'has-thumbnail'; } else { echo 'no-thumbnail'; } ?>" id="post-<?php echo get_the_ID(); ?>">
				<?php if ( has_post_thumbnail() ) { ?>
        <div class="post-image post-col">
          <a href="<?php the_permalink(); ?>" class="post-photo-link" style="<?php echo $styles; ?>"></a>
        </div>
			  <?php } else { } ?>
        <div class="post-content post-col">
          <h3 class="post-meta post-title"><a href="<?php the_permalink(); ?>"><?php echo ( strlen( get_the_title() ) > 35 ) ? substr( get_the_title(), 0, 29 ) . '[...]' : get_the_title() ; ?></a></h3>
          <p class="post-meta post-date-comments">
						<span class="post-meta-item post-date">
							<span class="fa fa-calendar"></span>
							<?php echo get_the_date('F j, Y', '', ''); ?></span>
						<span class="post-meta-item post-comments">
	            <span class="fa fa-commenting"></span>
	            <?php
	              $number = (int) get_comments_number( get_the_ID() );
	                if ( $number > 0 ){
	                  $css_class = 'comments-link has-comment';
	                } else {
	                  $css_class = 'comments-link no-comment';
	                }
	                comments_popup_link( '0 comments', '1 comment', '% comments', '', 'Comments disabled');
	            ?></span></p>
          <p class="post-meta post-excerpt"><?php echo ( strlen( get_the_excerpt() ) > 100 ) ? substr( get_the_excerpt(), 0, 94 ) . '[...]' : get_the_excerpt(); ?></p>
          <p class="post-meta post-link"><a href="<?php the_permalink(); ?>">Continue Reading <span class="blog-grid-icon fa fa-angle-right"></span></a><p>
        </div>
        <div class="clear"></div>
      </article>
		<?php } endwhile; wp_reset_postdata(); else : ?>
        <li class="recent" id="no-posts">
          <div class="recent-meta">
            <div class="recent-info">
              <h3>There are no forthcoming posts.</h3>
            </div>
          </div>
        </li>
      <?php endif; ?>
    </div>
<?php
		echo $after_widget;

    }


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {
      
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['style'] = $new_instance['style'];

		return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Recent Posts', 'recent-posts'), 'subtitle' => __('A selection of recent posts from our blog', 'recent-posts'), 'style' => '2c3r' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'recent-posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e('Subtitle:', 'recent-posts'); ?></label>
			<input id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" value="<?php echo $instance['subtitle']; ?>" style="width:100%;" />
		</p>

		<p>Blog layout style</p>
		<div>
			<p style="float: left; padding-right: 24px;"><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" value="1c3r" <?php checked( $instance['style'], '1c3r'); ?>> 1 column, 3 rows (3 posts)<br />
				<img src="<?php echo plugins_url( '/images/fp-blogposts/1c3r.png', dirname( __FILE__ ) ) ?>" width="300" style="margin-top: 14px;" /></p>
			<p style="float: left; padding-right: 24px;"><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" value="3c1r" <?php checked( $instance['style'], '3c1r'); ?>> 3 columns, 1 row (3 posts)<br />
				<img src="<?php echo plugins_url( '/images/fp-blogposts/3c1r.png', dirname( __FILE__ ) ) ?>" width="300" style="margin-top: 14px;" /></p>
			<p style="float: left; padding-right: 24px;"><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" value="2c2r" <?php checked( $instance['style'], '2c2r'); ?>> 2 columns, 2 rows (4 posts)<br />
				<img src="<?php echo plugins_url( '/images/fp-blogposts/2c2r.png', dirname( __FILE__ ) ) ?>" width="300" style="margin-top: 14px;" /></p>
			<p style="float: left;"><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" value="2c3r" <?php checked( $instance['style'], '2c3r'); ?>> 2 columns, 3 rows (6 posts)<br />
				<img src="<?php echo plugins_url( '/images/fp-blogposts/2c3r.png', dirname( __FILE__ ) ) ?>" width="300" style="margin-top: 14px;" /></p>
			<div style="clear: both;"></div>
		</div>

	<?php
      
    }

}

/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Recent_Posts_Preview_Widget' );
});
