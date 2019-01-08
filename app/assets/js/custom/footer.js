$(document).ready(function() {
    var subscribeForm = $('#subscribe-form');

    subscribeForm.submit(function(e) {
        e.preventDefault();
        var valid = validation
            .init()
            .email('subscribe-email')
            .result();

        if (valid) {
            var data = {
                email : $('input#subscribe-email').val()
            };

            self = this;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/support/subscribe/',
                data: data,
                success: function() {
                    notificationManager.successfulSubscription();
                    $('input#subscribe-email').val('')
                },
                error: function() {
                    notificationManager.unsuccessfulSubscription();
                }
            });
        } else {
            notificationManager.subscriptionValidationError();
        }
    });
});