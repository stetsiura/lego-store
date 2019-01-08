<?php

namespace Engine\Core\Config;

class Config
{
	/**
	 * @param string $key
	 * @param string $group
	 * @return mixed
	 */
	public static function item($key, $group = 'main')
	{
		if (!Repository::retrieve($group, $key)) {
			self::file($group);
		}
		
		return Repository::retrieve($group, $key);
	}
	
	/**
	 * @param string $group
	 * @return mixed
	 */
	public static function group($group)
	{
		if (!Repository::retrieveGroup($group)) {
			self::file($group);
		}
		
		return Repository::retrieveGroup($group);
	}
	
	/**
	 * @param string $group
	 * @return array
	 */
	public static function file($group)
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/' . mb_strtolower(ENV) . '/Config/' . $group . '.php';
		
		if (file_exists($path))
		{
			$items = require $path;
			
			if (is_array($items))
			{
				Repository::store($group, $items);
				return $items;
			}
			else
			{
				throw new \Exception(
					sprintf(
						'"%s" configuration file is not a valid array!',
						$group
					)
				);
			}
		}
		else
		{
			throw new \Exception(
				sprintf(
					'"%s" configuration file could not be found!', 
					$group
				)
			);
		}
		
		return false;
	}
}