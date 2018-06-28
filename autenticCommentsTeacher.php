<?php 
require_once "class/user.php";
require_once "class/comments.php";

User::autentication();

$user = new User();

$email = $_SESSION['usuario'];

$currentUser = $user->getCurrentUser($email);



	//echo($currentUser->user_id);

$title = isset($_POST['title']) ? $_POST['title'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";

$fkActivity = isset($_POST['fkActivity']) ? $_POST['fkActivity'] : "";



if(empty($title) || empty($description)){
	
	echo "<div class='alert alert-danger fade show' role='alert'>
          <a  data-dismiss='alert' class='close'>&times;</a>
          Preencha o formulario corretamente
        </div>";

}else{
	
		$commentsObj = new Comments();


		$commentsObj->addComments($title, $description, $fkActivity, $currentUser->user_id);

		echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			enviando...</div> <script> setTimeout(function(){ location.href='commentsTeacher.php?activity_id=$fkActivity'}, 1000) </script> ";
}

?>