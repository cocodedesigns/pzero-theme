<?php 
add_action( 'cmb2_init', 'ccdClient_ama_mb_postMetabox' );
function ccdClient_ama_mb_postMetabox() {

	$prefix = '_ccdclient_ama_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'question_information',
		'title'        => __( 'Question Information', 'ccdClient-wp' ),
		'object_types' => array( 'ama' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Name', 'ccdClient-wp' ),
		'id' => $prefix . 'name',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Email', 'ccdClient-wp' ),
		'id' => $prefix . 'email',
		'type' => 'text_email',
	) );

	$cmb->add_field( array(
		'name' => __( 'Receive Email Communications', 'ccdClient-wp' ),
		'id' => $prefix . 'receive_email',
		'type' => 'select',
		'options' => array(
			'yes' => __( 'I consent', 'ccdClient-wp' ),
			'no' => __( 'I do not consent', 'ccdClient-wp' ),
		),
		'default' => 'no',
	) );

	$cmb->add_field( array(
		'name' => __( 'Allow storing and processing of data', 'ccdClient-wp' ),
		'id' => $prefix . 'process_data',
		'type' => 'select',
		'options' => array(
			'yes' => __( 'I consent', 'ccdClient-wp' ),
			'no' => __( 'I do not consent', 'ccdClient-wp' ),
		),
		'default' => 'no',
	) );

	$cmb->add_field( array(
		'name' => __( 'Display name', 'ccdClient-wp' ),
		'id' => $prefix . 'display_name',
		'type' => 'select',
		'options' => array(
			'yes' => __( 'I consent', 'ccdClient-wp' ),
			'no' => __( 'I do not consent', 'ccdClient-wp' ),
		),
		'default' => 'no',
	) );

}