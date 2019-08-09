<?php
class CCD_Testimonial_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_testimonial_widget',
            __( 'Testimonial Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_testimonial_widget',
                'description' => __( 'Adds an testimonial box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-thumbs-up'
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
        
        $wID    = $args['widget_id'];
        $tID    = $instance['testimonial_id'];
        $wAL    = $instance['align'];
        $wBO    = $instance['border'];
        $wIM    = $instance['image_id'];
        $over   = $instance['over'];
        
        if ( $over == "dark" || $over == "light" ){ $cc = "has-image has-fi featured-image override-bgcheck background--" . $over; } else { $cc = "has-image has-fi featured-image bgc-image no-override"; }
        
        if ( $wIM ){
            $classes = $cc;
            $img = wp_get_attachment_image_src( $wIM, 'large' );
            $styles = 'background-image: url(\''.$img[0].'\')';
        } else { $classes = 'no-image no-fi'; }

        echo $before_widget;

        $recent_args = array(
          'post_type' => 'testimonial',
          'posts_per_page' => 1,
          'p' => $tID
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
        
        $content    = get_post_meta( get_the_ID(), 'ccd_testimonial_content', true );
        $person     = get_post_meta( get_the_ID(), 'ccd_testimonial_person', true );
        $position   = get_post_meta( get_the_ID(), 'ccd_testimonial_position', true );
        $company    = get_post_meta( get_the_ID(), 'ccd_testimonial_company', true );
        
        wp_enqueue_script( 'testimonial-js', get_template_directory_uri().'/js/testimonial.js' );
        
        echo '
        <article class="widget-testimonial-wrap">
          <div class="widget-testimonial single-testimonial testimonial-align-'.$wAL.' '.$classes.'" style="'.$styles.'" id="'.$wID.'">
            <div class="testimonial-wrap '.( $wBO == '1' ? 'has-border' : 'no-border' ).' '.( $wIM ? 'bgc-target' : 'no-target' ).'">
              <div class="testimonial-quote">
                <div class="testimonial-content-wrap">
                  <div class="testimonial-content-outer">
                    <div class="testimonial-content-inner">
                      <p class="testimonial-content">'.$content.'</p>
                    </div>
                  </div>
                </div>
                <p><span class="testimonial-credit testimonial-name">'.$person.'</span>
                  '.
                    ( ( $position && $company ) ? '<br /><span class="testimonial-credit testimonial-position">'.$position.' at</span>
                    <span class="testimonial-credit testimonial-company">'.$company.'</span>' : '' ) .
                    ( ( !$position && $company ) ? '<br /><span class="testimonial-credit testimonial-company">'.$company.'</span>' : '' )
                  .'
                </p>
              </div>
            </div>
          </div>
        </article>
        ';
        
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

        $instance['testimonial_id']  = strip_tags( $new_instance['testimonial_id'] );
        $instance['align']           = strip_tags( $new_instance['align'] );
        $instance['border']          = strip_tags( $new_instance['border'] );
        $instance['image_id']        = strip_tags( $new_instance['image_id'] );
        $instance['over']            = strip_tags( $new_instance['over'] );
         
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
     
        $tID    = esc_attr( $instance['testimonial_id'] );
        $wAL    = esc_attr( $instance['align'] );
        $wBO    = esc_attr( $instance['border'] );
        $wIM    = esc_attr( $instance['image_id'] );
        $over   = esc_attr( $instance['over'] );
        
        ?>
        <p><label for="<?php echo $this->get_field_id('testimonial_id'); ?>">Select a testimonial:</label>
        <select class="widefit" id="<?php echo $this->get_field_id('testimonial_id'); ?>" name="<?php echo $this->get_field_name('testimonial_id'); ?>">
          <option value="0" <?php selected( '0', $tID ); ?>>Select a testimonial</option>
        <?php

        $recent_args = array(
          'post_type' => 'testimonial',
          'posts_per_page' => -1
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
            echo '<option value="'.get_the_ID().'" '.selected( $tID, get_the_ID() ).'>'.get_the_title().' (Posted '.get_the_date('d/m/Y').')</option>';
        endwhile; wp_reset_postdata(); else : endif;
        ?>
        </select>
        <p><label>Content Alignment<label>
        <select name="<?php echo $this->get_field_name('align'); ?>" id="<?php echo $this->get_field_id('align'); ?>">
          <option value="left" <?php selected('left', $wAL); ?>>Left</option>
          <option value="center" <?php selected('center', $wAL); ?>>Center</option>
        </select></p>
        <p><label>Border</label>
        <select name="<?php echo $this->get_field_name('border'); ?>" id="<?php echo $this->get_field_id('border'); ?>">
          <option value="0" <?php selected('0', $wBO); ?>>No Border</option>
          <option value="1" <?php selected('1', $wBO); ?>>Show Border</option>
        </select></p>
        <p>
            <label for="<?php echo $this->get_field_id('over'); ?>"><?php _e('Force Light / Dark image:'); ?></label> 
            <select id="<?php echo $this->get_field_id('over'); ?>" name="<?php echo $this->get_field_name('over'); ?>">
                <option value="0" <?php selected( '0', $over ); ?>>No override</option>
                <option value="dark" <?php selected( 'dark', $over ); ?>>Dark image</option>
                <option value="light" <?php selected( 'light', $over ); ?>>Light image</option>
            </select>
        </p>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $wIM ) { $img = wp_get_attachment_image_src( $wIM, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" id="<?php echo $this->get_field_id('image_id'); ?>" name="<?php echo $this->get_field_name('image_id'); ?>" value="<?php echo $wIM; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 400px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery('.upload-button').click(function(e) {
      e.preventDefault();
      var widget_button = jQuery(this);
      var custom_uploader = wp.media({
        title: 'Select Background Image',
        button: {
            text: 'Select Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).parent().addClass('hasimage').css('background-image', 'url('+attachment.sizes.full.url+')');
        jQuery(widget_button).parent().next().val(attachment.id);
      })
      .open();
    });
    jQuery('.remove-image').click(function(e) {
        e.preventDefault();
        jQuery(this).prev().prev().removeClass('hasimage').css('background-image', '');
        jQuery(this).prev().val('');
    });
        </script>
    <?php 
    }
     
}

class CCD_Testimonial_Slider_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_testimonial_slider_widget',
            __( 'Testimonial Slider Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_testimonial_slider_widget',
                'description' => __( 'Adds an testimonial slider box.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-thumbs-up'
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
        
        if ( !is_child_theme() ) {

            wp_enqueue_script('unslider-js', get_template_directory_uri().'/js/unslider.min.js');

            extract( $args );

            $wID    = $args['widget_id'];
            $wAL    = $instance['align'];
            $wIM    = $instance['image_id'];
            $wNP    = $instance['number_posts'];
            $wSP    = $instance['speed'];
            $wDE    = $instance['delay'];
            $wAR    = $instance['arrows'];
            $wAN    = $instance['animation'];
            $wNA    = $instance['navigation'];

            if ( $wIM ){
                $classes = 'has-image has-fi featured-image bgc-image';
                $img = wp_get_attachment_image_src( $wIM, 'large' );
                $styles = 'background-image: url(\''.$img[0].'\')';
            } else { $classes = 'no-image no-fi'; }

            echo $before_widget;

            echo '
            <div class="widget-testimonial-slider widget-testimonial featured-testimonials page-testimonial unslider '.$classes.'" style="'.$styles.'" id="'.$wID.'">
              <ul class="'.( $wIM ? 'bgc-target' : 'no-target' ).'">';

            $recent_args = array(
              'post_type' => 'testimonial',
              'posts_per_page' => ( $wNP ? $wNP : 5 ),
              'orderby' => 'rand'
            );
            $recent_query = new WP_Query( $recent_args );
            if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();

            $content    = get_post_meta( get_the_ID(), 'ccd_testimonial_content', true );
            $person     = get_post_meta( get_the_ID(), 'ccd_testimonial_person', true );
            $position   = get_post_meta( get_the_ID(), 'ccd_testimonial_position', true );
            $company    = get_post_meta( get_the_ID(), 'ccd_testimonial_company', true );

            $Tcred    = '
                    <p><span class="testimonial-credit testimonial-name">'.$person.'</span>
                      '.
                        ( ( $position && $company ) ? '<br /><span class="testimonial-credit testimonial-position">'.$position.' at</span>
                        <span class="testimonial-credit testimonial-company">'.$company.'</span>' : '' ) .
                        ( ( !$position && $company ) ? '<br /><span class="testimonial-credit testimonial-company">'.$company.'</span>' : '' )
                      .'
                    </p>';

            // wp_enqueue_script( 'testimonial-js', get_template_directory_uri().'/js/testimonial.js' );

            echo '
            <li class="testimonial">
              <div class="slide-wrap container">
                <div class="slide-outer">
                  <div class="testimonial-wrap">
                    <div class="testimonial-outer">
                      <div class="testimonial-inner">
                        <div class="testimonial-main">
                          <p class="testimonial-content">'.$content.'</p>
                          '.$Tcred.'
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>';

            endwhile; wp_reset_postdata(); else : endif;

            echo $after_widget;

            echo'</ul>
            </div>
            <script>
              $(document).ready(function(){
                $(\'#'.$wID.'\').unslider({
                    speed: '.( $wSP ? $wSP : 500 ).',               //  The speed to animate each slide (in milliseconds)
                    delay: '.( $wDE ? $wDE : 7000 ).',              //  The delay between slide animations (in milliseconds)
                    fluid: false,              //  Support responsive design. May break non-responsive designs
                    animation: \''.$wAN.'\',
                    arrows: '.$wAR.',
                    keys: false,
                    nav: '.$wNA.',
                    autoplay: true
                });
              });
            </script>
            ';

        }
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

        $instance['align']           = strip_tags( $new_instance['align'] );
        $instance['image_id']        = strip_tags( $new_instance['image_id'] );
        $instance['number_posts']    = $new_instance['number_posts'];
        $instance['delay']           = $new_instance['delay'];
        $instance['speed']           = $new_instance['speed'];
        $instance['arrow']           = $new_instance['arrows'];
        $instance['animation']       = $new_instance['animation'];
        $instance['navigation']      = $new_instance['navigation'];
         
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
        
        $defaults = array( 'speed' => '500', 'delay' => '7000', 'number_posts' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults );
     
        $wAL    = esc_attr( $instance['align'] );
        $wIM    = esc_attr( $instance['image_id'] );
        $wNP    = esc_attr( $instance['number_posts'] );
        $wDE    = esc_attr( $instance['delay'] );
        $wSP    = esc_attr( $instance['speed'] );
        $wNA    = esc_attr( $instance['navigation'] );
        $wAN    = esc_attr( $instance['animation'] );
        $wAR    = esc_attr( $instance['arrows'] );
        ?>
        
        <p><label>Content Alignment<label>
        <select name="<?php echo $this->get_field_name('align'); ?>" id="<?php echo $this->get_field_id('align'); ?>">
          <option value="left" <?php selected('left', $wAL); ?>>Left</option>
          <option value="center" <?php selected('center', $wAL); ?>>Center</option>
        </select></p>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $wIM ) { $img = wp_get_attachment_image_src( $wIM, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" id="<?php echo $this->get_field_id('image_id'); ?>" name="<?php echo $this->get_field_name('image_id'); ?>" value="<?php echo $wIM; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 400px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery('.upload-button').click(function(e) {
      e.preventDefault();
      var widget_button = jQuery(this);
      var custom_uploader = wp.media({
        title: 'Select Background Image',
        button: {
            text: 'Select Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).parent().addClass('hasimage').css('background-image', 'url('+attachment.sizes.full.url+')');
        jQuery(widget_button).parent().next().val(attachment.id);
      })
      .open();
    });
    jQuery('.remove-image').click(function(e) {
        e.preventDefault();
        jQuery(this).prev().prev().removeClass('hasimage').css('background-image', '');
        jQuery(this).prev().val('');
    });
        </script>
        <p><label>Number of posts</label><br />
        <input type="number" class="widefat" name="<?php echo $this->get_field_name('number_posts'); ?>" min="1" max="8" id="<?php echo $this->get_field_id('number_posts'); ?>" value="<?php echo $wNP; ?>" /></p>
        <p><label>Speed</label><br />
        <input type="number" class="widefat" name="<?php echo $this->get_field_name('speed'); ?>" min="100" max="10000" step="100" id="<?php echo $this->get_field_id('speed'); ?>" value="<?php echo $wSP; ?>" /></p>
        <p><label>Delay (in ms)</label><br />
        <input type="number" class="widefat" name="<?php echo $this->get_field_name('delay'); ?>" min="250" max="60000" step="250" id="<?php echo $this->get_field_id('DE'); ?>" value="<?php echo $wDE; ?>" /></p>
        <p><label>Animation</label><br />
        <select class="widefat" name="<?php echo $this->get_field_name('animation'); ?>" id="<?php echo $this->get_field_id('animation'); ?>">
          <option value="horizontal" <?php selected($wAN,'horizontal'); ?>>Horizontal (left to right)</option>
          <option value="vertical" <?php selected($wAN,'vertical'); ?>>Vertical (top to bottom)</option>
          <option value="fade" <?php selected($wAN,'fade'); ?>>Fade</option>
        </select></p>
        <p><label>Navigation</label><br />
        <select class="widefat" name="<?php echo $this->get_field_name('navigation'); ?>" id="<?php echo $this->get_field_id('navigation'); ?>">
          <option value="true" <?php selected($wNA,'true'); ?>>Yes</option>
          <option value="false" <?php selected($wNA,'false'); ?>>No</option>
        </select></p>
        <p><label>Arrows</label><br />
        <select class="widefat" name="<?php echo $this->get_field_name('arrows'); ?>" id="<?php echo $this->get_field_id('arrows'); ?>">
          <option value="true" <?php selected($wAR,'true'); ?>>Yes</option>
          <option value="false" <?php selected($wAR,'false'); ?>>No</option>
        </select></p>
    <?php 
    }
     
}

class CCD_Testimonial_Large_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_testimonial_widget',
            __( 'Large Testimonial Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_testimonial_large_widget',
                'description' => __( 'Adds a large testimonial box, similar to the testimonial slider.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-thumbs-up'
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
        
        $wID    = $args['widget_id'];
        $tID    = $instance['testimonial_id'];
        $wAL    = $instance['align'];
        $wIM    = $instance['image_id'];
        
        if ( $wIM ){
            $classes = 'has-image has-fi featured-image bgc-image';
            $img = wp_get_attachment_image_src( $wIM, 'large' );
            $styles = 'background-image: url(\''.$img[0].'\')';
        } else { $classes = 'no-image no-fi'; }

        echo $before_widget;

        $recent_args = array(
          'post_type' => 'testimonial',
          'posts_per_page' => 1,
          'p' => $tID
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
        
        $content    = get_post_meta( get_the_ID(), 'ccd_testimonial_content', true );
        $person     = get_post_meta( get_the_ID(), 'ccd_testimonial_person', true );
        $position   = get_post_meta( get_the_ID(), 'ccd_testimonial_position', true );
        $company    = get_post_meta( get_the_ID(), 'ccd_testimonial_company', true );
        
        $Tcred    = '<p><span class="testimonial-credit testimonial-name">'.$person.'</span><br />
            <span class="testimonial-credit testimonial-position">'.$position.' at</span>
            <span class="testimonial-credit testimonial-company">'.$company.'</span></p>';
        
        echo '
        <div class="widget-testimonial-large widget-testimonial featured-testimonials page-testimonial unslider '.$classes.'" style="'.$styles.'" id="'.$wID.'">
          <div class="testimonial">
            <div class="slide-wrap container">
              <div class="slide-outer">
                <div class="testimonial-wrap">
                  <div class="testimonial-outer">
                    <div class="testimonial-inner">
                      <div class="testimonial-main">
                        <p class="testimonial-content">'.$content.'</p>
                        '.$Tcred.'
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        ';
        
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

        $instance['testimonial_id']  = strip_tags( $new_instance['testimonial_id'] );
        $instance['align']           = strip_tags( $new_instance['align'] );
        $instance['image_id']        = strip_tags( $new_instance['image_id'] );
         
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
     
        $tID    = esc_attr( $instance['testimonial_id'] );
        $wAL    = esc_attr( $instance['align'] );
        $wIM    = esc_attr( $instance['image_id'] );
        
        ?>
        <p><label for="<?php echo $this->get_field_id('testimonial_id'); ?>">Select a testimonial:</label>
        <select class="widefit" id="<?php echo $this->get_field_id('testimonial_id'); ?>" name="<?php echo $this->get_field_name('testimonial_id'); ?>">
          <option value="0" <?php selected( '0', $tID ); ?>>Select a testimonial</option>
        <?php

        $recent_args = array(
          'post_type' => 'testimonial',
          'posts_per_page' => -1
        );
        $recent_query = new WP_Query( $recent_args );
        if  ( $recent_query->have_posts() ) : while ( $recent_query->have_posts() ) : $recent_query->the_post();
            echo '<option value="'.get_the_ID().'" '.selected( $tID, get_the_ID() ).'>'.get_the_title().' (Posted '.get_the_date('d/m/Y').')</option>';
        endwhile; wp_reset_postdata(); else : endif;
        ?>
        </select>
        <p><label>Content Alignment<label>
        <select name="<?php echo $this->get_field_name('align'); ?>" id="<?php echo $this->get_field_id('align'); ?>">
          <option value="left" <?php selected('left', $wAL); ?>>Left</option>
          <option value="center" <?php selected('center', $wAL); ?>>Center</option>
        </select></p>
        <div id="slide-upload" class="ccd-image-clr-element">
          <div class="uploaded image title-image tab-content <?php if ( $wIM ) { $img = wp_get_attachment_image_src( $wIM, 'large' ); echo 'hasimage show-tab" style="background-image: url('.$img[0].');'; } ?>">
            <a href="#upload" class="upload upload-button" id="upload-image"><span class="icon dashicons dashicons-upload"></span>
              <span class="upload-label">Upload Image</span></a>
          </div>
          <input class="custom_media_id" type="hidden" id="<?php echo $this->get_field_id('image_id'); ?>" name="<?php echo $this->get_field_name('image_id'); ?>" value="<?php echo $wIM; ?>" readonly>
          <a href="#remove" class="remove-image"><span class="icon dashicons dashicons-trash"></span> Remove Image</a>
        </div>
        <style>
.title-image{ width: 400px; border: solid 1px #CCC; }
.title-image a.upload{ font-size: 14px; font-weight: 700; color: #B2B2B2; text-decoration: none; display: block; height: 178px; text-align: center; padding: 70px 0 0; transition: all ease-in-out .3s; box-shadow: inset 5px #FFF; box-sizing: border-box; }
.title-image a.upload .icon{ display: block; width: 100%; font-size: 30px; line-height: 35px; min-height: 35px; }
.title-image :not(.image-src) a:hover{ color: #936FB1; }
.title-image.hasimage{ background-size: cover; background-position: center; }
.title-image.hasimage a.upload{ color: #FFF; text-shadow: 0px 0px 5px rgba(0,0,0,.5); }
.title-image.hasimage:hover a.upload, .wys-slides .slide .body .slide-image-wrap .hasimage .form-wrap{ color: #FFF; background-color: rgba(0,0,0,.5); }
.ccd-image-clr-element .remove-image{ text-decoration: none; line-height 20px; margin-top: 6px; margin-bottom: 9px; text-align: center; display: inline-block; padding: 4px 8px; color: #A00; transition: all .3s ease-in-out; }
.ccd-image-clr-element .remove-image:hover{ color: #FFF; background-color: #A00; }
        </style>
        <script>
    jQuery('.upload-button').click(function(e) {
      e.preventDefault();
      var widget_button = jQuery(this);
      var custom_uploader = wp.media({
        title: 'Select Background Image',
        button: {
            text: 'Select Image'
        },
        multiple: false  // Set this to true to allow multiple files to be selected
      })
      .on('select', function() {
        var attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery(widget_button).parent().addClass('hasimage').css('background-image', 'url('+attachment.sizes.full.url+')');
        jQuery(widget_button).parent().next().val(attachment.id);
      })
      .open();
    });
    jQuery('.remove-image').click(function(e) {
        e.preventDefault();
        jQuery(this).prev().prev().removeClass('hasimage').css('background-image', '');
        jQuery(this).prev().val('');
    });
        </script>
    <?php 
    }
     
}
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_Testimonial_Widget' );
     register_widget( 'CCD_Testimonial_Large_Widget' );
     register_widget( 'CCD_Testimonial_Slider_Widget' );
});