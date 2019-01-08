<?php

namespace App\Controller;

class ShopsController extends AppController
{
    public function index()
    {
        $this->view->setTitle('Магазины');
        $this->view->render('shops/index', $this->data);
    }
}