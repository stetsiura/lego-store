<?php

namespace App\Controller;

class CategoryController extends AppController
{
	public function category($alias)
	{
		$this->load->model('Category');
		$this->load->model('Product');
		
		$this->data['pageParams'] = \Url::pageParams($this->request->get, $alias);
		$this->data['category'] = $this->model->category->categoryByAlias($alias);
		$this->data['products'] = $this->model->product->productsInCategoryByAlias($alias, $this->data['pageParams']);
		$this->data['productsCount'] = $this->model->product->productsInCategoryByAliasCount($alias);
        //$this->data['categories'] = $this->model->category->allCategories();
		
		$this->view->setTitle('Категория "' . $this->data['category']['name'] . '"');
		$this->view->render('category/category', $this->data);
	}

	public function load($alias)
    {
        $this->load->model('Category');
        $this->load->model('Product');

        $this->data['pageParams'] = \Url::pageParams($this->request->get, $alias);

        $this->data['items'] = $this->model->product->productsInStack($alias, $this->data['pageParams']);
        $this->data['productsCount'] = $this->model->product->productsInStackCount($alias, $this->data['pageParams']);
        $this->data['type'] = 'category';

        $this->view->render('partials/product_list', $this->data);
    }
}