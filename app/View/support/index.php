
<?php $this->theme->header(); ?>

<div class="account-header">
    <div class="container">
        <h1>Доставка и поддержка</span></h1>
    </div>
</div>

<div class="section reset-password-section bg-yellow padding-b-40">
    <div class="container">
        <div class="centered-block">
            <div class="heading">
                <h1 class="color-blue">Поддержка</h1>
            </div>
            <form id="support-form" action="/support/support-form/" method="post">
                
                <div class="form-group">
                    <p class="form-text align-center">
                        Доставка наборов, которые сейчас есть в наличии, осуществляется в любое отделение службы Новая Почта 
                        по всей Украине в течение ориентировочно <spn class="color-green">2-х дней</spn>.<br>
                        Если набора сейчас нет в наличии, то на его странице отображается надпись &laquo;Под заказ&raquo;. 
                        При заказе такого набора у нас на сайте срок его доставки в отделение Новой Почты по Украине составляет около
                        <span class="color-green">20-ти дней</span>.<br>
                        Оплата за заказ происходит в отделении Новой Почты только после осмотра Вами своей посылки.
                    </p>
                </div>
                <?php if(Session::has('support-message')): ?>
                    <?php $message = Session::flash('support-message'); ?>
                    <div class="form-alert success"><?= $message ?></div>
                <?php endif; ?>
                <?php if($auth['authorized']):?>
                    <div class="form-group">
                        <?php Html::label('name', 'Как к Вам можно обращаться?', 'required'); ?>
                        <?php Html::inputText('name', 'name', 'form-control', $auth['user']['name'], 'false', 'false', '', 'Ваше имя...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('email', 'Ваш E-mail:', 'required'); ?>
                        <?php Html::inputText('email', 'email', 'form-control', $auth['user']['email'], 'false', 'false', '', 'Ваш E-mail...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <?php Html::label('name', 'Как к Вам можно обращаться?', 'required'); ?>
                        <?php Html::inputText('name', 'name', 'form-control', '', 'false', 'false', '', 'Ваше имя...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('email', 'Ваш E-mail:', 'required'); ?>
                        <?php Html::inputText('email', 'email', 'form-control', '', 'false', 'false', '', 'Ваш E-mail...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <?php Html::label('message', 'Сообщние:', 'required'); ?>
                    <?php Html::textarea('message', 'message', 'form-control', '', '', 'Ваше сообщение'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-green">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/support/support'); ?>

<?php $this->theme->footer(); ?>