<?php Asset::css('/app/assets/css/home/home'); ?>

<?php $this->theme->header(); ?>
<?php if(Session::has('home-message')): ?>
    <?php $message = Session::flash('home-message'); ?>
    <div class="container">
        <div class="alert success margin-top-15"><?= $message ?></div>
    </div>
<?php endif; ?>
<div class="container">
    <div class="home-intro">
        <div id="main-slider" class="slider-container image-slider shadow">
            <?php $this->theme->block('partials/image_slider', ['slides' => $slides]); ?>
        </div>
        <div class="links-container">
            <a href="/catalog/" class="intro-link shadow" style="background-image: url(/app/assets/img/home/catalog-bg.png);">
                <div class="caption">
                    <div class="image">
                        <img src="/app/assets/img/common/miniso-logo.png" alt="Miniso logo" />
                    </div>
                    <div class="text">
                        <span class="color-brand">Каталог</span>
                        <span>Более 2000 наименований!</span>
                    </div>
                </div>
            </a>
            <a href="/shops/" class="intro-link shadow" style="background-image: url(/app/assets/img/home/shop-bg.png);">
                <div class="caption">
                    <div class="image">
                        <img src="/app/assets/img/common/map-pointer.png" alt="Map pointer icon" />
                    </div>
                    <div class="text">
                        <span class="color-brand">Магазины MINISO в Киеве</span>
                        <span>Ждем Вас с 10:00 до 22:00</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="testimonials">
        <div class="line">
        <!--<span><i class="fa fa-quote-left"></i></span>-->
        </div>
        <div class="description clearfix">
            <div class="image">
                <img src="/app/assets/img/home/headphones-bg.png" alt="MINISO наушники" />
            </div>
            <div class="text">
                <h6 class="testimonials-title">Десять категорий</h6>
                <p>
                    <span class="color-brand">MINISO</span> - это больше, чем бренд, это стиль жизни.
                </p>
                <p>
                    Ассортимент MINISO в Украине представлен в 10 категориях с продукцией для всех аспектов жизни,
                    среди которых здоровье и красота, игрушки, электронные аксессуары, канцелярские товары и
                    подарки, бытовые и сезонные товары, домашний уют, спорт, украшения, сумки и кошельки.
                </p>
            </div>
            <div class="image">
                <img src="/app/assets/img/home/parphumes-bg.png" alt="MINISO духи" />
            </div>
        </div>
        <div class="line"></div>
    </div>
</div>

<div class="container">
    <div class="heading">
        <h2>Популярные категории</h2>
    </div>
    <div class="popular-categories-container">
        <div class="row">
            <div class="col col-4">
                <a href="/category/digital-products" class="popular-category shadow" style="background-image: url(/app/assets/img/home/pop-cat-01.jpg);">
                    <div class="caption">
                        <div class="image">
                            <span style="background-position: 0px 0px">
                                <img src="/app/assets/img/home/popular-categories/digital-accessories.png" alt="Digital accessories icon" />
                            </span>
                        </div>
                        <div class="text">
                            <span class="color-brand">Цифровые аксессуары</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-4">
                <a href="/category/stationery-gift" class="popular-category shadow" style="background-image: url(/app/assets/img/home/pop-cat-02.jpg);">
                    <div class="caption">
                        <div class="image">
                            <span style="background-position: -56px 0px">
                                <img src="/app/assets/img/home/popular-categories/stationary-gift.png" alt="Stationary gift icon" />
                            </span>
                        </div>
                        <div class="text">
                            <span class="color-brand">Канцелярские товары</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-4">
                <a href="/category/creative-homeware" class="popular-category shadow" style="background-image: url(/app/assets/img/home/pop-cat-03.jpg);">
                    <div class="caption">
                        <div class="image">
                            <span style="background-position: -112px 0px">
                                <img src="/app/assets/img/home/popular-categories/creative-homeware.png" alt="Creative homeware icon" />
                            </span>
                        </div>
                        <div class="text">
                            <span class="color-brand">Домашний уют</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-4">
                <a href="/category/health-beauty" class="popular-category shadow" style="background-image: url(/app/assets/img/home/pop-cat-04.jpg);">
                    <div class="caption">
                        <div class="image">
                            <span style="background-position: -170px 0px">
                                <img src="/app/assets/img/home/popular-categories/health-beauty.png" alt="Health and beauty icon" />
                            </span>
                        </div>
                        <div class="text">
                            <span class="color-brand">Здоровье и красота</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="button-centered">
        <a href="/catalog/" class="btn btn-brand btn-lg btn-fixed">
            Все категории
        </a>
    </div>
</div>

<div class="container">
    <div class="heading">
        <h2>Популярные товары</h2>
    </div>

    <?php $this->theme->block('partials/product_slider', ['items' => $popularProducts]); ?>

    <div class="button-centered">
        <a href="/catalog/" class="btn btn-brand btn-lg btn-fixed">
            Больше товаров
        </a>
    </div>
</div>

<div class="container">
    <div class="shop">
        <div class="row">
            <div class="col col-2">
                <div class="description bg-brand shadow">
                    <div class="title">
                        Мы ждем Вас в наших фирменных магазинах!
                    </div>
                    <div class="shop-list clearfix">
                        <div class="shop-item active" data-tab="1">
                            <div class="image">
                            </div>
                            <p class="title color-brand">Магазин на Крещатике</p>
                            <p class="address">
                                ул. Крещатик, 29/1
                            </p>
                            <p class="show-map">
                                <span>Показать на карте</span>
                            </p>
                        </div>
                        <div class="shop-item" data-tab="2">
                            <div class="image">
                            </div>
                            <p class="title color-brand">ТРЦ &laquo;Lavina Mall&raquo;</p>
                            <p class="address">
                                ул. Берковецкая, 6Д
                            </p>
                            <p class="show-map">
                                <span>Показать на карте</span>
                            </p>
                        </div>
                        <div class="shop-item" data-tab="3">
                            <div class="image">
                            </div>
                            <p class="title color-brand">ТРЦ &laquo;New Way&raquo;</p>
                            <p class="address">
                                ул. Архитектора Вербицкого,1
                            </p>
                            <p class="show-map">
                                <span>Показать на карте</span>
                            </p>
                        </div>
                    </div>
                    <div class="footnotes">
                        <a class="social" href="https://www.facebook.com/minisoua/" target="_blank">
                            <i class="fa fa-facebook-square"></i>minisoua
                        </a>
                        <a class="social" href="https://www.instagram.com/minisoukraine/" target="_blank">
                            <i class="fa fa-instagram"></i>minisoukraine
                        </a>
                        <span class="welcome">
                        Мы ждем Вас с 10:00 до 22:00!
                    </span>
                    </div>
                </div>
            </div>
            <div class="col col-2">
                <div class="map" id="map-1">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5081.77737448099!2d30.521467!3d50.443174!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x22d85b1cf8340f8a!2sMINISO+Ukraine!5e0!3m2!1sen!2sua!4v1516189909501" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="map" id="map-2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10152.400596865904!2d30.3620859!3d50.4950938!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x11d5d921a99ffa4c!2sLavina+Mall!5e0!3m2!1sen!2sua!4v1516189552375" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="map" id="map-3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10169.57327815493!2d30.6502119!3d50.4151431!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7cfaef800270a63c!2sNew+Way!5e0!3m2!1sen!2sua!4v1516189632218" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(count($recentNews)): ?>
<div class="container">
    <div class="heading">
        <h2>Последние новости</h2>
    </div>
    <div class="latest-news">
        <div class="news-grid clearfix">
            <?php foreach($recentNews as $item): ?>
            <div class="grid-item">
                <a href="/news/article/<?= $item['alias'] ?>" class="news-item fix-height">
                    <div class="image">
                        <img src="<?php Html::newsThumbnailImage($item['small_image_url']); ?>" alt="News image">
                    </div>
                    <div class="title news-title-fix-height">
                        <?= $item['title'] ?>
                    </div>
                    <p class="description">
                        <?= $item['content_preview'] ?>...
                    </p>
                    <div class="date">
                        <span><?php Html::date($item['creation_date']); ?></span>
                        <span class="color-brand">Читать дальше</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="button-centered">
        <a href="/news/" class="btn btn-brand btn-lg btn-fixed">
            Все новости
        </a>
    </div>
</div>
<?php endif; ?>

<?php Asset::js('/app/assets/js/custom/image-slider'); ?>
<?php Asset::js('/app/assets/js/custom/product-slider'); ?>
<?php Asset::js('/app/assets/js/custom/home/home'); ?>

<?php $this->theme->footer(); ?>