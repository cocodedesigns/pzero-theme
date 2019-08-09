<?php

// Settings
include_once PLUGIN_DIR . '/settings/settings-page_posts-events.php';
// Metabox
include_once TEMPLATEPATH . '/inc/metaboxes/cpt_events.php';
// Archive Loop
include_once PLUGIN_DIR . '/loops/events.php';
// Widget
include_once PLUGIN_DIR . '/widgets/event-widget.php';

// Events custom post type

add_action('init', 'ccdClient_events');

function ccdClient_events() {

	$labels = array(
		'name' => _x('Events', 'post type general name'),
		'singular_name' => _x('Event', 'post type singular name'),
		'add_new' => _x('Add New', 'post type item'),
		'add_new_item' => __('Add New Event'),
		'edit_item' => __('Edit Event'),
		'new_item' => __('New Event'),
		'view_item' => __('View Event'),
		'search_items' => __('Search Events'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-calendar-alt',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 21,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
		'can_export' => true,
		'show_in_menu' => true,
		'has_archive' => 'events'
	  );

	register_post_type( 'event' , $args );
	flush_rewrite_rules();
}

function event_type_tax() {
  $labels = array(
    'name' => _x( 'Event Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Event Types' ),
    'all_items' => __( 'All Event Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ),
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Event Type' ),
    'new_item_name' => __( 'New Event Type' ),
    'menu_name' => __( 'Event Types' ),
  );

  register_taxonomy('event-type','event', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
		'show_in_quick_edit' => false,
		'meta_box_cb' => false,
    'show_admin_column' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tickets' ),
  ));
}
function ccdClient_event_cats_taxonomy(){
    $labels = array(
        'name' => _x( 'Event Categories', 'Event Categories' ),
        'singular_name' => _x( 'Category', 'Event Categories' ),
        'search_items' => __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category' ),
        'edit_item' => __( 'Edit Categories' ),
        'update_item' => __( 'Update Categories' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category' ),
        'menu_name' => __( 'Categories' ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => false,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'event-cats' ),
    );
    register_taxonomy( 'event-cats', array( 'event' ), $args );
}
function ccdClient_event_tags_taxonomy(){
    $labels = array(
        'name' => _x( 'Event Tags', 'Event Tags' ),
        'singular_name' => _x( 'Tag', 'Event Tags' ),
        'search_items' => __( 'Search Tags' ),
        'popular_items' => __( 'Popular Tags' ),
        'all_items' => __( 'All Tags' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Tags' ),
        'update_item' => __( 'Update Tags' ),
        'add_new_item' => __( 'Add New Tag' ),
        'new_item_name' => __( 'New Tag' ),
        'separate_items_with_commas' => __( 'Separate tags with commas' ),
        'add_or_remove_items' => __( 'Add or remove tags' ),
        'choose_from_most_used' => __( 'Choose from the most used tags' ),
        'menu_name' => __( 'Tags' ),
    );
    $args = array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => false,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'event-tags' ),
    );
    register_taxonomy( 'event-tags', array( 'event' ), $args );
}
add_action( 'init', 'event_type_tax', 50 );
add_action( 'init', 'ccdClient_event_cats_taxonomy', 0 );
add_action( 'init', 'ccdClient_event_tags_taxonomy', 0 );

// Events widget

add_action( 'widgets_init', 'ccdClient_events_widget' );


function ccdClient_events_widget() {
	register_widget( 'ccdClient_Events_Widget' );
}

class ccdClient_Events_Widget extends WP_Widget {

	function ccdClient_Events_Widget() {
		$widget_ops = array( 'classname' => 'ccdClient-events', 'description' => __('Widget to display list of events', 'ccdClient-events') );

		$control_ops = array( 'id_base' => 'ccdClient-events-widget' );

		$this->WP_Widget( 'ccdClient-events-widget', __('Events List', 'ccdClient-events'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
        if ( $instance['count'] >= 5 ) { $count = 5; } else { $count = $instance['count']; }
		$show_info = $instance['show_info'] ? true : false;

		echo $before_widget;

		// Display the widget title
		if ( $title )
			echo $before_title . $title . $after_title;

        include TEMPLATEPATH . '/inc/widgets/events-loop.php';

		echo $after_widget;
	}

	//Update the widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['show_info'] = ( !empty( $new_instance['show_info'] ) ) ? $new_instance['show_info'] = true : $new_instance['show_info'] = false;

		return $instance;
	}


	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Events', 'ccdClient-events'), 'count' => __('5', 'ccdClient-events'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ccdClient-events'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of events shown:', 'ccdClient-events'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="number" min="0" max="10" style="width:100%;" />
		</p>
<!--		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display event information?', 'ccdClient-events'); ?></label>
		</p> -->

	<?php
	}
}

add_filter('manage_event_posts_columns', 'bs_event_table_head');
function bs_event_table_head( $defaults ) {
    $defaults['event_date']  = 'Event Date';
    $defaults['ticket_status']    = 'Ticket Status';
    $defaults['venue']   = 'Venue';
    $defaults['author'] = 'Added By';
    return $defaults;
}

add_action( 'manage_event_posts_custom_column', 'bs_event_table_content', 10, 2 );

function bs_event_table_content( $column_name, $post_id ) {
    if ($column_name == 'event_date') {
      $event_date = get_post_meta( $post_id, '_ccdclient_eventdetails_start_date', true );
      echo date( _x( 'F d, Y, H:i', 'Event date format', 'textdomain' ), $event_date );
//      echo $event_date;
    }
    if ($column_name == 'ticket_status') {
      $status = get_post_meta( $post_id, '_ccdclient_eventdetails_tickets', true );
      echo $status;
    }

    if ($column_name == 'venue') {
      echo get_post_meta( $post_id, '_ccdclient_eventdetails_location_name', true );
    }

}

add_filter( 'manage_edit-event_sortable_columns', 'bs_event_table_sorting' );
function bs_event_table_sorting( $columns ) {
  $columns['event_date'] = 'event_date';
  $columns['ticket_status'] = 'ticket_status';
  $columns['venue'] = 'venue';
  return $columns;
}

add_filter( 'request', 'bs_event_date_column_orderby' );
function bs_event_date_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => '_ccdclient_eventdetails_start_date',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter( 'request', 'bs_ticket_status_column_orderby' );
function bs_ticket_status_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'ticket_status' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => '_ccdclient_eventdetails_tickets',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_filter( 'request', 'bs_venue_column_orderby' );
function bs_venue_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'venue' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => '_ccdclient_eventdetails_location_name',
            'orderby' => 'meta_value'
        ) );
    }

    return $vars;
}

add_action( 'restrict_manage_posts', 'bs_event_table_filtering' );
function bs_event_table_filtering() {
  global $wpdb;
  if ( $screen->post_type == 'event' ) {

    $dates = $wpdb->get_results( "SELECT EXTRACT(YEAR FROM meta_value) as year,  EXTRACT( MONTH FROM meta_value ) as month FROM $wpdb->postmeta WHERE meta_key = '_ccdclient_eventdetails_start_date' AND post_id IN ( SELECT ID FROM $wpdb->posts WHERE post_type = 'event' AND post_status != 'trash' ) GROUP BY year, month " ) ;

    echo ’;
      echo ’ . __( 'Show all event dates', 'textdomain' ) . ’;
    foreach( $dates as $date ) {
      $month = ( strlen( $date->month ) == 1 ) ? 0 . $date->month : $date->month;
      $value = $date->year . '-' . $month . '-' . '01 00:00:00';
      $name = date( 'F Y', strtotime( $value ) );

      $selected = ( !empty( $_GET['event_date'] ) AND $_GET['event_date'] == $value ) ? 'selected="select"' : ’;
      echo ’ . $name . ’;
    }
    echo ’;

    $ticket_statuses = get_ticket_statuses();
    echo ’;
      echo ’ . __( 'Show all ticket statuses', 'textdomain' ) . ’;
    foreach( $ticket_statuses as $value => $name ) {
      $selected = ( !empty( $_GET['ticket_status'] ) AND $_GET['ticket_status'] == $value ) ? 'selected="selected"' : ’;
      echo ’ . $name . ’;
    }
    echo ’;

  }
}

add_filter( 'parse_query','bs_event_table_filter' );
function bs_event_table_filter( $query ) {
  if( is_admin() AND $query->query['post_type'] == 'event' ) {
    $qv = &$query->query_vars;
    $qv['meta_query'] = array();

    if( !empty( $_GET['event_date'] ) ) {
      $start_time = strtotime( $_GET['event_date'] );
      $end_time = mktime( 0, 0, 0, date( 'n', $start_time ) + 1, date( 'j', $start_time ), date( 'Y', $start_time ) );
      $end_date = date( 'Y-m-d H:i:s', $end_time );
      $qv['meta_query'][] = array(
        'field' => '_ccdclient_eventdetails_start_date',
        'value' => array( $_GET['event_date'], $end_date ),
        'compare' => 'BETWEEN',
        'type' => 'DATETIME'
      );

    }

    if( !empty( $_GET['ticket_status'] ) ) {
      $qv['meta_query'][] = array(
        'field' => '_ccdclient_eventdetails_tickets',
        'value' => $_GET['ticket_status'],
        'compare' => '=',
        'type' => 'CHAR'
      );
    }

    if( !empty( $_GET['orderby'] ) AND $_GET['orderby'] == 'event_date' ) {
      $qv['orderby'] = 'meta_value';
      $qv['meta_key'] = '_ccdclient_eventdetails_start_date';
      $qv['order'] = strtoupper( $_GET['order'] );
    }

  }
}

?>