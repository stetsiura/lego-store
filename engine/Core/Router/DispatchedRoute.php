<?php

namespace Engine\Core\Router;

class DispatchedRoute
{
	private $controller;
	
	/**
	 * @var array
	 */
	private $parameters;
	
	/**
	 * Dispatched route constructor
	 * @param $controller
	 * @param array $parameters
	 */
	public function __construct($controller, $parameters = [])
	{
		$this->controller = $controller;
		$this->parameters = $parameters;
	}
	
	/**
	 * Controller getter
	 * @return mixed
	 */
	public function getController()
	{
		return $this->controller;
	}
	
	/**
	 * Parameters getter
	 * @return array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}
}