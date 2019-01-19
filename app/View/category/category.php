<?php $this->theme->header(); ?>

<div class="category-intro" style="background-color: #<?= $category['cover_color'] ?>; background-image: url('<?php Html::categoryBigImage($category['big_image_url']); ?>');">
    <div class="container">
        <div class="intro-header" style="background-color: #<?= $category['cover_color'] ?>;">
            <h1>Тема &laquo;<?= $category['name'] ?>&raquo;</h1>
        </div>
    </div>
</div>

<div class="section category-section-description padding-b-40">
    <div class="container">
        <?php if (!empty($category['youtube_link'])): ?>
            <div class="row clearfix">
                <div class="description fix-height">
                    <p><?= $category['description'] ?></p>
                </div>
                <div class="cameraman fix-height">
                    <img src="/app/assets/img/category/cameraman.png" alt="Lego cameraman">
                </div>
                <div class="video fix-height">
                    <div class="video-wrapper">
                        <iframe width="480" height="360" src="<?= $category['youtube_link'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        <?php else: ?>

        <?php endif; ?>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/custom-select'); ?>
<?php Asset::js('/app/assets/js/custom/category/category'); ?>

<?php $this->theme->footer(); ?>
