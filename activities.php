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
	<title>Template Bootstrap</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">
	

</head>
<body>

	
	<?php include("./inc/navbarTeacher.php"); ?>

	<!-- Page Content -->
	<div class="content container mt-5 main-container">

		<div class="row">
			
			<?php include("./inc/sidebarTeacher.php"); ?><!-- side bar col-md-3 -->

        	<div class="col-md-9 container-body">
        		<div class="table-responsive">
	        		<table class="table table-hover">

			          	<thead>
			                <tr>
			                    <th scope="col">#</th>
			                    <th scope="col">Titulo</th>
			                    <th scope="col">alunos</th>
			                    <th scope="col">status</th>
			                    <th scope="col"></th>
			                </tr>
			            </thead>

	            		<tbody>
	            				<?php 
	            				foreach ($activiesTeacher as $key => $value) { 
	            					$status = ($value->activity_status == false) ? "Ativa" : "Concluida";
	            				?>
	            					          			
			                    <tr>
			                        <th scope="row"><?php echo($key+1) ?></th>
			                        <td><?php echo($value->activity_title) ?></td>
			                        <td><?php echo($value->name_student) ?></td>
			                        <td><?php echo($status) ?></td>
			                        <td>
			                        	
			                        	<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#activityDeleteModal" data-id="<?php echo($value->activity_id) ?>">Deletar</a>
			                        	<a href="activity.php?activity_id=<?php echo($value->activity_id) ?>" class="btn btn-primary">mostrar</a>
			                        </td>
			                    </tr>

			                    <?php 
			                    }	
			                    ?>
			                    
	          			</tbody>
	        		</table>
        		</div>
        		<div class="text-right">
        			<a href="#" class="btn btn-success text-right">Adicionar</a>
        		</div>
        		
        	</div><!-- /.col-lg-9 -->
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>


    <!--modal -->
    <div class="modal fade" id="activityDeleteModal">
  		<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title text-danger">Você tem certeza que quer apagar está atividade?</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div><!--/modal-header-->

		      	<div class="modal-body">
		      		<input type="hidden" class="form-control" name="id" id="activity_id_modal">
		      		<p>Todos os dados referentes a esta atividade será apagado!</p>
		        	
		      		<div id="ajaxResultDelete"></div>

		      	</div><!--/modal-body-->

		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        	<button type="button" class="btn btn-danger" onclick="activityDelete()">Deletar
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
		
		//ajax
	    function activityDelete(){
	    	let id = $("#activity_id_modal").val();
	    	
	      	$.ajax({
	      		//id : $("#activity_id_modal").val(),
	      		
	        	url:   'activityDelete.php?activity_id='+id,
	        	type:  'POST',
	        	cache: false,
	        	
	        	error: function() {
	         		alert('Erro ao tentar ação!');
	       		},	
	       		success: function(data) {
	       	 		//alert (data);
	              	$("#ajaxResultDelete").html(data);
	            }
	        });
	      return false;
	    }

	    $('#activityDeleteModal').on('show.bs.modal', function (event) {
		      var button = $(event.relatedTarget) // Button that triggered the modal
		      var id = button.data('id');

		      var modal = $(this)
		      modal.find('#activity_id_modal').val(id);
    	})//adress edit
	</script>
</body>
</html>