<?php

require_once('advanced-search/wpas.php');
function wpas_search_form(){
    $args = array();
    $args['wp_query']   = array( 
        'post_type'         => array( 'post', 'page', 'portfolio' ),
        'posts_per_page'    => 20
    );
    $args['fields'][]   = array(
        'type'          => 'search',
        'label'         => 'Search',
        'value'         => get_search_query(),
        'placeholder'   => 'Enter search terms ...'
    );
    $args['fields'][]   = array(
        'type'          => 'post_type',
        'label'         => 'Post Type',
        'format'        => 'multi-select',
        'values'        => array(
            'post'      => 'Post',
            'page'      => 'Page',
            'portfolio' => 'Portfolio'
        )
    );
    $args['fields'][]   = array(
        'type'          => 'order',
        'label'         => 'Order',
        'values'        => array(
            'ASC'   => 'Ascending',
            'DESC'  => 'Descending'
        ),
        'default'       => 'ASC'
    );
    register_wpas_form( 'ccd-wpas-form', $args );
}
add_action( 'init', 'wpas_search_form' );