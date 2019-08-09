<?php
    require "Akismet.class.php";
        function send_mail( $name, $email, $website, $ip, $is_spam, $message) {
            $subject = '';
            if( $is_spam == true )
                $subject = "[SPAM?]"; 
            $subject .= "[Your_site.com] E-mail received from ".$name."//".$email;
            
            wp_mail( 'nate@cocode.co.uk', '[WP] ' . $subject, $message, 'From: '. $name . ' <' . $email . '>');
//            mail( 'nate@cocode.co.uk', '[PHP]' . $subject, $message, 'From: '. $name . ' <' . $email . '>');
        }
 
        $wp_key = '96e819174b99';
        $our_url = 'http://www.cocode.co.uk/';
         
        $name = $_POST['name'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $message = $_POST['message'];
        $ip = $_SERVER['REMOTE_ADDR'];
         
        $akismet = new Akismet($our_url, $wp_key);
        $akismet->setCommentAuthor($name);
        $akismet->setCommentAuthorEmail($email);
        $akismet->setCommentAuthorURL($website);
        $akismet->setCommentContent($message);
        $akismet->setUserIP($ip);
         
        send_mail( $name, $email, $website, $ip, $akismet->isCommentSpam(), $message);
?>