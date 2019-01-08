<?php

namespace App\Controller;

class FranchiseController extends AppController
{
    public function index()
    {
        $this->view->setTitle('Франчайзинг');
        $this->view->render('franchise/index', $this->data);
    }
}