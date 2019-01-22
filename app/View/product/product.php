<?php $this->theme->header(); ?>

<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li>
                <a href="/catalog/">Каталог</a>
            </li>
            <li>
                <a href="/category/<?= $category['alias'] ?>"><?= $category['name'] ?></a>
            </li>
            <li>
                <span><?= $product['item_code'] ?> - <?= $product['name'] ?></span>
            </li>
        </ul>
    </div>
</div>

<div class="product-details padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Набор <?= $product['item_code'] ?> &laquo;<?= $product['name'] ?>&raquo;</h2>
        </div>
        <div class="row clearfix">
            <div class="image">
                <img src="<?php Html::productOriginalImage($product['big_image_url']); ?>" alt="Изображение набора <?= $product['item_code'] ?> - <?= $product['name'] ?>">
            </div>
            <div class="description">
                <table class="description-table">
                    <tbody>
                        <tr>
                            <td>
                                Название:
                            </td>
                            <td>
                                <b><?= $product['name'] ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Оригинальное название:
                            </td>
                            <td>
                                <?= $product['original_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Номер:
                            </td>
                            <td>
                                <b><?= $product['item_code'] ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Год выпуска:
                            </td>
                            <td>
                                <?= $product['year_released'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Количество деталей:
                            </td>
                            <td>
                                <?= $product['parts_count'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Количество человечков:
                            </td>
                            <td>
                                <?= $product['minifigures_count'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Состояние:
                            </td>
                            <td>
                                <?php if ($product['item_condition'] == 'new'): ?>
                                    <b>Новый</b>
                                <?php else: ?>
                                    <b>Б/У</b> (в отличном состоянии) <br><br>

                                    <?php if ($product['has_all_parts']): ?>
                                        <i class="fa fa-check"></i> Полная комплектация (есть все детали)<br>
                                    <?php endif; ?>

                                    <?php if ($product['has_instructions']): ?>
                                        <i class="fa fa-check"></i> Есть инструкция<br>
                                    <?php endif; ?>

                                    <?php if ($product['has_box']): ?>
                                        <i class="fa fa-check"></i> Есть коробка<br>
                                    <?php endif; ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Наличие:
                            </td>
                            <td>
                                <?= Html::productStateText($product['item_state']) ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="control-btns">
                    <button class="buy-btn cart-ctrl" data-product-id="<?= $product['id'] ?>">
                        <?= Html::productPrice($product) ?> грн | <?= Html::buyButtonText($product['item_state']) ?>
                    </button>

                    <?php if($auth['authorized']): ?>
                        <?php if(is_null($wishlistItem)): ?>
                            <a class="wishlist-btn wishlist-ctrl wishlist-add" data-id="<?= $product['id'] ?>">
                                <i class="fa fa-heart"></i>
                                <span>Добавить в список желаний</span>
                            </a>
                        <?php else: ?>
                            <a class="wishlist-btn wishlist-ctrl wishlist-remove" data-id="<?= $wishlistItem['id'] ?>">
                                <i class="fa fa-heart"></i>
                                <span>Удалить из списка желаний</span>
                            </a>
                        <?php endif; ?>

                    <?php else: ?>
                        <a href="/product/wishlist-redirect/" class="wishlist-btn">
                            <i class="fa fa-heart"></i>
                            Добавить в список желаний
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section bg-yellow">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Возможно, Вас заинтересует</h2>
        </div>
        <?php $this->theme->block('partials/item_slider', ['items' => $suggestions]); ?>
        <div class="btn-container padding-b-40">
            <a href="/catalog/" class="btn btn-green"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/item-slider'); ?>
<?php Asset::js('/app/assets/js/custom/product/product'); ?>

<?php $this->theme->footer(); ?>
