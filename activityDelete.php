<?php  
	require "class/user.php";
	require "class/activity.php";
	
	$IdActivity =  isset($_GET['activity_id']) ? $_GET['activity_id'] : "";


	if (!empty($IdActivity)){
		
		$activity = new activity();

		$activityData = $activity->selectActivity($IdActivity);
		$fkStudentGroup = $activityData->fk_student_group;
		
		$activity->deleteActivity($IdActivity);

		echo "<div class='alert alert-success'>
			Atividade Apagada!</div>
			<script>
			setTimeout(function(){ location.href='studentMy.php?group=$fkStudentGroup'}, 1000);
			</script>";
	}else{
		echo "<div class='alert alert-danger'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			Erro ao Apagar Atividade</div>
			";
	}


?>