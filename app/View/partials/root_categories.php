<?php if(count($categories)): ?>

<ul>
    <?php foreach($categories as $category): ?>
    <li>
        <span style="background-position: <?= Html::medCategoryIconPosition($category['alias']) ?>"></span>
        <a href="/category/<?= $category['alias'] ?>"><?= $category['name'] ?></a>
    </li>
    <?php endforeach; ?>
</ul>

<?php endif; ?>
