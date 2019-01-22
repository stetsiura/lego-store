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
            <form id="reset-form" action="/account/password-reset-complete/" method="post">
                <?php html::inputHidden('hash', 'hash', $hash); ?>
                <div class="form-group">
                    <p class="form-text align-center">
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
                    <button type="submit" class="btn btn-green">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
    

<?php Asset::js('/app/assets/js/custom/login/password-reset-form'); ?>

<?php $this->theme->footer(); ?>