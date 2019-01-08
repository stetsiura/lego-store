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

            <?php $this->theme->block('partials/breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>

            <div class="product-section clearfix">
                <div class="image">
                    <img src="<?php Html::productOriginalImage($product['big_image_url']); ?>" alt="" />
                </div>
                <div class="description">
                    <div class="product-header">
                        <h1><?= $product['name'] ?></h1>
                    </div>
                    <?php Html::inputHidden('product_id', 'product-id', $product['id']); ?>
                    <div class="about">
                        <p>
                            <?= nl2br($product['description']) ?>
                        </p>
                    </div>
                    <div class="details">
                        <table>
                            <tbody>
                            <tr>
                                <td>SKU:</td>
                                <td><?= $product['sku'] ?></td>
                            </tr>
                            <tr>
                                <td>ID товара:</td>
                                <td><?= $product['item_code'] ?></td>
                            </tr>
                            <tr>
                                <td>Штрихкод:</td>
                                <td><?= $product['barcode'] ?></td>
                            </tr>
                            <tr>
                                <td>Составляющие:</td>
                                <td><?= nl2br($product['ingredients']) ?></td>
                            </tr>
                            <tr>
                                <td>Спецификация:</td>
                                <td>
                                    <?= nl2br($product['specification']) ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="price-favourites clearfix">
                        <div class="price">
                            <?= Html::productPrice($product) ?> грн
                        </div>
                        <div class="fovourites">
                            <?php if($auth['authorized']): ?>
                                <?php if(is_null($wishlistItem)): ?>
                                    <a class="btn btn-brand btn-block wishlist-btn wishlist-add" data-id="<?= $product['id'] ?>">
                                        <i class="fa fa-heart"></i>
                                        <span>Добавить в список желаний</span>
                                    </a>
                                <?php else: ?>
                                    <a class="btn btn-brand btn-block wishlist-btn wishlist-remove" data-id="<?= $wishlistItem['id'] ?>">
                                        <i class="fa fa-heart"></i>
                                        <span>Удалить из списка желаний</span>
                                    </a>
                                <?php endif; ?>

                            <?php else: ?>
                                <a href="/product/wishlist-redirect/" class="btn btn-brand btn-block">
                                    <i class="fa fa-heart"></i>
                                    Добавить в список желаний
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($product['product_usage'])): ?>
            <div class="product-header">
                <h3>Использование</h3>
            </div>
            <div class="aditional-description">
                <?= $product['product_usage'] ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($product['warning'])): ?>
            <div class="product-alert">
                <i class="fa fa-exclamation-triangle alert-icon"></i>
                <div class="content">
                    <?= $product['warning'] ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($suggestions)): ?>
            <div class="heading">
                <h2>Возможно, Вас заинтересует</h2>
            </div>

            <?php $this->theme->block('partials/product_slider', ['items' => $suggestions, 'class' => 'margin-hor-0']); ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/product-slider'); ?>
<?php Asset::js('/app/assets/js/custom/product/product'); ?>

<?php $this->theme->footer(); ?>
