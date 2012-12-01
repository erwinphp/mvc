<?php
class Config {
	static $url = 'localhost/proyectos/mvc-expertophp/';
	static $img_path = 'img/';
	static $relative_path;
	static $dbUsr = 'root';
	static $dbPass = '';
	static $dbHost = 'localhost';
	static $dbName = 'expertophp';
	static $cnxType = 'MySQL';
	static $rootFolder;
	static $ds;
	static $appPath;
	static $css_path = 'css/';
	static $js_path = 'js/';
	static $themeFolder = 'layouts';
	static $ga_account = '12345678-9';
	static $template = 'default';

	static function configure() {
		self::$ds = DIRECTORY_SEPARATOR;
		self::$rootFolder = realpath(__DIR__).self::$ds;
	}
	static function setUrl($url){
		self::$url = $url;
	}
	static function getUrl(){
		return 'http://'.self::$url;
	}
	static function getRootFolder(){
		return self::$rootFolder;
	}
	static function getCssPath(){
		return PUBLIC_FOLDER.self::$css_path;
	}
	static function getJsPath(){
		return PUBLIC_FOLDER.self::$js_path;
	}
	static function getThemeFolder(){
		return APPLICATION.'views'.DS.self::$themeFolder.DS;
	}
}
?>
