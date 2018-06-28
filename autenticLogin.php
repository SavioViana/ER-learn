<?php 

require "class/user.php";

$email = $_POST['email'];
$password = $_POST['password'];



$user = new User();

$autentication = $user->login($email, $password);

if($autentication){
	
	if($user->type == 1) $userType = "homeTeacher.php";
	if($user->type == 2) $userType = "homeStudent.php";


	echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Login efetuado com sucesso! Redirecionando...</div> <script>
			setTimeout(function(){ location.href='$userType'}, 1000);
		</script>";

}else{
	//echo "<div class='alert alert-danger'>Login ou senha invalido .</div>";
	echo "<div class='alert alert-danger fade show' role='alert'>
          <a  data-dismiss='alert' class='close'>&times;</a>
          Login ou senha invalido
        </div>";
}


 ?>