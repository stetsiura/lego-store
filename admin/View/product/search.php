<?php Asset::css('/admin/assets/css/jstree/themes/default/style.min'); ?>
<?php Asset::css('/admin/assets/css/dashboard/dashboard'); ?>

<?php $this->theme->header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h4>Поиск товаров</h4>
            </div>
            <form action="/admin/product/search-post/" method="post">
                <div class="form-group">
                    <?php AdminHtml::label('term', 'Поиск по номеру или названию:') ?>
                    <div class="input-group">
                        <?php AdminHtml::inputText('term', 'term', 'form-control', $term, 'false', 'false', 'autofocus', 'Номер или название...'); ?>
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Поиск</button>
                    </span>
                    </div>
                </div>
            </form>

            <?php if (!empty($products)): ?>
                <div>
                    <div class="margin-top-10">
                        <select id="sort-order" class="form-control">
                            <option value="<?= AdminUrl::productsSearchUrl($pageParams['term'], 1, 'name', 'asc') ?>" <?= AdminHtml::sortOrderSelected('name', 'asc', $pageParams); ?>>Сортировать по Названию (по возрастанию)</option>
                            <option value="<?= AdminUrl::productsSearchUrl($pageParams['term'], 1, 'name', 'desc') ?>" <?= AdminHtml::sortOrderSelected('name', 'desc', $pageParams); ?>>Сортировать по Названию (по убыванию)</option>
                            <option value="<?= AdminUrl::productsSearchUrl($pageParams['term'], 1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате добавления (по убыванию)</option>
                            <option value="<?= AdminUrl::productsSearchUrl($pageParams['term'], 1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате добавления (по возрастанию)</option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <div class="margin-top-10">
                <?php if ($productsCount > 0): ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Картинка</th>
                            <th>Название</th>
                            <th>Номер</th>
                            <th>Цена</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td>
                                    <img src="<?php AdminHtml::productThumbnailImage($product['small_image_url']); ?>" >
                                </td>
                                <td>
                                    <strong><?= $product['original_name'] ?></strong>
                                    <?php AdminHtml::inStock($product['item_state']); ?>
                                    <?php AdminHtml::isPopular($product['is_popular']); ?>
                                </td>
                                <td>
                                    <?= $product['item_code'] ?>
                                </td>
                                <td>
                                    <?= $product['price'] ?> грн
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Опции <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/admin/product/edit/<?= $product['id'] ?>/in-category/<?= $product['category_id'] ?>">Редактировать</a></li>
                                            <li><a href="#" data-product-id="<?= $product['id'] ?>" class="moving-product-btn" data-toggle="modal" data-target="#moving-product-modal">Перенести</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" class="removing-product-btn" data-toggle="modal" data-target="#removing-product-modal" data-product-id="<?= $product['id'] ?>" data-product-name="<?= $product['name'] ?>" data-category-id="<?= $product['category_id'] ?>">Удалить</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <?php if (!$initial): ?>
                        <div class="alert alert-info" role="alert">Поиск не дал результатов</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div>
                <?php AdminHtml::pagination($pageParams, $productsCount, 'products-search');?>
            </div>
        </div>
    </div>
</div>

<?php if (!$initial): ?>
    <!-- Modal for moving product -->
    <div class="modal fade" id="moving-product-modal" tabindex="-1" role="dialog" aria-labelledby="moving-product-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="/admin/product/move/">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="moving-product-modal-label">Выберите категорию:</h4>
                    </div>
                    <div class="modal-body">
                        <?php AdminHtml::inputHidden('moving_product_id', 'moving-product-id', '-1'); ?>
                        <?php AdminHtml::inputHidden('moving_product_category_id', 'moving-product-category-id', '1'); ?>
                        <div id="moving-product-categories-tree" class="tree">
                            <?php AdminHtml::tree($tree); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Перенести</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for removing product -->
    <div class="modal fade" id="removing-product-modal" tabindex="-1" role="dialog" aria-labelledby="removing-product-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="/admin/product/delete/">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="removing-product-modal-label">Удаление продукта</h4>
                    </div>
                    <?php AdminHtml::inputHidden('removing_product_category_id', 'removing-product-category-id', '1'); ?>
                    <?php AdminHtml::inputHidden('removing_product_id', 'removing-product-id', '-1'); ?>
                    <div class="modal-body">
                        Удалить продукт &laquo;<strong id="removing-product-name">Название продукта</strong>&raquo;?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php Asset::js('/admin/assets/js/jstree/jstree.min') ?>
<?php Asset::js('/admin/assets/js/product/search'); ?>

<?php $this->theme->footer(); ?>
