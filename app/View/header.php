<?php Asset::css('/app/assets/css/font-awesome.min'); ?>
<?php Asset::css('/app/assets/css/common'); ?>

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
<header class="main-header shadow">
    <div class="main-header-logo-login clearfix">
        <div class="container">
            <div class="logo-and-login clearfix">
                <a href="/" class="logo">
                    <img src="/app/assets/img/common/miniso-logo.png" alt="MINISO logo" />
                    <span class="moto color-brand">
                        Love Life,<br />
                        Love MINISO
                    </span>
                </a>
                <div class="address">
                    <div>
                        <span>
                            Ждем Ваших звонков:
                        </span>
                    </div>
                    <div>
                        <span>
                            <i class="fa fa-phone"></i> <span class="color-brand">0-800-123-45-67</span>
                        </span>
                    </div>
                </div>
                <div class="credentials">
                    <?php if(AuthUtils::isInRole($auth, ['admin'])): ?>
                        <a href="/admin/dashboard/" class="link color-brand"><i class="fa fa-sliders"></i>Админ-панель</a>
                    <?php else: ?>
                        <a href="/wishlist/" class="link color-brand"><i class="fa fa-heart-o"></i>Список желаний</a>
                    <?php endif; ?>

                    <?php if($auth['authorized']): ?>
                        <a href="/account/logout/" class="btn btn-brand">Выйти</a>
                    <?php else: ?>
                        <a href="/account/signin-or-register/" class="btn btn-brand">Войти</a>
                    <?php endif; ?>

                </div>
                <button id="mobile-toggle" class="mobile-nav-toggle">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="main-header-nav-search bg-brand">
        <div class="container clearfix">
            <nav class="nav">
                <ul>
                    <li>
                        <a class="link color-white" href="/catalog/"><i class="fa fa-bars"></i>Каталог товаров</a>
                    </li>
                    <li>
                        <a class="link color-white" href="/shops/">Магазины</a>
                    </li>
                    <li>
                        <a class="link color-white" href="/news/">Новости</a>
                    </li>
                    <li>
                        <a class="link color-white" href="/about-us/">О нас</a>
                    </li>
                    <li>
                        <a class="link color-white" href="/support/">Поддержка</a>
                    </li>
                    <li>
                        <a class="link color-white" href="/franchise/">Франчайзинг</a>
                    </li>
                </ul>
            </nav>
            <div class="search">
                <form action="/search/form/" method="post">
                    <input type="search" class="search-box" placeholder="Поиск по всем товарам..." name="term" />
                    <button type="submit" class="search-icon">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <nav id="mobile-nav" class="mobile-nav bg-brand">
        <div class="container">
            <ul>
                <li class="align-center">
                    <a class="link color-white" href="/catalog/"><i class="fa fa-bars"></i>Каталог товаров</a>
                </li>
                <li class="align-center">
                    <a class="link color-white" href="/shops/">Магазины</a>
                </li>
                <li class="align-center">
                    <a class="link color-white" href="/news/">Новости</a>
                </li>
                <li class="align-center">
                    <a class="link color-white" href="/about-us/">О нас</a>
                </li>
                <li class="align-center">
                    <a class="link color-white" href="/support/">Поддержка</a>
                </li>
                <li class="align-center">
                    <a class="link color-white" href="/franchise/">Франчайзинг</a>
                </li>
                <?php if(AuthUtils::isInRole($auth, ['admin'])): ?>
                    <li class="align-center">
                        <a class="link color-white" href="/admin/dashboard/"><i class="fa fa-sliders"></i>Админ-панель</a>
                    </li>
                <?php else: ?>
                    <li class="align-center">
                        <a class="link color-white" href="/wishlist/"><i class="fa fa-heart-o"></i>Список желаний</a>
                    </li>
                <?php endif; ?>

                <?php if($auth['authorized']): ?>
                    <li>
                        <a class="btn btn-white btn-block align-center" href="/account/logout/">Выйти</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a class="btn btn-white btn-block align-center" href="/account/signin-or-register/">Войти</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>