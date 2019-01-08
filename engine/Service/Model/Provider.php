<?php

namespace Engine\Service\Model;

use \Engine\Service\AbstractProvider;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'model';
	
	/**
	 * @return void
	 */
	public function init()
	{
		$modelRegistry = new \stdClass();
		
		$this->di->set($this->serviceName, $modelRegistry);
	}
}