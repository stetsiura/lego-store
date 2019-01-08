<?php

namespace Engine\Core\Router;

class Router
{
	/**
	 * @var array
	 */
	private $routes = [];
	
	/**
	 * @var string
	 */
	private $host;
	
	/**
	 * @var string
	 */
	private $dispatcher;
	
	/**
	 * @param string host
	 */
	public function __construct($host)
	{
		$this->host = $host;
	}
	
	/**
	 * @param string $key
	 * @param string $pattern
	 * @param string $controller
	 * @param string $method
	 */
	public function add($key, $pattern, $controller, $method = 'GET')
	{
		$this->routes[$key] = [
			'pattern'    => $pattern,
			'controller' => $controller,
			'method'     => $method
		];
	}
	
	/**
	 * @param string $key
	 * @param string $uri
	 * 
	 * @return \DispatchedRoute
	 */
	public function dispatch($method, $uri)
	{
		return $this->getDispatcher($method, $uri)->dispatch($method, $uri);
	}
	
	/**
	 * @param string $method
	 * @param string $uri
	 */
	public function getDispatcher($method, $uri)
	{
		if ($this->dispatcher == null)
		{
			$this->dispatcher = new UrlDispatcher();
			
			foreach($this->routes as $route)
			{
				$this->dispatcher->register($route["method"], $route["pattern"], $route["controller"]);
			}
		}
		
		return $this->dispatcher;
	}
}