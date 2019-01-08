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
            <div class="heading">
                <h2>Фильтры</h2>
            </div>
            <div class="filters clearfix">
                <ul>
                    <?php foreach($childCategories as $childCategory): ?>
                        <?php $checked = (in_array($childCategory['alias'], $pageParams['filters'])) ? 'checked' : ''; ?>

                        <li>
                            <div class="checkbox medium">
                                <input type="checkbox" value="None" id="filter-<?= $childCategory['id'] ?>" name="check" class="filter-check" data-alias="<?= $childCategory['alias'] ?>" <?= $checked ?> />
                                <label for="filter-<?= $childCategory['id'] ?>"></label>
                            </div>
                            <span><?= $childCategory['name'] ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="catalog-content margin-top-0">
            <div class="heading">
                <h2><?= $category['name'] ?></h2>
            </div>
            <?php Html::inputHidden('alias', 'alias', $category['alias']); ?>
            <div class="catalog-hero">
                <img src="<?php Html::categoryImage($category['image_url']); ?>" alt="Category hero" />
            </div>
            <div class="filters-sort clearfix">
                <span class="label">Сортировка:</span>
                <div class="order">
                    <div class="custom-select">
                        <select id="sort-order">
                            <option value="price-asc" <?= Html::sortOrderSelected('price', 'asc', $pageParams) ?> >По цене (по возрастанию)</option>
                            <option value="price-desc" <?= Html::sortOrderSelected('price', 'desc', $pageParams) ?> >По цене (по убыванию)</option>
                            <option value="name-asc" <?= Html::sortOrderSelected('name', 'asc', $pageParams) ?> >По названию (по возрастанию)</option>
                            <option value="name-desc" <?= Html::sortOrderSelected('name', 'desc', $pageParams) ?> >По названию (по убыванию)</option>
                        </select>
                        <span>
                            По цене (по возрастанию)
                        </span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </div>
                <div class="in-stock">
                    <div class="checkbox medium">
                        <input type="checkbox" value="None" id="in-stock" name="check" checked />
                        <label for="in-stock"></label>
                    </div>
                </div>
                <span class="label">
                    в наличии
                </span>

                <span class="total-items-count">
                    <span id="products-count-text"><?= $productsCount ?></span> <?= Html::productCasing($productsCount) ?>
                </span>
            </div>

            <div id="products-block">
                <?php $this->theme->block('partials/product_list', ['items' => $products, 'productsCount' => $productsCount, 'pageParams' => $pageParams, 'type' => 'category']); ?>
            </div>
        </div>
    </div>

    <div id="loader" class="loader-container">
        <div class="loader"></div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/custom-select'); ?>
<?php Asset::js('/app/assets/js/custom/category/category'); ?>

<?php $this->theme->footer(); ?>
