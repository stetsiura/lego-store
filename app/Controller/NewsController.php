<?php

namespace App\Controller;

class NewsController extends AppController
{
    public function index()
    {
        $this->load->model('News');

        $this->data['news'] = $this->model->news->all();

        if (count($this->data['news']) > 0) {
            $this->data['firstNews'] = array_shift($this->data['news']);
        } else {
            $this->data['firstNews'] = null;
        }

        $this->view->setTitle('Новости');
        $this->view->render('news/index', $this->data);
    }

    public function article($alias)
    {
        $this->load->model('News');

        $this->data['article'] = $this->model->news->article($alias);
        $this->data['recent'] = $this->model->news->recent();

        $this->view->setTitle($this->data['article']['title']);
        $this->view->render('news/article', $this->data);
    }
}