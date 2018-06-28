<?php 
require_once "class/user.php";
require "class/activity.php";

	User::autentication();

	$activity = new Activity();

	$mail = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Pagina Inicial</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5 main-container">
		
		

				<?php 

				$activities = $activity->selectActivityGroupStudent($mail);
				//print_r($activities);
				$status;
				$statusClass;

				
				foreach ($activities as $key => $value) { 

					if($value->activity_status == 0){
						$status = "aberta";
						$statusClass = "text-danger";
					}else{
						$status = "Concluida";
						$statusClass = "text-success";
					}
				?>
					<div class="card bg-light mb-3">
						<h5 class="card-header"><?php echo($value->activity_title); ?></h5>
						<div class="card-body">
						    <p class="card-text"><?php echo($value->activity_description) ?></p>
						    <p class="<?php echo($statusClass) ?>"><?php echo($status) ?></p>
						    <a href="./activitySelected.php?activity_id=<?php echo($value->activity_id); ?>" class="btn btn-primary">Abrir</a>
					  	</div>
					</div><?php
				}
        		?>
        	</div><!-- /.col-lg-9 -->
		</div><!--row -->

	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>