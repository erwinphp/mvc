<?php
abstract class Model {    
    protected $db;
    protected $table = '';
    protected $columns = '';
	
    public function __construct($connect = false){
        if($connect){
            require_once 'MySQL.php';
            $this->db = MySQL::getInstance();
        }
		$sql = 'SELECT * from '.$this->table;
		$this->db->execute($sql);
		$this->columns = $this->db->getColumns();
    }
    
    public function getTableName(){
        return $this->table;
    }//end getTableName

    public function getColumns(){
        return $this->columns;
    }//end getColumns
    
    public function setVisibilityColumn($column='', $visibility=true){
        if($column != ''){
            if(array_key_exists($column, $this->columns)){
                $this->columns[$column] = $visibility;
            }
            else{
                throw new Exception("Invalid Column: Param " . $column . " is not a column for " . $this->table . " productos");
            }
        }else{
            foreach ($this->columns as $key => $value) {
                $this->columns[$key] = $visibility;
            }
        }
    }//end setVisibilityFunction
}
?>
