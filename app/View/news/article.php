<?php Asset::css('/app/assets/css/news/news'); ?>

<?php $this->theme->header(); ?>

<div class="container clearfix">
    <div class="article">
        <div class="heading">
            <h1><?= $article['title'] ?></h1>
        </div>
        <div class="article-date">
            <?php Html::date($article['creation_date']); ?>
        </div>
        <article>
            <img src="<?php Html::newsOriginalImage($article['big_image_url']); ?>" />

            <?= $article['content'] ?>
        </article>
    </div>
    <aside class="latest-news">
        <div class="heading">
            <h3>Последние новости</h3>
        </div>
        <div class="latest-news-grid clearfix">

            <?php foreach($recent as $item): ?>
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
                            <?php Html::date($item['creation_date']); ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            
        </div>
    </aside>
</div>

<?php Asset::js('/app/assets/js/custom/news/news'); ?>

<?php $this->theme->footer(); ?>
