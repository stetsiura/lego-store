<?php

namespace Engine\Helper;

class Session 
{
	/**
	 * @param string $key
	 */
	public static function has($key)
	{
		return isset($_SESSION[$key]) ? true : false;
	}
	
	/**
	 * @param string $key
	 */
	public static function get($key)
	{
		return self::has($key) ? $_SESSION[$key] : null;
	}
	
	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	 * @param string $key
	 */
	public static function delete($key)
	{
		if (self::has($key)) {
			unset($_SESSION[$key]);
		}
	}
	
	/**
	 * @param string $key
	 */
	public static function flash($key)
	{
		$value = self::get($key);
		
		self::delete($key);
		
		return $value;
	}
}