<?php $className = ($margin) ? "margin-bottom-10" : ""; ?>

<div class="breadcrumbs <?= $className ?>">
	<span>Категория:</span>
	<ul>
		<li>
			<a href="<?= Render::categoryUrl($book['category_id'], 1, 'name', 'asc') ?>"><?= $book['category_name'] ?></a>
		</li>
	</ul>
</div>