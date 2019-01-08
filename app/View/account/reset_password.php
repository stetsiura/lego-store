<?php Asset::css('/app/assets/css/login/login'); ?>

<?php $this->theme->header(); ?>


<div class="container">
    <div class="centered-block margin-bottom-200">
        <div class="heading">
            <h1>Сброс пароля</h1>
        </div>
        <form id="reset-form" action="/account/password-reset-post/" method="post">
            <div class="form-group">
                <p class="form-text">
                    Если Вы забыли пароль для входа на сайт, мы поможем Вам его восстановить.<br>
                    Для начала введите Ваш E-mail в форму ниже и нажмите &laquo;Продолжить&raquo;.
                </p>
            </div>
            <div class="form-group">
                <?php Html::label('reset-email', 'E-mail', 'required'); ?>
                <?php Html::inputText('email', 'reset-email', 'form-control', '', 'false', 'false', 'autofocus', 'Ваш E-mail...'); ?>
                <p class="form-error-message"></p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-brand btn-md">Далее</button>
            </div>
        </form>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/login/password-reset'); ?>

<?php $this->theme->footer(); ?>
