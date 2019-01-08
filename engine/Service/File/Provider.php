<?php

namespace Engine\Service\File;

use \Engine\Service\AbstractProvider;
use \Engine\Core\File\File;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'file';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$file = new File($this->di);
		
		$this->di->set($this->serviceName, $file);
	}
}