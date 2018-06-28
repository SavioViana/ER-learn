<?php 
require_once "class/diagram.php";


$fkActivity = $_GET['activity_id'];

$relationships = $_POST['relationship'];

//print_r($relationships);


$relationshipsJson  =  json_encode($relationships);

$diagram = new Diagram();

$diagram->addRelationships($fkActivity, $relationshipsJson);


echo("Relacionamento alterado com sucesso!");


?>