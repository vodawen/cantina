<?php 
class Controler{
	
	//variable string
	public $url;
	
	public function __construct($url){
		$this->url = $url ;
	}
	
	public function aiguiller(){
		
		switch($this->url) {
				
			default:
				$template = "top/Commandes.phtml";
				$commandes = "TODO";
				include 'Global.phtml';
				break;
		}
	}
}


?>