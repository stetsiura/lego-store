<?php

namespace Admin\Controller;

class DashboardController extends AdminController
{
	protected $authorizedActions = [
		'index' => ['admin']
	];
	
	public function index()
	{
		$this->view->setTitle('Панель управления');
		
		$this->view->render('dashboard/index', $this->data);
	}
}
