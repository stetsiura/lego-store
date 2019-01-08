<?php

namespace Engine\Service\Config;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Config\Config;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'config';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$config['main']     = Config::group('main');
		$config['database'] = Config::group('database');
		
		$this->di->set($this->serviceName, $config);
	}
}