<?php

namespace Engine;

abstract class Model
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
	 * @var array
	 */
	protected $config;
	
	/**
	 * @var \Engine\Model
	 */
	protected $model;
	
	/**
	 * @var \Engine\Load
	 */
	protected $load;
	
	/**
	 * @var \Engine\Core\File\File
	 */
	protected $file;

    /**
     * @var \Engine\Core\Auth\Auth
     */
	protected $auth;
	
	/**
	 * Model constructor
	 * @param DI $di
	 */
	public function __construct(\Engine\DI\DI $di)
	{
		$this->di = $di;
		$this->config = $this->di->get('config');
		$this->db = $this->di->get('db');
		$this->qb = $this->di->get('query_builder');
		$this->load = $this->di->get('load');
		$this->model = $this->di->get('model');
		$this->file = $this->di->get('file');
		$this->auth = $this->di->get('auth');
	}
}