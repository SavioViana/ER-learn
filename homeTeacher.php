<?php 
require_once "class/user.php";
require "class/activity.php";


	User::autentication();

	$user = new User();
	$activity = new Activity();

	$email = $_SESSION['usuario'];

	$currentUser = $user->getCurrentUser($email);

	$activiesTeacher = $activity->selectActivityTeacher($currentUser->user_id);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Atividade</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">



</head>
<body>

	
	<?php include("./inc/navbarTeacher.php"); ?>

	<!-- Page Content -->
	<div class="content mt-5 container main-container">

		<div class="row">
			
			<?php include("./inc/sidebarTeacher.php"); ?><!-- side bar col-md-3 -->

        	<div class="col-md-9">
        	
				<?php 
        			
        			foreach ($activiesTeacher as $key => $value) {
        				$status = ($value->activity_status == 0) ? "Aberta" : "Concluida";
        				$statusClass = ($value->activity_status == 0) ? "text-danger" : "text-success";
        				?>
        				<div class="card">
        					<h5 class="card-header"><?php echo($value->activity_title); ?></h5>
							<div class="card-body">
		
							    <p class="card-text"><?php echo($value->activity_description) ?></p>
							    <p class="<?php echo($statusClass) ?>"><?php echo($status) ?></p>
							    <a href="activity.php?activity_id=<?php echo($value->activity_id); ?>" class="card-link text-success">Ver mais</a>
						  	</div>
						</div><?php
        			}
        		?>
        	</div><!-- /.col-lg-9 -->
		</div><!--row -->

	</div><!-- /.container -->


	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>