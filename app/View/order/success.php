<?php $this->theme->header(); ?>

<div class="checkout-header">
    <div class="container">
        <h1>Оформление заказа</h1>
    </div>
</div>
<div class="section order-success-section bg-yellow padding-t-40 padding-b-40">
    <div class="container">
        <div class="order-success">
            <div class="icon">
                <i class="fa fa-check-circle-o"></i>
            </div>
            <div class="message">
                <p class="message-header">
                    Ваш заказ успешно оформлен!
                </p>
                <p class="message-details">
                    Благодарим Вас за заказ в нашем магазине! Ваш заказ принят и обрабатывается.
                    <br>
                    <br>
                    Мы отправили письмо на указанный Вами адрес E-mail с деталями заказа.
                </p>
                <div class="continue">
                    <a class="btn btn-green" href="/"><img src="/app/assets/img/common/brick-icon.png">Продолжить покупки</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->theme->footer(); ?>
