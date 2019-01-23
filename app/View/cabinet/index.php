<?php $this->theme->header(); ?>

<div class="catalog-header">
    <div class="container">
        <h1>Мой кабинет</h1>
    </div>
</div>

<div class="section bg-yellow">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Список желаний</h2>
        </div>
        <?php $this->theme->block('partials/item_slider', ['items' => $products]); ?>
        <div class="btn-container padding-b-150">
            <a href="/account/logout/" class="btn btn-green"><img src="/app/assets/img/common/brick-icon.png">Выйти из системы</a>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/item-slider'); ?>

<?php $this->theme->footer(); ?>
