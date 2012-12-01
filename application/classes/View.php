<?php
abstract class View {
    public $head;
    public $basicTablePath = 'basic-table.html';
	protected $css;
	protected $js;
	protected $scripts;
	protected $currentTheme;
	protected $_templateKeys;
	protected $_templateValues;
    
	public function setCurrentTheme($theme='default'){
		$this->currentTheme = $theme;
	}
	
    public function getTableList($headData, $bodyData){    
        if( !file_exists(DEFAULT_HTML.$this->basicTablePath) ){
            throw new FileNotFoundException("Archivo no encontrado", $this->basicTablePath);
        }
        $table = file_get_contents(DEFAULT_HTML.$this->basicTablePath);
        $headValues = array_values($headData);
        $tableBody = '';
        foreach ($bodyData as $key => $rowValue) {    
            $tableBody .= '<tr>';
            if(sizeof($headData) != sizeof((array)$rowValue)) {
                throw new LengthException("size of head is diferent to body data ");
            } 
            foreach ( array_values((array)$rowValue) as $cellKey => $cellValue ) {
                if( !((Boolean)$headValues[$cellKey]) ){
                    $tableBody .= '<td style="display:none;">' . $cellValue . '</td>';
                }else{
                    $tableBody .= '<td>' . $cellValue . '</td>';
                }                
            }
            $tableBody .= '</tr>';
        }
        
        $tableHead = '';
        foreach ($headData as $key => $value) {
            if( !((Boolean)$value) ){
                $tableHead .= '<th scope="col" style="display:none;">'.$key.'</th>';
            }else{
                $tableHead .= '<th scope="col">'.$key.'</th>';
            } 
        }
        
        $table = str_replace('{head_data}', $tableHead, $table);
        return str_replace('{body_data}', $tableBody, $table);
    }
    public function loadController($controller){
        $controller = ucfirst($controller);
        require_once(CONTROLLERS.$controller."Controller.php");
        return (new $controller(true));
    }
	
	public function addCss($cssFile,$media='all'){
		try {
			if(file_exists(Config::getCssPath().$cssFile)){
				$this->css[] = '<link href="css/'.$cssFile.'" rel="stylesheet" type="text/css" media="'.$media.'"/>';
			}
			else {
				throw new FileNotFoundException("archivo no encontrado");
			}
		}catch(FileNotFoundException $ex){
			echo $ex->getMessage() . "</br>";
            echo $ex->getFile() . "(Line: " . $ex->getLine() . ") => " . $ex->getTraceAsString();
		}
	}
	
	public function addJs($JsFile,$media='all'){
		try {
			if(file_exists(Config::getJsPath().$JsFile)){
				$this->js[] = '<script src="js/'.$JsFile.'" type="text/javascript"></script>';
			}
			else {
				throw new FileNotFoundException("archivo no encontrado");
			}
		}catch(FileNotFoundException $ex){
			echo $ex->getMessage() . "</br>";
            echo $ex->getFile() . "(Line: " . $ex->getLine() . ") => " . $ex->getTraceAsString();
		}
	}
	
	public function setValue($key,$value){
		$this->_templateKeys[] = '{'.$key.'}';
		$this->_templateValues[] = $value;
	}
	
	public function dump($output = false){
		$this->htmlScript = "";
		$css_files = "";
		$js_files = "";
		if($this->css){
			foreach($this->css as $css){
				$css_files .=$css;
			}
		}
		if($this->js){
			foreach($this->js as $js){
				$js_files .=$js;
			}
		}
		$this->setValue('css_scripts',$css_files);
		$this->setValue('js_scripts',$js_files);
		$html  = $this->getThemeFile('header.html')."\r\n";
		$html .= $this->getThemeFile('content.html')."\r\n";
		$html .= $this->getThemeFile('footer.html');
		$content = str_ireplace($this->_templateKeys,$this->_templateValues,$html);
		if($output){
			echo $content;
		}else{
			return $content;
		}	
	}
	public function getThemeFile($file){
		$fileContent = '';
		if(file_exists(Config::getThemeFolder().$this->currentTheme.'/'.$file)){
			$fileContent = file_get_contents(Config::getThemeFolder().$this->currentTheme.DS.$file);
		} else {
			throw new FileNotFoundException('Archivo no encontrado');
		}
		return $fileContent;
	}
}
?>