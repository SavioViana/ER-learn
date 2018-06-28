<?php 
require_once "class/diagram.php";

//$activity_id = isset($_GET['activity_id']) ? $_GET['activity_id'] : "" ;

$nameDer = isset($_POST['nameDer']) ? $_POST['nameDer'] : "" ;
$descriptionDer = isset($_POST['descriptionDer']) ? $_POST['descriptionDer'] : "";

$fkActivity = isset($_POST['fkActivity']) ? $_POST['fkActivity'] : "";


$entities = isset($_POST['entities']) ? $_POST['entities'] : "" ;

$dados;

if(empty($nameDer) || empty($fkActivity)){
	echo("preencha os dados obrigatorio");
}else{

	if(empty($entities[0]['name']) ){
		echo "Necessario no minimo uma editidade para ser salva";
	}else{
		if(empty($entities[0][0]) || empty($entities[0][2])){
			echo "Necessario no minimo dois atributos para ser salva";
		}else{

			//codigo aki;
			$dados = json_encode($entities);

			$diagram = new Diagram();

			$diagram->addEntities($nameDer, $descriptionDer, $dados, $fkActivity);


			echo "Entidades Adicionada";
			

		}
	}

}
/*
$dados['entities'] = $entities;

print_r(json_encode($dados));
//print_r(json_encode($entities));
*/



?>