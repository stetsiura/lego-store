$(document).ready(function() {
    var registerForm = $('#register-form');

    registerForm.submit(function(e) {
        var valid = validation
            .init()
            .notEmpty('register-name', 'Пожалуйста, укажите Ваше имя')
            .email('register-email')
            .notEmpty('register-password', 'Пожалуйста, напишите Ваш новый пароль')
            .match('register-password', 'register-password-repeat')
            .emailNotExists('register-email')
            .result();

        if (!valid) {
            e.preventDefault();
        }
    });
});
