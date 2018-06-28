<?php 
require_once('class/user.php');

$id = $_POST['id'];
$name = $_POST['name'];



$user = new User();


	$valid = $user->nameEdit($id, $name);

	//print_r($valid);
	echo "Nome atualizado";


 ?>