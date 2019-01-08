<?php

namespace App\Controller;

class SearchController extends AppController
{
	public function form()
	{
	    $params = $this->request->post;
//
//		$url = \Render::searchUrl($this->request->post['term'], $params['page'], $params['sort'], $params['order']);
		
		\Redirect::to(\Url::searchUrl($params['term'], 1, 'name', 'asc'));
	}
	
	public function result()
	{		
		$this->load->model('Category');
		$this->load->model('Product');
		
		$this->data['pageParams'] = \Url::pageParams($this->request->get, null);
			
		$this->data['products'] = $this->model->product->search($this->data['pageParams']);
		$this->data['productsCount'] = $this->model->product->searchCount($this->data['pageParams']['term']);
        $this->data['categories'] = $this->model->category->rootCategories();
	
		$this->view->setTitle('Результаты поиска');
		
		$this->view->render('search/result', $this->data);
	}
}