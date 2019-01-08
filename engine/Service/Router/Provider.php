<?php

namespace Engine\Service\Router;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Router\Router;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'router';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$router = new Router('http://bookshop.loc:8080/');
		
		$this->di->set($this->serviceName, $router);
	}
}