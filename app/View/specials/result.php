<?php Asset::css('/app/assets/css/site/category-and-search/category-and-search'); ?>

<?php $this->theme->header(); ?>


    <div class="container">
        <div class="sidebar-and-search-grid">
            <div class="sidebar">
                <div class="sidebar-category-list">
                    <a id="sidebar-categories-toggle" class="sidebar-categories-toggle">
                        Категории <i class="fa fa-chevron-down"></i>
                    </a>
                    <div id="sidebar-categories-wrapper" class="sidebar-categories-wrapper">
                        <ul>
                            <?php $this->theme->block('partials/navigator', ['navigator' => $navigator]); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="search-result">
                <div class="search-result-content">
                    <!--<div class="search-result-header">
                        <h1><?= $heading ?></h1>
                    </div>-->

                    <?php $this->theme->block('partials/banner', ['type' => $type]) ?>

                    <div class="search-result-books-grid">

                        <?php if (count($books) == 0): ?>
                            <?php $this->theme->block('partials/empty'); ?>
                        <?php endif; ?>

                        <div class="books-grid-wrap">
                            <?php foreach($books as $book): ?>
                                <div class="grid-item">
                                    <a href="<?= Render::bookUrl($book['id']) ?>">
                                        <div class="image">
                                            <img src="<?php Render::adminImageThumbnail($book['small_image_url']); ?>" />
                                        </div>
                                        <div class="title">
                                            <h6><?= $book['title'] ?></h6>
                                        </div>
                                        <div class="author">
                                            <span><?= $book['author_name'] ?></span>
                                        </div>
                                        <?php if ($book['has_discount']): ?>
                                            <div class="price">
                                                <span class="current"><?= $book['actual_price'] ?> грн</span>
                                                <span class="actual"><?= $book['price'] ?> грн</span>
                                            </div>
                                        <?php else: ?>
                                            <div class="price">
                                                <span class="current"><?= $book['price'] ?> грн</span>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    <button class="add-to-cart cart-ctrl" data-book-id="<?= $book['id'] ?>">
                                        В корзину <i class="fa fa-cart-plus"></i>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php Asset::js('/app/assets/js/site/category-and-search/categories-bar'); ?>

<?php $this->theme->footer(); ?>