<?php Asset::css('/app/assets/css/shops/shops'); ?>

<?php $this->theme->header(); ?>

<div class="container">
    <div class="heading">
        <h1>Магазины MINISO в Киеве</h1>
    </div>
    <div id="map-wrapper">
        <div id="map-canvas" class="mapping"></div>
    </div>
    <div class="shops-list clearfix">
        <div class="shop-item" data-marker="1">
            <p class="title color-brand">
                ТРЦ &laquo;Lavina Mall&raquo;
            </p>
            <p class="address">
                Киев, ул. Берковецкая, 6Д
            </p>
            <p class="working-hours">
                Время работы: с 10:00 до 22:00
            </p>
        </div>
        <div class="shop-item" data-marker="0">
            <p class="title color-brand">
                Магазин на Крещатике
            </p>
            <p class="address">
                Киев, ул. Крещатик, 29/1
            </p>
            <p class="working-hours">
                Время работы: с 10:00 до 22:00
            </p>
        </div>
        <div class="shop-item"  data-marker="2">
            <p class="title color-brand">
                ТРЦ &laquo;New Way&raquo;
            </p>
            <p class="address">
                Киев, ул. Архитектора Вербицкого,1
            </p>
            <p class="working-hours">
                Время работы: с 10:00 до 22:00
            </p>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/shops/shops'); ?>

<?php $this->theme->footer(); ?>
