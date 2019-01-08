<?php

namespace Engine\Service\QueryBuilder;

use \Engine\Service\AbstractProvider;
use \Engine\Core\Database\QueryBuilder;

class Provider extends AbstractProvider
{
	/**
	 * @var string $serviceName
	 */
	public $serviceName = 'query_builder';
	
	/**
	 * @return mixed
	 */
	public function init()
	{
		$queryBuilder = new QueryBuilder();
		
		$this->di->set($this->serviceName, $queryBuilder);
	}
}