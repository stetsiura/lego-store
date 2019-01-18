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
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/image-slider'); ?>
<?php Asset::js('/app/assets/js/custom/item-slider'); ?>
<?php Asset::js('/app/assets/js/custom/home/home'); ?>

<?php $this->theme->footer(); ?>