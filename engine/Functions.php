<?php

/**
 * @param string $section
 * @return string
 */
function path($section)
{
	switch(strtolower($section)) {
		
		case "controller":
			return ROOT_DIR . DS . "Controller";
		case "config":
			return ROOT_DIR . DS . "Config";
		case "model":
			return ROOT_DIR . DS . "Model";
		case "view":
			return ROOT_DIR . DS . "View";
		default:
			return ROOT_DIR;
	}
}