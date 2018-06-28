<?php  
	require "class/user.php";
	require "class/activity.php";
	
	$groupId =  isset($_GET['groupId']) ? $_GET['groupId'] : "";

	$title = $_POST['title'];

	$description = isset($_POST['description']) ? $_POST['description'] : "";



	if (!empty($groupId) and !empty($title) and !empty($description)){
		

		$activity = new activity();

		$activity->addActivity($groupId, $title, $description );

		echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Atividade adicionada!</div>
			<script>
			setTimeout(function(){ location.href='studentMy.php?group=$groupId'}, 1000);
			</script>";
	}else{
		echo "<div class='alert alert-danger'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Preencha todos os dados corretamente!</div>
			";
	}


?>