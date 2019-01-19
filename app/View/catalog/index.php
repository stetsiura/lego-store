<?php $this->theme->header(); ?>

<div class="catalog-header">
    <div class="container">
        <h1>Каталог раритетных наборов <span class="color-yellow">LEGO&reg;</span></h1>
    </div>
</div>
<div class="section section-catalog-intro">
    <div class="container">
        <div class="row clearfix">
            <div class="text">
                <p>
                    В этом каталоге представлены самые популярные темы LEGO 90-х - 2000-х
                    годов. Пираты, Город, Замок - все они стали легендами LEGO.<br>
                    Эта страница - отправная точка в Вашем путешествии в прошлое к 
                    золотым денькам компании LEGO!
                    <br><br>
                    Надеемся, что Вам понравится какой-нибудь наборчик, а если его не будет в
                    наличии, то мы закажем его специально для Вас.
                </p>
            </div>
            <div class="image">
                <img src="/app/assets/img/catalog/professor-and-timmy.jpg" alt="Professor Cyber and Timmy TimeCruiser">
            </div>
        </div>
    </div>
</div>

<div class="section section-catalog-themes bg-yellow">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Темы LEGO</h2>
        </div>
        <div class="row clearfix">
            <?php if (count($categories) > 0): ?>
                <?php foreach($categories as $category): ?>
                    <div class="theme-item">
                        <a href="/category/<?= $category['alias'] ?>">
                            <div class="image">
                                <img src="<?php Html::categorySmallImage($category['small_image_url']); ?>">
                            </div> 
                            <span class="title"><?= $category['name'] ?></span>
                            <div class="details">
                                <p>
                                    <?= $category['description'] ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="section bg-yellow padding-b-40">
    <div class="container">
        <div class="heading">
            <h2 class="color-blue">Популярные наборы</h2>
        </div>
        <?php $this->theme->block('partials/item_slider', ['items' => $popularProducts]); ?>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/item-slider'); ?>
<?php Asset::js('/app/assets/js/custom/catalog/catalog'); ?>

<?php $this->theme->footer(); ?>
