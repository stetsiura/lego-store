<?php

namespace Engine;

abstract class Controller
{
	/**
	 * @var \Engine\DI\DI
	 */
	protected $di;
	
	/**
	 * @var \Engine\Core\Database\Connection
	 */
	protected $db;
	
	/**
	 * @var \Engine\Core\Database\QueryBuilder
	 */
	protected $qb;
	
	/**
	 * @var \Engine\Load
	 */
	protected $load;
	
	/**
	 * @var \Engine\Core\Template\View
	 */
	protected $view;
	
	/**
	 * @var array
	 */
	protected $config;
	
	/**
	 * @var \Engine\Core\Request\Request;
	 */
	protected $request;
	
	/**
	 * @var \stdClass
	 */
	protected $model;
	
	/**
	 * @var \Engine\Core\Auth\Auth
	 */
	protected $auth;
	
	/**
	* @var \Engine\Core\Image\Image
	*/
	protected $image;
	
	/**
	* @var \Engine\Core\File\File
	*/
	protected $file;

    /**
     * @var \Engine\Core\Mail\Mail
     */
    protected $mail;
	
	/**
	 * Controller constructor
	 * @param \Engine\DI\DI $di
	 */
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
		
		$this->initVars();
	}

	/**
	 * @param string
	 * @return mixed
	 */
	public function __get($key) 
	{
		return $this->di->get($key);
	}
	
	/**
	 * @param string $action
	 * @return array
	 */
	protected function getAuthRolesForAction($action) 
	{
		if (isset($this->authorizedActions[$action])) {
			return $this->authorizedActions[$action];
		}
		return [];
	}
	
	/**
	 * @param string $action
	 * @return bool
	 */
	protected function actionNeedsCheck($action) 
	{
		if (isset($this->authorizedActions[$action])) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * @param string $action
	 */
	public function checkAuthorization($action) {
		$allowedRoles = $this->getAuthRolesForAction($action);
		
		$authorized = $this->auth->isAuthorized($allowedRoles);
		
		$this->data['auth']['authorized'] = $authorized;
		$this->data['auth']['user'] = $this->auth->getUserFromSession();
		
		if ($this->actionNeedsCheck($action) && !$authorized) {
			\Redirect::to($this->config['main']['auth_redirect_url']);
		}
	}
	
	/**
	 * @return \Engine\Controller
	 */
	public function initVars()
	{
		$vars = array_keys(get_object_vars($this));
		
		foreach ($vars as $var) {
			if ($this->di->has($var)) {
				$this->{$var} = $this->di->get($var);
			}
		}
		
		return $this;
	}
}