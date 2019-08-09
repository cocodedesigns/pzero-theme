<?php

class CCD_Quote_Widget extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'quote-widget',
            __('Quotation Widget', 'quote-widget'),
            array(
                'classname'   => 'quote-widget',
                'description' => __('Widget to display quotation', 'quote-widget'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-format-quote'
                ),
            array( 
                'width' => 300, 
                'height' => 350, 
                'id_base' => 'quote-widget'
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

		echo $before_widget;

        echo do_shortcode( '[showquote name="'.$instance['name'].'"]'. wpautop( $instance['quote'] ) .'[/showquote]' );

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
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['quote'] = $new_instance['quote'];

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

    wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( '/js/wp-color-picker-alpha.min.js',  dirname( __FILE__ ) ) );
    wp_enqueue_style('ccdWidget-mainStyles', plugins_url( '../css/widget-editor-styles.css', __FILE__ ), array(),'all');
    $edid = uniqid('ccdClient_ckeditor_');

		// Set up some default widget settings.
		$defaults = array( 'textClr' => '#FFFFFF' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<script>
  jQuery(document).ready(function($){
    $('ul.ccdWidget-tabWidget-tabs li').click(function(){
      var tab_id = $(this).attr('data-tab');
      $('ul.ccdWidget-tabWidget-tabs li').removeClass('current');
      $('.ccdWidget-tabWidget-content').removeClass('current');
      $(this).addClass('current');
      console.log($(this));
      $("#"+tab_id+".widgetContentDiv").addClass('current');
      console.log('Added class to content div');
    })
  })
</script>
  <div class="ccdWidget-tabContainer">
    <ul class="ccdWidget-tabWidget-tabs">
      <li class="tab-link current" data-tab="tab-mainContent">Content</li>
    </ul>

    <div id="tab-mainContent" class="ccdWidget-tabWidget-content widgetContentDiv current">
      <div id="<?php echo $this->get_field_id('quote'); ?>" class="can-hide">
        <textarea class="richtext-editor" name="<?php echo $this->get_field_name('quote'); ?>" id="<?php echo $edid; ?>"><?php echo wpautop( $instance['quote'] ); ?></textarea>
        <script>
            jQuery(document).ready(function($) {
                $('#<?php echo $edid; ?>').richText({
                  // text alignment
                  leftAlign: false,
                  centerAlign: false,
                  rightAlign: false,
                  // lists
                  ol: false,
                  ul: false,
                  // title
                  heading: false,
                  // fonts
                  fonts: false,
                  fontColor: false,
                  // uploads
                  imageUpload: false,
                  fileUpload: false,
                  // media
                  videoEmbed: false,
                  // links
                  urls: false,
                  // tables
                  table: false,
                  // Force Paragraphs
                  useParagraph: true,
                  height: 150
                });
            });
        </script>
      </div>
      <p>
        <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Quote attributed to:', 'quote-widget'); ?></label>
        <input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
      </p>
    </div>
    
    <div id="tab-featuredImage" class="ccdWidget-tabWidget-content widgetContentDiv">
    </div>
  </div>
	<?php
      
    }

}

/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Quote_Widget' );
});

function ccd_showquote_shortcode( $atts, $content = null ){

    // Set default attributes
    $atts = ( shortcode_atts( array(
            'name'   => '', // Quote name
        ), $atts, 'showquote' ) );

    // Set classes
    $class = "";

    // Create Quote wrap
    $showquote = '
                  <div class="quoteWidget-wrap quoteWidget">
                    <div class="quoteOverlay">
                      <div class="quoteWrap">
                        <div class="container">
                          <div class="quoteMark quoteMark-open">
                            <span class="fas fa-quote-left"></span>
                          </div>
                          <div class="quoteContainer">
                            '.$content.'
                          </div>
                          <div class="quotePerson">
                            <p class="quotedBy">-- '.$atts['name'].'</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
        ';
    return $showquote;
}
add_shortcode( 'showquote', 'ccd_showquote_shortcode' );
