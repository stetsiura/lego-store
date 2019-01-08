<?php

namespace Admin\Controller;

class NewsController extends AdminController
{
    protected $authorizedActions = [
        'index' => ['admin'],
        'add' => ['admin'],
        'addSave' => ['admin'],
        'uploadImage' => ['admin'],
        'edit' => ['admin'],
        'editSave' => ['admin'],
        'delete' => ['admin']
    ];

    public function index()
    {
        $this->load->model('News');

        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get);
        $this->data['news'] = $this->model->news->news($this->data['pageParams']);
        $this->data['newsCount'] = $this->model->news->newsCount();

        $this->view->setTitle('Новости');
        $this->view->render('news/index', $this->data);
    }

    public function add()
    {
        $this->load->model('News');

        $this->data['news'] = $this->model->news->emptyNews();
        $this->data['url'] = '/admin/news/add-save/';

        $this->view->setTitle('Добавление новости');
        $this->view->render('news/edit', $this->data);
    }

    public function addSave()
    {
        $this->load->model('News');
        $params = $this->request->post;

        $this->model->news->add($params);

        \Session::set('news-message', 'Новость успешно добавлена');
        \Redirect::to(\AdminUrl::newsUrl(1, 'date', 'desc'));
    }

    public function uploadImage()
    {
        $imageUrl = $this->file->processNewsContentImage('contentImage');

        echo $imageUrl;
    }

    public function edit($id)
    {
        $this->load->model('News');

        $this->data['news'] = $this->model->news->singleNews($id);
        $this->data['url'] = '/admin/news/edit-save/';

        $this->view->setTitle('Редактирование новости');
        $this->view->render('news/edit', $this->data);
    }

    public function editSave()
    {
        $this->load->model('News');
        $params = $this->request->post;

        $this->model->news->edit($params);

        \Session::set('news-message', 'Изменения сохранены');
        \Redirect::to(\AdminUrl::newsUrl(1, 'date', 'desc'));
    }

    public function delete()
    {
        $this->load->model('News');
        $params = $this->request->post;

        $this->model->news->delete($params['removing_news_id']);

        \Session::set('news-message', 'Новость успешно удалена');
        \Redirect::to(\AdminUrl::newsUrl(1, 'date', 'desc'));
    }
}