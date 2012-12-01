<?php
class BootStrap {
    static function run($url){
        $params = explode("/",$url);
        $controller = filter_var($params[0],FILTER_SANITIZE_URL);
		// echo($url);
		// echo($controller);
		// exit();
        array_shift($params);
        $method = filter_var($params[0],FILTER_SANITIZE_URL) ;
        if(empty($method))$method = 'index';
		array_shift($params);
        $args = array_filter($params);
        $controller = ucfirst($controller);
        if(file_exists(APPLICATION.'controllers'.DS.$controller.'.Controller'.'.php')){
            require APPLICATION.'controllers'.DS.$controller.'.Controller'.'.php'; 
            $controlador = new $controller();
        }        
        if(is_callable(array($controlador,$method))){
            $metodo = $method;
            call_user_func_array(array($controlador,$metodo),$args);
        }
    }
}
?>
