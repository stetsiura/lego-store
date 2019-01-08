<?php

namespace Admin\Controller;

class ProductController extends AdminController
{
	protected $authorizedActions = [
		'index' => ['admin'],
		'add' => ['admin'],
		'edit' => ['admin'],
		'addSave' => ['admin'],
		'editSave' => ['admin'],
		'move' => ['admin'],
		'delete' => ['admin'],
        'search' => ['admin'],
        'searchPost' => ['admin'],
        'searchResult' => ['admin']
	];	
	
	public function index()
	{
		$this->load->model('Category');
		$this->load->model('Book');
		
		$this->data['breadcrumbs'] = $this->model->category->breadCrumbs(6);
		
		$this->view->setTitle('Добавление/редактирование книги');
		$this->view->render('book/create', $this->data);
	}
	
	public function add($categoryId)
	{
		$this->load->model('Category');
		$this->load->model('Product');
		
		$this->data['breadcrumbs'] = $this->model->category->breadCrumbs((int)$categoryId);
		$this->data['product'] = $this->model->product->emptyProduct($categoryId);
		
		$this->data['url'] = '/admin/product/add-save/';
		
		$this->view->setTitle('Добавление продукта');
		$this->view->render('product/edit', $this->data);
	}
	
	public function addSave()
	{
		$this->load->model('Product');
		
		$params = $this->request->post;
		
		$this->model->product->addProduct($params);

        \Session::set('category-message', 'Продукт успешно добавлен');
		\Redirect::to(\AdminUrl::categoryUrl($params['category_id'], 1, 'name', 'asc'));
	}
	
	public function edit($id, $categoryId)
	{
		$this->load->model('Category');
		$this->load->model('Product');;
		
		$this->data['breadcrumbs'] = $this->model->category->breadCrumbs((int)$categoryId);
		$this->data['product'] = $this->model->product->product($id);
		
		$this->data['url'] = '/admin/product/edit-save/';
		
		$this->view->setTitle('Редактирование продукта');
		$this->view->render('product/edit', $this->data);
		
		
	}
	
	public function editSave()
	{
		$this->load->model('Product');
		
		$params = $this->request->post;
		
		$this->model->product->editProduct($params);

        \Session::set('category-message', 'Изменения сохранены');
		\Redirect::to(\AdminUrl::categoryUrl($params['category_id'], 1, 'name', 'asc'));
	}
	
	public function move()
	{
		$this->load->model("Product");
		
		$params = $this->request->post;
		
		$this->model->product->moveProduct($params['moving_product_id'], $params['moving_product_category_id']);

        \Session::set('category-message', 'Продукт перемещен');
		\Redirect::to(\AdminUrl::categoryUrl($params['moving_product_category_id'], 1, 'name', 'asc'));
	}
	
	public function delete()
	{
		$this->load->model("Product");
		
		$params = $this->request->post;
		
		$this->model->product->deleteProduct($params['removing_product_id']);

        \Session::set('category-message', 'Продукт удален');
		\Redirect::to(\AdminUrl::categoryUrl($params['removing_product_category_id'], 1, 'name', 'asc'));
	}

	public function search()
    {
        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get);

        $this->data['term'] = '';

        $this->data['products'] = [];

        $this->data['productsCount'] = 0;

        $this->data['initial'] = true;

        $this->view->setTitle('Поиск товаров');
        $this->view->render('product/search', $this->data);
    }

    public function searchPost()
    {
        $params = $this->request->post;

        \Redirect::to(\AdminUrl::productsSearchUrl($params['term'], 1, 'name', 'asc'));
    }

    public function searchResult()
    {
        $this->load->model('Product');

        $this->load->model('Category');

        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get);

        $this->data['term'] = $this->data['pageParams']['term'];

        $this->data['products'] = $this->model->product->search($this->data['pageParams']);

        $this->data['productsCount'] = $this->model->product->searchCount($this->data['pageParams']['term']);

        $this->data['initial'] = false;

        $this->data['tree'] = $this->model->category->categoryTree(-1);

        $this->view->setTitle('Поиск товаров');
        $this->view->render('product/search', $this->data);
    }
}