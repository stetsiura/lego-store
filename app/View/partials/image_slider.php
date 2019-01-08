<div class="slider-box">
    <?php foreach($slides as $slide): ?>
    <a class="slide" style="background-image: url(<?php Html::sliderImage($slide['image_url']) ?>);" href="<?= $slide['url'] ?>"></a>
    <?php endforeach; ?>
</div>
<a class="slide-control prev">
    <i class="fa fa-chevron-left"></i>
</a>
<a class="slide-control next">
    <i class="fa fa-chevron-right"></i>
</a>