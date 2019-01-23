<?php

namespace App\Controller;

class NewsController extends AppController
{
    public function index()
    {
        $this->load->model('News');

        $this->data['news'] = $this->model->news->all();

        $this->view->setTitle('Блог');
        $this->view->render('news/index', $this->data);
    }

    public function article($alias)
    {
        $this->load->model('News');

        $this->data['article'] = $this->model->news->article($alias);
        //$this->data['recent'] = $this->model->news->recent();

        $this->view->setTitle($this->data['article']['title'] . ' - Блог');
        $this->view->render('news/article', $this->data);
    }
}