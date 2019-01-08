<?php

namespace App\Controller;

use \Engine\Controller;

class AppController extends Controller
{
	/**
	 * @var array
	 */
	protected $authorizedActions = [];
	
	/**
	 * @var array
	 */
	protected $data = [];
	
	/**
	 * @var /Engine/Core/Cart/Cart
	 */
	protected $cart;
	
	/**
	 * AppController constructor
	 * @param \Engine\DI\DI $di
	 */
	public function __construct(\Engine\DI\DI $di)
	{
		parent::__construct($di);
		
		$this->cart = $this->di->get('cart');
		
		$this->data['auth'] = [
			'authorized' => false,
			'user' => null
		];
		
		$this->rootCategories();
		
		$this->initCart();
	}
	
	private function rootCategories()
	{
		$this->load->model('Category');
		
		$this->data['root'] = $this->model->category->rootCategories();
	}
	
	private function initCart()
	{
		$this->data['cart'] = $this->cart->cart();
	}
}