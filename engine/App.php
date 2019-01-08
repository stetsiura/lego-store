<?php

namespace Engine;

use \Engine\Helper\Common;

use \Engine\Core\Router\DispatchedRoute;

class App
{
    /**
     * @var \Engine\DI
     */
    private $di;
	
	/**
     * @var \Engine\Core\Router\Router
     */
	public $router;

    /**
     * App consructor
     * @param \Engine\DI $di
     */
    public function __construct($di)
    {
        $this->di = $di;
		$this->router = $this->di->get('router');
    }

    /**
     * Run App
     */
    public function run()
    {
		try
		{	
			require_once __DIR__ . "/../" . mb_strtolower(ENV) . "/Route.php";
			
			$routeDispatch = $this->router->dispatch(Common::getMethod(), Common::getPathUrl());
			
			if ($routeDispatch == null)
			{
				$routeDispatch = new DispatchedRoute("ErrorController:page404");
			}
			
			list($class, $action) = explode(":", $routeDispatch->getController(), 2);
			
			$controllerClass = '\\' . ENV . '\\Controller\\' . $class;
			
			$controller = new $controllerClass($this->di);
			
			$parameters = $routeDispatch->getParameters();
			
			$controller->checkAuthorization($action);
			
			call_user_func_array([$controller, $action], $parameters);
		}
		catch(\Exception $e)
		{
			debug($e->getMessage());
			exit;
		}
		
    }
}
