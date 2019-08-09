<?php

$dPath = TEMPLATEPATH . '/inc/functions';

include( $dPath . '/comments.php' );
include( $dPath . '/header.php' );
include( $dPath . '/page-nav.php' );
include( $dPath . '/blog-index.php' );
include( $dPath . '/sidebars.php' );

include( $dPath . '/job-data.php' );

// Convert numbers to words
// include( TEMPLATEPATH . '/inc/numtowords.php' );

add_action( 'cmb2_init', 'ccdClient_pageSettings' );
function ccdClient_pageSettings() {

	$prefix = '_ccdClient_pageSettings_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . '_mb_ccdClient_pageSettings',
		'title'        => __( 'Page Settings', 'ccdClient-wp' ),
		'object_types' => array( 'page' ),
		'context'      => 'side',
		'priority'     => 'core',
	) );

	$cmb->add_field( array(
		'name' => __( 'Show Sidebar', 'ccdClient-wp' ),
		'id' => $prefix . 'sidebar',
		'type' => 'select',
    'default' => 'off',
		'options' => array(
			'on' => __( 'Show', 'ccdClient-wp' ),
			'off' => __( 'Hide', 'ccdClient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Page padding (top)', 'ccdClient-wp' ),
		'id' => $prefix . 'padding_top',
		'type' => 'select',
    'default' => 'on',
		'options' => array(
			'on' => __( 'Enable', 'ccdClient-wp' ),
			'off' => __( 'Disable', 'ccdClient-wp' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Page padding (bottom)', 'ccdClient-wp' ),
		'id' => $prefix . 'padding_bottom',
		'type' => 'select',
    'default' => 'on',
		'options' => array(
			'on' => __( 'Enable', 'ccdClient-wp' ),
			'off' => __( 'Disable', 'ccdClient-wp' ),
		),
	) );

}

add_filter( 'avatar_defaults', 'ccdClient_defaultAvatar' );
function ccdClient_defaultAvatar ($avatar_defaults) {
    $myavatar = 'http://virtuauws/cocode2018/wp-content/uploads/2017/09/Han_Ga_Eun_035-150x150.jpg';
    $avatar_defaults[$myavatar] = "Cocode Designs";
    return $avatar_defaults;
}