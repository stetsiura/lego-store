<?php

namespace Engine\Service\Image;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Image\Image;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'image';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$image = new Image($this->di);
		
		$this->di->set($this->serviceName, $image);
	}
}