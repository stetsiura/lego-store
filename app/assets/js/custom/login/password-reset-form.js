$(document).ready(function() {
    var registerForm = $('#reset-form');

    registerForm.submit(function(e) {
        var valid = validation
            .init()
            .notEmpty('password', 'Пожалуйста, напишите Ваш новый пароль')
            .match('password', 'password-repeat')
            .result();

        if (!valid) {
            e.preventDefault();
        }
    });
});
