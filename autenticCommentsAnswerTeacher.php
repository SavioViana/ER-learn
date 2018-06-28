<?php 

require_once "class/user.php";
require_once "class/comments.php";

User::autentication();

$user = new User();

$email = $_SESSION['usuario'];

$currentUser = $user->getCurrentUser($email);

$descriptionAnswer = isset($_POST['description-answer']) ? $_POST['description-answer'] : "";
$fkActivity = isset($_POST['activity-id']) ? $_POST['activity-id'] : "";

$idComment = isset($_POST['comments-id']) ? $_POST['comments-id'] : "";

$commentsObj = new Comments();


//$comment = $commentsObj->getComment($idComment);



if(empty($descriptionAnswer || empty($idComment))){

	echo "<div class='alert alert-danger fade show' role='alert'>
          <a  data-dismiss='alert' class='close'>&times;</a>
          Preencha sua duvida
        </div>";

}else{

	
		$commentsObj->addComments(null, $descriptionAnswer, $fkActivity, $currentUser->user_id, $idComment);

		echo "<div class='alert alert-success'>
			<a  data-dismiss='alert' class='close'>&times;</a>
			enviando...</div> <script> setTimeout(function(){ location.href='commentsTeacher.php?activity_id=$fkActivity'}, 1000) </script> ";
	
}

?>