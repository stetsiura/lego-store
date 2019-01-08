<?php

namespace App\Controller;

class WishlistController extends AppController
{
    public function index()
    {
        $auth = $this->data['auth'];

        if (!$auth['authorized']) {
            \Session::set('login-error', 'Пожалуйста, авторизируйтесь на сайте, чтобы воспользоваться списком желаний');

            \Redirect::to('/account/signin-or-register/');
        }

        $this->load->model('Wishlist');
        $this->load->model('Category');

        $this->data['categories'] = $this->model->category->rootCategories();
        $this->data['products'] = $this->model->wishlist->all($auth['user']['id']);

        $this->view->setTitle('Список желаний');
        $this->view->render('wishlist/index', $this->data);



    }
}