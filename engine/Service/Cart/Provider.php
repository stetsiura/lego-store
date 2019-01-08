<?php

namespace Engine\Service\Cart;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Cart\Cart;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'cart';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$cart = new Cart($this->di);
		
		$this->di->set($this->serviceName, $cart);
	}
}