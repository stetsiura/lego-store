<?php

namespace Engine\Core\Cart;

class Cart
{
	const SESSION_CART_KEY = 'cart';
	
	/**
	 * @var \Engine\DI\DI;
	 */
	protected $di;
	
	/**
	 * @var \Engine\Core\Database\Connection
	 */
	protected $db;
	
	/**
	 * @var \Engine\Core\Database\QueryBuilder
	 */
	protected $qb;
	
	/**
	 * @var \Engine\Model
	 */
	protected $model;
	
	/**
	 * @var \Engine\Load
	 */
	protected $load;
	
	/**
	 * @var array
	 */
	protected $cart = null;
	
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
		$this->db = $this->di->get('db');
		$this->qb = $this->di->get('query_builder');
		$this->load = $this->di->get('load');
		$this->model = $this->di->get('model');
		
		$this->initCart();
	}
	
	public function add($id)
	{
		$this->load->model('Product');
		
		$product = $this->model->product->productById($id);
		
		$this->cart();		
		$this->addToItems($id, $product);		
		$this->calculateItems();
		$this->calculateTotalPrice();
		
		$this->save();
		
		return [
			'product_name' => "{$product['item_code']} - {$product['name']}",
			'count' => $this->cart['count'],
			'total_price' => number_format($this->cart['total_price'], 2)
		];
	}
	
	public function cart()
	{
		$this->cart = \Session::get(self::SESSION_CART_KEY);
		
		return $this->cart;
	}
	
	public function remove($id)
	{
		$this->cart();
		
		if (isset($this->cart['items'][$id])) {
			unset($this->cart['items'][$id]);
		}
		
		$this->calculateItems();
		$this->calculateTotalPrice();
		
		$this->save();
	}

	public function clear()
    {
        if (\Session::has(self::SESSION_CART_KEY)) {
            \Session::delete(self::SESSION_CART_KEY);
        }

        $this->initCart();
    }
	
	private function save()
	{
		\Session::set(self::SESSION_CART_KEY, $this->cart);
	}
	
	private function calculateTotalPrice()
	{
		$this->cart['total_price'] = 0.0;
		
		foreach($this->cart['items'] as $item) {
			$this->cart['total_price'] += $item['item_price'] * $item['count'];
		}
	}
	
	private function productPrice($product)
	{
		return ($product['has_discount']) ? $product['actual_price'] : $product['price'];
	}
	
	private function calculateItems()
	{
		if (empty($this->cart['items'])) {
			$this->cart['count'] = 0;
		} else {
			$this->cart['count'] = array_reduce($this->cart['items'], function($sum, $item) {
				return $sum += $item['count'];
			});
		}
	}
	
	private function addToItems($id, $product)
	{
		$this->load->model('Setting');

		if (!isset($this->cart['items'][$id])) {
			$this->cart['items'][$id]['count'] = 1;
			$this->cart['items'][$id]['product'] = $product;
			$this->cart['items'][$id]['item_price'] = $this->productPrice($product);

			if ($product['item_state'] == 'order') {
				$this->cart['items'][$id]['delivery_time'] = (float)$this->model->setting->setting('average-delivery-time-order');
			} else {
				$this->cart['items'][$id]['delivery_time'] = (float)$this->model->setting->setting('average-delivery-time-instock');
			}
		}
	}
	
	private function initCart()
	{
		if (!\Session::has(self::SESSION_CART_KEY)) {
			
			$this->cart = [
				'items' => [],
				'count' => 0,
				'total_price' => 0.0
			];
			
			\Session::set(self::SESSION_CART_KEY, $this->cart);
		}
	}
}