<?php Html::inputHidden('products_count', 'products-count', $productsCount); ?>

<?php if(!empty($items)): ?>
<div class="product-grid">
    <?php foreach($items as $item): ?>

        <div class="grid-item">
            <a href="/product/<?= $item['alias'] ?>" class="product">
                <div class="image">
                    <img src="<?php Html::productThumbnailImage($item['small_image_url']); ?>" />
                </div>
                <div class="title">
                    <?= $item['name'] ?>
                </div>
                <div class="price">
                    <?= Html::productPrice($item) ?> грн
                </div>
            </a>
        </div>

    <?php endforeach; ?>
</div>
<?php else: ?>
<p>
    <div class="alert warning align-center">Ни один товар не удовлетворяет критериям поиска</div>
</p>
<?php endif; ?>

<?php if(!is_null($pageParams)): ?>
    <?php Html::pagination($pageParams, $productsCount, $type) ?>
<?php endif; ?>
