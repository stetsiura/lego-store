<?php

namespace Engine\Core\Template;

class Theme
{
    const RULES_FILE_NAME = [
        "header"  => "header-%s",
        "footer"  => "footer-%s",
        "sidebar" => "sidebar-%s"
    ];

    /**
     * @var array
     */
    protected $data = [];

    /**
     * Theme constructor
     */
    public function __construct()
    {
		// empty
    }

    /**
     * @param string $name
     */
    public function header($name = "")
    {
        $name = (string) $name;
        $file = self::detectFileName($name, __FUNCTION__);

        Component::load($file, $this->data);
    }

    /**
     * @param string $name
     */
    public function footer($name = "")
    {
        $name = (string) $name;
        $file = self::detectFileName($name, __FUNCTION__);

        Component::load($file, $this->data);
    }

    /**
     * @param string $name
     * @param array $data
     */
    public function block($name = "", $data = [])
    {
        $name = (string) $name;

        if ($name !== "")
        {
            Component::load($name, $data);
        }

    }
	
	/**
     * @param string $name
     * @param string $function
	 * @return string
     */
	private function detectFileName($name, $function)
	{
		return empty(trim($name)) ? $function : sprintf(self::RULES_FILE_NAME[$function], $name);
	}

    /**
     * $data getter
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * $data setter
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
