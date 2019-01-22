<?php

namespace App\Controller;

use \Engine\Core\Mail\Message\RegistrationMessage;
use \Engine\Core\Mail\Message\PasswordResetMessage;

class AccountController extends AppController
{
    public function signinOrRegister()
    {
        $this->view->setTitle('Войдите или зарегистрируйтесь');
        $this->view->render('account/signin_or_register', $this->data);
    }

    public function checkEmail()
    {
        $params = $this->request->post;

        $this->load->model('User');

        $result = $this->model->user->checkEmail($params['email']);

        echo json_encode($result);
    }

    public function register()
    {
        $params = $this->request->post;

        $validator = new \Validator($this->di);

        $valid = $validator->validateRegistration($params);

        if (!$valid) {
            \Redirect::to('/account/signin-or-register/');
        }

        $this->load->model('User');

        $this->model->user->createUser($params);

        $authorized = $this->auth->authorize($params['email'], $params['password'], true);

        if ($authorized) {

            $message = new RegistrationMessage(
                [
                    'name' => $params['name'],
                    'email' => $params['email']
                ],
                $params['email']
            );

            $result = $this->mail->sendMessage($message);
            \Session::set('home-message', 'Вы успешно зарегистрированы. Добро пожаловать на сайт BricksUnity!');
            \Redirect::to('/');
        }

        \Redirect::to('/');
    }

    public function login()
    {
        $params = $this->request->post;

        $authorized = $this->auth->authorize($params['email'], $params['password'], true);

        if ($authorized) {
            \Session::set('home-message', 'Вы успешно вошли в систему. Рады Вас видеть!');
            \Redirect::to('/');
        }

        \Session::set('login-error', 'E-mail или пароль указаны неверно');

        \Redirect::to('/account/signin-or-register/');
    }

    public function logout()
    {
        $this->auth->unauthorize();
        \Session::set('home-message', 'Вы успешно вышли из системы. Возвращайтесь поскорее!');
        \Redirect::to('/');
    }

    public function passwordReset()
    {
        $this->view->setTitle('Сброс пароля');
        $this->view->render('account/reset_password', $this->data);
    }

    public function passwordResetPost()
    {
        $params = $this->request->post;

        $this->load->model('User');

        $user = $this->model->user->userByEmail($params['email']);

        $result = '';

        if (is_null($user)) {
            $this->data['result'] = 'not-found';
            $this->view->setTitle('Сброс пароля');
            $this->view->render('account/password_reset_result', $this->data);
            exit;
        }

        $hash = $this->model->user->setResetHashForUser($user['id']);

        $message = new PasswordResetMessage(
            [
                'link' => \Url::passwordResetUrl($hash)
            ],
            $user['email']);

        $result = $this->mail->sendMessage($message);

        $this->data['result'] = 'message-sent';

        $this->view->setTitle('Сброс пароля');
        $this->view->render('account/password_reset_result', $this->data);
    }

    public function passwordResetForm($hash)
    {
        $this->data['hash'] = $hash;
        $this->view->setTitle('Сброс пароля');
        $this->view->render('account/password_reset_form', $this->data);
    }

    public function passwordResetComplete()
    {
        $params = $this->request->post;

        $this->load->model('User');

        $user = $this->model->user->userByResetHash($params['hash']);

        if (is_null($user)) {
            $this->data['result'] = 'fail';
            $this->view->setTitle('Сброс пароля');
            $this->view->render('account/password_reset_result', $this->data);
        }

        $this->model->user->resetPassword($user['id'], $params['password']);

        $this->data['result'] = 'success';
        $this->view->setTitle('Сброс пароля');
        $this->view->render('account/password_reset_result', $this->data);
    }
}