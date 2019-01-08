<?php

namespace Engine\Service;

abstract class AbstractProvider
{
	/**
	 * @param Engine\DI $di
	 */
	protected $di;
	
	/**
	 * AbstractProvider constructor
	 * @param Engine\DI\DI $di
	 */
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
	}
	
	abstract function init();
}