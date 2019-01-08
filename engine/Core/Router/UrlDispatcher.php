<?php

namespace Engine\Core\Router;

//use Engine\Core\Router\DispatchedRoute;

class UrlDispatcher
{
	/**
	 * @var array
	 */
	private $methods = [
		"GET",
		"POST"
	];
	
	/**
	 * @var array
	 */
	private $routes = [
		"GET"  => [],
		"POST" => []
	];
	
	/**
	 * @var array
	 */
	private $patterns = [
		"int" => "[0-9]+",
		"str" => "[a-zA-z\.\-_%]+",
		"any" => "[a-zA-z0-9\.\-_%]+"
	];
	
	/**
	 * @param string $key
	 * @param string $pattern
	 */
	public function addPattern($key, $pattern)
	{
		return isset($this->routes[$method]) ? $this->routes[$method] : [];
	}
	
	/**
	 * @param string $key
	 * @return array
	 */
	public function routes($method = "GET")
	{
		return $this->routes[$method];
	}
	
	/**
	 * @param string $method
	 * @param string $pattern
	 * @param string $controller
	 */
	public function register($method, $pattern, $controller)
	{
		$convert = $this->convertPattern($pattern);
		
		$this->routes[strtoupper($method)][$convert] = $controller;
	}
	
	/**
	 * @param string $pattern
	 * @return string
	 */
	private function convertPattern($pattern)
	{
		if (strpos($pattern, "(") === false)
		{
			return $pattern;
		}
		
		return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, "replacePattern"], $pattern);
	}
	
	/**
	 * @param array $parameters
	 * @return array
	 */
	private function processParam($parameters)
	{
		foreach($parameters as $key => $value)
		{
			if (is_int($key))
			{
				unset($parameters[$key]);
			}
		}
		
		return $parameters;
	}
	
	/**
	 * @param array $matches
	 * @return string
	 */
	private function replacePattern($matches)
	{
		return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
	}
	
	/**
	 * @param string $method
	 * @param string $uri
	 */
	public function dispatch($method, $uri)
	{
		$routes = $this->routes(strtoupper($method));
		
		if (array_key_exists($uri, $routes))
		{
			return new DispatchedRoute($routes[$uri]);
		}
		
		return $this->doDispatch($method, $uri);
	}
	
	/**
	 * @param string $method
	 * @param string $uri
	 * @return \Engine\Core\Router\DispatchedRoute
	 */
	private function doDispatch($method, $uri)
	{
		foreach($this->routes[$method] as $route => $controller)
		{
			$pattern = '#^' . $route . '$#s';
			
			if (preg_match($pattern, $uri, $parameters))
			{
				return new DispatchedRoute($controller, $this->processParam($parameters));
			}
		}
	}
}