<?php $this->theme->header(); ?>

<div class="category-intro" style="background-color: #<?= $category['cover_color'] ?>; background-image: url('<?php Html::categoryBigImage($category['big_image_url']); ?>');">
    <div class="container">
        <div class="intro-header" style="background-color: #<?= $category['cover_color'] ?>;">
            <h1>Тема &laquo;<?= $category['name'] ?>&raquo;</h1>
        </div>
    </div>
</div>

<div class="section category-section-description padding-b-40">
    <div class="container">
        <?php if (!empty($category['youtube_link'])): ?>
            <div class="row clearfix">
                <div class="description fix-height">
                    <p><?= $category['description'] ?></p>
                </div>
                <div class="cameraman fix-height">
                    <img src="/app/assets/img/category/cameraman.png" alt="Lego cameraman">
                </div>
                <div class="video fix-height">
                    <div class="video-wrapper">
                        <iframe width="480" height="360" src="<?= $category['youtube_link'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="single-description">
                <p>
                    <p><?= $category['description'] ?></p>
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="section category-items-section bg-yellow padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Наборы в теме &laquo;<?= $category['name'] ?>&raquo;</h2>
        </div>

        <div class="sort-select-container padding-b-40">
            <span>Сортировать по:</span>
            <div class="custom-select bg-blue">
                <select id="sort-order">
                    <option value="<?= Url::navigationUrl('', $category['alias'], 'price', 'asc', 'category') ?>" <?= Html::sortOrderSelected('price', 'asc', $pageParams) ?> >Цене (по возрастанию)</option>
                    <option value="<?= Url::navigationUrl('', $category['alias'], 'price', 'desc', 'category') ?>" <?= Html::sortOrderSelected('price', 'desc', $pageParams) ?> >Цене (по убыванию)</option>
                    <option value="<?= Url::navigationUrl('', $category['alias'], 'name', 'asc', 'category') ?>" <?= Html::sortOrderSelected('name', 'asc', $pageParams) ?> >Названию (по возрастанию)</option>
                    <option value="<?= Url::navigationUrl('', $category['alias'], 'name', 'desc', 'category') ?>" <?= Html::sortOrderSelected('name', 'desc', $pageParams) ?> >Названию (по убыванию)</option>
                </select>
                <span>По имени (а-я)</span>
                <i class="fa fa-chevron-down"></i>
            </div>
        </div>
        
        <div class="row clearfix category-items">
            <?php foreach($products as $product): ?>
                <div class="category-item">
                    <div class="item">
                        <a class="image" href="/product/<?= $product['item_code'] ?>">
                            <img src="<?php Html::productThumbnailImage($product['small_image_url']); ?>" />
                        </a>
                        <a class="title" href="/product/<?= $product['item_code'] ?>">
                            <?= $product['item_code'] ?> - <?= $product['name'] ?>
                        </a>
                        <div class="details">
                            <?= $product['parts_count'] ?> <?= Html::partsCasing($product['parts_count']) ?>, 
                            <?= $product['minifigures_count'] ?> <?= Html::minifiguresCasing($product['minifigures_count']) ?>
                        </div>
                        <div class="buy-btn-container">
                            <button class="buy-btn cart-ctrl" data-product-id="<?= $product['id'] ?>">
                                <?= Html::productPrice($product) ?> грн | <?= Html::buyButtonText($product['item_state']) ?>
                            </button> 
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/custom-select'); ?>
<?php Asset::js('/app/assets/js/custom/category/category'); ?>

<?php $this->theme->footer(); ?>
