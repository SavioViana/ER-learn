<?php 
require_once "class/user.php";
require_once "class/comments.php";

	User::autentication();

	$idActivity = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";

	$commentsObj = new Comments();

	$comments = $commentsObj->getComments($idActivity);

	$user = new User();

	$email = $_SESSION['usuario'];

	$currentUser = $user->getCurrentUser($email);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Atividade Selecionada</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">

</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5 main-container container-body">

		<?php include "./inc/comments.php" ?>

		<a href="./activitySelected.php?activity_id=<?php echo($idActivity) ?>" class="btn btn-info mt-2">Voltar</a>
	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

	<script type="text/javascript">


		function enviar(){

		      $.ajax({
		        url:   'autenticComments.php',
		       type:  'POST',
		       cache: false,
		       data :   $("#commentsForm").serialize(),
		       error: function() {
		         alert('Erro ao tentar ação!');
		       },
		       success: function(data) {
		              //alert(data);
		              $("#ajaxResultComments").html(data);
		            }
		          });

	      	return false;
	    }


	    function enviarAnswer(elemment){


	    	$.ajax({
		    	url:   'autenticCommentsAnswer.php',
		        type:  'POST',
		        cache: false,
		        data :   $(elemment).serialize(),
		        error: function() {
		        	alert('Erro ao tentar ação!');
		        },
		        success: function(data) {
		          	//alert(data);
		            $(elemment).find('.formAnswerAjax').html(data);
		            }
		    });

	      	return false;
	    
	    }



	</script>
</body>
</html>