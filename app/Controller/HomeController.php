<?php

namespace App\Controller;

class HomeController extends AppController
{
    public function index()
	{
        $this->load->model('Product');
        $this->load->model('News');
        $this->load->model('Content');

		$this->data['popularProducts'] = $this->model->product->popular();
		$this->data['slides'] = $this->model->content->slides('main-slider');

		$this->view->setTitle('Главная');
		$this->view->render('home/index', $this->data);
	}
}
