<?php
global $db_options;
class CCD_ContactDetails_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'ccd_cd_widget',
            __( 'Contact Details Widget', 'ccd_widget' ),
            array(
                'classname'   => 'ccd_cd_widget',
                'description' => __( 'Adds the contact details from the Centres Custom Post Type.', 'ccd_widget' ),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-phone'
                )
        );
       
        load_plugin_textdomain( 'ccd_widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget():
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
    
        global $db_options;
         
        extract( $args );
         
        echo $before_widget;
        ?>
        <div class="contact-details contact-details-wrap">
          <div class="cd-element cd-icon">
            <div class="cd-wrap">
              <span class="cd-icon-span flaticon-pin71"></span>
            </div>
          </div>
            <div class="cd-element cd-details">
              <div class="cd-wrap">
                <h3>Address</h3>
                <p class="address"><?php echo nl2br( $db_options['db-contact-address'] ); ?></p>
                <?php if( $db_options['db-contact-tel'] ) { ?>
                <p class="tel"><span class="icon-16 flaticon-mobile26"></span> <span class="content"><?php echo $db_options['db-contact-tel']; ?></span></p>
                <?php } else { } ?>
                <p class="email"><span class="icon-16 flaticon-read4"></span> <span class="content"><?php if( $db_options['db-contact-email'] ) { echo $db_options['db-contact-email']; } else { echo get_option('admin_email'); } ?></span></p>
                <?php include TEMPLATEPATH . '/inc/social-networks.php'; ?>
              </div>
            </div>
            <div class="cd-element cd-open">
              <div class="cd-wrap">
                <h3>Opening Times</h3>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Monday</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">09:30</span>
                  <span class="cd-ot-to cd-ot-el">-</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">17:30</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Tuesday</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">09:30</span>
                  <span class="cd-ot-to cd-ot-el">-</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">17:30</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Wednesday</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">09:30</span>
                  <span class="cd-ot-to cd-ot-el">-</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">17:30</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Thursday</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">09:30</span>
                  <span class="cd-ot-to cd-ot-el">-</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">17:30</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Friday</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">09:30</span>
                  <span class="cd-ot-to cd-ot-el">-</span>
                  <span class="cd-ot-time cd-ot-el cd-ot-data">17:30</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Saturday</span>
                  <span class="cd-ot-closed cd-ot-el cd-ot-data">CLOSED</span>
                </p>
                <p class="cd-ot-row clear">
                  <span class="cd-ot-day cd-ot-el">Sunday</span>
                  <span class="cd-ot-closed cd-ot-el cd-ot-data">CLOSED</span>
                </p>
              </div>
            </div>
            <div class="clear"></div>
          </div>
        <?php 
        echo $after_widget;
    }
 
      /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     
        ?>
        
        <p>There are no details for you to edit.</p>
     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'CCD_ContactDetails_Widget' );
});
