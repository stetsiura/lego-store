<?php Asset::css('/app/assets/css/news/news'); ?>

<?php $this->theme->header(); ?>

<div class="container">
    <div class="heading">
        <h1>Новости MINISO</h1>
    </div>

    <div class="news-grid clearfix">
        <div class="left-column">
            <?php if(!is_null($firstNews)): ?>
            <a href="/news/article/<?= $firstNews['alias'] ?>" class="news-item">
                <div class="image">
                    <img src="<?php Html::newsThumbnailImage($firstNews['small_image_url']); ?>" alt="News image">
                </div>
                <div class="title">
                    <?= $firstNews['title'] ?>
                </div>
                <p class="description">
                    <?= $firstNews['content_preview'] ?>...
                </p>
                <div class="date">
                    <span><?php Html::date($firstNews['creation_date']); ?></span>
                    <span class="color-brand">Читать дальше</span>
                </div>
            </a>
            <?php endif; ?>
        </div>
        <div class="right-column">
            <div class="inner-grid clearfix">
                <?php $counter = 0; ?>
                <?php foreach($news as $item): ?>
                    <div class="grid-item">
                        <a href="/news/article/<?= $item['alias'] ?>" class="news-item fix-height">
                            <div class="image">
                                <img src="<?php Html::newsThumbnailImage($item['small_image_url']); ?>" alt="News image">
                            </div>
                            <div class="title">
                                <?= $item['title'] ?>
                            </div>
                            <div class="dummy"></div>
                            <div class="date">
                                <span><?php Html::date($item['creation_date']); ?></span>
                                <span class="color-brand">Читать дальше</span>
                            </div>
                        </a>
                    </div>
                    <?php $counter++; ?>

                    <?php if($counter >= 6) { break; } ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/news/news'); ?>

<?php $this->theme->footer(); ?>
