<?php

namespace Engine\Helper;

class Common
{
	/**
	 * @return bool
	 */
	public static function isPost()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * @return string
	 */
	public static function getMethod()
	{
		return strtoupper($_SERVER["REQUEST_METHOD"]);
	}
	
	/**
	 * @return string
	 */
	public static function getPathUrl()
	{
		$pathUrl = $_SERVER["REQUEST_URI"];
		
		if ($position = strpos($pathUrl, '?'))
		{
			$pathUrl = substr($pathUrl, 0, $position);
		}
		
		return $pathUrl;
	}
	
	public static function pageParams($getParams, $categoryId = null)
	{
		$params = [];
		
		$params['page'] = isset($getParams['page']) ? $getParams['page'] : 1;
		
		$params['sort'] = isset($getParams['sort']) ? $getParams['sort'] : 'name';
		
		$params['order'] = isset($getParams['order']) ? $getParams['order'] : 'asc';
		
		$params['term'] = isset($getParams['term']) ? trim($getParams['term']) : '';
		
		$params['category_id'] = $categoryId;
		
		return $params;
		
	}
}