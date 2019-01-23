<?php

namespace App\Controller;

use \Engine\Core\Mail\Message\SupportMessage;

class SupportController extends AppController
{
    public function index()
    {
        $this->view->setTitle('Поддержка');
        $this->view->render('support/index', $this->data);
    }

    public function form()
    {
        $this->load->model('Setting');

        $email = $this->model->setting->setting('support-email');

        $params = $this->request->post;

        $message = new SupportMessage([
            'name' => $params['name'],
            'email' => $params['email'],
            'message' => $params['message']
        ],
        $email);

        $result = $this->mail->sendMessage($message);

        \Session::set('support-message', 'Ваша заявка успешно отправлена в Службу поддержки');
        \Redirect::to('/support/');
    }

    public function subscribe()
    {
        $this->load->model('Subscriber');

        $email = $this->request->post['email'];

        $this->model->subscriber->add($email);

        echo "true";
    }
}