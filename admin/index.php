<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('max_execution_time', 300);

define("ROOT_DIR", __DIR__);
define("FILE_ROOT_DIR", dirname(dirname(__FILE__)));
define("DS", DIRECTORY_SEPARATOR);
define("ENV", "Admin");
define("SRV", "DEV");

define("UPLOADS_PATH", DS . "content" . DS . "uploads" . DS);
define("UPLOADS_THUMBS_PATH", DS . "content" . DS . "uploads" . DS . "thumbs" . DS);

define("TEMPLATES_PATH", DS . "content" . DS . "templates" . DS);
define("SLIDER_PATH", DS . "content" . DS . "slider" . DS);

define("CLIENT_UPLOADS_PATH", "/content/uploads/");
define("CLIENT_UPLOADS_THUMBS_PATH", "/content/uploads/thumbs/");

define("CLIENT_SLIDER_PATH", "/content/slider/");

require_once "../debug/debug.php";
require_once "../engine/bootstrap.php";
