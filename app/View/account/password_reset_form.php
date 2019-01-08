<?php Asset::css('/app/assets/css/login/login'); ?>

<?php $this->theme->header(); ?>


    <div class="container">
        <div class="centered-block margin-bottom-200">
            <div class="heading">
                <h1>Сброс пароля</h1>
            </div>
            <form id="reset-form" action="/account/password-reset-complete/" method="post">
                <?php html::inputHidden('hash', 'hash', $hash); ?>
                <div class="form-group">
                    <p class="form-text">
                        Остался всего один шаг!<br>
                        Пожалуйста, придумайте новый пароль и введите его в поля ниже.
                    </p>
                </div>
                <div class="form-group">
                    <?php Html::label('password', 'Пожалуйста, придумайте новый пароль', 'required'); ?>
                    <?php Html::inputPassword('password', 'password', 'form-control', 'Ваш новый пароль...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('password-repeat', 'Введите пароль еще раз', 'required'); ?>
                    <?php Html::inputPassword('password_repeat', 'password-repeat', 'form-control', 'Еще раз пароль...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-brand btn-md">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

<?php Asset::js('/app/assets/js/custom/login/password-reset-form'); ?>

<?php $this->theme->footer(); ?>