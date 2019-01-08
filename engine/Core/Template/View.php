<?php

namespace Engine\Core\Template;

use \Engine\Core\Template\Theme;

use \Engine\Core\Config\Config;

class View
{
	public function __construct()
	{
		$this->theme = new Theme();
	}

	/**
	 * @var \Engine\Core\Template\Theme
	 */
	protected $theme;
	
	/**
	 * @var array
	 */
	protected $data = [];

	/**
	 * @param string $template
	 * @param array $vars
	 */
	public function render($template, $vars = [])
	{
		$templatePath = $this->getTemplatePath($template, ENV);

		if (!is_file($templatePath))
		{
			throw new \InvalidArgumentException(
				sprintf('Template "%s" not found in "%s".', $template, $templatePath)
			);
		}
		
		$this->data = array_merge($this->data, $vars);
		
		$this->theme->setData($this->data);
		extract($this->data);

		ob_start();
		ob_implicit_flush(0);

		try
		{
			require $templatePath;
		}
		catch(\Exception $e)
		{
			ob_end_clean();
			throw $e;
		}

		echo ob_get_clean();
	}
	
	public function setTitle($title = '')
	{
		$this->data['title'] = trim($title) . Config::group('main')['title_ending'];
	}
	
	/**
	 * @param string $template
	 * @param string $env
	 * @return string
	 */
	private function getTemplatePath($template, $env = null)
	{
		
		if ($env == 'App')
		{
			return ROOT_DIR . '/app/View/' . $template . '.php';
		}
		
		return path('view') . DS . $template . '.php';
	}
}
