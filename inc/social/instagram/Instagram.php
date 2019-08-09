<?php
function instagram_feed( $access_token, $instagram_id, $count = 5 ) {
	if ( false === ( $feed = get_transient( 'instagram_feed' ) ) ) {
        $url      = 'https://api.instagram.com/v1/users/' . $instagram_id . '/media/recent?access_token=' . $access_token . '&count=5';
		$response = wp_remote_get( $url );
		$body = json_decode( $response['body'] );
		$feed = $body->data;
		set_transient( 'instagram_feed', $feed, 12 * HOUR_IN_SECONDS );
	}
	return $feed;
}

function show_instagram_feed( $access_token, $instagram_id ){
    
    $feed = instagram_feed( $access_token, $instagram_id, 5 );

    if ( $feed ) {
        echo '<div class="instagram-wrap">';
        foreach ( $feed as $post ) {
            echo '
                <div id="ig_'.$post->id.'" class="insta-single-post">
                  <div class="insta-wrap">
                    <a href="' . $post->images->standard_resolution->url . '" class="fancybox insta-photo" style="background-image: url(\'' . $post->images->low_resolution->url . '\');"></a>
                  </div>
                </div>
            ';
        }
        echo '</div>';
    }
}

function rudr_instagram_api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	$json = json_decode( $json_return ); // decode and return
    
    return $json;
}

function display_instagram_feed($access_token, $user_id){
    // $username = 'instagram';
    // $user_search = rudr_instagram_api_curl_connect();
    // $user_search is an array of objects of all found users
    // we need only the object of the most relevant user - $user_search->data[0]
    // $user_search->data[0]->id - User ID
    // $user_search->data[0]->first_name - User First name
    // $user_search->data[0]->last_name - User Last name
    // $user_search->data[0]->profile_picture - User Profile Picture URL
    // $user_search->data[0]->username - Username

    // $user_id = $user_search->data[0]->id; // or use string 'self' to get your own media
    $return_url = "https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access_token . "&count=5";
    $return = rudr_instagram_api_curl_connect( $return_url );

    // var_dump( $return ); // if you want to display everything the function returns
    
    if ( $return->data ){
        echo '<div class="instagram-wrap">';
        foreach ($return->data as $post) {
            echo '
                <div id="ig_'.$post->id.'" class="insta-single-post">
                  <div class="insta-wrap">
                    <a href="' . $post->images->standard_resolution->url . '" class="fancybox insta-photo" style="background-image: url(\'' . $post->images->low_resolution->url . '\');"></a>
                  </div>
                </div>
            ';
        }
        echo '</div>';
    }
}
?>