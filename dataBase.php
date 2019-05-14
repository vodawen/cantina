<?php

class dataBase
{

    private $pdo;
    private $host;
    private $dbName;
	private $user;
	private $mdp;
    private $options = array();
    
    public function __construct($host, $user, $mdp, $dbName, $options = [])
    { 
        $this->host = $host;
		
        $this->dbName = $dbName;
		
		$this->user = $user;
				
		$this->mdp = $mdp;
	
        $this->options = $options;  

		$this->initPDO();
    }
    
    public function initPDO()
    {
        $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->mdp, $this->options);
		$this->pdo->exec ('SET NAMES UTF8');
    }
    
    public function queryAll($sql, array $params=[])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
		$output = $query->fetchAll();
		return $output;
	}
	
	public function queryOne($sql, array $params=[])
    {
        $query = $this->pdo->prepare($sql);
        $query_Post->execute([$params]);
		$output = $query_Post->fetch();
		return $output;
	}
	
	 public function queryAction($sql, array $params=[])
    {
        $query =$this->pdo->prepare($sql);
        return $query->execute($params);
    }
	
}
    
    


?>