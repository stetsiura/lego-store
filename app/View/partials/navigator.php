<?php if (!is_null($navigator['parent'])): ?>
<li>
	<a href="<?= Render::categoryUrl($navigator['parent']['id'], 1, 'name') ?>" class="category-parent">
		<i class="fa fa-chevron-left"></i> <?= $navigator['parent']['name'] ?>
	</a>
</li>
<?php else: ?>
<li>
	<a href="/" class="category-parent">
		<i class="fa fa-chevron-left"></i> На главную
	</a>
</li>
<?php endif; ?>


<li>
	<a class="category-current">
		<?= $navigator['current']['name'] ?>
	</a>
</li>


<?php foreach($navigator['child'] as $category): ?>
<li>
	<a href="<?= Render::categoryUrl($category['id'], 1, 'name') ?>">
		<?= $category['name'] ?>
	</a>
</li>
<?php endforeach; ?>
