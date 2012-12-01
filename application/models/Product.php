<?php
class Product extends Model {
    protected $table = 'productos';
   /* protected $columns = array('cod_produc'    => false, 
                               'nombre'        => true,
                               'descripcion'   => true,
                               'precio'        => true,
                               'estado'        => false);
							   */
    
    public function getProductList(){
        $sql = "SELECT * from " . $this->table;
        $this->db->execute($sql);
        $results = $this->db->loadObjectList();
        return $results;

    }

    public function getProduct($id){
		
       $sql = 'SELECT * FROM ' . $this->table . ' WHERE cod_produc = ?';
	   $this->db->prepareStatement($sql);
       $this->db->bindVariables(array($id=>'i'));
	   $this->db->executeStmt();
       $result = $this->db->loadObject();
       return $result;
    }

    public function getTotalProducts($status=1){
        $status = $this->db->sanitize($status,'int');
        $sql = 'SELECT * from ' . $this->table . ' where status ='.$status;
        $this->db->execute($sql);
        $rows =  $this->db->getNumRows();
        return $rows;
    }

    public function doInsert(ProductVO $product){
        $nombre = $this->db->sanitize($product->getNombre());
        $descripcion = $this->db->sanitize($product->getDescripcion());
        $precio = $this->db->sanitize($product->getPrecio(),'float');
        $status = $this->db->sanitize($product->getStatus(),'int');
        $sql = 'INSERT into ' . $this->table . ' SET nombre = '.$nombre.', descripcion ='.$descripcion.', precio = '.$precio.', estado = '.$status;
        if($this->db->execute($sql)){
			$product->setCod_Producto($this->db->getInsertId());
			return true;
        }
    }
}
?>
