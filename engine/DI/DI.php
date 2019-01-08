<?php

namespace Engine\DI;

class DI
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @param string $key
     * @param mixed $value
     * @return DI $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }
	
	public function push($key, $element = [])
	{
		if ($this->has($key)) {
			$this->set($key, []);
		}
		
		if (!empty($element)) {
			$this->container[$key][$element['key']] = $element['value'];
		}
		
		array_push($this->container[$key], $value);
	}
}
