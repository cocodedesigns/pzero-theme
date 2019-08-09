<?php

add_action( 'widgets_init', 'ccd_opening_hours_widget' );


function ccd_opening_hours_widget() {
	register_widget( 'CCD_Opening_Hours_Widget' );
}

class CCD_Opening_Hours_Widget extends WP_Widget {

	function CCD_Opening_Hours_Widget() {
		$widget_ops = array( 'classname' => 'opening-hours', 'description' => __('Display the opening hours of your business, including contact details', 'opening-hours'),
                'panels_groups' => array('ccd_widgets'),
                'panels_icon'   => 'dashicons dashicons-location-alt' );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'opening-hours-widget' );
		
		$this->WP_Widget( 'opening-hours-widget', __('Opening Hours', 'opening-hours'), $widget_ops, $control_ops );
	}
	
    function widget( $args, $instance ) {
      extract( $args );

      global $lvk_options;
      echo $before_widget;
      ?>
      <div id="<?php echo $args['widget_id']; ?>" class="lvk-opening-hours-widget">
        <?php if ( $instance['show_email'] || $instance['show_tel'] || $instance['show_add'] ) { ?>
        <div class="lvk-opening-contact-details">
          <?php if ( $instance['show_add'] ) { ?>
            <div class="lvk-oh-contact-address lvk-oh-contact-option">
              <span class="lvk-oh-contact-label"><span class="lvk-oh-icon fa fa-home"></span> Address:</span>
              <span class="lvk-oh-contact-details"><?php echo nl2br( $lvk_options['lvk-contact-address'] ); ?></span>
            </div>
          <?php } ?>
          <?php if ( $instance['show_email'] ) { ?>
            <div class="lvk-oh-contact-email lvk-oh-contact-option">
              <span class="lvk-oh-contact-label"><span class="lvk-oh-icon fa fa-envelope"></span> Email:</span>
              <span class="lvk-oh-contact-details"><?php echo $lvk_options['lvk-contact-email']; ?></span>
            </div>
          <?php } ?>
          <?php if ( $instance['show_tel'] ) { ?>
            <div class="lvk-oh-contact-tel lvk-oh-contact-option">
              <span class="lvk-oh-contact-label"><span class="lvk-oh-icon fa fa-phone"></span> Telephone:</span>
              <span class="lvk-oh-contact-details"><?php echo $lvk_options['lvk-contact-tel']; ?></span>
            </div>
          <?php } ?>
        </div>
        <?php } ?>
        <div class="lvk-opening-hours">
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-monday">
            <span class="lvk-oh-label-day show-day">Monday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_mon'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_mon_am'] && $instance['close_mon_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_mon_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_mon_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_mon_pm'] && $instance['close_mon_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_mon_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_mon_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-tuesday">
            <span class="lvk-oh-label-day show-day">Tuesday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_tue'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_tue_am'] && $instance['close_tue_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_tue_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_tue_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_tue_pm'] && $instance['close_tue_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_tue_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_tue_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-wednesday">
            <span class="lvk-oh-label-day show-day">Wednesday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_wed'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_wed_am'] && $instance['close_wed_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_wed_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_wed_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_wed_pm'] && $instance['close_wed_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_wed_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_wed_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-thursday">
            <span class="lvk-oh-label-day show-day">Thursday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_thu'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_thu_am'] && $instance['close_thu_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_thu_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_thu_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_thu_pm'] && $instance['close_thu_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_thu_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_thu_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-friday">
            <span class="lvk-oh-label-day show-day">Friday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_fri'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_fri_am'] && $instance['close_fri_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_fri_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_fri_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_fri_pm'] && $instance['close_fri_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_fri_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_fri_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-saturday">
            <span class="lvk-oh-label-day show-day">Saturday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_sat'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_sat_am'] && $instance['close_sat_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_sat_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_sat_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_sat_pm'] && $instance['close_sat_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_sat_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_sat_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="lvk-oh-single-day lvk-oh-row-day lvk-oh-sunday">
            <span class="lvk-oh-label-day show-day">Sunday</span>
            <div class="lvk-oh-times">
              <?php if ( $instance['closed_sun'] ) { ?>
                <span class="lvk-oh-closedallday lvk-oh-closed">Closed all day</span>
              <?php } else { ?>
                <div class="lvk-oh-session lvk-oh-am">
                  <?php if ( $instance['open_sun_am'] && $instance['close_sun_am'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_sun_am']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_sun_am']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
                <div class="lvk-oh-session lvk-oh-pm">
                  <?php if ( $instance['open_sun_pm'] && $instance['close_sun_pm'] ) { ?>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-opening-time"><?php echo $instance['open_sun_pm']; ?></span>
                    <span class="lvk-oh-label-to">-</span>
                    <span class="lvk-oh-value lvk-oh-time lvk-oh-closing-time"><?php echo $instance['close_sun_pm']; ?></span>
                  <?php } else { ?>
                    <span class="lvk-oh-closed lvk-oh-closed-session">Closed</span>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <?php
      echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
        
		$instance = $old_instance;
        
        $instance = $new_instance;

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <h3>Opening Hours</h3>
        <p><strong>Monday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_mon_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_mon_am' ); ?>" name="<?php echo $this->get_field_name( 'open_mon_am' ); ?>" type="time" value="<?php echo $instance['open_mon_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_mon_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_mon_am' ); ?>" name="<?php echo $this->get_field_name( 'close_mon_am' ); ?>" type="time" value="<?php echo $instance['close_mon_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_mon_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_mon_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_mon_pm' ); ?>" type="time" value="<?php echo $instance['open_mon_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_mon_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_mon_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_mon_pm' ); ?>" type="time" value="<?php echo $instance['close_mon_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_mon' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_mon' ); ?>" name="<?php echo $this->get_field_name( 'closed_mon' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_mon' ); ?>">Closed all day</label></p>

        <p><strong>Tuesday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_tue_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_tue_am' ); ?>" name="<?php echo $this->get_field_name( 'open_tue_am' ); ?>" type="time" value="<?php echo $instance['open_tue_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_tue_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_tue_am' ); ?>" name="<?php echo $this->get_field_name( 'close_tue_am' ); ?>" type="time" value="<?php echo $instance['close_tue_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_tue_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_tue_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_tue_pm' ); ?>" type="time" value="<?php echo $instance['open_tue_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_tue_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_tue_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_tue_pm' ); ?>" type="time" value="<?php echo $instance['close_tue_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_tue' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_tue' ); ?>" name="<?php echo $this->get_field_name( 'closed_tue' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_tue' ); ?>">Closed all day</label></p>

        <p><strong>Wednesday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_wed_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_wed_am' ); ?>" name="<?php echo $this->get_field_name( 'open_wed_am' ); ?>" type="time" value="<?php echo $instance['open_wed_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_wed_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_wed_am' ); ?>" name="<?php echo $this->get_field_name( 'close_wed_am' ); ?>" type="time" value="<?php echo $instance['close_wed_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_wed_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_wed_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_wed_pm' ); ?>" type="time" value="<?php echo $instance['open_wed_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_wed_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_wed_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_wed_pm' ); ?>" type="time" value="<?php echo $instance['close_wed_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_wed' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_wed' ); ?>" name="<?php echo $this->get_field_name( 'closed_wed' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_wed' ); ?>">Closed all day</label></p>

        <p><strong>Thursday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_thu_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_thu_am' ); ?>" name="<?php echo $this->get_field_name( 'open_thu_am' ); ?>" type="time" value="<?php echo $instance['open_thu_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_thu_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_thu_am' ); ?>" name="<?php echo $this->get_field_name( 'close_thu_am' ); ?>" type="time" value="<?php echo $instance['close_thu_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_thu_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_thu_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_thu_pm' ); ?>" type="time" value="<?php echo $instance['open_thu_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_thu_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_thu_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_thu_pm' ); ?>" type="time" value="<?php echo $instance['close_thu_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_thu' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_thu' ); ?>" name="<?php echo $this->get_field_name( 'closed_thu' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_thu' ); ?>">Closed all day</label></p>

        <p><strong>Friday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_fri_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_fri_am' ); ?>" name="<?php echo $this->get_field_name( 'open_fri_am' ); ?>" type="time" value="<?php echo $instance['open_fri_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_fri_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_fri_am' ); ?>" name="<?php echo $this->get_field_name( 'close_fri_am' ); ?>" type="time" value="<?php echo $instance['close_fri_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_fri_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_fri_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_fri_pm' ); ?>" type="time" value="<?php echo $instance['open_fri_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_fri_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_fri_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_fri_pm' ); ?>" type="time" value="<?php echo $instance['close_fri_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_fri' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_fri' ); ?>" name="<?php echo $this->get_field_name( 'closed_fri' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_fri' ); ?>">Closed all day</label></p>

        <p><strong>Saturday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_sat_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_sat_am' ); ?>" name="<?php echo $this->get_field_name( 'open_sat_am' ); ?>" type="time" value="<?php echo $instance['open_sat_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_sat_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_sat_am' ); ?>" name="<?php echo $this->get_field_name( 'close_sat_am' ); ?>" type="time" value="<?php echo $instance['close_sat_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_sat_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_sat_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_sat_pm' ); ?>" type="time" value="<?php echo $instance['open_sat_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_sat_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_sat_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_sat_pm' ); ?>" type="time" value="<?php echo $instance['close_sat_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_sat' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_sat' ); ?>" name="<?php echo $this->get_field_name( 'closed_sat' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_sat' ); ?>">Closed all day</label></p>

        <p><strong>Sunday</strong></p>
		<p>
            <span class="lvk-ot-period">AM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_sun_am' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_sun_am' ); ?>" name="<?php echo $this->get_field_name( 'open_sun_am' ); ?>" type="time" value="<?php echo $instance['open_sun_am']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_sun_am' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_sun_am' ); ?>" name="<?php echo $this->get_field_name( 'close_sun_am' ); ?>" type="time" value="<?php echo $instance['close_sun_am']; ?>" class="lvk-ot-field" />
        </p>
		<p>
            <span class="lvk-ot-period">PM</span>
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'open_sun_pm' ); ?>"><?php _e('Opens:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'open_sun_pm' ); ?>" name="<?php echo $this->get_field_name( 'open_sun_pm' ); ?>" type="time" value="<?php echo $instance['open_sun_pm']; ?>" class="lvk-ot-field" />
			<label class="lvk-ot-label" for="<?php echo $this->get_field_id( 'close_sun_pm' ); ?>"><?php _e('Closes:', 'showmap'); ?></label>
			<input id="<?php echo $this->get_field_id( 'close_sun_pm' ); ?>" name="<?php echo $this->get_field_name( 'close_sun_pm' ); ?>" type="time" value="<?php echo $instance['close_sun_pm']; ?>" class="lvk-ot-field" />
        </p>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'closed_sun' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'closed_sun' ); ?>" name="<?php echo $this->get_field_name( 'closed_sun' ); ?>" /> <label for="<?php echo $this->get_field_id( 'closed_sun' ); ?>">Closed all day</label></p>

        <h3>Display contact information</h3>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_email' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_email' ); ?>" name="<?php echo $this->get_field_name( 'show_email' ); ?>" /> <label for="<?php echo $this->get_field_id( 'show_email' ); ?>">Display email address</label></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_add' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_add' ); ?>" name="<?php echo $this->get_field_name( 'show_add' ); ?>" /> <label for="<?php echo $this->get_field_id( 'show_add' ); ?>">Display postal address</label></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'show_tel' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_tel' ); ?>" name="<?php echo $this->get_field_name( 'show_tel' ); ?>" /> <label for="<?php echo $this->get_field_id( 'show_tel' ); ?>">Display telephone number</label></p>

	<?php
	}
}
