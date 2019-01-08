<?php Asset::css('/app/assets/css/login/login'); ?>

<?php $this->theme->header(); ?>


<div class="container">
    <div class="centered-block margin-bottom-200">
        <div class="heading">
            <h1>Сброс пароля</h1>
        </div>
        <?php if ($result == 'not-found' || $result == 'fail'): ?>
            <div class="alert warning align-center">
                Что-то пошло не так. Сейчас не удается сбросить Ваш пароль.
            </div>
            <div class="form-group align-center">
                <a href="/account/password-reset/" class="link color-black">Попробовать ввести другой Email</a>
            </div>
        <?php elseif ($result == 'message-sent'): ?>
            <div class="alert success align-center">
                На указанный вами при регистрации адрес E-mail отправлено письмо со ссылкой для сброса пароля.<br>
                Пожалуйста, проверьте Ваш почтовый ящик. Если письма нет в папке &laquo;Входящие&raquo;, проверьте
                папку &laquo;Спам&raquo;.
            </div>
        <?php elseif ($result == 'success'): ?>
            <div class="alert success align-center">
                Ваш новый пароль успешно сохранен. Для входа на сайт нажмите кнопку &laquo;Войти&raquo;.
            </div>
            <div class="form-group">
                <a href="/account/signin-or-register/" class="btn btn-brand btn-md">Войти</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/login/password-reset'); ?>

<?php $this->theme->footer(); ?>
