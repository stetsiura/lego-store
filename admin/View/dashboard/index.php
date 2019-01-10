<?php Asset::css('/admin/assets/css/dashboard/dashboard'); ?>

<?php $this->theme->header(); ?>

<div class="cont">
	<div class="jumbotron padding-vert">
		<h2>Добро пожаловать в админ-панель &laquo;BricksUnity&raquo;!</h2>
		<p>Для начала работы нажмите кнопку &laquo;Управление товарами&raquo;.</p>
		<p><a class="btn btn-primary btn-lg" href="/admin/categories/" role="button">Управление товарами</a></p>
	</div>
</div>

<?php $this->theme->footer(); ?>