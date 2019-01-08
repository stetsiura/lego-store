<?php

namespace App\Controller;

class SpecialsController extends AppController
{
    public function bestsellers()
    {
        $this->load->model('Category');
        $this->load->model('Book');

        $this->data['books'] = $this->model->book->specialsBestsellers();
        $this->data['navigator'] = $this->model->category->searchNavigator($this->data['books']);

        $this->data['heading'] = 'Наши бестселлеры';
        $this->data['type'] = 'bestsellers';

        $this->view->setTitle('Наши бестселлеры - Интернет магазин Babybook.com.ua');
        $this->view->render('specials/result', $this->data);
    }

    public function shares()
    {
        $this->load->model('Category');
        $this->load->model('Book');

        $this->data['books'] = $this->model->book->specialsShares();
        $this->data['navigator'] = $this->model->category->searchNavigator($this->data['books']);

        $this->data['heading'] = 'Книги по скидкам';
        $this->data['type'] = 'shares';

        $this->view->setTitle('Книги по скидкам - Интернет магазин Babybook.com.ua');
        $this->view->render('specials/result', $this->data);
    }
}