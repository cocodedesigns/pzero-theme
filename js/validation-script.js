// validate signup form on keyup and submit
$("form.amaForm").validate({
    rules: {
        ama_question: {
            required: true,
            minlength: 10
        },
        ama_name: {
            required: true,
            minlength: 2
        },
        ama_email: {
            required: true,
            email: true
        },
        gdpr_email: "required",
        gdpr_process: "required",
        gdpr_display: "required"
    },
    messages: {
        ama_question: {
            required: "Please enter a question.",
            minlength: "It does not look like you are asking a legitimate question.  Your question should be at least 10 characters long."
        },
        ama_name: {
            required: "Please enter your name.",
            minlength: "It looks like you have not provided your real name.  Your name should be at least two characters long."
        },
        ama_email: "Please enter a valid email address.",
        gdpr_email: "Please select whether you would consent to receiving emails about your question.",
        gdpr_process: "Please select whether you would consent to your information being processed.",
        gdpr_display: "Please select whether you would consent to having your name displayed publicly on this website."
    }
});