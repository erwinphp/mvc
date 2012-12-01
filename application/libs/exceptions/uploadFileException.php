<?php

class UploadFileException extends Exception 
{ 
    protected $message;
    protected $code;
    protected $stringCode;
    protected $fileName;

    public function __construct($code, $message='', $fileName='') { 
        $this->code = $code;
        list($ms, $this->stringCode) = $this->codeToMessageError($this->code);
        if($ms != '') $this->message = $message;
        $this->fileName = $fileName;
        define("UPLOAD_ERR_UNABLE_TO_MOVE",5);
        parent::__construct($this->message, $this->code); 
    }

    public static function codeToMessageError($code) 
    { 
        switch ($code) { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
                $stringCode = 'UPLOAD_ERR_INI_SIZE';
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"; 
                $stringCode = 'UPLOAD_ERR_FORM_SIZE';
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "The uploaded file was only partially uploaded"; 
                $stringCode = 'UPLOAD_ERR_PARTIAL';
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "No file was uploaded"; 
                $stringCode = 'UPLOAD_ERR_NO_FILE';
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Missing a temporary folder"; 
                $stringCode = 'UPLOAD_ERR_NO_TMP_DIR';
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "Failed to write file to disk";
                $stringCode = 'UPLOAD_ERR_CANT_WRITE';
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "File upload stopped by extension"; 
                $stringCode = 'UPLOAD_ERR_EXTENSION';
                break; 
            case UPLOAD_ERR_UNABLE_TO_MOVE:
                $message = "Unable to move file"; 
                $stringCode = 'UPLOAD_ERR_UNABLE_TO_MOVE';
            default: 
                $message = "Unknown upload error"; 
                $stringCode = 'UNKNOWN_UPLOAD_ERROR';
                break; 
        } 
        return array($message,$stringCode); 
    }//end codeToMessageError
    
    public function getStringCode(){
        return $this->stringCode;
    }//end getStringCode
    
    public function getFilename(){
        return $this->fileName;
    }//end getFilename
    
}//end UploadFileException 
?>
