<div class="breadcrumbs">
    <ul>
        <?php $counter = 0; ?>
        <?php foreach($breadcrumbs as $part): ?>
            <?php if ($counter == 0): ?>
                <li>
                    <a href="/category/<?= $part['alias'] ?>">
                        <?= $part['name'] ?>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <?= $part['name'] ?>
                </li>
            <?php endif; ?>

            <?php $counter++; ?>
        <?php endforeach; ?>
    </ul>
</div>