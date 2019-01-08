$(document).ready(function() {
    var supportForm = $('#support-form');

    supportForm.submit(function(e) {
        var valid = validation
            .init()
            .notEmpty('name', 'Пожалуйста, укажите Ваше имя')
            .email('email')
            .notEmpty('message', 'Пожалуйста, напишите Ваше сообщение')
            .result();

        if (!valid) {
            e.preventDefault();
        }
    });
});