<?php
abstract class Controller {
    abstract function index();
    abstract function getTableColumns();
	public function __construct(){
		//Hago un foreach del uses y cargo todos los modelos
    }
    public function loadModel($model){
        $model = ucfirst($model);
        require_once(MODELS.$model.".php");
        return (new $model(true));
    }
    public function loadView($view){
        $view = ucfirst($view);
        require_once(VIEWS.$view.".php");
        return (new $view());
    }
}
?>
