<?php

namespace Admin\Controller;

class ContentController extends AdminController
{
    protected $authorizedActions = [
        'slider' => ['admin'],
        'slide' => ['admin'],
        'newSlide' => ['admin'],
        'addSlide' => ['admin'],
        'updateSlide' => ['admin'],
        'removeSlide' => ['admin'],
        'slideMoveDown' => ['admin'],
        'slideMoveUp' => ['admin']
    ];

	public function slider($alias)
	{
		$this->load->model('Content');
		
		$slides = $this->model->content->slides($alias);
		
		if (count($slides)) {
			\Redirect::to("/admin/content/slide/{$alias}/1");
		}
		
		\Redirect::to("/admin/content/slider/{$alias}/new-slide/");
	}
	
	public function slide($alias, $position)
	{
		$this->load->model('Content');
		
		$this->data['slides'] = $this->model->content->slides($alias);
		$this->data['slide'] = $this->model->content->slideByPosition($alias, $position);
		$this->data['alias'] = $alias;
		
		$this->view->setTitle('Управление слайдером');
		$this->view->render('content/slide', $this->data);
	}
	
	public function newSlide($alias)
	{
		$this->load->model('Content');
		
		$this->data['slides'] = $this->model->content->slides($alias);
		$this->data['alias'] = $alias;
		
		$this->view->setTitle('Управление слайдером');
		$this->view->render('content/new_slide', $this->data);
	}
	
	public function addSlide()
	{
		$this->load->model('Content');
		
		$params = $this->request->post;
		
		$position = $this->model->content->addSlide($params);

		\Session::set('slider-message', 'Слайд добавлен');
		\Redirect::to('/admin/content/slide/' . $params['alias']. '/' . $position);
	}
	
	public function updateSlide()
	{
		$this->load->model('Content');
		
		$params = $this->request->post;
		
		$this->model->content->updateSlide($params);

        \Session::set('slider-message', 'Изменения сохранены');
		\Redirect::to('/admin/content/slide/' . $params['alias']. '/' . $params['position']);
	}
	
	public function removeSlide()
	{
		$this->load->model('Content');
		
		$params = $this->request->post;
		
		$this->model->content->removeSlide($params['alias'], $params['id']);

        \Session::set('slider-message', 'Слайд удален');
		\Redirect::to('/admin/content/slider/' . $params['alias']);
	}
	
	public function slideMoveDown()
	{
		$this->load->model('Content');
		
		$params = $this->request->post;
		
		$position = $this->model->content->moveDownSlide($params['alias'], $params['id']);

        \Session::set('slider-message', 'Слайд перемещен');
		\Redirect::to('/admin/content/slide/' . $params['alias']. '/' . $position);
	}
	
	public function slideMoveUp()
	{
		$this->load->model('Content');
		
		$params = $this->request->post;
		
		$position = $this->model->content->moveUpSlide($params['alias'], $params['id']);

        \Session::set('slider-message', 'Слайд перемещен');
		\Redirect::to('/admin/content/slide/' . $params['alias']. '/' . $position);
	}
}