<?php

if(!class_exists('Db')){
	require "config/db.class.php";
}

class Diagram extends Db{

	function __construct()
	{
		parent::__construct();

		$this->conn = new Db();
	}


	public function addEntities($name, $description, $entities, $fkActivity){
		$sql = "INSERT INTO diagram (diagram_name, diagram_description, diagram_json, fk_activity) VALUES (:NAME, :DESCRIPTION, :JSON, :FK)";

		$param = array(':NAME' => $name,
					':DESCRIPTION' => $description,
					':JSON' => $entities,
					':FK' => $fkActivity );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}


	public function updateEntities($name, $description, $entities, $fkActivity){
		$sql = "UPDATE diagram SET diagram_name = :NAME, diagram_description = :DESCRIPTION, diagram_json = :JSON 
				WHERE fk_activity = :FK";

		$param = array(':NAME' => $name,
					':DESCRIPTION' => $description,
					':JSON' => $entities,
					':FK' => $fkActivity );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}


	public function addRelationships($fkActivity, $relatioshipJson){
		$sql = "UPDATE diagram SET diagram.relatioship_json = :RELATIONSHIPS WHERE diagram.fk_activity = 
			:FK";

		$param = array(':RELATIONSHIPS' => $relatioshipJson,
					':FK' => $fkActivity );

		$stmt = $this->conn->query($sql, $param);
		//print_r($stmt);
		return $stmt;
	}

	

	public function getDiagram($fkActivity){
		$sql = "SELECT * FROM diagram WHERE diagram.fk_activity = $fkActivity";

		$stmt = $this->conn->query($sql);
		
		$diagram = $stmt->fetchAll(PDO::FETCH_OBJ);
		

		return $diagram;

	}

	//retorna 0 ou 1. caso o diagrama tiver ou não relacionamentos
	public function hasDiagramRelationships($fkActivity){
		//$sql = "SELECT COUNT(diagram.diagram_json) as count_diagram_json, COUNT(diagram.relatioship_json) as count_relationship_json FROM diagram WHERE diagram.fk_activity = :FK";

		$sql = "SELECT  count(*) as count_relationship_json from diagram 
				WHERE diagram.fk_activity = :FK AND diagram.relatioship_json != ''";
		$param = array(':FK' => $fkActivity);

		$stmt = $this->conn->query($sql, $param);

		$hasdiagram = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		if($hasdiagram[0]->count_relationship_json == 0){
			return 0;
		}else{
			return 1;
		}

	}

	//retorna 0 ou 1. caso o diagrama tiver ou entidades cadastradas
	public function hasDiagramEntities($fkActivity){

		$sql = "SELECT  count(*) as count_diagram_json from diagram 
				WHERE diagram.fk_activity = :FK AND diagram.diagram_json != ''";
		$param = array(':FK' => $fkActivity);

		$stmt = $this->conn->query($sql, $param);

		$hasEntities = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		if($hasEntities[0]->count_diagram_json <= 0){
			return 0;
		}else{
			return 1;
		}

	}


}