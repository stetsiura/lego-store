<?php Asset::css('/admin/assets/css/jstree/themes/default/style.min'); ?>
<?php Asset::css('/admin/assets/css/dashboard/dashboard'); ?>

<?php Asset::js('/admin/assets/js/jstree/jstree.min') ?>
<?php Asset::js('/admin/assets/js/validation'); ?>
<?php Asset::js('/admin/assets/js/categories/categories') ?>

<?php $this->theme->header(); ?>

<?php 
	$categoryName = (!is_null($category)) ? $category['name'] : "Все книги";
	$categoryId = (!is_null($category)) ? $category['id'] : -1;
?>

<div class="cont">
	<?php $this->theme->block('partials/breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
    <div class="rw">
        <div class="cl cl-3">
            <div id="categories-tree" class="tree">
				<?php AdminHtml::tree($tree); ?>
            </div>
        </div>
        <div class="cl cl-7">

            <?php if(Session::has('category-message')): ?>
                <?php $message = Session::flash('category-message'); ?>
                <div class="alert alert-success" role="alert"><?= $message ?></div>
            <?php endif; ?>

            <?php if(Session::has('category-error')): ?>
                <?php $message = Session::flash('category-error'); ?>
                <div class="alert alert-danger" role="alert"><?= $message ?></div>
            <?php endif; ?>
            <?php if(!is_null($category)): ?>
            <div>
                <div class="btn-group" role="group" aria-label="Опции">
                    <?php if(!is_null($category)) :?>
                        <?php if($category['id'] != 1): ?>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Опции
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#category-edit-modal">Редактировать эту категорию</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#" data-toggle="modal" data-target="#category-removal-modal">Удалить эту категорию</a></li>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <a type="button" class="btn btn-default" href="/admin/product/add/to-category/<?= $category['id'] ?>">Добавить продукт</a>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div class="margin-top-10">
                    <select id="sort-order" class="form-control">
                        <option value="<?= AdminUrl::categoryUrl($pageParams['category_id'], 1, 'name', 'asc') ?>" <?= AdminHtml::sortOrderSelected('name', 'asc', $pageParams); ?>>Сортировать по Названию (по возрастанию)</option>
                        <option value="<?= AdminUrl::categoryUrl($pageParams['category_id'], 1, 'name', 'desc') ?>" <?= AdminHtml::sortOrderSelected('name', 'desc', $pageParams); ?>>Сортировать по Названию (по убыванию)</option>
                        <option value="<?= AdminUrl::categoryUrl($pageParams['category_id'], 1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате добавления (по убыванию)</option>
                        <option value="<?= AdminUrl::categoryUrl($pageParams['category_id'], 1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате добавления (по возрастанию)</option>
                    </select>
                </div>
            </div>

            <?php if(count($products) > 0): ?>
            <div class="products-list margin-top-10">
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
                                        <li><a href="#" class="removing-product-btn" data-toggle="modal" data-target="#removing-product-modal" data-product-id="<?= $product['id'] ?>" data-product-name="<?= $product['original_name'] ?>">Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-info align-center margin-top-10" role="alert">
                    В данной категории <strong>нет товаров</strong>.
                </div>
            <?php endif; ?>

            <div>
                <?php AdminHtml::pagination($pageParams, $productsCount, 'categories');?>
            </div>

            <?php else: ?>
                <div>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#category-create-modal">Создать категорию</button>
                </div>
                
                <div class="alert alert-info align-center margin-top-10" role="alert">
                    Для начала работы <strong>выберите категорию из списка слева</strong>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if(!is_null($category) && $category['id'] != 1): ?>
<!-- Category Edit Modal -->
<div class="modal fade" id="category-edit-modal" tabindex="-1" role="dialog" aria-labelledby="category-edit-modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="edit-form" action="/admin/categories/edit/" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-edit-modal-label">Редактирование категории</h4>
                </div>
                <div class="modal-body">
                    <?php AdminHtml::inputHidden('id', 'id', $category['id']); ?>
                    <div class="form-group">
                        <?php AdminHtml::label('name', 'Название:'); ?>
                        <?php AdminHtml::inputText('name', 'name', 'form-control', $category['name'], 'false', 'false', '', 'Название категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('original_name', 'Оригинальное название (на английском):'); ?>
                        <?php AdminHtml::inputText('original_name', 'original-name', 'form-control', $category['original_name'], 'false', 'false', '', 'Оригинальное название категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('alias', 'Псевдоним:'); ?>
                        <?php AdminHtml::inputText('alias', 'alias', 'form-control', $category['alias'], 'false', 'false', '', 'Псевдоним...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('cover-color', 'Цвет обложки (HEX):'); ?>
                        <?php AdminHtml::inputText('cover_color', 'cover-color', 'form-control', $category['cover_color'], 'false', 'false', '', 'Цвет обложки (HEX)...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('youtube-link', 'Ссылка YouTube:'); ?>
                        <?php AdminHtml::inputText('youtube_link', 'youtube-link', 'form-control', $category['youtube_link'], 'false', 'false', '', 'Ссылка YouTube...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('description', 'Описание:'); ?>
                        <?php AdminHtml::textarea('description', 'description', 'form-control half-height', $category['description'], '', 'Описание категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php AdminHtml::label('category_image_file', 'Обложка категории:'); ?>
                                <div class="category-image">
                                    <img id="category-image" src="<?= AdminHtml::categorySmallImage($category['small_image_url']) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="file-input">
                                    <button type="button" id="category-img-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
                                    <input type="file" accept="image/*" name="category_image_file" id="category-image-file" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php AdminHtml::label('category_thumb_file', 'Иконка категории:'); ?>
                                <div class="category-image">
                                    <img id="category-thumb" src="<?= AdminHtml::categoryThumbImage($category['thumb_image_url']) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="file-input">
                                    <button type="button" id="category-thumb-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
                                    <input type="file" accept="image/*" name="category_thumb_file" id="category-thumb-file" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(is_null($category)): ?>
    <!-- Category Create Modal -->
    <div class="modal fade" id="category-create-modal" tabindex="-1" role="dialog" aria-labelledby="category-create-modal-label">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="edit-form" action="/admin/categories/add/" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-edit-modal-label">Редактирование категории</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php AdminHtml::label('name', 'Название:'); ?>
                        <?php AdminHtml::inputText('name', 'name', 'form-control', '', 'false', 'false', '', 'Название категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('original_name', 'Оригинальное название (на английском):'); ?>
                        <?php AdminHtml::inputText('original_name', 'original-name', 'form-control', '', 'false', 'false', '', 'Оригинальное название категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('alias', 'Псевдоним:'); ?>
                        <?php AdminHtml::inputText('alias', 'alias', 'form-control', '', 'false', 'false', '', 'Псевдоним...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('cover_color', 'Цвет обложки (HEX):'); ?>
                        <?php AdminHtml::inputText('cover_color', 'cover-color', 'form-control', '', 'false', 'false', '', 'Цвет обложки (HEX)...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('youtube-link', 'Ссылка YouTube:'); ?>
                        <?php AdminHtml::inputText('youtube_link', 'youtube-link', 'form-control', '', 'false', 'false', '', 'Ссылка YouTube...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="form-group">
                        <?php AdminHtml::label('description', 'Описание:'); ?>
                        <?php AdminHtml::textarea('description', 'description', 'form-control half-height', '', '', 'Описание категории...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php AdminHtml::label('category_image_file', 'Обложка категории:'); ?>
                                <div class="category-image">
                                    <img id="category-image" src="<?= AdminHtml::categorySmallImage('') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="file-input">
                                    <button type="button" id="category-img-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
                                    <input type="file" accept="image/*" name="category_image_file" id="category-image-file" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php AdminHtml::label('category_thumb_file', 'Иконка категории:'); ?>
                                <div class="category-image">
                                    <img id="category-thumb" src="<?= AdminHtml::categoryThumbImage('') ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="file-input">
                                    <button type="button" id="category-thumb-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
                                    <input type="file" accept="image/*" name="category_thumb_file" id="category-thumb-file" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
        </div>
    </div>
<?php endif; ?>

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

<?php if (!is_null($category)): ?>
    <!-- Modal for removing product -->
    <div class="modal fade" id="removing-product-modal" tabindex="-1" role="dialog" aria-labelledby="removing-product-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="/admin/product/delete/">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="removing-product-modal-label">Удаление продукта</h4>
                    </div>
                    <?php AdminHtml::inputHidden('removing_product_category_id', 'removing-product-category-id', $category['id']); ?>
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

<?php if (!is_null($category)): ?>
    <!-- Modal for removing category -->
    <div class="modal fade" id="category-removal-modal" tabindex="-1" role="dialog" aria-labelledby="category-removal-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/categories/remove/" method="post">
                    <?php AdminHtml::inputHidden('removing_category_id', 'removing-category-id', $category['id']); ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="category-removal-modal-label">Удаление категории &laquo;<strong><?= $category['name'] ?></strong>&raquo;</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>Внимание!</strong> Это действие удалит текущую категорию. Все продукты в
                            этой категории <em>не</em> будут удалены, а будут перемещены в категорию &laquo;Несортированные товары&raquo;.
                        </p>
                        <p>
                            <strong>Удалить категорию &laquo;<?= $category['name'] ?>&raquo;?</strong>
                        </p>
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

<?php $this->theme->footer(); ?>