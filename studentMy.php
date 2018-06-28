<?php 
require_once "class/user.php";
require_once "class/studentGroup.php";
require "class/activity.php";

	User::autentication();

				
	$user = new User();

	$email = $_SESSION['usuario'];

	$currentUser = $user->getCurrentUser($email);

	

	$activity = new Activity();
	$studentGroupObj = new StudentGroup();

	$idGroup = isset($_GET['group']) ? $_GET['group'] : "";

	$studentMy = $studentGroupObj->studentGroup($idGroup);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Atividades-deste-estudante</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">

</head>
<body>

	
	<?php include("./inc/navbarTeacher.php"); ?>

	<!-- Page Content -->
	<div class="content container mt-5 main-container ">

		<div class="row">
			
			<?php include("./inc/sidebarTeacher.php"); ?><!-- side bar col-md-3 -->

        	<div class="col-md-6">
        		<?php 
        			$fkGroup = isset($_GET['group']) ? $_GET['group'] : "";

        			$activities = $activity->selectActivityGroup($fkGroup);
        			
        			foreach ($activities as $key => $value) {
        				$status = ($value->activity_status == 0) ? "Aberta" : "Concluida";
        				$statusClass = ($value->activity_status == 0) ? "text-danger" : "text-success"; 
        				?>
        				<div class="card">
							<div class="card-body">
							    <h5 class="card-title"><?php echo($value->activity_title); ?></h5>
							    <p class="card-text"><?php echo($value->activity_description) ?></p>
							    <p class="<?php echo($statusClass) ?>" ><?php echo($status) ?></p>
							    <a href="activity.php?activity_id=<?php echo($value->activity_id); ?>" class="card-link">Ver mais</a>
						  	</div>


						</div><?php
        			}
        		?>
        		
        		


        		
        	</div><!-- /.col-lg-6 -->

        	<div class="col-md-3">
        		<div class="row mb-3">
        			<div class="col">

        				<ul class="list-group">
						  <li class="list-group-item">
						  	<h3 class="text-center"><?php echo($studentMy->user_name) ?></h3>
						  	<p class="text-center"><?php echo($studentMy->user_email) ?></p>
						  </li>
						  <li class="list-group-item">Atividades aberta : <?php echo($activity->getCountActivityOpenGroup($idGroup)); ?></li> 
						  <li class="list-group-item">Atividades Concluida: <?php echo($activity->getCountActivityCloseGroup($idGroup)); ?></li>
						  <li class="list-group-item">Total: <?php echo($activity->getCountActivityAllGroup($idGroup)); ?></li>
						</ul>
        			</div><!--col dados alunos -->

        		</div><!--row filha -->

        		<div class="row mb-3">
        			<div class="col">
        				<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#activityAdd">Nova Atividade</button>
        			</div><!--col dados alunos -->

        		</div><!--row filha -->

        		
        	</div><!-- /.col-lg-3 -->
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>


        <!--modal -->
    <div class="modal fade" id="activityAdd">
  		<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title">Nova Atividade</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div><!--/modal-header-->

		      	<div class="modal-body">

		      		<form id="activityAddForm" method="POST">
		      			 <div class="form-group">
						    <label>Titulo:</label>
						    <input type="text" class="form-control" name="title">
						  </div>

						  <div class="form-group">
						    <label>Descrição:</label>
						    <textarea class="form-control" name="description" rows="5"></textarea>
						  </div>

						  <div id="ajaxResult"></div>
		      		</form>
		        	

		      	</div><!--/modal-body-->

		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-success" 
		        	onclick="activityAdd(<?php echo $_GET['group']; ?>);">Salvar
		        	</button>
		      	</div><!--/modal-footer-->
	    	</div><!--/modal-content-->
  		</div><!-- /modal-dialog -->
	</div><!--/modal -->

	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">
		
		function activityAdd(id){
			$.ajax({
	        	url:   'activityAdd.php?groupId='+id,
	       		type:  'POST',
	       		cache: false,
	       		data :   $("#activityAddForm").serialize(),
	       		error: function() {
	         		alert('Erro ao tentar ação!');
	       		},
	       		success: function(data) {
	              //alert(data);
	              $("#ajaxResult").html(data);
	            }
	          });
	      return false;
		}

	</script>

</body>
</html>