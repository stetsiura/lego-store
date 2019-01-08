<?php

namespace Engine\Core\Template;

class Component
{
	/**
     * @param string $fileName
     * @param array $data
     */
	public static function load($fileName, $data = [])
	{
		$templateFile = ROOT_DIR . "/app/View/" . $fileName . ".php";
		
		if (ENV == "Admin")
		{
			$templateFile = path('view') . "/" . $fileName . ".php";
		}

        if (is_file($templateFile))
        {
            extract($data);
            require $templateFile;
        }
        else
        {
            throw new \InvalidArgumentException(
                sprintf('View file "%s" does not exist!', $templateFile)
            );
        }
	}
}