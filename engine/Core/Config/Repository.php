<?php

namespace Engine\Core\Config;

class Repository
{
	/**
	 * @var array
	 */
	protected static $stored = [];
	
	/**
	 * @param string $group
	 * @param string $key
	 * @param mixed $data
	 */
	public static function store($group, $data)
	{
		if (!isset(static::$stored[$group]) || !is_array(static::$stored[$group])) {
			static::$stored[$group] = [];
		}
		
		static::$stored[$group] = $data;
	}
	
	/**
	 * @param string $group
	 * @param string $key
	 * @return mixed
	 */
	public static function retrieve($group, $key)
	{
		return isset(static::$stored[$group][$key]) ? 
			static::$stored[$group][$key] :
			false;
	}
	
	/**
	 * @param string $group
	 * @return mixed
	 */
	public static function retrieveGroup($group)
	{
		return isset(static::$stored[$group]) ? 
			static::$stored[$group] :
			false;
	}
}