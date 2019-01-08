<?php if (count($items)): ?>
    <?php $className = (isset($class)) ? $class : ""; ?>
    <div class="product-slider slider-wrap slider-start <?= $className ?>">
        <div class="slider-box">
            <?php foreach($items as $item): ?>
            <div class="slider-item">
                <a href="/product/<?= $item['alias'] ?>">
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
        <a class="slider-nav left">
        <span>
            <i class="fa fa-chevron-left"></i>
        </span>
        </a>
        <a class="slider-nav right">
        <span>
            <i class="fa fa-chevron-right"></i>
        </span>
        </a>
    </div>

<?php endif; ?>

