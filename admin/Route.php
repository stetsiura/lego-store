<?php

/* Dashboard */

$this->router->add('dashboard', '/admin/dashboard/', 'DashboardController:index');

/* Account */

$this->router->add('login', '/admin/account/login/', 'AccountController:login');
$this->router->add('auth', '/admin/account/auth/', 'AccountController:auth', 'POST');
$this->router->add('logout', '/admin/account/logout/', 'AccountController:logout');

/* Users */

$this->router->add('users-index', '/admin/users/(role:str)', 'UsersController:index');
$this->router->add('users-add', '/admin/users/add-user/', 'UsersController:add');
$this->router->add('users-add-post', '/admin/users/add-post/', 'UsersController:addPost', 'POST');
$this->router->add('users-check-email', '/admin/users/check-email/', 'UsersController:checkEmail', 'POST');
$this->router->add('users-edit', '/admin/users/edit-user/(id:int)', 'UsersController:edit');
$this->router->add('users-edit-post', '/admin/users/edit-post/', 'UsersController:editPost', 'POST');
$this->router->add('users-delete-post', '/admin/users/delete/', 'UsersController:delete', 'POST');
$this->router->add('users-search', '/admin/users/search/', 'UsersController:search');
$this->router->add('users-search-post', '/admin/users/search-post/', 'UsersController:searchPost', 'POST');
$this->router->add('users-search-result', '/admin/users/search/search-result', 'UsersController:searchResult');

/* Categories */

$this->router->add('categories-index', '/admin/categories/', 'CategoriesController:index');
$this->router->add('categories-category', '/admin/categories/(id:int)', 'CategoriesController:category');
$this->router->add('categories-edit', '/admin/categories/edit/', 'CategoriesController:edit', 'POST');
$this->router->add('categories-add', '/admin/categories/add/', 'CategoriesController:add', 'POST');
$this->router->add('categories-move-category', '/admin/categories/move-category/', 'CategoriesController:moveCategory', 'POST');
$this->router->add('categories-remove-category', '/admin/categories/remove/', 'CategoriesController:remove', 'POST');

/* Products */

$this->router->add('add-product', '/admin/product/add/to-category/(categoryId:int)', 'ProductController:add');
$this->router->add('add-save-product', '/admin/product/add-save/', 'ProductController:addSave', 'POST');
$this->router->add('edit-product', '/admin/product/edit/(id:int)/in-category/(categoryId:int)', 'ProductController:edit');
$this->router->add('edit-save-product', '/admin/product/edit-save/', 'ProductController:editSave', 'POST');
$this->router->add('move-product', '/admin/product/move/', 'ProductController:move', 'POST');
$this->router->add('delete-product', '/admin/product/delete/', 'ProductController:delete', 'POST');
$this->router->add('products-search', '/admin/product/search/', 'ProductController:search');
$this->router->add('products-search-post', '/admin/product/search-post/', 'ProductController:searchPost', 'POST');
$this->router->add('products-search-result', '/admin/product/search/search-result', 'ProductController:searchResult');

/* News */

$this->router->add('news-index', '/admin/news/', 'NewsController:index');
$this->router->add('news-add', '/admin/news/add/', 'NewsController:add');
$this->router->add('news-add-save', '/admin/news/add-save/', 'NewsController:addSave', 'POST');
$this->router->add('news-upload-content-image', '/admin/news/upload-content-image/', 'NewsController:uploadImage', 'POST');
$this->router->add('news-edit', '/admin/news/edit/(id:int)', 'NewsController:edit');
$this->router->add('news-edit-save', '/admin/news/edit-save/', 'NewsController:editSave', 'POST');
$this->router->add('news-delete', '/admin/news/delete/', 'NewsController:delete', 'POST');

/* Content */

$this->router->add('content-slider', '/admin/content/slider/(alias:any)', 'ContentController:slider');
$this->router->add('content-slide', '/admin/content/slide/(alias:any)/(position:int)', 'ContentController:slide');
$this->router->add('content-new-slide', '/admin/content/slider/(alias:any)/new-slide/', 'ContentController:newSlide');
$this->router->add('content-add-slide', '/admin/content/slider/add-slide/', 'ContentController:addSlide', 'POST');
$this->router->add('content-update-slide', '/admin/content/slider/update-slide/', 'ContentController:updateSlide', 'POST');
$this->router->add('content-remove-slide', '/admin/content/slider/remove-slide/', 'ContentController:removeSlide', 'POST');
$this->router->add('content-slide-move-down', '/admin/content/slider/slide-move-down/', 'ContentController:slideMoveDown', 'POST');
$this->router->add('content-slide-move-up', '/admin/content/slider/slide-move-up/', 'ContentController:slideMoveUp', 'POST');

/* Settings */

$this->router->add('settings-general', '/admin/settings/general/', 'SettingsController:general');
$this->router->add('settings-update', '/admin/settings/update/', 'SettingsController:updateSetting', 'POST');

/* Orders */

$this->router->add('orders-index', '/admin/orders/(section:str)', 'OrdersController:index');
$this->router->add('orders-item', '/admin/orders/item/(id:int)', 'OrdersController:item');
$this->router->add('orders-update', '/admin/orders/update/', 'OrdersController:update', 'POST');
