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
        <div class="catalog-content">
            <div class="share-slider clearfix">
                <div class="catalog-share">
                    <a href="#" class="share-container shadow" style="background-image: url(/app/assets/img/catalog/share.png);"></a>
                </div>
                <div class="catalog-slider">
                    <div id="catalog-slider" class="slider-container image-slider shadow">
                        <?php $this->theme->block('partials/image_slider', ['slides' => $slides]); ?>
                    </div>
                </div>
            </div>

            <div class="heading">
                <h2>Популярные товары</h2>
            </div>

            <?php $this->theme->block('partials/product_slider', ['items' => $popularProducts]); ?>

            <div class="heading margin-top-50">
                <h2>Новые поступления</h2>
            </div>

            <?php $this->theme->block('partials/product_slider', ['items' => $newProducts]); ?>

        </div>
    </div>
</div>


<?php Asset::js('/app/assets/js/custom/image-slider'); ?>
<?php Asset::js('/app/assets/js/custom/product-slider'); ?>
<?php Asset::js('/app/assets/js/custom/catalog/catalog'); ?>

<?php $this->theme->footer(); ?>
