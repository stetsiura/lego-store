<?php Asset::css('/app/assets/css/login/login'); ?>

<?php $this->theme->header(); ?>

<div class="container">
    <div class="login-register clearfix">
        <div class="login">
            <div class="heading">
                <h2>Вход</h2>
            </div>
            <form action="/account/login/" method="post">
                <?php if(Session::has('login-error')): ?>
                    <?php $message = Session::flash('login-error'); ?>
                    <div class="alert warning"><?= $message ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <?php Html::label('login-email', 'E-mail', 'required'); ?>
                    <?php Html::inputText('email', 'login-email', 'form-control', '', 'false', 'false', '', 'Ваш E-mail...'); ?>
                </div>
                <div class="form-group">
                    <?php Html::label('login-password', 'Пожалуйста, придумайте пароль', 'required'); ?>
                    <?php Html::inputPassword('password', 'login-password', 'form-control', 'Ваш пароль...'); ?>
                </div>
                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-brand btn-md margin-right-10">
                        Войти
                    </button>
                    <a href="/account/password-reset/" class="link color-black">Забыли пароль?</a>
                </div>
            </form>
        </div>
        <div class="register">
            <div class="heading">
                <h2>Быстрая регистрация</h2>
            </div>
            <form id="register-form" action="/account/register/" method="post">
                <div class="form-group">
                    <?php Html::label('register-name', 'Как к Вам можно обращаться?', 'required'); ?>
                    <?php Html::inputText('name', 'register-name', 'form-control', '', 'false', 'false', '', 'Ваше имя...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('register-email', 'E-mail', 'required'); ?>
                    <?php Html::inputText('email', 'register-email', 'form-control', '', 'false', 'false', '', 'Ваш E-mail...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('register-password', 'Пожалуйста, придумайте пароль', 'required'); ?>
                    <?php Html::inputPassword('password', 'register-password', 'form-control', 'Ваш пароль...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('register-password-repeat', 'Введите пароль еще раз', 'required'); ?>
                    <?php Html::inputPassword('password_repeat', 'register-password-repeat', 'form-control', 'Еще раз пароль...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-brand btn-md">
                        Регистрация
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/login/login'); ?>

<?php $this->theme->footer(); ?>
