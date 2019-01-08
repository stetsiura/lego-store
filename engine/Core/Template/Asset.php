<?php

namespace Engine\Core\Template;

class Asset
{
	const EXT_JS = ".js";
	const EXT_CSS = ".css";
	
	const JS_SCRIPT_MASK = "<script src=\"%s\"></script>\n";
	const CSS_LINK_MASK = "<link rel=\"stylesheet\" href=\"%s\">\n";
	
	/**
	 * @var array
	 */
	private static $container = [];
        
	/**
	 * @var array 
	 */
	private static $commonJsContainer = [];
	
	/**
	 * @param string $link
	 */
	public static function css($link)
	{
		$file = $link . self::EXT_CSS;

		self::$container['css'][] = [
			'file' => $file
		];
	}
	
	/**
	 * @param string $link
	 */
	public static function js($link)
	{
		$file = $link . self::EXT_JS;

		self::$container['js'][] = [
			'file' => $file
		];
	}
        
        /**
	 * @param string $link
	 */
	public static function commonJs($link)
	{
		$file = $link . self::EXT_JS;

		self::$commonJsContainer[] = [
			'file' => $file
		];
	}
	
	/**
	 * @param string $extension
	 */
	public static function render($extension)
	{
		$assetsList = isset(self::$container[$extension]) ? self::$container[$extension] : [];
		
		$renderMethod = 'render' . ucfirst($extension);

		self::{$renderMethod}($assetsList);
	}
	
	/**
	 * @param array $list
	 */
	public static function renderJs($list)
	{		
		$list = array_merge(self::$commonJsContainer, $list);
		
		foreach($list as $item) {
			echo sprintf(
				self::JS_SCRIPT_MASK,
				$item['file']
			);
		}
	}
	
	/**
	 * @param array $list
	 */
	public static function renderCss($list) 
	{
		foreach($list as $item) {
			echo sprintf(
				self::CSS_LINK_MASK,
				$item['file']
			);
		}
	}
}