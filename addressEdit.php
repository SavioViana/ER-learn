<?php 
require_once('class/user.php');

$id = $_POST['id'];
$state = $_POST['state'];
$city = $_POST['city'];
$publicSpace = $_POST['publicSpace'];
$number = $_POST['number'];
$phone = $_POST['phone'];


$user = new User();


	$valid = $user->addressEdit($id, $state, $city, $publicSpace, $number, $phone);

	//print_r($valid);
	echo "Endereço alterado";


 ?>