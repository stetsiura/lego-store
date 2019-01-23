<?php

namespace App\Controller;

class CabinetController extends AppController
{
    public function index()
    {
        $auth = $this->data['auth'];

        if (!$auth['authorized']) {
            \Session::set('login-error', 'Пожалуйста, авторизируйтесь на сайте, чтобы воспользоваться кабинетом');

            \Redirect::to('/account/signin-or-register/');
        }

        $this->load->model('Wishlist');

        $this->data['products'] = $this->model->wishlist->all($auth['user']['id']);

        $this->view->setTitle('Кабинет');
        $this->view->render('cabinet/index', $this->data);
    }
}