<?php $this->theme->header(); ?>

<div class="news-header">
    <div class="container">
        <h1>Блог <span class="color-yellow">BricksUnity</span></h1>
    </div>
</div>

<div class="section section-news-list bg-yellow padding-t-40 padding-b-40">
    <div class="container">
        <div class="row clearfix">
            <?php foreach($news as $item):  ?>
                <div class="news-item">
                    <a href="/blog/article/<?= $item['alias'] ?>">
                        <div class="image">
                            <img src="<?php Html::newsThumbnailImage($item['small_image_url']); ?>" alt="News image">
                        </div>
                        <div class="title">
                            <?= $item['title'] ?>
                        </div>
                        <p class="description">
                            <?= $item['content_preview'] ?>...
                        </p>
                        <div class="date clearfix">
                            <span><?php Html::date($item['creation_date']); ?></span>
                            <span class="color-blue">Читать дальше</span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>   
        </div>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/news/news'); ?>

<?php $this->theme->footer(); ?>
