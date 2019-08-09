<?php
add_action( 'cmb2_init', 'ccdClient_eventDetails_metabox' );
add_action( 'cmb2_init', 'ccdClient_eventSchedule_details' );

function ccdClient_eventDetails_metabox() {

	$prefix = '_ccdclient_eventdetails_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Event Details', 'ccdClient-wp' ),
		'object_types' => array( 'event' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Start date and time', 'ccdClient-wp' ),
		'id' => $prefix . 'start_date',
		'type' => 'text_datetime_timestamp',
		'desc' => 'Enter the date in <code><strong>MM/DD/YYYY</strong></code> format.'
	) );

	$cmb->add_field( array(
		'name' => __( 'End date and time', 'ccdClient-wp' ),
		'id' => $prefix . 'end_date',
		'type' => 'text_datetime_timestamp',
		'desc' => 'Enter the date in <code><strong>MM/DD/YYYY</strong></code> format.'
	) );

	$cmb->add_field( array(
		'name' => __( 'Location Name', 'ccdClient-wp' ),
		'id' => $prefix . 'location_name',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Address', 'ccdClient-wp' ),
		'id' => $prefix . 'address',
		'type' => 'address',
		'desc' => 'This address will be geocoded to present a Map using the MapQuest API. If there is not a valid Zip Code / Postcode, a map will not be displayed.'
	) );

	$cmb->add_field( array(
		'name' => __( 'Tickets', 'ccdClient-wp' ),
		'id' => $prefix . 'tickets',
		'type' => 'taxonomy_select',
		'taxonomy' => 'event-type',
	) );
  
	$cmb->add_field( array(
		'name' => __( 'URL for external listings', 'ccdClient-wp' ),
		'id' => $prefix . 'eventbriteurl',
		'type' => 'text_url',
		'desc' => 'Use this to display the link for an external bookings page, such as Eventbrite.  Make sure you include the <code>https://</code> or <code>http://</code> at the start of the URL.'
	) );

}

function ccdClient_eventSchedule_details() {

	$prefix = '_ccdclient_eventschedule_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'ccdClient_schedule_details',
		'title'        => __( 'Schedule Items', 'ccd-wp' ),
		'object_types' => array( 'event' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

  // $group_field_id is the field id string, so in this case: $prefix . 'demo'
  $group_id = $cmb->add_field( array(
      'id'                => $prefix . 'schedule_group',
      'type'              => 'group',
      'options'           => array(
          'group_title'   => 'Item {#}',
          'add_button'    => 'Add Another Item',
          'remove_button' => 'Remove Item',
          'sortable'      => true,
					'closed'     	  => true,
      )
  ) );

  $cmb->add_group_field( $group_id, array(
      'id'            => $prefix . 'schedule_item',
      'name'          => __('Schedule Item', 'cgc-quiz'),
      'type'          => 'schedule',
		  'show_names'    => false,
  ) );

}
