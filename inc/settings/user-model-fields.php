<?php
add_action( 'cmb2_admin_init', 'ccdClient_modelProfile_modelData' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function ccdClient_modelProfile_modelData() {
	$prefix = '_ccdClient_modelProfile_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => __( 'Model Profile Data', 'ccdClient-wp' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
	$cmb_user->add_field( array(
		'name'     => __( 'Vital Statistics', 'ccdClient-wp' ),
		'id'       => $prefix . 'title_vitals',
		'type'     => 'title',
		'on_front' => false,
	) );
	$cmb_user->add_field( array(
        'name' => __( 'Nationality', 'ccdClient-wp' ),
        'id' => $prefix . 'model_nationality',
        'type' => 'text',
    ) );
	$cmb_user->add_field( array(
      'name' => __( 'Date of birth', 'ccdClient-wp' ),
      'id' => $prefix . 'model_dob',
      'type' => 'text_date',
    ) );
	$cmb_user->add_field( array(
      'name' => __( 'Show as', 'ccdClient-wp' ),
      'id' => $prefix . 'model_show_dob',
      'type' => 'select',
      'options' => array(
        'full' => __( 'Full date (eg 01 January 1990)', 'ccdClient-wp' ),
        'my' => __( 'Month and year only (eg. January 1990)', 'ccdClient-wp' ),
        'dm' => __( 'Date and month only (eg. 1 January)', 'ccdClient-wp' ),
        'none' => __( 'Do not display', 'ccdClient-wp' ),
      ),
      'attributes' => array(
        'data-conditional-id' => $prefix . 'model_dob',
      ),
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Height (in cm)', 'ccdClient-wp' ),
        'id' => $prefix . 'model_height',
        'type' => 'text_small',
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Weight (in kgs)', 'ccdClient-wp' ),
        'id' => $prefix . 'model_weight',
        'type' => 'text_small',
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Occupation', 'ccdClient-wp' ),
        'id' => $prefix . 'model_occupation',
        'type' => 'text',
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Bust', 'ccdClient-wp' ),
        'id' => $prefix . 'model_measurements_bust',
        'type' => 'text_small',
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Waist', 'ccdClient-wp' ),
        'id' => $prefix . 'model_measurements_waist',
        'type' => 'text_small',
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Hips', 'ccdClient-wp' ),
        'id' => $prefix . 'model_measurements_hips',
        'type' => 'text_small',
    ) );
    $cmb_user->add_field( array(
        'name' => __( 'Bra Size', 'ccdClient-wp' ),
        'id' => $prefix . 'model_bra_size',
        'type' => 'text_small',
    ) );
	$cmb_user->add_field( array(
		'name'     => __( 'Profile Photos', 'ccdClient-wp' ),
		'id'       => $prefix . 'title_photos',
		'type'     => 'title',
		'on_front' => false,
	) );
	$cmb_user->add_field( array(
        'name' => __( 'Slider Images', 'ccdClient-wp' ),
        'id' => $prefix . 'model_slider_photos',
        'type' => 'file_list',
        'preview_size' => 'thumbnail',
        'desc' => __('These images will appear as a photo slider.  A minimum of four photos is recommended.', 'ccdClient-wp'),
    ) );
	$cmb_user->add_field( array(
        'name' => __( 'Galley Images', 'ccdClient-wp' ),
        'id' => $prefix . 'model_gallery_photos',
        'type' => 'file_list',
        'preview_size' => 'thumbnail',
        'desc' => __('There should be between three and six photos in this field.  If there are less than three photos here, the section will not display.  If there are more than six, only the first six in the list will be displated.', 'ccdClient-wp'),
    ) );
}

function ccdClient_shortcode_modelProfile( $atts ) {

	// Parse attributes
    $atts = ( shortcode_atts( array(
        'id'        => uniqid('ccdClient_modelProfile_'),
        'user'      => ''
    ), $atts, 'show_profile' ) );
  
    $profile = 'Da Profile';

    return $profile;
}
add_shortcode('show_profile', 'ccdClient_shortcode_modelProfile');