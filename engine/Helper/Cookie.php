<?php

namespace Engine\Helper;

class Cookie
{
	/**
	 * @param string $key
	 * @param string $value
	 * @param int $time
	 */
	public static function set($key, $value, $time = 31536000)
	{
		setcookie($key, $value, time() + $time, '/');
	}
	
	/**
	 * @param string $key
	 * @return string
	 */
	public static function get($key)
	{
		return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
	}
	
	/**
	 * @param string $key
	 */
	public static function delete($key)
	{
		if (isset($_COOKIE[$key]))
		{
			self::set($key, '', -3600);
			unset($_COOKIE[$key]);
		}
	}
}