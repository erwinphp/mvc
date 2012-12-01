<?php

class FileNotFoundException extends Exception{
    
    protected $file = "Unknown";
    protected $message = "Archivo no encontrado";
    
    public function __construct($message, $file) {
        if($message != '')$this->message = $message;
        if($file != '')$this->file = $file;
        parent::__construct($this->message . ": " . $this->file);
    }
    
    protected function getFileName(){
        return $this->file;
    }
}
?>
