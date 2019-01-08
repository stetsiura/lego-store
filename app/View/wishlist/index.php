<?php Asset::css('/app/assets/css/catalog/catalog'); ?>

<?php $this->theme->header(); ?>

<div class="container">
    <div class="row margin-bottom-50">
        <div class="catgories-list">
            <div class="heading">
                <h2>Категории</h2>
            </div>
            <div class="categories clearfix">
                <?php $this->theme->block('partials/root_categories', ['categories' => $categories]); ?>
            </div>
        </div>
        <div class="catalog-content margin-top-0">
            <div class="heading">
                <h2>Мой список желаний</h2>
            </div>
            <div class="catalog-hero">
                <img src="/app/assets/img/wishlist/wishlist-hero.jpg" alt="Список желаний MINISO" />
            </div>

            <div id="products-block">
                <?php $this->theme->block('partials/product_list', ['items' => $products, 'productsCount' => count($products), 'pageParams' => null, 'type' => 'wishlist']); ?>
            </div>
        </div>
    </div>

    <div id="loader" class="loader-container">
        <div class="loader"></div>
    </div>
</div>

<?php $this->theme->footer(); ?>
