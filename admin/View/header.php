<?php Asset::css('/admin/assets/css/bootstrap.min'); ?>
<?php Asset::css('/admin/assets/css/admin'); ?>

<?php Asset::commonJs('/admin/assets/js/jquery-3.2.1.min'); ?>
<?php Asset::commonJs('/admin/assets/js/bootstrap.min'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<?php Asset::render('css'); ?>
    <link rel="shortcut icon" type="image/x-icon" href="/app/assets/img/favicons/favicon.ico">
    <link rel="icon" type="image/png" href="/app/assets/img/favicons/favicon-32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/app/assets/img/favicons/apple-touch-icon.png">
</head>
<body>

<?php if (AuthUtils::isInRole($auth, ['admin'])): ?>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin/dashboard/">Админ панель</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Товары <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/categories/">Список товаров</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/admin/product/search/">Поиск по всем товарам</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Пользователи <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= AdminUrl::usersUrl('admin', 1, 'name', 'asc') ?>">Список пользователей</a></li>
                    <li><a href="/admin/users/add-user/">Добавить пользователя</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/admin/users/search/">Поиск пользователей</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Новости <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= AdminUrl::newsUrl(1, 'date', 'desc') ?>">Список новостей</a></li>
                    <li><a href="/admin/news/add/">Добавить новость</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Контент <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/admin/content/slider/main-slider">Слайдер на главной</a></li>
                </ul>
            </li>
            <li class=""><a href="/admin/settings/general/">Настройки</a></li>
            <li class=""><a href="<?= AdminUrl::orderUrl('new', 1, 'date', 'desc'); ?>">Заказы</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php if ($auth['authorized']): ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $auth['user']['name'] ?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
                <li><a href="/">На главный сайт</a></li>
				<li><a href="/admin/account/logout/">Выйти</a></li>
			</ul>
        </li>
		<?php else: ?>
		<li><a href="/admin/account/login/">Вход</a></li>
		<?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php else: ?>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin/dashboard/">Админ панель</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/account/login/">Вход</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<?php endif; ?>
