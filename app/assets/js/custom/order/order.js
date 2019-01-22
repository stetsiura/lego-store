$(document).ready(function() {
    var form = $('#order-form');

    form.submit(function(e) {

        var valid = false;

        valid = validation
            .init()
            .notEmpty('name', 'Пожалуйста, укажите Ваше имя')
            .email('email')
            .notEmpty('phone', 'Пожалуйста, укажите Ваш телефон')
            .notEmpty('city', 'Пожалуйста, укажите Ваш город')
            .notEmpty('post-office', 'Пожалуйста, укажите отделение Новой Почты')
            .result();

        if (!valid) {
            e.preventDefault();
        }
    });
});