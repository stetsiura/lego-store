<?php

namespace Engine\Core\Database;

use \PDO;
use \Engine\Core\Config\Config;

class Connection
{
	/**
	 * @var \PDO $link
	 */
	private $link;
	
	/**
	 * @var array
	 */
	private $result;

	/**
	 * Connection constructor
	 */
	public function __construct()
	{
		$this->connect();
	}

	/**
	 * @return \Connection
	 */
	private function connect()
	{
		$config = Config::group('database');

		$dsn = "mysql:host=" . $config["host"] . ";dbname=" . $config["db_name"]
							 . ";charset=" . $config["charset"];

		$this->link = new PDO($dsn, $config["username"], $config["password"]);

		return $this;
	}

	/**
	 * @param string $sql
	 * @param array $values
	 * @return bool
	 */
	public function execute($sql, $values = [])
	{
		$sth = $this->link->prepare($sql);

		return $sth->execute($values);
	}

	/**
	 * @param string $sql
	 * @param array $values
	 * @return array
	 */
	public function query($sql, $values = [])
	{
		$sth = $this->link->prepare($sql);

		$sth->execute($values);

		$this->result = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return $this;
	}
	
	public function all()
	{
		if ($this->result == false) {
			return [];
		}
		
		return $this->result;
	}
	
	public function firstOrDefault()
	{
		if ($this->result === false || (is_array($this->result) && empty($this->result)))
		{
			return null;
		}
		
		return $this->result[0];
	}
	
	/**
	 * @return int
	 */
	public function lastInsertId()
	{
		return $this->link->lastInsertId();
	}
}
