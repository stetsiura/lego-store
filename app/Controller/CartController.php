<?php

namespace App\Controller;

class CartController extends AppController
{
	public function index()
	{
		$this->load->model('Setting');
		
		// $this->data['deliveryCost'] = (float)$this->model->setting->setting('delivery-cost');
		// $this->data['deliveryLimit'] = (float)$this->model->setting->setting('free-delivery-limit');
		
		$this->view->setTitle('Корзина (' . $this->data['cart']['count'] . ' ' . \Html::productCasing($this->data['cart']['count']) . ')');
		$this->view->render('cart/index', $this->data);
	}
	
	public function add()
	{
		$params = $this->request->post;
		
		$result = $this->cart->add((int)$params['product_id']);
		
		echo json_encode($result);
	}
	
	public function remove()
	{
		$params = $this->request->post;
		
		$this->cart->remove((int)$params['product_id']);
		
		\Redirect::to('/cart/');
	}
}