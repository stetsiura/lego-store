<?php

namespace App\Controller;

class CartController extends AppController
{
	public function index()
	{
		$this->load->model('Setting');
		
		$this->data['deliveryCost'] = (float)$this->model->setting->setting('delivery-cost');
		$this->data['deliveryLimit'] = (float)$this->model->setting->setting('free-delivery-limit');
		
		$this->view->setTitle('Корзина (' . $this->data['cart']['count'] . ' товара) - Интернет магазин Babybook.com.ua');
		$this->view->render('cart/index', $this->data);
	}
	
	public function add()
	{
		$params = $this->request->post;
		
		$result = $this->cart->add((int)$params['book_id']);
		
		echo json_encode($result);
	}
	
	public function setCount()
	{
		$params = $this->request->post;
		
		$this->cart->setCount((int)$params['book_id'], (int)$params['count']);
		
		\Redirect::to('/cart/');
	}
	
	public function remove()
	{
		$params = $this->request->post;
		
		$this->cart->remove((int)$params['book_id']);
		
		\Redirect::to('/cart/');
	}
	
	public function setDelivery()
	{
		$params = $this->request->post;
		
		$this->cart->setDelivery($params['delivery']);
		
		\Redirect::to('/cart/');
	}
}