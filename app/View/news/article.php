<?php $this->theme->header(); ?>

<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li>
                <a href="/blog/">Блог</a>
            </li>
            <li>
                <span><?= $article['title'] ?></span>
            </li>
        </ul>
    </div>
</div>

<div class="section blog-article-section bg-yellow padding-b-40">
    <div class="container clearfix">
        <div class="article">
            <div class="heading">
                <h1 class="color-blue"><?= $article['title'] ?></h1>
            </div>
            <div class="article-date">
                <?php Html::date($article['creation_date']); ?>
            </div>
            <article>
                <img class="cover-image" src="<?php Html::newsOriginalImage($article['big_image_url']); ?>" />
    
                <?= $article['content'] ?>
            </article>
        </div>
    </div>
</div>


<?php Asset::js('/app/assets/js/custom/news/news'); ?>

<?php $this->theme->footer(); ?>
