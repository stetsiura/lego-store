<?php

/* Home */
$this->router->add('home', '/', 'HomeController:index');

/* Account */
$this->router->add('account-signin-or-register', '/account/signin-or-register/', 'AccountController:signinOrRegister');
$this->router->add('account-login', '/account/login/', 'AccountController:login', 'POST');
$this->router->add('account-logout', '/account/logout/', 'AccountController:logout');
$this->router->add('account-check-email', '/account/check-email/', 'AccountController:checkEmail', 'POST');
$this->router->add('account-register', '/account/register/', 'AccountController:register', 'POST');
$this->router->add('account-reset', '/account/password-reset/', 'AccountController:passwordReset');
$this->router->add('account-reset-post', '/account/password-reset-post/', 'AccountController:passwordResetPost', 'POST');
$this->router->add('account-reset-form', '/account/password-reset-form/(hash:any)', 'AccountController:passwordResetForm');
$this->router->add('account-reset-complete', '/account/password-reset-complete/', 'AccountController:passwordResetComplete', 'POST');

/* Catalog */
$this->router->add('catalog', '/catalog/', 'CatalogController:index');

/* Category */

$this->router->add('category-load', '/category/load/(alias:any)', 'CategoryController:load');
$this->router->add('category', '/category/(alias:any)', 'CategoryController:category');

/* Product */

$this->router->add('product', '/product/(alias:any)', 'ProductController:product');
$this->router->add('product-wishlist-redirect', '/product/wishlist-redirect/', 'ProductController:wishlistRedirect');
$this->router->add('product-add-wishlist', '/product/add-to-wishlist/', 'ProductController:addWishlist', 'POST');
$this->router->add('product-remove-wishlist', '/product/remove-from-wishlist/', 'ProductController:removeWishlist', 'POST');

/* Wishlist */

$this->router->add('wishlist', '/wishlist/', 'WishlistController:index');

/* News */

$this->router->add('news', '/news/', 'NewsController:index');
$this->router->add('news-article', '/news/article/(alias:any)', 'NewsController:article');

/* Search */

$this->router->add('search-form', '/search/form/', 'SearchController:form', 'POST');
$this->router->add('search-result', '/search', 'SearchController:result');

/* Shops */

$this->router->add('shops', '/shops/', 'ShopsController:index');

/* About */

$this->router->add('about', '/about-us/', 'AboutController:index');

/* Support */

$this->router->add('support-index', '/support/', 'SupportController:index');
$this->router->add('support-form', '/support/support-form/', 'SupportController:form', 'POST');
$this->router->add('support-subscribe', '/support/subscribe/', 'SupportController:subscribe', 'POST');

/* Franchise */

$this->router->add('franchise-index', '/franchise/', 'FranchiseController:index');