<?php 
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',realpath('..'.DS).DS);
define('CLASS_PATH',ROOT.'application'.DS.'classes'.DS);
define('APPLICATION', ROOT.'application'.DS);
define('MODELS', ROOT.'application'.DS.'models'.DS);
define('CONTROLLERS', ROOT.'application'.DS.'controllers'.DS);
define('VIEWS', ROOT.'application'.DS.'views'.DS);
define('DEFAULT_HTML',VIEWS.'layouts'.DS.'default'.DS);
define('PUBLIC_FOLDER',ROOT.'public'.DS);
require_once(CLASS_PATH.'Config.php');
require_once(CLASS_PATH.'Controller.php');
require_once(CLASS_PATH.'Model.php');
require_once(CLASS_PATH.'View.php');
require_once(CLASS_PATH.'BootStrap.php');
require_once(APPLICATION.'libs'.DS.'exceptions'.DS.'FileNotFoundException.php');
Config::configure();
$url = $_GET['url'];
BootStrap::run($url);

?>
