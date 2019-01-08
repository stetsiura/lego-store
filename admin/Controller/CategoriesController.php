<?php

namespace Admin\Controller;

class CategoriesController extends AdminController
{
	protected $authorizedActions = [
		'index' => ['admin'],
		'category' => ['admin'],
		'add' => ['admin'],
		'edit' => ['admin'],
		'moveCategory' => ['admin'],
		'remove' => ['admin']
	];
	
	public function index()
	{
		$this->load->model('Category');
		
		$this->data['tree'] = $this->model->category->categoryTree(-1);
		$this->data['category'] = null;
		$this->data['breadcrumbs'] = $this->model->category->breadCrumbs(-1);
		
		$this->data['products'] = [];
		
		$this->view->setTitle('Управление категориями');
		$this->view->render('categories/category', $this->data);
	}
	
	public function category($id)
	{
		$this->load->model('Category');
		$this->load->model('Product');
		
		$this->data['tree'] = $this->model->category->categoryTree($id);
		$this->data['category'] = $this->model->category->category($id);
		$this->data['breadcrumbs'] = $this->model->category->breadCrumbs($id);
		$this->data['pageParams'] = \AdminUrl::pageParams($this->request->get, $id);
		
		$this->data['products'] = $this->model->product->productsInCategory($id, $this->data['pageParams']);
		$this->data['productsCount'] = $this->model->product->productsInCategoryCount($id);
		
		$this->view->setTitle('Управление категориями');
		$this->view->render('categories/category', $this->data);
	}
	
	public function add()
	{
		$this->load->model('Category');
		
		$params = $this->request->post;
		
		$this->model->category->create($params);

        \Session::set('category-message', 'Категория создана');
		\Redirect::to('/admin/categories/');
	}
	
	public function edit()
	{
		$this->load->model('Category');
		
		$params = $this->request->post;
		
		$this->model->category->edit($params);

		\Session::set('category-message', 'Изменения сохранены');
		\Redirect::to('/admin/categories/' . $params['id']);
	}
	
	public function moveCategory()
	{
		$this->load->model('Category');
		
		$params = $this->request->post;

		if ($this->model->category->canMoveCategory($params['categoryId'], $params['targetCategoryId'])) {
            $this->model->category->moveCategory($params);

            \Session::set('category-message', 'Категория перемещена');
        } else {
            \Session::set('category-error', 'Нельзя выполнить перемещение в выбранную категорию');
        }

        \Redirect::to('/admin/categories/' . $params['categoryId']);
	}

	public function remove()
    {
        $this->load->model('Category');

        $params = $this->request->post;

        $this->model->category->remove($params['removing_category_id']);

        \Session::set('category-message', 'Категория удалена');
        \Redirect::to('/admin/categories/');
    }
}