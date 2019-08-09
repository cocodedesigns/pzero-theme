<?php

function get_copyrightText( $attid ){
    
    $attMeta = wp_get_attachment_metadata( $attid );
    echo '<pre>'; var_dump( $attMeta ); echo '</pre>';
}