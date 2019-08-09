<?php

// Start the download if there is a request for that
function ccdClient_downloadFile(){
    
    if ( isset( $_GET["aid"] ) && isset( $_GET['dlf'] ) ){
        $rn = $_REQUEST['_wpnonce'];   
        if( ! wp_verify_nonce( $rn, 'ccdclient_dl_file' ) ) {
            die( 'Failed security check' );
        } else {
            ccdClient_downloadFile_process();
        }
    } else { }
}
add_action('init','ccdClient_downloadFile');

// Send the file to download
function ccdClient_downloadFile_process(){
	//get filedata
    $attID = $_GET['aid'];
    $theFile = wp_get_attachment_url( $attID );
    
    if( ! $theFile ) {
        return;
    }
    //clean the fileurl
    $file_url  = stripslashes( trim( $theFile ) );
    //get filename
    $file_name = basename( $theFile );
    //get fileextension
    
    $file_extension = pathinfo($file_name);
    //security check
    $fileName = strtolower($file_url);
    
    $whitelist = apply_filters( "ccdclient_allowed_file_types", array('pdf','doc','docx','zip','xls','xlsx','ppt','pptx') );
    
    if(!in_array(end(explode('.', $fileName)), $whitelist)){
        exit('Invalid file!');
    }
    if(strpos( $file_url , '.php' ) == true){
        die("Invalid file!");
    }
 
	$file_new_name = $file_name;
    $content_type = get_post_mime_type( $attID );
    //check filetype
    /*
    switch( $file_extension['extension'] ) {
		case "png": 
	    	  $content_type="image/png"; 
	    	  break;
		case "gif": 
	    	  $content_type="image/gif"; 
	    	  break;
		case "tiff": 
	    	  $content_type="image/tiff"; 
	    	  break;
		case "jpeg":
		case "jpg": 
	    	  $content_type="image/jpg"; 
	    	  break;
		default: 
              $content_type="application/force-download";
    }
    */
    
    $content_type = apply_filters( "ccdclient_content_type", $content_type, $file_extension['extension'] );
    
    header("Expires: 0");
    header("Cache-Control: no-cache, no-store, must-revalidate"); 
    header('Cache-Control: pre-check=0, post-check=0, max-age=0', false); 
    header("Pragma: no-cache");	
    header("Content-type: {$content_type}");
    header("Content-Disposition:attachment; filename={$file_new_name}");
    header("Content-Type: application/force-download");
    
    readfile("{$file_url}");
    exit();
}