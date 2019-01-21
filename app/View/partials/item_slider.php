<?php if (count($items)): ?>
    <?php $className = (isset($class)) ? $class : ""; ?>
    <div class="items-slider padding-b-40 <?= $className ?>">
        <div class="slider-wrap">
            <div class="slider-box clerarfix">
                <?php foreach($items as $item): ?>
                <div class="slider-item">
                    <div class="slider-item-product">
                        <a class="image" href="/product/<?= $item['item_code'] ?>">
                            <img src="<?php Html::productThumbnailImage($item['small_image_url']); ?>" />
                        </a>
                        <a class="title" href="/product/<?= $item['item_code'] ?>">
                            <?= $item['item_code'] ?> - <?= $item['name'] ?>
                        </a>
                        <div class="details">
                            <?= $item['parts_count'] ?> <?= Html::partsCasing($item['parts_count']) ?>, 
                            <?= $item['minifigures_count'] ?> <?= Html::minifiguresCasing($item['minifigures_count']) ?>
                        </div>
                        <div class="buy-btn-container">
                            <button class="buy-btn cart-ctrl" data-product-id="<?= $item['id'] ?>">
                                <?= Html::productPrice($item) ?> грн | <?= Html::buyButtonText($item['item_state']) ?>
                            </button> 
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <a class="slider-nav left">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="slider-nav right">
            <i class="fa fa-chevron-right"></i>
        </a>
    </div>

<?php endif; ?>

