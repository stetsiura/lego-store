<?php

namespace Admin\Controller;

use \Engine\Controller;

class AdminController extends Controller
{	
	/**
	 * @var array
	 */
	protected $authorizedActions = [];
	
	/**
	 * @var array
	 */
	protected $data = [];
	
	/**
	 * AdminController constructor
	 * @param \Engine\DI\DI $di
	 */
	public function __construct(\Engine\DI\DI $di)
	{
		parent::__construct($di);
		
		$this->data['auth'] = [
			'authorized' => false,
			'user' => null
		];
	}
}