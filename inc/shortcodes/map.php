<?php

function lvk_sc_mapdisp( $atts ){

    global $lvk_options;

    // Ensure unique ID
    static $si = 0; $si++;

    // Default attributes
    $atts = ( shortcode_atts( array(
        'id'        => $si,
        'address'   => $lvk_options['lvk-contact-address'],
        'lat'       => '',
        'lon'       => '',
        'pointer'   => get_template_directory_uri().'/images/map-pointer.png',
        'place'     => '',
        'height'    => '450',
        'showmarker' => 'yes'
        ), $atts, 'map' ) );

    // Collect source
    if ( $atts['address'] != '0' ) { // This map has an address
        $hs = 1; // Has source
        $address = $atts['address']; // Address
        $address_enc = urlencode( $atts['address'] ); // URL Encoded address
        $json = file_get_contents( 'http://open.mapquestapi.com/nominatim/v1/search.php?key='.$lvk_options['lvk-apis-mapquest-key'].'&format=json&q=' . $address_enc . '&addressdetails=1&limit=1' ); // JSON Feed from OSM
        $data = json_decode( $json, true ); // Decodes JSON
        if ( $data[0]['lat'] == "" && $data[0]['lon'] == "" ) { $hs = 2; } else { }
    } else { // This map has no source
        $hs = 0; // Has no source
    }

    // Create pointer
    if ( $atts['place'] ){
        $mapplace = '<strong style="font-size: 18px;">' . htmlentities($atts['place'], ENT_QUOTES) . '</strong><br />' . htmlentities($atts['address'], ENT_QUOTES);
    } else {
        $mapplace = htmlentities($atts['address'], ENT_QUOTES);
    }

    if ( is_numeric( $atts['height'] ) ) {
        $mapheight = $atts['height'] . 'px';
    } else {
        $mapheight = $atts['height'];
    }

    if ( $atts['showmarker'] == "no" ) { $showmarker = ''; } else { $showmarker = "// add a marker in the given location, attach some popup content to it and open the popup
L.marker([".$data[0]['lat'].", ".$data[0]['lon']."], {icon: myIcon}).addTo(map".$atts['id'].")
    .bindPopup('" . $mapplace . "')
    .openPopup();"; }

    // Print map
    if ( $hs == 1 ) { // If has source
//        $mapreturn = '<p>http://open.mapquestapi.com/nominatim/v1/search.php?format=json&q=' . $address_enc . '&addressdetails=1&limit=1</p><p>Lat: '.$data[0]['lat'].', Lon: '.$data[0]['lon'].'</p>';
        $mapreturn .= "
      <script type=\"text/javascript\" language=\"javascript\">
         $(document).ready(function() {
           var map".$atts['id']." = L.map('lvk-map-".$atts['id']."', { center: [".$data[0]['lat'].", ".$data[0]['lon']."], zoom: 16 });
var myIcon = L.icon({ iconUrl: '".$atts['pointer']."', iconSize: [44,65], iconAnchor: [22,81], popupAnchor: [0, -76] });

// add an OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors'
}).addTo(map".$atts['id'].");

".$showmarker."
            });
</script>
<div id=\"lvk-map-".$atts['id']."\" class=\"map-wrap\" style=\"height: " . $mapheight . ";\"></div>";
    } elseif ( $hs == 2 ) { // If invalid source
        $mapreturn = '<div id="map-id" class="map-class">Sorry, but the map that has been requested is invalid.  Please contact the site administrator on ' . get_option( 'admin_email' ) . '.</div>'.var_dump($data);
    } else { // If no source
        $mapreturn = '<div id="map-id" class="map-class">Sorry, but the map that has been requested does not have a source address.  Please contact the site administrator on ' . get_option( 'admin_email' ) . '.</div>'.var_dump($data);
    }

    return $mapreturn;
}
add_shortcode( 'map', 'lvk_sc_mapdisp' );
