<?php 
require_once('class/user.php');

$id = $_POST['id'];
$password = $_POST['password'];
$passwordNew = $_POST['passwordNew'];

$user = new User();


if ($password == $passwordNew){
	$user->passwordEdit($id, $passwordNew);

	echo "senha alterada";
}else{
	echo "Senhas não conferem";
}



 ?>