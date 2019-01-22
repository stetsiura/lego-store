<?php $this->theme->header(); ?>

<div class="account-header">
    <div class="container">
        <h1>Сброс пароля</span></h1>
    </div>
</div>
<div class="section reset-password-section bg-yellow padding-b-40">
    <div class="container">
        <div class="centered-block">
            <div class="heading">
                <h1 class="color-blue">Сброс пароля</h1>
            </div>
            <form id="reset-form" action="/account/password-reset-post/" method="post">
                <div class="form-group">
                    <p class="form-text align-center">
                        Если Вы забыли пароль для входа на сайт, мы поможем Вам его восстановить.<br>
                        Для начала введите Ваш E-mail в форму ниже и нажмите &laquo;Далее&raquo;.
                    </p>
                </div>
                <div class="form-group">
                    <?php Html::label('reset-email', 'E-mail', 'required'); ?>
                    <?php Html::inputText('email', 'reset-email', 'form-control', '', 'false', 'false', 'autofocus', 'Ваш E-mail...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-green">Далее</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/login/password-reset'); ?>

<?php $this->theme->footer(); ?>
