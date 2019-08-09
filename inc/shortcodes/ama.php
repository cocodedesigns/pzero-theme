<?php
function ccdClient_shortcode_amaForm( $atts ) {

	// Parse attributes
    $atts = ( shortcode_atts( array(
        'id'        => uniqid('ccdClient_amaForm_'),
    ), $atts, 'ama_form' ) );

    $rcKey = cmb2_get_option( 'ccdtheme_settings_apikeys', '_ccdclient_themesettings_apikeys_captcha_sitekey' );
    
    $form = '
    <form id="' . $atts['id'] . '" name="' . $atts['id'] . '" method="post" action="'.get_post_type_archive_link( 'ama' ).'?asking" class="amaForm">
        <div class="amaError"></div>
        <div class="amaForm-field-question amaForm-field">
            <p class="amaForm-fieldLabel"><label for="ama_question">Your Question</label>
                (<span class="amaForm-charCount">250/250</span> characters left)</p>
            <p class="amaForm-fieldItem"><textarea id="ama_question" name="ama_question" tabindex="1" class="amaForm-input amaForm-inputTextarea amaForm-input-question" data-maxchars="250"></textarea></p>
            <script>
                var maxchars = $(".amaForm .amaForm-field-question #ama_question").data("maxchars");
                $(".amaForm .amaForm-field-question #ama_question").keyup(function () {
                    var tlength = $(this).val().length;
                    $(this).val($(this).val().substring(0, maxchars));
                    var tlength = $(this).val().length;
                    remain = maxchars - parseInt(tlength);
                    $(".amaForm .amaForm-field-question .amaForm-charCount").text(remain + "/" + maxchars);
                });
            </script>
        </div>
        <div class="amaForm-fieldGroup amaForm-groupTwo clearfix">
            <div class="amaForm-field-name amaForm-field">
                <p class="amaForm-fieldLabel"><label for="ama_name">Your Name</label></p>
                <p class="amaForm-fieldItem"><input type="text" id="ama_name" name="ama_name" tabindex="2" class="amaForm-input amaForm-inputText amaForm-input-name" /></p>
            </div>
            <div class="amaForm-field-email amaForm-field">
                <p class="amaForm-fieldLabel"><label for="ama_email">Your Email</label></p>
                <p class="amaForm-fieldItem"><input type="email" id="ama_email" name="ama_email" tabindex="3" class="amaForm-input amaForm-inputText amaForm-input-email" /></p>
            </div>
        </div>
        <div class="amaForm-field amaForm-field-ask_anonymously">
            <p class="amaForm-fieldLabel">
                <label for="ama_ask_anonymously"><input type="checkbox" name="ama_ask_anonymously" id="ama_ask_anonymously"> Ask anonymously</label></p>
            <script>
                $(".amaForm #ama_ask_anonymously").click(function () {
                    if ($(this).prop("checked")) {
                        $(".amaForm #ama_name").val("Anonymous").attr("disabled", "disabled");
                        $(".amaForm #ama_email").val("nobody@anonymous.tld").attr("disabled", "disabled");
                    }
                    else {
                        $(".amaForm #ama_name").val("").prop("disabled", false);
                        $(".amaForm #ama_email").val("").prop("disabled", false);
                    }
                });
            </script>
        </div>
        <div class="amaForm-field-gdpr amaForm-fieldGroup">
            <div class="amaForm-gdpr-fieldRow amaForm-gdprField clearfix">
                <div class="amaForm-fieldLabel"><p><label for="gdpr_email">Do you consent to receiving email communication from me specifically with regards to this question?</label></p></div>
                <div class="amaForm-fieldItem amaForm-field"><p><select name="gdpr_email" id="gdpr_email" class="amaForm-input amaForm-inputSelect amaForm-input-gdpr_email">
                    <option value="yes">I consent</option>
                    <option value="no" selected>I do not consent</option>
                </select></p></div>
            </div>
            <div class="amaForm-gdpr-fieldRow amaForm-gdprField clearfix">
                <div class="amaForm-fieldLabel"><p><label for="gdpr_process">Do you consent for me to process and store this question permanently as part of my website content?</label></p></div>
                <div class="amaForm-fieldItem amaForm-field"><p><select name="gdpr_process" id="gdpr_process" class="amaForm-input amaForm-inputSelect amaForm-input-gdpr_process">
                    <option value="yes">I consent</option>
                    <option value="no" selected>I do not consent</option>
                </select></p></div>
            </div>
            <div class="amaForm-gdpr-fieldRow amaForm-gdprField clearfix">
                <div class="amaForm-fieldLabel"><p><label for="gdpr_display">Do you consent to having your name displayed publicly on my website?  Your email address will not be publicly associated with this question.</label></p></div>
                <div class="amaForm-fieldItem amaForm-field"><p><select name="gdpr_display" id="gdpr_display" class="amaForm-input amaForm-inputSelect amaForm-input-gdpr_display">
                    <option value="yes">I consent</option>
                    <option value="no" selected>I do not consent</option>
                </select></p></div>
            </div>
        </div>
        <div class="amaForm-field-recaptcha amaForm-field amaForm-recaptcha">
            <div class="g-recaptcha" data-sitekey="' . $rcKey . '"></div>
        </div>
        <div class="amaForm-field-submit amaForm-field">
            <input type="submit" value="Publish" id="amaSubmit" name="submit" class="amaForm-button amaForm-submit amaForm-submitButton" />
            <script>
                $("form.amaForm").submit(function(){
                    $(".amaForm-field-submit input[type=\'submit\']", this)
                    .val("Please Wait...")
                    .attr("disabled", "disabled" );
                    return true;
                });
            </script>
        </div>
    </form>
    <script src="' . get_template_directory_uri() . '/js/validation-script.js" type="text/javascript"></script>';

    return $form;
}
add_shortcode('ama_form', 'ccdClient_shortcode_amaForm');

function ama_form_process() {
    // If the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Include WordPress files
        include_once '../../../../../wp-includes/wp-load.php';

        // Set reCaptcha private key
        $recaptchaKey = cmb2_get_option( 'ccdtheme_settings_apikeys', '_ccdclient_themesettings_apikeys_captcha_secretkey' );

        // If the Google Recaptcha box was clicked
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
            $response_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptchaKey . "&response=" . $captcha;
            $response = file_get_contents( $response_url );
            $obj = json_decode($response);

            // If the Google Recaptcha check was successful
            if($obj->success == true) {
                $ama_question = strip_tags( trim( $_POST['ama_question'] ) );
                $ama_name = strip_tags( trim( $_POST["ama_name"] ) );
                $ama_name = str_replace( array("\r","\n"), array(" "," "), $ama_name);
                $ama_email = filter_var( trim( $_POST["ama_email"] ), FILTER_SANITIZE_EMAIL );
                if ( !$ama_name || !filter_var($ama_email, FILTER_VALIDATE_EMAIL)) {
                    echo "Oops! There was a problem with your submission. Please complete the form and try again.";
                    exit;
                }

                // Add the content of the form to $post as an array
                $ama_post = array(
                    'post_title'    => $ama_question,
                    'post_status'   => 'pending',   // Could be: publish
                    'post_type' 	=> 'ama', // Could be: `page` or your CPT
                    'meta_input'    => array(
                        '_ccdclient_ama_name'   => $ama_name,
                        '_ccdclient_ama_email'  => $ama_email,
                        '_ccdclient_ama_receive_email' => $_POST['gdpr_email'],
                        '_ccdclient_ama_process_data' => $_POST['gdpr_process'],
                        '_ccdclient_ama_display_name' => $_POST['gdpr_display'],
                    ),
                );
                wp_insert_post($ama_post);
                echo 'Saved your post successfully! :)';

                $ama_recipient = get_option('admin_email');
                $ama_subject = "New question from $ama_name";
                $ama_email_content = "Name: $ama_name\n";
                $ama_email_content .= "Email: $ama_email\n\n";
                $ama_email_content .= "Message:\n$ama_question\n";
                $ama_email_headers = "From: $ama_name <$ama_email>";
                wp_mail( $ama_recipient, $ama_subject, $ama_email_content, $ama_email_headers );
            }
            // If the Google Recaptcha check was not successful
            else {
                echo "Robot verification failed. Please try again. Success:" . $response_url;
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
}
add_action("wp_ajax_ama_form_process", "ama_form_process");
//use this version for if you want the callback to work for users who are not logged in
add_action("wp_ajax_nopriv_ama_form_process", "ama_form_process");