<?php

namespace Admin\Controller;

class AccountController extends AdminController
{	
	public function login()
	{
		$this->view->setTitle('Вход в систему');
		$this->view->render('account/login', $this->data);
	}

	public function auth()
	{
		$params = $this->request->post;
		
		$authorized = $this->auth->authorize($params['email'], $params['password'], true);
		
		if ($authorized) {
			\Redirect::to('/admin/dashboard/');
		}
		
		\Redirect::to('/admin/account/login/');

	}

	public function logout()
	{
		$this->auth->unauthorize();
		\Redirect::to('/admin/account/login/');
	}
}
