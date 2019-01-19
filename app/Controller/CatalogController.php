<?php

namespace App\Controller;

class CatalogController extends AppController
{
    public function index()
    {
        $this->load->model('Product');
        $this->load->model('Category');
        $this->load->model('Content');

        $this->data['popularProducts'] = $this->model->product->popular();
        //$this->data['newProducts'] = $this->model->product->newProducts();
        $this->data['categories'] = $this->model->category->allCategories();
        //$this->data['slides'] = $this->model->content->slides('catalog-slider');

        $this->view->setTitle('Каталог');
        $this->view->render('catalog/index', $this->data);
    }
}