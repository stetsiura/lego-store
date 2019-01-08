<ol class="breadcrumb margin-bottom-10">

<?php for($i = 0, $len = count($breadcrumbs); $i < $len; $i++): ?>
	<?php if ($i != $len - 1): ?>
		<li><a href="<?= $breadcrumbs[$i]['url'] ?>"><?= $breadcrumbs[$i]['name'] ?></a></li>
	<?php else: ?>
		<li class="active"><strong><?= $breadcrumbs[$i]['name'] ?></strong></li>
	<?php endif; ?>
<?php endfor; ?>

</ol>
	