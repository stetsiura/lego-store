<?php Asset::css('/app/assets/css/font-awesome.min'); ?>
<?php Asset::css('/app/assets/css/site'); ?>

<?php Asset::commonJs('/app/assets/js/lib/jquery-1.10.2.min'); ?>
<?php Asset::commonJs('/app/assets/js/lib/jquery.matchHeight'); ?>
<?php Asset::commonJs('/app/assets/js/custom/settings'); ?>
<?php Asset::commonJs('/app/assets/js/custom/header'); ?>
<?php Asset::commonJs('/app/assets/js/custom/custom-select'); ?>
<?php Asset::commonJs('/app/assets/js/custom/validation'); ?>
<?php Asset::commonJs('/app/assets/js/custom/notifications'); ?>
<?php Asset::commonJs('/app/assets/js/custom/footer'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <?php Asset::render('css'); ?>
    <link rel="shortcut icon" type="image/x-icon" href="/app/assets/img/favicons/favicon.ico">
    <link rel="icon" type="image/png" href="/app/assets/img/favicons/favicon-32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/app/assets/img/favicons/apple-touch-icon.png">
</head>
<body>
<header class="header bg-yellow clearfix">
    <div class="container">
        <a href="/" class="header-logo">
            <img src="/app/assets/img/common/logo-colored.png" alt="Логотип BricksUnity" />
        </a>
        <nav id="menu">
            <ul class="left-side">
                <li><a href="#">Каталог</a></li>
                <li><a href="#">Темы</a></li>
                <li><a href="#">Блог</a></li>
                <li><a href="#">Служба поддержки</a></li>
                <li><a href="#">Доставка</a></li>
            </ul>
            <ul class="right-side">
                <li><a href="#" class="cart"><img src="/app/assets/img/common/cart-icon.png" />Корзина<span>0</span></a></li>
                <li><a href="#">Вход</a></li>
            </ul>
        </nav>
        <button id="nav-toggle" class="nav-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</header>