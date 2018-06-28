<?php 
require_once('class/user.php');

$id = $_POST['id'];
$email = $_POST['email'];



$user = new User();


	$valid = $user->emailEdit($id, $email);

	//print_r($valid);
	echo "Email atualizado";

	//User::desLogin();


 ?>