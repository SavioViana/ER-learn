<?php
require ("class/user.php");
require ("class/validation.php");
/*
	$name = $_POST['name'];
	$cpf = $_POST['cpf'];
	$rg = $_POST['rg'];
	$type = $_POST['type'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$publicSpace = $_POST['publicSpace'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];



	$user = new User();

	$u = $user->userAdd($name, $cpf, $rg, $type, $state, $city, $publicSpace, $number, $email, $password, $phone);

	header("Location: login.php?msm=registed");
	*/
	
	if (!isset($_POST) || empty($_POST)) {
		$erro = 'Nada foi postado';
	}


	$name = isset($_POST['name']) ? $_POST['name'] : "";
	$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
	$rg = isset($_POST['rg']) ? $_POST['rg'] : "";
	$type = isset($_POST['type']) ? $_POST['type'] : "";
	$state = isset($_POST['state']) ? $_POST['state'] : "";
	$city = isset($_POST['city']) ? $_POST['city'] : "";
	$publicSpace = isset($_POST['publicSpace']) ? $_POST['publicSpace'] : "";
	$number = isset($_POST['number']) ? $_POST['number'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";
	$phone = isset($_POST['phone']) ? $_POST['phone'] : "";


	$v = new Validation();
	//name
	if($v->simpleValidation("Nome", $name, '70', '5')){
		$msg = $v->simpleValidation("Nome", $name, '70', '5')." *";
		echo "<script>
		document.getElementById('errorName').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorName').innerHTML=''
		</script>";
	}


	//cpf
	if($v->cpfValidation($cpf)){
		$msg = $v->cpfValidation($cpf)." *";
		echo "<script>
		document.getElementById('errorCpf').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorCpf').innerHTML=''
		</script>";
	}


	//rg
	//falta validação completa
	if($v->numberValidation("RG", $rg)){
		$msg = $v->numberValidation("RG", $rg)." *";
		echo "<script>
		document.getElementById('errorRg').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorRg').innerHTML=''
		</script>";
	}


	//type

	//state

	//city
	if($v->simpleValidation("Cidade", $city, '70', "2")){
		$msg = $v->simpleValidation("Cidade", $city, '70', "2")." *";
		echo "<script>
		document.getElementById('errorCity').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorCity').innerHTML=''
		</script>";
	}

	//publicSpace
	if($v->simpleValidation("Logradouro", $publicSpace, '255', "2")){
		$msg = $v->simpleValidation("Logradouro", $publicSpace, '255', "2")." *";
		echo "<script>
		document.getElementById('errorPublicSpace').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorPublicSpace').innerHTML=''
		</script>";
	}

	//number
	if($v->numberValidation("Nº", $number)){
		$msg = $v->numberValidation("Nº", $number)." *";
		echo "<script>
		document.getElementById('errorNumber').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorNumber').innerHTML=''
		</script>";
	}

	//email
	if($v->emailValidation($email)){
		$msg = $v->emailValidation($email)." *";
		echo "<script>
		document.getElementById('errorEmail').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorEmail').innerHTML=''
		</script>";
	}

	//password
	if($v->simpleValidation("Senha", $password, '255', "5")){
		$msg= $v->simpleValidation("Senha", $password, '255', "5")." *";
		echo "<script>
		document.getElementById('errorPassword').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorPassword').innerHTML=''
		</script>";
	}


	//telefone
	if($v->phoneValidation($phone)){
		$msg = $v->phoneValidation($phone);
		echo "<script>
		document.getElementById('errorPhone').innerHTML='$msg'
		</script>";
	}else{
		echo "<script>
		document.getElementById('errorPhone').innerHTML=''
		</script>";
	}


	//verifico se ha erros
	if($v->status()){
		$user = new User();

		$u = $user->userAdd($name, $cpf, $rg, $type, $state, $city, $publicSpace, 
							$number, $email, $password, $phone);

		echo "<script>
		window.location.replace('login.php?msg=registed');
		</script>";

	}else{
			echo "<div class='alert alert-danger fade show' role='alert'>
          <a  data-dismiss='alert' class='close'>&times;</a>
          Preencha o formulario corretamente!
        </div>";
	}


?>