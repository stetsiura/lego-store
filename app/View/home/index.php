<?php Asset::css('/app/assets/css/home/home'); ?>

<?php $this->theme->header(); ?>
<?php if(Session::has('home-message')): ?>
    <?php $message = Session::flash('home-message'); ?>
    <div class="container">
        <div class="alert success margin-top-15"><?= $message ?></div>
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
                            <a class="slider-btn" style="background-color: #009d00;"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <a class="slider-btn" style="background-color: #009d00;"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            <a class="btn btn-green"><img src="/app/assets/img/common/brick-icon.png">Перейти в каталог</a>
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

<?php Asset::js('/app/assets/js/custom/image-slider'); ?>
<?php Asset::js('/app/assets/js/custom/item-slider'); ?>
<?php Asset::js('/app/assets/js/custom/home/home'); ?>

<?php $this->theme->footer(); ?>