<?php
function ddl_large_button( $style ){
    $output = '<a href="%url%" title="Download %title%" rel="nofollow" class="ddl-link ddl-output ddl-button-large ddl-button-'.$style.' %class%" id="ddl-%id%">
                              <div class="ddl-icon ddl-element">
                                <span class="fa fa-download dd-icon"></span>
                              </div>
                              <div class="ddl-text-wrap ddl-element">
                                <p class="ddl-heading ddl-span-block">%text%</p>
                                <p class="ddl-text ddl-span-block">%filesize% - %filename%</p>
                              </div>
                              <div class="clear"></div>
                            </a>';
    return $output;
}
function ddl_small_button( $style ){
    $output = '<a href="%url%" title="Download %title%" rel="nofollow" class="ddl-button-small ddl-button-'.$style.' ddl-output %class%">
                              <div class="ddl-icon ddl-element">
                                <span class="fa fa-download dd-icon"></span>
                              </div>
                              <div class="ddl-text-wrap ddl-element">
                                <p class="ddl-heading ddl-span-block">%text%</p>
                              </div>
                              <div class="clear"></div>
                            </a>';
    return $output;
}

function dedo_custom_output( $styles ) {
    $styles = array(
        'ddl-button-large-light' => array(
            'name'		=> __( 'Large Button (Light)', 'delightful-downloads' ),
            'format'	=> ddl_large_button('light')
        ),
        'ddl-button-large-clr' => array(
            'name'		=> __( 'Large Button (Coloured)', 'delightful-downloads' ),
            'format'	=> ddl_large_button('clr')
        ),
        'ddl-button-large-dark' => array(
            'name'		=> __( 'Large Button (Dark)', 'delightful-downloads' ),
            'format'	=> ddl_large_button('dark')
        ),
        'ddl-button-small-light'	=> array(
            'name'		=> __( 'Small Button (Light)', 'delightful-downloads' ),
            'format'	=> ddl_small_button('light')
        ),
        'ddl-button-small-clr'	=> array(
            'name'		=> __( 'Small Button (Coloured)', 'delightful-downloads' ),
            'format'	=> ddl_small_button('clr')
        ),
        'ddl-button-small-dark'	=> array(
            'name'		=> __( 'Small Button (Dark)', 'delightful-downloads' ),
            'format'	=> ddl_small_button('dark')
        ),
        'ddl-link'		=> array(
            'name'		=> __( 'Text Link', 'delightful-downloads' ),
            'format'	=> '<a href="%url%" title="Download %title%" rel="nofollow" class="ddl-text-link %class%">%text%</a>'
        )
	);
	return $styles;
}
add_filter( 'dedo_get_styles', 'dedo_custom_output' );

function dedo_custom_button( $buttons ) {
    $buttons =  array(
        'ddl-light'     => array(
            'name'      => __( 'Light', 'delightful-downloads' ),
            'class'     => 'ddl-button-light'
        ),
        'ddl-clr'     => array(
            'name'      => __( 'Coloured', 'delightful-downloads' ),
            'class'     => 'ddl-button-clr'
        ),
        'ddl-dark'      => array(
            'name'      => __( 'Dark', 'delightful-downloads' ),
            'class'     => 'ddl-button-dark'
        )
    );
    return $buttons;
}
add_filter( 'dedo_get_buttons', 'dedo_custom_button' );

function custom_list( $lists ) {
/* if ( has_post_thumbnail() ) { 
                $fImg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); $fi = $fImg[0];
              } else { $fi = get_template_directory_uri().'/images/new-download.png'; } */
//	$fi = simple_fields_value( 'sr_ddl_fi_file' );
//    $fi_dump = var_dump( $fi );
    $new_lists = array(
        'ddl-list-block' => array(
            'name'      => __( 'Download Block', 'delightful-downloads' ),
            'format'    => '
              <article class="ddl-list-block ddl-list-item" id="ddl-%id%">
            
            <div class="download-wrap" style="background-image: url(\'%fi%\');">
              <div class="download-item">
                <div class="download-details">
                  <h2>%title%</h2>
                  <div class="download-meta">
                    <div class="download-meta-data"></div>
                    <a href="%url%" class="download-link">Download</a>
                  </div>
                </div>
              </div>
            </div>
          </article>
            '
        ),
        'ddl-list-line' => array(
            'name'      => __( 'Table Layout', 'delightful-downloads' ),
            'format'    => ''
        ),
        'ddl-list-plain' => array(
            'name'		=> 'Plain List',
            'format'	=> '<i class="fa fa-download"></i><a href="%url%" title="%title%" rel="nofollow">%title% - %date%</a>'
        )
    );

	return $new_lists;
}
add_filter( 'dedo_get_lists', 'custom_list' );

function custom_wildcards( $string ){
	$fi_output = simple_fields_value( 'ccd_ddl_fi_file' );
    $fi_url = @$fi_output['url'];
    if ( $fi_url == "" ) { 
        $fi = get_template_directory_uri().'/images/new-download.png';
    } else { $fi = $fi_url; }
    if ( strpos( $string, '%fi%' ) !== false ){
        $string = str_replace( '%fi%', $fi, $string );
    }
    if ( strpos( $string, '%thing%' ) !== false ){
        $string = str_replace( '%thing%', var_dump( $fi_output ), $string );
    }
    return $string;
}

// add_filter( 'dedo_search_replace_wildcards', 'custom_wildcards' );