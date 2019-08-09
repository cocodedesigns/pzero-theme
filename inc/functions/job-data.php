<?php
add_action( 'cmb2_admin_init', 'ccdClient_jobPost_files_cmb' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function ccdClient_jobPost_files_cmb() {
	$prefix = '_ccdclient_jobpost_files_';
	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'filelist_mb',
		'title'        => esc_html__( 'List of files to display', 'ccdClient-wp' ),
		'object_types' => array( 'vacancy' ),
		'context'      => 'side',
		'priority'     => 'core',
	) );
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'filelist',
		'type'        => 'group',
		'description' => esc_html__( 'Add files to be displayed in post', 'ccdClient-wp' ),
		'options'     => array(
			'group_title'   => esc_html__( 'File {#}', 'ccdClient-wp' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another File', 'ccdClient-wp' ),
			'remove_button' => esc_html__( 'Remove File', 'ccdClient-wp' ),
			'sortable'      => true, // beta
			// 'closed'     => true, // true to have the groups closed by default
		),
	) );
	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Display Text', 'ccdClient-wp' ),
		'id'         => $prefix . 'displaytext',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );
	$cmb_group->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'File', 'ccdClient-wp' ),
		'id'   => $prefix . 'fileurl',
		'type' => 'file',
		'options' => array(
			'url' => false,
		),
	) );
}