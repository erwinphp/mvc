<?php
class sampleView extends View{	
	Public function CurrentTheme($setCurrentTheme){
		$this->setCurrentTheme($setCurrentTheme);
	}
	Public function Css($addCss){
		$this->addCss = $addCss;
	}
	Public function Js($addJs){
		$this->addJs = $addJs;
	}
	Public function value($key, $value){
		$this->setValue($key,$value);
	}
	Public function showpage(){
		$this->dump(true);
	}
	Public function loadpage(){
		$page = $this->dump(false);
		return $page;
	}
}
?>