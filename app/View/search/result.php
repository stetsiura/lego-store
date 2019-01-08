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
                <h2>Результат поиска по &laquo;<?= $pageParams['term'] ?>&raquo;</h2>
            </div>

            <div class="filters-sort clearfix">
                <span class="label">Сортировка:</span>
                <div class="order">
                    <div class="custom-select">
                        <select id="sort-order">
                            <option value="<?= Url::searchUrl($pageParams['term'], 1, 'price', 'asc') ?>" <?= Html::sortOrderSelected('price', 'asc', $pageParams) ?> >По цене (по возрастанию)</option>
                            <option value="<?= Url::searchUrl($pageParams['term'], 1, 'price', 'desc') ?>" <?= Html::sortOrderSelected('price', 'desc', $pageParams) ?> >По цене (по убыванию)</option>
                            <option value="<?= Url::searchUrl($pageParams['term'], 1, 'name', 'asc') ?>" <?= Html::sortOrderSelected('name', 'asc', $pageParams) ?> >По названию (по возрастанию)</option>
                            <option value="<?= Url::searchUrl($pageParams['term'], 1, 'name', 'desc') ?>" <?= Html::sortOrderSelected('name', 'desc', $pageParams) ?> >По названию (по убыванию)</option>
                        </select>
                        <span>
                            По цене (по возрастанию)
                        </span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div id="products-block">
                <?php $this->theme->block('partials/product_list', ['items' => $products, 'productsCount' => $productsCount, 'pageParams' => $pageParams, 'type' => 'search']); ?>
            </div>
        </div>
    </div>

    <div id="loader" class="loader-container">
        <div class="loader"></div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/custom-select'); ?>
<?php Asset::js('/app/assets/js/custom/search/search'); ?>

<?php $this->theme->footer(); ?>
