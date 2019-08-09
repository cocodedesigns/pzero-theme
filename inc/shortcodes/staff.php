<?php 

function ocp_staffdisp_format( $format, $id ){
    
    $staff = get_user_by( 'id', $id );
    // Get the image URL using the author ID and image size params
    $imgURL = get_cupp_meta($id, 'profile-image');
    if ( $imgURL == "" ) {
        $picURL = get_bloginfo('template_url')."/images/d_silhouette_Bed_Head.jpg";
    } else {
        $picURL = $imgURL;
    }
    if ( get_user_meta( $id, 'post_title', true ) && get_user_meta( $id, 'project', true ) ) { $comma = ', '; } else { }
    if ( $format == 'block' ) {
        $staff_box = '<div id="staff-'.$id.'" class="staff-display staff-block staff-display-wrap">
          <div class="staff-display-inner">
            <div class="staff-display-image" style="background-image: url(\'' . $picURL .'\');"></div>
            <div class="staff-display-content">
              <h2 class="staff-display-name">' . $staff->first_name . ' ' . $staff->last_name . '</h2>
              <p class="staff-display-title">' . get_user_meta( $id, 'post_title', true ) . $comma . get_user_meta( $id, 'project', true ) . '</p>
              <ul class="social-networks">';
        if ( get_the_author_meta( 'user_url', $id ) ) { $staff_box .= '
                <li class="web"><a href="' . get_the_author_meta( 'user_url', $id ) . '" target="_blank"><span class="network-icon flaticon-web58"></span> Website</a></li>'; }
        if ( get_the_author_meta( 'facebook', $id ) ) { $staff_box .= '
                <li class="facebook"><a href="http://www.facebook.com/' . get_the_author_meta( 'facebook', $id ) . '" target="_blank"><span class="network-icon network-element flaticon-facebook12"></span> Facebook</a></li>'; }
        if ( get_the_author_meta( 'twitter', $id ) ) { $staff_box .= '
                <li class="twitter"><a href="http://twitter.com/' . get_the_author_meta( 'twitter', $id ) . '" target="_blank"><span class="network-icon flaticon-twitter33"></span> Twitter</a></li>'; }
        if ( get_the_author_meta( 'googleplus', $id ) ) { $staff_box .= '
                <li class="googleplus"><a href="http://plus.google.com/' . get_the_author_meta( 'googleplus', $id ) . '" target="_blank"><span class="network-icon flaticon-google109"></span> Google+</a></li>'; }
        if ( get_the_author_meta( 'linkedin', $id ) ) { $staff_box .= '
                <li class="linkedin"><a href="http://linkedin.com/' . get_the_author_meta( 'linkedin', $id ) . '" target="_blank"><span class="network-icon flaticon-linkedin11"></span> LinkedIn</a></li>'; }
        if ( get_the_author_meta( 'tumblr', $id ) ) { $staff_box .= '
                <li class="tumblr"><a href="http://' . get_the_author_meta( 'tumblr', $id ) . '.tumblr.com/" target="_blank"><span class="network-icon flaticon-logotype1"></span> Tumblr</a></li>'; }
        if ( get_the_author_meta( 'instagram', $id ) ) { $staff_box .= '
                <li class="instagram"><a href="http://instagram.com/' . get_the_author_meta( 'instagram', $id ) . '" target="_blank"><span class="network-icon flaticon-instagram11"></span> Instagram</a></li>'; }
        if ( get_the_author_meta( 'youtube', $id ) ) { $staff_box .= '
                <li class="youtube"><a href="http://www.youtube.com/' . get_the_author_meta( 'youtube', $id ) . '" target="_blank"><span class="network-icon flaticon-youtube13"></span> YouTube</a></li>'; }
        $staff_box .= '
              </ul>
            </div>
          </div>
        </div>';
    } elseif ( $format == 'profile' ) {
        $staff_box = '<div id="staff-'.$id.'" class="staff-display staff-block staff-display-wrap">
          <div class="staff-display-inner">
            <div class="staff-display-image" style="background-image: url(\'' . $picURL .'\');"></div>
            <div class="staff-display-content">
              <h2 class="staff-display-name">' . $staff->first_name . ' ' . $staff->last_name . '</h2>
              <p class="staff-display-title">' . get_user_meta( $id, 'post_title', true ) . '</p>
              <ul class="social-networks">';
        if ( get_the_author_meta( 'user_url', $id ) ) { $staff_box .= '
                <li class="web"><a href="' . get_the_author_meta( 'user_url', $id ) . '" target="_blank"><span class="network-icon flaticon-web58"></span> Website</a></li>'; }
        if ( get_the_author_meta( 'facebook', $id ) ) { $staff_box .= '
                <li class="facebook"><a href="http://www.facebook.com/' . get_the_author_meta( 'facebook', $id ) . '" target="_blank"><span class="network-icon network-element flaticon-facebook12"></span> Facebook</a></li>'; }
        if ( get_the_author_meta( 'twitter', $id ) ) { $staff_box .= '
                <li class="twitter"><a href="http://twitter.com/' . get_the_author_meta( 'twitter', $id ) . '" target="_blank"><span class="network-icon flaticon-twitter33"></span> Twitter</a></li>'; }
        if ( get_the_author_meta( 'googleplus', $id ) ) { $staff_box .= '
                <li class="googleplus"><a href="http://plus.google.com/' . get_the_author_meta( 'googleplus', $id ) . '" target="_blank"><span class="network-icon flaticon-google109"></span> Google+</a></li>'; }
        if ( get_the_author_meta( 'linkedin', $id ) ) { $staff_box .= '
                <li class="linkedin"><a href="http://linkedin.com/' . get_the_author_meta( 'linkedin', $id ) . '" target="_blank"><span class="network-icon flaticon-linkedin11"></span> LinkedIn</a></li>'; }
        if ( get_the_author_meta( 'tumblr', $id ) ) { $staff_box .= '
                <li class="tumblr"><a href="http://' . get_the_author_meta( 'tumblr', $id ) . '.tumblr.com/" target="_blank"><span class="network-icon flaticon-logotype1"></span> Tumblr</a></li>'; }
        if ( get_the_author_meta( 'instagram', $id ) ) { $staff_box .= '
                <li class="instagram"><a href="http://instagram.com/' . get_the_author_meta( 'instagram', $id ) . '" target="_blank"><span class="network-icon flaticon-instagram11"></span> Instagram</a></li>'; }
        if ( get_the_author_meta( 'youtube', $id ) ) { $staff_box .= '
                <li class="youtube"><a href="http://www.youtube.com/' . get_the_author_meta( 'youtube', $id ) . '" target="_blank"><span class="network-icon flaticon-youtube13"></span> YouTube</a></li>'; }
        $staff_box .= '
              </ul>
            </div>
          </div>
        </div>';
    } elseif ( $format == 'author' ) {
        $staff_box = '<div id="staff-'.$id.'" class="staff-display staff-author staff-display-wrap">
          <div class="staff-display-inner">
            <div class="staff-display-image" style="background-image: url(\'' . $picURL .'\');"></div>
            <div class="staff-display-content">
              <h2 class="staff-display-name">' . $staff->first_name . ' ' . $staff->last_name . '</h2>
              <p class="staff-display-title">' . get_user_meta( $id, 'post_title', true ) . '</p>
              <ul class="social-networks">';
        if ( get_the_author_meta( 'user_url', $id ) ) { $staff_box .= '
                <li class="web"><a href="' . get_the_author_meta( 'user_url', $id ) . '" target="_blank"><span class="network-icon flaticon-web58"></span> Website</a></li>'; }
        if ( get_the_author_meta( 'facebook', $id ) ) { $staff_box .= '
                <li class="facebook"><a href="http://www.facebook.com/' . get_the_author_meta( 'facebook', $id ) . '" target="_blank"><span class="network-icon flaticon-facebook12"></span> Facebook</a></li>'; }
        if ( get_the_author_meta( 'twitter', $id ) ) { $staff_box .= '
                <li class="twitter"><a href="http://twitter.com/' . get_the_author_meta( 'twitter', $id ) . '" target="_blank"><span class="network-icon flaticon-twitter33"></span> Twitter</a></li>'; }
        if ( get_the_author_meta( 'googleplus', $id ) ) { $staff_box .= '
                <li class="googleplus"><a href="http://plus.google.com/' . get_the_author_meta( 'googleplus', $id ) . '" target="_blank"><span class="network-icon flaticon-google109"></span> Google+</a></li>'; }
        if ( get_the_author_meta( 'linkedin', $id ) ) { $staff_box .= '
                <li class="linkedin"><a href="http://linkedin.com/' . get_the_author_meta( 'linkedin', $id ) . '" target="_blank"><span class="network-icon flaticon-linkedin11"></span> LinkedIn</a></li>'; }
        if ( get_the_author_meta( 'tumblr', $id ) ) { $staff_box .= '
                <li class="tumblr"><a href="http://' . get_the_author_meta( 'tumblr', $id ) . '.tumblr.com/" target="_blank"><span class="network-icon flaticon-logotype1"></span> Tumblr</a></li>'; }
        if ( get_the_author_meta( 'instagram', $id ) ) { $staff_box .= '
                <li class="instagram"><a href="http://instagram.com/' . get_the_author_meta( 'instagram', $id ) . '" target="_blank"><span class="network-icon flaticon-instagram11"></span> Instagram</a></li>'; }
        if ( get_the_author_meta( 'youtube', $id ) ) { $staff_box .= '
                <li class="youtube"><a href="http://www.youtube.com/' . get_the_author_meta( 'youtube', $id ) . '" target="_blank"><span class="network-icon flaticon-youtube13"></span> YouTube</a></li>'; }
        $staff_box .= '
              </ul>
            </div>
          </div>
        </div>';
    } else { return 'Error! Can\'t understand format "'.$format.'"'; }
    
    return $staff_box;
}

function ocp_sc_staffdisp( $atts ){
    $atts = ( shortcode_atts( array(
        'format'    => 'single', // 'single' or 'group'
        'number'    => 3, // Number in each row, maximum of 4
        'style'     => 'block', // 'block', 'profile' or 'author'
        'uid'       => '', // User login name
        'role'      => '' // Search for trustee, staff or volunteers
        ), $atts, 'staff' ) );
    if ( $atts['format'] == 'group' ) { // If more than one member of staff
        $staffs = get_users( array( 'role' => $atts['role'] ) );
        usort($staffs, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
        $staff_var = '';
        foreach ( $staffs as $staff ) {
          $staff_var .= ocp_staffdisp_format( 'block', $staff->ID );
        }
        $staff_var .= '<div class="clear"></div>';
    } else { // Default to one member of staff
        if ( $atts['style'] == 'profile' ) {
          $staff = get_user_by( 'login', $atts['uid'] );
          $staff_var = ocp_staffdisp_format( 'profile', $staff->ID );
        } elseif ( $atts['style'] == 'author' ) {
          $staff_var = ocp_staffdisp_format( 'author', get_the_author_id() );
        } else {
          $staff = get_user_by( 'login', $atts['uid'] );
          $staff_var = ocp_staffdisp_format( 'block', $staff->ID );
        }
    }
    return '<div class="staff-display-wrap">'.$staff_var.'</div>';
}
add_shortcode( 'staff', 'ocp_sc_staffdisp' );