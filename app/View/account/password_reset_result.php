<?php $this->theme->header(); ?>

<div class="account-header">
    <div class="container">
        <h1>Сброс пароля</span></h1>
    </div>
</div>

<div class="section reset-password-section bg-yellow padding-b-40">
    <div class="container">
        <div class="centered-block" style="margin-bottom: 400px;">
            <div class="heading">
                <h1 class="color-blue">Сброс пароля</h1>
            </div>
            <?php if ($result == 'not-found' || $result == 'fail'): ?>
                <div class="form-alert warning">
                    Что-то пошло не так. Сейчас не удается сбросить Ваш пароль.
                </div>
                <div class="form-group align-center">
                    <a href="/account/password-reset/" class="link color-gray">Попробовать ввести другой Email</a>
                </div>
            <?php elseif ($result == 'message-sent'): ?>
                <div class="form-alert success align-center">
                    На указанный Вами при регистрации адрес E-mail отправлено письмо со ссылкой для сброса пароля.<br>
                    Пожалуйста, проверьте Ваш почтовый ящик. Если письма нет в папке &laquo;Входящие&raquo;, проверьте
                    папку &laquo;Спам&raquo;.
                </div>
            <?php elseif ($result == 'success'): ?>
                <div class="form-alert success align-center">
                    Ваш новый пароль успешно сохранен. Для входа на сайт нажмите кнопку &laquo;Войти&raquo;.
                </div>
                <div class="form-group align-center">
                    <a href="/account/signin-or-register/" class="btn btn-green">Войти</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/login/password-reset'); ?>

<?php $this->theme->footer(); ?>
