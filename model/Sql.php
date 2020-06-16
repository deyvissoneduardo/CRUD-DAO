<?php

class Sql extends PDO{

    private $conn;

    /* metodo que conecta automaticamente
    */
    public function __construct(){
        
        $this->conn = new PDO("mysql:host=127.0.0.1;dbname=myprojeto", "root", "root");
        
    }

    /* 
    * bindParam para varios paramentros
    */ 
    private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}

	}

    /* 
    * bindParam para um paramentro
    */ 
    private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}

    /*
    * metodo para executa query
    */
    public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
    }

    
    /*
    * executa select na tabela
    */
    public function select($rawQuery, $params = array()):array {
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
