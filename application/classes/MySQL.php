<?php
class MySQL {
	protected static $_instance = NULL;
	protected $_conexion = NULL;
	protected $query;
	protected $result;
	protected $idInstance;
	protected $stmt;
    protected $num_rows;
	
	public static function getInstance(){
		if(!self::$_instance instanceof self){
			self::$_instance = new self;
		}
		return self::$_instance;
		
	}
	protected function __construct(){
		$this->_conexion = new MySQLi(Config::$dbHost,config::$dbUsr,config::$dbPass,config::$dbName);
		$this->idInstance = rand(1,10);
	}
	public function setQuery($sql){
		$this->query = $sql;
	}
	public function execute($sql=""){
		if($sql != ""){
			$this->query = $sql;
		}
		if($this->query != ""){
			$this->result = $this->_conexion->query($this->query);
                        $this->num_rows = $this->result->num_rows;
		}
		
	}
	public function loadObjectList(){
		if($this->num_rows > 0){
			$arrResults = array();
			
			while($row = $this->result->fetch_object()){
			$arrResults[] = $row;
			}
			return $arrResults;
		
		}
		return false;
	}

        public function loadObject(){
            if($this->num_rows == 1){
                $result = $this->result->fetch_object();
                return $result;
            }
            return false;
        }

        public function sanitize($param,$dataType='string'){
            //Falta llamado a una clase que se encargue de sanitizar los caracteres html
            $response = false;
            switch($dataType){
                case 'i':
                   if(is_int($param)){
                    $response = $param;
                   }
                    break;
                case 'f':
                    if(is_float($param)){
                        $response = $param;
                    }
                    break;
                default:
                    $response  = '"'.$this->_conexion->real_escape_string($param).'"';
                    break;
            }
            return $response;
        }

	public function getIdInstance(){
		return $this->idInstance;
	}

    public function getNumRows(){
            return $this->num_rows;
        }

    public function getInsertId(){
            return $this->_conexion->insert_id;
        }
	public function getColumns(){
		return $this->result->fetch_fields();
	}
	
	public function prepareStatement($sql){
		$this->stmt = $this->_conexion->prepare($sql);
		print_r($this->stmt);
	}
	
	public function bindVariables($variables){

		foreach($variables as $variable => $type){
			$var[] = $this->sanitize($variable,$type);
			$typeString .= $type;
			}
			$vars = implode(",",$var);
			$this->stmt->bind_param($typeString,$vars);
	}
	
	public function executeStmt(){
		$this->stmt->execute();
		//print_r($this->stmt->bind_result());
		}
}