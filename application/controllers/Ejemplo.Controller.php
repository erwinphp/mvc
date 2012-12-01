<?php
class Ejemplo extends Controller {// cambiar nombre de clase
    public $uses = array('Products','Items');
	
	public function testView(){
		$vista = $this->loadView('sampleView');
		$vista->CurrentTheme("default");
		$vista->Css("estilo1.css"); 
		$vista->Js("javascript.js");
		$vista->value("body",$this->listado()."<a href='".Config::getUrl()."public/products/listado/'> Ir a algun lugar</a>");
		$vista->value("titulo","Mi titulo");
		$vista->value("copyright","Erwin lo hizo!");
		$vista->showpage();
	}
	
    public function index(){
        echo Config::getThemeFolder();
    }

    public function listado(){
        try{
            $product = $this->LoadModel('Product');
            $productView = $this->loadView('ProductList');
            $tabla = $productView->getTableList($product->getColumns(), $product->getProductList());
        }catch(LengthException $ex){
            echo $ex->getMessage() . "</br>";
            echo $ex->getFile() . "(Line: " . $ex->getLine() . ") => " . $ex->getTraceAsString();
        }catch(FileNotFoundException $ex){
            echo $ex->getMessage() . "</br>";
            echo $ex->getFile() . "(Line: " . $ex->getLine() . ") => " . $ex->getTraceAsString();
        }catch(Exception $ex){
            echo $ex->getMessage() . "</br>";
            echo $ex->getFile() . "(Line: " . $ex->getLine() . ") => " . $ex->getTraceAsString();
        }
		return $tabla;
    }

    public function getTableColumns() {
        $product = $this->loadModel('Product');
        return $product->getColumns();
    }
    
    public function getTableName() {
        $product = $this->loadModel('Product');
        return $product->getTableName();
    }
	
	
	public function getProducto(){
		$product = $this->loadModel('Product');
		$product = $product->getProduct(1);
		var_dump($product);
	}
}
?>