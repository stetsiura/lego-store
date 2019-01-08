<?php

namespace Admin\Controller;

class SettingsController extends AdminController
{
    protected $authorizedActions = [
        'general' => ['admin'],
        'updateSetting' => ['admin']
    ];

	public function general()
	{
		$this->load->model('Setting');
		
		$this->data['settings'] = $this->model->setting->getSettings();

		$this->view->setTitle('Управление настройками');
		$this->view->render('settings/general', $this->data);
	}
	
	public function updateSetting()
	{
		$this->load->model('Setting');
		$params = $this->request->post;
		
		$this->model->setting->update($params);

		\Session::set('settings-message', 'Настройки успешно сохранены');

		\Redirect::to('/admin/settings/general/');
	}
}