<?php

class Commandes
{
	private $descriptions;
	private $titres;
	private $reservations;
	private $CommandesBDD;

	
    
	private $dumping = false;
	
	//vas chercher dans la base de donnée
	public function getCmds(){
	    include 'dataBase.php'; 
    	$db = new dataBase('localhost', 'root', '', '4h',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    	$this->CommandesBDD = $db->queryAll("SELECT * FROM commandes");
	}
	


	//trie le tableau
	public function OrdonnerCommandes($dumping = false){
	    $cmdBDD = $this->CommandesBDD;
	    $NbreCmds = count($cmdBDD);
    	$currentMaxRsv = 0 ;
    	$Commandes =[];
    	for ($i = 0 ; $i < $NbreCmds ; $i++ ){
    		
    		if ($dumping == true ){var_dump ("_________________________________occurences : ". $i);}
    		
    		foreach($cmdBDD as $Commande){
    			// trouve le nombre de reservations le plus important
    			if ($currentMaxRsv <= $Commande['Reservations']){
    				$currentMaxRsv = $Commande['Reservations'];
    				if ($dumping == true ){var_dump ("reservations de la cmd actuelle : ".$Commande['Reservations']);}
    				if ($dumping == true ){var_dump ("RsvMax : ".$currentMaxRsv);}
    			}
    			
    		}
    		
    			
    		foreach($cmdBDD as $Index => $Commande){
    		
    			//celui qui a ce nombre de reservations est rangé dans l'itération de la boucle
    			
    			if ($currentMaxRsv == $Commande['Reservations']){
    				$Commandes[$i] = $Commande;
    				$cmdBDD[$Index]['Reservations'] = 0 ;
    				if ($dumping == true ){var_dump ($Commande);}
    			}
    		}
    		$currentMaxRsv = 0 ;
    		
    	}
    	if ($dumping == true ){var_dump ("________Reservations");}
    
    	foreach ($Commandes as $Index => $Commande){
    	    $this->reservations[$Index] = $Commandes[$Index]['Reservations'];
    		
    	}
    	if ($dumping == true ){var_dump ($this->reservations);}
    
    	if ($dumping == true ){var_dump ("________Descriptions");}
    
    	foreach ($Commandes as $Index => $Commande){
    	    $this->descriptions[$Index] = $Commandes[$Index]['Descriptions'];
    		
    	}
    	if ($dumping == true ){var_dump ($this->descriptions);}
	}

	public function CreateCmdHTML($indice){
	    $des = $this->descriptions;
	    $res = $this->reservations;
	    $htmlOutput = "<div>";
    	if (array_key_exists ( $indice , $des )){
    	    $htmlOutput = $htmlOutput."<h2>{$des[$indice]}</h2>
            <p>{$res[$indice]}reservations</p>
            <href class='rsv' >reserver</href><href class='more' ></href>";
    	}
    	
    	else{
    		
    	}
    	$htmlOutput = $htmlOutput."</div>";
    	return $htmlOutput;
    }
}

?>