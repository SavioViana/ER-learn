<?php  
	require "class/user.php";
	require "class/activity.php";
	
	$IdActivity =  isset($_POST['id']) ? $_POST['id'] : "";

	$title = isset($_POST['title']) ? $_POST['title'] : "";

	$description = isset($_POST['description']) ? $_POST['description'] : "";



	if (!empty($IdActivity) and !empty($title) and !empty($description)){
		

		$activity = new activity();

		$activity->editActivity($IdActivity, $title, $description );

		echo "<div class='alert alert-success'>
			Atividade Alterada!</div>
			<script>
			setTimeout(function(){ location.href='activity.php?activity_id=$IdActivity'}, 1000);
			</script>";
	}else{
		echo "<div class='alert alert-danger'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Preencha todos os dados corretamente!</div>
			";
	}


?>