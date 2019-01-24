<?php Asset::css('/app/assets/css/font-awesome.min'); ?>
<?php Asset::css('/app/assets/css/site.min'); ?>

<?php Asset::commonJs('/app/assets/js/lib/jquery-1.10.2.min'); ?>
<?php Asset::commonJs('/app/assets/js/lib/jquery.matchHeight'); ?>
<?php Asset::commonJs('/app/assets/js/custom/settings'); ?>
<?php Asset::commonJs('/app/assets/js/custom/header'); ?>
<?php Asset::commonJs('/app/assets/js/custom/custom-select'); ?>
<?php Asset::commonJs('/app/assets/js/custom/validation'); ?>
<?php Asset::commonJs('/app/assets/js/custom/notifications'); ?>
<?php Asset::commonJs('/app/assets/js/custom/cart'); ?>
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
                <li><a href="/catalog/">Каталог</a></li>
                <li><a href="/blog/">Блог</a></li>

                <?php if(AuthUtils::isInRole($auth, ['admin'])): ?>
                    <li><a href="/admin/dashboard/">Админка</a></li>
                <?php else: ?>
                    <li><a href="/support/">Служба поддержки и доставка</a></li>
                <?php endif; ?>
            </ul>
            <ul class="right-side">
                <li><a href="/cart/" class="cart"><img src="/app/assets/img/common/cart-icon.png" />Корзина<span id="cart-total-count"><?= $cart['count'] ?></span></a></li>
                <?php if($auth['authorized']): ?>
                    <li><a href="/cabinet/"><?= $auth['user']['name'] ?></a></li>
                <?php else: ?>
                    <li><a href="/account/signin-or-register/">Войти</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <button id="nav-toggle" class="nav-toggle">
            <i class="fa fa-bars"></i>
        </button>
    </div>
</header>
