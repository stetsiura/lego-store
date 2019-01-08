<?php

namespace Admin\Controller;

class UsersController extends AdminController
{
    protected $authorizedActions = [
        'index' => ['admin'],
        'add' => ['admin'],
        'addPost' => ['admin'],
        'checkEmail' => ['admin'],
        'edit' => ['admin'],
        'editPost' => ['admin'],
        'delete' => ['admin'],
        'search' => ['admin'],
        'searchPost' => ['admin'],
        'searchResult' => ['admin'],
    ];

    public function index($section = 'admin')
    {
        $this->load->model('User');
        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get, $section);
        $this->data['usersCount'] = $this->model->user->usersCount($section);
        $this->data['users'] = $this->model->user->users($section, $this->data['pageParams']);

        $this->view->setTitle(\AdminHtml::usersSectionName($section));
        $this->view->render('users/index', $this->data);
    }

    public function add()
    {
        $this->load->model('User');

        $this->data['user'] = $this->model->user->emptyUser();
        $this->data['formData'] = [
            'header' => 'Добавление пользователя',
            'action' => 'add-post'
        ];

        $this->view->setTitle('Добавление пользователя');
        $this->view->render('users/edit', $this->data);
    }

    public function addPost()
    {
        $params = $this->request->post;

        $validator = new \Validator($this->di);

        $valid = $validator->validateRegistration($params);

        if (!$valid) {
            \Session::set('edit-user-message', 'Пожалуйста, укажите корректные значения!');
            \Redirect::to('/account/users/add-user/');
        }

        $this->load->model('User');

        $this->model->user->createUser($params);

        \Session::set('users-message', 'Пользователь успешно добавлен');
        \Redirect::to(\AdminUrl::usersUrl($params['role'], 1, 'name', 'asc'));
    }

    public function checkEmail()
    {
        $params = $this->request->post;

        $this->load->model('User');

        $result = $this->model->user->checkEmail($params['email']);

        echo json_encode($result);
    }

    public function edit($id)
    {
        $this->load->model('User');

        $this->data['user'] = $this->model->user->userById($id);

        $this->data['formData'] = [
            'header' => 'Редактирование пользователя',
            'action' => 'edit-post'
        ];

        $this->view->setTitle('Редактирование пользователя');
        $this->view->render('users/edit', $this->data);
    }

    public function editPost()
    {
        $params = $this->request->post;

        $validator = new \Validator($this->di);

        $valid = $validator->validateUserEdit($params);

        if (!$valid) {
            \Session::set('edit-user-message', 'Пожалуйста, укажите корректные значения!');
            \Redirect::to('/account/users/edit-user/' . $params['id']);
        }

        $this->load->model('User');

        $this->model->user->editUser($params);

        \Session::set('users-message', 'Изменения сохранены');
        \Redirect::to(\AdminUrl::usersUrl($params['role'], 1, 'name', 'asc'));
    }

    public function delete()
    {
        $params = $this->request->post;

        $this->load->model('User');

        $this->model->user->delete($params['id']);

        \Session::set('users-message', 'Пользователь успешно удален');
        \Redirect::to(\AdminUrl::usersUrl($params['role'], 1, 'name', 'asc'));
    }
    
    public function search()
    {
        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get);

        $this->data['term'] = '';

        $this->data['users'] = [];

        $this->data['usersCount'] = 0;

        $this->data['initial'] = true;

        $this->view->setTitle('Поиск пользователей');
        $this->view->render('users/search', $this->data);
    }

    public function searchPost()
    {
        $params = $this->request->post;

        \Redirect::to(\AdminUrl::usersSearchUrl($params['term'], 1, 'name', 'asc'));
    }

    public function searchResult()
    {
        $this->load->model('User');

        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get);

        $this->data['term'] = $this->data['pageParams']['term'];

        $this->data['users'] = $this->model->user->search($this->data['pageParams']);

        $this->data['usersCount'] = $this->model->user->searchCount($this->data['pageParams']['term']);

        $this->data['initial'] = false;

        $this->view->setTitle('Поиск пользователей');
        $this->view->render('users/search', $this->data);
    }
}