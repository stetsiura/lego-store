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
		$this->load->model('Book');
		
		$book = $this->model->book->book($id);
		
		$this->cart();		
		$this->addToItems($id, $book);		
		$this->calculateItems();
		$this->calculateTotalPrice();
		
		$this->deliveryPrice();
		
		$this->save();
		
		return [
			'book_name' => $book['title'],
			'count' => $this->cart['count'],
			'total_price' => number_format($this->cart['total_price'], 2)
		];
	}
	
	public function cart()
	{
		$this->cart = \Session::get(self::SESSION_CART_KEY);
		
		return $this->cart;
	}
	
	public function setCount($id, $count)
	{
		$this->cart();
		
		$this->cart['items'][$id]['count'] = (int)$count;
		$this->cart['items'][$id]['item_price'] = $this->cart['items'][$id]['count'] * $this->bookPrice($this->cart['items'][$id]['book']);
		
		$this->calculateItems();
		$this->calculateTotalPrice();
		
		$this->deliveryPrice();
		
		$this->save();
	}
	
	public function remove($id)
	{
		$this->cart();
		
		if (isset($this->cart['items'][$id])) {
			unset($this->cart['items'][$id]);
		}
		
		$this->calculateItems();
		$this->calculateTotalPrice();
		
		$this->deliveryPrice();
		
		$this->save();
	}
	
	public function setDelivery($delivery)
	{
		$this->cart();
		
		$this->cart['delivery'] = $delivery;
		
		$this->deliveryPrice();
		
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
	
	private function deliveryPrice()
	{
		$this->load->model('Setting');
		
		$delivery = $this->cart['delivery'];
		
		$deliveryLimit = (float)$this->model->setting->setting('free-delivery-limit');
		$deliveryCost = (float)$this->model->setting->setting('delivery-cost');
		
		if ($delivery == 'self') {
			$this->cart['delivery_cost'] = 0.0;
		} else {
			if ($this->cart['total_price'] < $deliveryLimit) {
				$this->cart['delivery_cost'] = $deliveryCost;
			} else {
				$this->cart['delivery_cost'] = 0.0;
			}
		}
	}
	
	private function calculateTotalPrice()
	{
		$this->cart['total_price'] = 0.0;
		
		foreach($this->cart['items'] as $item) {
			$this->cart['total_price'] += $item['item_price'];
		}
	}
	
	private function bookPrice($book)
	{
		return ($book['has_discount']) ? $book['actual_price'] : $book['price'];
	}
	
	private function calculateItems()
	{
		$this->cart['count'] = array_reduce($this->cart['items'], function($sum, $item) {
			return $sum += $item['count'];
		});
	}
	
	private function addToItems($id, $book)
	{
		if (isset($this->cart['items'][$id])) {
			$this->cart['items'][$id]['count'] = $this->cart['items'][$id]['count'] + 1;
			$this->cart['items'][$id]['item_price'] = $this->bookPrice($book) * $this->cart['items'][$id]['count'];
		} else {
			$this->cart['items'][$id]['count'] = 1;
			$this->cart['items'][$id]['book'] = $book;
			$this->cart['items'][$id]['item_price'] = $this->bookPrice($book);
		}
	}
	
	private function initCart()
	{
		if (!\Session::has(self::SESSION_CART_KEY)) {
			
			$this->cart = [
				'items' => [],
				'count' => 0,
				'total_price' => 0.0,
				'delivery' => 'self',
				'delivery_cost' => 0.0
			];
			
			\Session::set(self::SESSION_CART_KEY, $this->cart);
		}
	}
}