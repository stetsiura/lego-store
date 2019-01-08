<?php

namespace Engine\Service\Auth;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Auth\Auth;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'auth';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$auth = new Auth($this->di);
		
		$this->di->set($this->serviceName, $auth);
	}
}