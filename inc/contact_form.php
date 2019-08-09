<?php
define('DEFAULT_POST_ID', post_id_here);
/* Contact form handling here */
if ($_POST['contact']) {
    require_once( '/wp-load.php' );
    $contact_invalid = array();
    $contact_data = array();
    $contact_data['name'] = filter_var($_POST['contact_name'],
        FILTER_SANITIZE_STRING);
    $contact_data['message'] = filter_var($_POST['contact_message'],
        FILTER_SANITIZE_STRING);
    $contact_data['email'] = filter_var($_POST['contact_email'],
        FILTER_VALIDATE_EMAIL);
    foreach ($contact_data as $contact_key => $contact_field) {
        if (!$contact_field) {
            $contact_invalid[$contact_key] = true;
        }
    }

    if (!$contact_invalid && !$_COOKIE['awesomemath_contact']) {
        $comment_post_ID = DEFAULT_POST_ID;
        $comment_author = $contact_data['name'];
        $comment_author_email = $contact_data['email'];
        $comment_author_url = '';
        $comment_content = $contact_data['message'];
        $comment_type = '';
        $comment_parent = 0;
        $user_ID = 0;

        $commentdata = compact('comment_post_ID', 'comment_author',
            'comment_author_email', 'comment_author_url', 'comment_content',
            'comment_type', 'comment_parent', 'user_ID');
        $comment_id = wp_new_comment( $commentdata );
        $comment_approved = $wpdb->get_results(
           "SELECT (comment_approved = 'spam')
                AS spam
            FROM wp_comments
            WHERE comment_ID = '{$comment_id} LIMIT 1;'"
        );
        // allow contact again after one hour
        setcookie('awesomemath_contact', 1, time() + 3600, '/');
        if ($comment_id && !$comment_approved->spam) {
            // not spam!
            $contact_headers = 
            "From: {$contact_data['name']} <{$contact_data['email']}>\r\n\\";
            wp_mail(get_option('admin_email'),
                'Examplesite Contact Form Message'
                , $contact_data['message'], $contact_headers);
            $contact_headers =
                "From: Examplesite <me@examplesite.com>\r\n\\";
            wp_mail("{$contact_data['name']} <{$contact_data['email']}>",
                'Thank you for contacting Examplesite!',
                'Thank you for contacting us. We will get back to you shortly.

Below is a copy of your message.
If for any reason we do not get back to you soon, simply reply to this email.

------------------------------

' . $contact_data['message'], $contact_headers);
            // redirect to prevent resubmission
            header("Location: {$_SERVER['HTTP_REFERER']}?contacted=1");
            die;
        }
    }
}