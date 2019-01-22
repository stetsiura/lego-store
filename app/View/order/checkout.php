<?php $this->theme->header(); ?>

<div class="checkout-header">
    <div class="container">
        <h1>Оформление заказа</h1>
    </div>
</div>
<div class="section checout-section bg-yellow padding-b-40 padding-t-40">
    <div class="container">
        <form id="order-form" action="/order/place-order/" method="post">
            <div class="row clearfix">
                <div class="left-panel">
                    <div class="form-group">
                        <?php Html::label('name', 'Как к Вам можно обращаться?', 'required'); ?>
                        <?php Html::inputText('client_name', 'name', 'form-control', $name, 'false', 'false', '', 'Ваше имя...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('email', 'E-mail:', 'required'); ?>
                        <?php Html::inputText('email', 'email', 'form-control', $email, 'false', 'false', '', 'Ваш E-mail...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('phone', 'Телефон:', 'required'); ?>
                        <?php Html::inputText('phone', 'phone', 'form-control', $phone, 'false', 'false', '', 'Телефон...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
                <div class="right-panel">
                    <div class="form-group">
                        <?php Html::label('city', 'Город (Украина):', 'required'); ?>
                        <?php Html::inputText('city', 'city', 'form-control', $city, 'false', 'false', '', 'Город...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('post-office', 'Ближайшее отделение Новой Почты:', 'required'); ?>
                        <?php Html::inputText('post_office', 'post-office', 'form-control', $post, 'false', 'false', '', 'Отделение Новой Почты...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php Html::label('notes', 'Комментарий:'); ?>
                        <?php Html::textarea('notes', 'notes', 'form-control', '', '', 'Ваш комментарий...'); ?>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-green"><img src="/app/assets/img/common/brick-icon.png">Оформить заказ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/order/order'); ?>

<?php $this->theme->footer(); ?>