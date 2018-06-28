<?php  
	require "class/user.php";
	require "class/studentGroup.php";

	$fkAluno = isset($_GET['aluno']) ? $_GET['aluno'] : '';

	if (!empty($fkAluno)){
		
		$user = new User();
		$group = new StudentGroup();

		$email = $_SESSION['usuario'];
		$sql = "SELECT * FROM user where user_email = '$email'";

		$stmt = $user->conn->query($sql);
		$datas = $stmt->fetchAll(PDO::FETCH_OBJ);
		$teacher = $datas[0];

		$group->addGroup($teacher->user_id, $fkAluno);

		echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Aludo adicionado!</div>
			<script>
			setTimeout(function(){ location.href='students.php'}, 1000);
			</script>";

		//setTimeout(function(){ location.href='students.php'}, 1000);
	}

	

	//print_r($teacher);



?>