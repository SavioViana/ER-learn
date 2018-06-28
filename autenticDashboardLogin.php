<?php 

require "class/admin.php";


$username = $_POST['username'];
$password = $_POST['password'];



$admin = new Admin();

$autentication = $admin->login($username, $password);

if($autentication){

	echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Login efetuado com sucesso! Redirecionando...</div> <script>
			setTimeout(function(){ location.href='dashboard.php'}, 1000);
		</script>";

}else{
	//echo "<div class='alert alert-danger'>Login ou senha invalido .</div>";
	echo "<div class='alert alert-danger fade show' role='alert'>
          <a  data-dismiss='alert' class='close'>&times;</a>
          usuario ou senha invalido
        </div>";
}


 ?>