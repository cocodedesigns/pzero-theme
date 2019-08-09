<?php
// If the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include WordPress files
    include_once '../../../../../wp-includes/wp-load.php';

    // Set reCaptcha private key
    $recaptchaKey = "6LerK_cSAAAAAKuM3zYf3VraPtKoWHkFHuruchbc";

    // If the Google Recaptcha box was clicked
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptchaKey . "&response=" . $captcha);
        $obj = json_decode($response);

        // If the Google Recaptcha check was successful
        if($obj->success == true) {
            $question = strip_tags( trim( $_POST['question'] ) );
            $name = strip_tags( trim( $_POST["name"] ) );
            $name = str_replace( array("\r","\n"), array(" "," "), $name);
            $email = filter_var( trim( $_POST["email"] ), FILTER_SANITIZE_EMAIL );
            if ( !$name || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Oops! There was a problem with your submission. Please complete the form and try again.";
                exit;
            }

            // Add the content of the form to $post as an array
            $post = array(
                'post_title'    => $question,
                'post_status'   => 'pending',   // Could be: publish
                'post_type' 	=> 'ama', // Could be: `page` or your CPT
                'meta_input'    => array(
                    '_ccdclient_ama_name'   => $name,
                    '_ccdclient_ama_email'  => $email,
                ),
            );
            wp_insert_post($post);
            echo 'Saved your post successfully! :)';

            $recipient = get_option('admin_email');
            $subject = "New question from $name";
            $email_content = "Name: $name\n";
            $email_content .= "Email: $email\n\n";
            $email_content .= "Message:\n$question\n";
            $email_headers = "From: $name <$email>";
            wp_mail( $recipient, $subject, $email_content, $email_headers );
        }
        // If the Google Recaptcha check was not successful
        else {
            echo "Robot verification failed. Please try again. Success:" . $response;
        }
    }
    // If the Google Recaptcha box was not clicked
    else {
        echo "Please click the reCAPTCHA box.";
    }
}
// If the form was not submitted
// Not a POST request, set a 403 (forbidden) response code.
else {
    echo "There was a problem with your submission, please try again.";
}
?>