$(document).ready(function() {
    var registerForm = $('#reset-form');

    registerForm.submit(function(e) {
        var valid = validation
            .init()
            .email('reset-email')
            .result();

        if (!valid) {
            e.preventDefault();
        }
    });
});
