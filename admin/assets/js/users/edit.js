function emailChanged() {
    return $('input#current-email').val() != $('input#email').val();
}


$(document).ready(function() {
    var action = $('input#action').val(),
        registerForm = $('#user-form');

    if (action == 'add-post') {

        registerForm.submit(function(e) {
            var valid = validation
                .init()
                .notEmpty('name', 'Пожалуйста, укажите имя')
                .email('email')
                .notEmpty('password', 'Пожалуйста, напишите новый пароль')
                .match('password', 'password-repeat')
                .emailNotExists('email')
                .result();

            if (!valid) {
                e.preventDefault();
            }
        });
    } else {
        registerForm.submit(function(e) {
            var valid = false;

            if (emailChanged()) {
                valid = validation
                    .init()
                    .notEmpty('name', 'Пожалуйста, укажите имя')
                    .email('email')
                    .emailNotExists('email')
                    .result();
            } else {
                valid = validation
                    .init()
                    .notEmpty('name', 'Пожалуйста, укажите имя')
                    .email('email')
                    .result();
            }
            console.log(valid);
            if (!valid) {
                e.preventDefault();
            }
        });
    }
});
