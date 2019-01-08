<?php

use \Engine\App;
use \Engine\DI\DI;

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/Functions.php";

class_alias('Engine\\Core\\Template\\Asset', 'Asset');
class_alias('Engine\\Core\\Template\\Theme', 'Theme');
class_alias('Engine\\Helper\\Redirect', 'Redirect');
class_alias('Engine\\Helper\\Session', 'Session');
class_alias('Engine\\Helper\\Cookie', 'Cookie');
class_alias('Engine\\Helper\\Render', 'Render');
class_alias('Engine\\Helper\\Common', 'Common');
class_alias('Engine\\Helper\\Validator', 'Validator');
class_alias('Engine\\Helper\\AuthUtils', 'AuthUtils');
class_alias('Engine\\Helper\\AdminUrl', 'AdminUrl');
class_alias('Engine\\Helper\\AdminHtml', 'AdminHtml');
class_alias('Engine\\Helper\\Url', 'Url');
class_alias('Engine\\Helper\\Html', 'Html');
class_alias('Engine\\Helper\\Sanitize', 'Sanitize');

session_start();

try
{
    // Dependency injection
    $di  = new DI();

    $services = require __DIR__ . "/Config/Service.php";
	
	// Init services
	foreach($services as $service) {
		$provider = new $service($di);
		
		$provider->init();
	}

    $app = new App($di);

    $app->run();
}
catch(\ErrorException $e)
{
    echo $e->getMessage();
}
