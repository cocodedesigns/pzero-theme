<?php
class CCD_Portfolio_Piece_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'ccd_portfolio_piece_widget',
            __( 'Portfolio Piece', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_portfolio_piece_widget',
                'description' => __( 'Adds an portfolio preview.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-media-document'
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

        $wID      = $args['widget_id'];
        $tID      = $instance['portfolio_id'];

        echo $before_widget;

        $recent_args = array(
          'post_type' => 'portfolio',
          'posts_per_page' => 1,
          'p' => $tID
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();

        if ( has_post_thumbnail() ) {
          $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
          $featImg = $fImg[0];
        }
        ?>

        <div class="portfolio-widget portfolio-piece-widget clearfix">
          <?php get_template_part( 'inc/posts/portfolio', 'post'); ?>
        </div>

        <?php
        endwhile; wp_reset_postdata(); else : endif;

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

        $instance['portfolio_id']  = strip_tags( $new_instance['portfolio_id'] );

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

        $tID    = esc_attr( $instance['portfolio_id'] );

        ?>
        <p><label for="<?php echo $this->get_field_id('portfolio_id'); ?>">Select a project:</label>
        <select class="widefat" id="<?php echo $this->get_field_id('portfolio_id'); ?>" name="<?php echo $this->get_field_name('portfolio_id'); ?>">
          <option value="0" <?php selected( '0', $tID ); ?>>Select a project</option>
        <?php

        $recent_args = array(
          'post_type' => 'portfolio',
          'posts_per_page' => -1,
          'order' => 'ASC',
          'orderby' => 'title'
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
            echo '<option value="'.get_the_ID().'" '.selected( $tID, get_the_ID() ).'>'.get_the_title().' (Posted '.get_the_date('d/m/Y').')</option>';
        endwhile; wp_reset_postdata(); else : endif;
        ?>
        </select>
    <?php
    }

}


/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Portfolio_Piece_Widget' );
});
