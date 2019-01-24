<?php $this->theme->header(); ?>

<?php if(Session::has('home-message')): ?>
    <?php $message = Session::flash('home-message'); ?>
    <div class="alert success">
        <div class="container"><?= $message ?></div>
    </div>
<?php endif; ?>

<div id="main-slider" class="main-slider">
    <div class="slides-container">
        <div class="slide" style="background-color: #2258b1;">
            <div class="container slide-content" style="background-image: url('/app/assets/img/home/hero-image.jpg');">
                <div class="left-panel">
                    <div class="panel-content">
                        <h1>Интернет-магазин раритетных наборов <span class="color-yellow">LEGO&reg;</span></h1>
                        <p>
                            Каждая компания переживает свой золотой век.
                            90-е и 2000-е - это золотой век компании Lego.
                            Здесь Вы можете заказать практически любой набор Lego,
                            большой или маленький, который был выпущен в то время,
                            и который в современных магазинах Вы не найдете.
                        </p>
                        <div class="slide-btn-container">
                            <a href="/catalog/" class="slider-btn" style="background-color: #009d00;"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach($slides as $slide): ?>
            <div class="slide" style="background-color: #<?= $slide['cover_color'] ?>;">
                <div class="container slide-content" style="background-image: url(<?php Html::sliderImage($slide['image_url']) ?>);">
                    <div class="left-panel">
                        <div class="panel-content">
                            <h1><?= $slide['header_text'] ?></h1>
                            <p><?= $slide['slide_description'] ?></p>
                            <div class="slide-btn-container">
                                <a href="<?= $slide['button_url'] ?>" class="slider-btn" style="background-color: #<?= $slide['button_color'] ?>;">
                                    <img src="/app/assets/img/common/brick-icon.png"><?= $slide['button_text'] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a class="slide-control prev"><i class="fa fa-chevron-left"></i></a>
    <a class="slide-control next"><i class="fa fa-chevron-right"></i></a>
</div>

<div class="section bg-yellow">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Популярные наборы</h2>
        </div>
        <?php $this->theme->block('partials/item_slider', ['items' => $popularProducts]); ?>
        <div class="btn-container padding-b-40">
            <a href="/catalog/" class="btn btn-green"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
        </div>
    </div>
</div>

<div class="section section-home-about padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Золотая эпоха LEGO&reg;</h2>
        </div>
        <p>
            Конец 80-х, 90-е и начало 2000-х по праву можно считать эпохой самого расцвета компании LEGO.<br>
            В этот период были выпущены наборы, которые стали классикой жанра, примером для подражания
            и, в каком-то смысле, лицом компании LEGO.
            Это были удивительные наборы - не слишком простые, не слишком сложные, схематичные и
            детализированные одновременно. От этих наборов веяло добротой и теплом.
            И герои, и злодеи в них - все казались добрыми.
            <br><br>
            В нашем магазине Вы можете заказать практически любой из этих раритетных наборов по
            самым приемлимым ценам.
            <br><br>
            Надеемся, что путешествие в прошлое с нашим магазином окажется для Вас приятным и увлекательным!
        </p>
        <img src="/app/assets/img/home/bricks-mix.jpg" alt="Mix of Lego bricks" />
    </div>
</div>

<div class="section section-popular-themes bg-yellow padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Популярные темы</h2>
        </div>
        <div class="row clearfix">
            <div class="popular-theme-item">
                <a href="/category/town" class="content">
                    <div class="image">
                        <img src="/app/assets/img/home/town-theme-icon.jpg" >
                    </div>
                    <span>Город</span>
                </a>
            </div>
            <div class="popular-theme-item">
                <a href="/category/pirates" class="content">
                    <div class="image">
                        <img src="/app/assets/img/home/pirates-theme-icon.jpg" >
                    </div>
                    <span>Пираты</span>
                </a>
            </div>
            <div class="popular-theme-item">
                <a href="/category/castle" class="content">
                    <div class="image">
                        <img src="/app/assets/img/home/castle-theme-icon.jpg" >
                    </div>
                    <span>Замок</span>
                </a>
            </div>
            <div class="popular-theme-item">
                <a href="/category/western" class="content">
                    <div class="image">
                        <img src="/app/assets/img/home/western-theme-icon.jpg" >
                    </div>
                    <span>Вестерн</span>
                </a>
            </div>
            <div class="popular-theme-item">
                <a href="/category/space" class="content">
                    <div class="image">
                        <img src="/app/assets/img/home/space-theme-icon.jpg" >
                    </div>
                    <span>Космос</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="section section-delivery padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Доставка по всей Украине</h2>
        </div>
        <div class="row clearfix">
            <div class="description">
                <p>
                    Мы заказываем раритетные наборы LEGO прямо из Европы и выполним доставку
                    в любое ближайшее к вам отделение Новой Почты по всей Украине.
                    <br><br>
                    Нажмите кнопку &laquo;Заказать&raquo; на странице набора и пройдите быструю
                    процедуру заказа с указанием ближайшего к Вам отделения Новой Почты. Все остальное мы берем на себя.
                    <br><br>
                    Оплата осуществляется наложенным платежом только после получения набора в отделении Новой Почты
                    и после его осмотра.
                    <br><br>
                    Вы всегда можете отказаться от получения набора. Однако, мы сделаем все, чтобы Вы остались
                    довольны своей покупкой и вернулись к нам еще не раз!
                </p>
            </div>
            <div class="map">
                <img src="/app/assets/img/home/map.jpg" alt="The map of the Europe">
            </div>
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/image-slider'); ?>
<?php Asset::js('/app/assets/js/custom/item-slider'); ?>
<?php Asset::js('/app/assets/js/custom/home/home'); ?>

<?php $this->theme->footer(); ?>
