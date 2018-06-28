<?php 
require_once "class/user.php";
require "class/activity.php";
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
	<title>Atividade-selecionada</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">


</head>
<body>

	
	<?php include("./inc/navbarTeacher.php"); ?>

	<!-- Page Content -->
	<div class="content container main-container mt-5">

		<div class="row">
			
			<?php include("./inc/sidebarTeacher.php"); ?><!-- side bar col-md-3 -->

        	<div class="col-md-9 show-activity container-body">
        		
        		<?php include "./inc/comments.php"; ?>
        		
        	<a href="./activity.php?activity_id=<?php echo($idActivity) ?>" class="btn btn-info mt-2">Voltar</a>
        	</div><!-- /.col-lg-6 -->

     
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>




	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">
		
		function enviar(){

		      $.ajax({
		        url:   'autenticCommentsTeacher.php',
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
		    	url:   'autenticCommentsAnswerTeacher.php',
		        type:  'POST',
		        cache: false,
		        data :   $(elemment).serialize(),
		        error: function() {
		        	alert('Erro ao tentar ação!');
		        },
		        success: function(data) {
		          	//alert(data);
		          	console.log($(elemment).find('.formAnswerAjax'));
		          	$(elemment).find('.formAnswerAjax').html(data);
		            //$("elemment").html(data);
		            }
		    });

	      	return false;
	    
	    }

	</script>

</body>
</html>