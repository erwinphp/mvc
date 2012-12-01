<?php
class Products extends Controller {
    
    public $uses = array('Products','Items');

    public function index(){
        echo Config::getThemeFolder();
    }

    public function listado(){
        try{
            $product = $this->loadModel('Product');
            $productView = $this->loadView('ProductList');
            echo $productView->getTableList($product->getColumns(), $product->getProductList());
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
    }

    public function getTableColumns() {
        $product = $this->loadModel('Product');
        return $product->getColumns();// array con las columnas
    }
    
    public function getTableName() {
        $product = $this->loadModel('Product');
        return var_dump($product->getTableName());
    }
	
	public function testView(){
		$this->loadView('sampleView');
	}
	
	public function getProducto(){
		$product = $this->loadModel('Product');
		$product = $product->getProduct(1);
		var_dump($product);
	}
}
?>