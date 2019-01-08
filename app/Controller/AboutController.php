<?php

namespace App\Controller;

class AboutController extends AppController
{
    public function index()
    {
        $this->view->setTitle('О нас');
        $this->view->render('about/index', $this->data);
    }
}