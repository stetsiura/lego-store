var validation;

(function() {

    var Validation = function() {
        this.valid = true;

        this.emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        this.notEmptyRegex = /([^\s])/;

        this.emailCheckUrl = '/account/check-email/';
    };

    Validation.prototype.showMessage = function(input, message) {
        var errorBox = input.siblings('.form-error-message');

        errorBox.html(message);
        errorBox.show();
    };

    Validation.prototype.hideErrors = function() {
        var errorBoxes = $('.form-error-message');

        errorBoxes.hide();
    };

    Validation.prototype.init = function () {
        this.valid = true;
        this.hideErrors();

        return this;
    };

    Validation.prototype.notEmpty = function(id, message) {
        var input = $('#' + id),
            value = input.val();

        if (!this.notEmptyRegex.test(value)) {
            this.valid = false;
            this.showMessage(input, message);
        }

        return this;
    };

    Validation.prototype.email = function(id) {
        var input = $('#' + id),
            value = input.val();

        if (!this.emailRegex.test(value)) {
            this.valid = false;
            this.showMessage(input, 'Пожалуйста, укажите корректный адрес E-mail');
        }

        return this;
    };

    Validation.prototype.emailNotExists = function(id) {
        var input = $('#' + id),
            email = input.val();

        var data = {
            email : email
        };

        var self = this;
        if (this.valid)
        {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: this.emailCheckUrl,
                data: data,
                async: false,
                success: function(data) {
                    if (!data) {
                        self.valid = false;
                        self.showMessage(input, 'Данный адрес электронной почты уже зарегистрирован');
                    }
                },
                error: function() {
                    self.valid = false;
                    self.showMessage(input, 'Данный адрес электронной почты уже зарегистрирован');
                }
            });
        }

        return this;
    };

    Validation.prototype.match = function(id, target)
    {
        var input = $('#' + id),
            value = input.val(),
            targetInput = $('#' + target),
            targetValue = targetInput.val();

        if (value !== targetValue) {
            this.valid = false;
            this.showMessage(targetInput, 'Пароли не совпадают');
        }

        return this;
    };

    Validation.prototype.result = function() {
        return this.valid;
    };

    $(document).ready(function() {
        validation = new Validation();
    });

})();
