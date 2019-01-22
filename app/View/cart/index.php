<?php $this->theme->header(); ?>

<div class="cart-header">
    <div class="container">
        <h1>Корзина (<span class="color-yellow"><?= $cart['count'] ?></span> <?= Html::productCasing($cart['count']) ?>)</h1>
    </div>
</div>
<div class="section section-cart-items bg-yellow padding-b-40 padding-t-40">
    <div class="container">
        <?php if($cart['count'] > 0): ?>
            <?php foreach($cart['items'] as $id => $item): ?>
                <div class="cart-item">
                    <div class="row clearfix">
                        <div class="image">
                            <img src="<?php Html::productOriginalImage($item['product']['big_image_url']); ?>" >
                        </div>
                        <div class="description">
                            <div>
                                <h3><?= $item['product']['item_code'] ?> - <?= $item['product']['name'] ?></h3>
                            </div>
                            <div>
                                <?php if ($item['product']['item_state'] == 'order'): ?>
                                    <p>
                                        <b>Этот набор будет заказан специально для вас.</b> <br><br>
                                        Ориентировочное время ожидания набора - <b><span class="color-green"><?= $item['delivery_time'] ?> <?= Html::daysCasing($item['delivery_time']) ?></span></b> 
                                    </p>
                                <?php else: ?>
                                    <p>
                                        <b>Этот набор есть в наличии</b> <br><br>
                                        Ориентировочный срок доставки Новой Почтой по Украине - <b><span class="color-green"><?= $item['delivery_time'] ?> <?= Html::daysCasing($item['delivery_time']) ?></span></b> 
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="cart-price color-blue"><?= Html::productPrice($item['product']) ?> грн</span>
                            </div>
                        </div>
                        <div class="cart-remove-item">
                            <form class="clearfix" action="/cart/remove/" method="POST">
                                    <?php Html::inputHidden('product_id', 'product-remove-id-' . $item['product']['id'], $item['product']['id']); ?>
                                <div>
                                    <button type="submit" class="remove-btn">Убрать из корзины</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-cart-image">
                <img src="/app/assets/img/common/butterfly.png" alt="Butterfly">
                <span>Тут пока пусто</span>
            </div>
        <?php endif; ?>
    </div>

    <div class="container delivery">
        <p>
            Стоимость доставки по Украине согласно тарифам Новой Почты (оплачивает получатель).
        </p>
    </div>

    <div class="container">
        <div class="total clearfix">
            <span>Итого за заказ (без стоимости доставки по Украине): <b class="color-blue"><?= $cart['total_price'] ?></b> грн</span>
            <a class="btn btn-green" href="/order/checkout/"><img src="/app/assets/img/common/brick-icon.png">Оформить заказ</a>
        </div>
    </div>
    
</div>

<?php $this->theme->footer(); ?>