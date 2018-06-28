<?php 
require_once "class/user.php";
require "class/activity.php";

	User::autentication();

	$user = new User();

	$email = $_SESSION['usuario'];

	$currentUser = $user->getCurrentUser($email);

				
	$activity = new Activity();

	$activityId = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";

	if(!empty($activityId)){
		$activityOne = $activity->selectActivity($activityId);
	}

			

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
        		<h2><?php echo "$activityOne->activity_title"; ?></h2>
        		<!-- <h3><?php echo "$activityOne->activity_title"; ?></h3> -->

        		<h3>Descrição: </h3>
        		<p><?php echo "$activityOne->activity_description"; ?></p>

        		<?php 
        			$status = $activityOne->activity_status == 0 ? "Aberta" : "Concluida";
        			$statusClass = $activityOne->activity_status == 0 ? "text-danger" : "text-success";
        		?>

        		<p class="text-right <?php echo $statusClass; ?>">
        			<?php $status = $activityOne->activity_status == 0 ?"Aberta" : "Concluida";	echo $status; 
        			?>
        				
        		</p>

        		<div class="row">
        			<div class="col-md-6">
        				<button class="btn btn-secondary btn-sm-lg" data-toggle="modal" data-target="#activityDeleteModal" data-id="<?php echo "$activityOne->activity_id"; ?>" >Excluir</button>
        				<button class="btn btn-primary btn-md-lg" data-toggle="modal" data-target="#activityEditModal" data-id="<?php echo "$activityOne->activity_id"; ?>" data-title="<?php echo "$activityOne->activity_title"; ?>" data-description="<?php echo "$activityOne->activity_description"; ?>" >Editar</button>
        			</div>

        			<div class="col-md-6 text-right">
        				<a class="btn btn-warning" href="./commentsTeacher.php?activity_id=<?php  echo($_GET['activity_id'])?>">Duvidas</a>
        				<a class="btn btn-success btn-sm-lg" href="#" onclick="goToDiagram(<?php echo($_GET['activity_id']) ?>, <?php echo($activityOne->activity_status) ?>)">Ver Diagrama</a>
        			</div>
        		</div><!--botoes -->

   		
        		
        		
        		
        		
        	
        	</div><!-- /.col-lg-6 -->

     
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>



        <!--modal -->
    <div class="modal fade" id="activityEditModal">
  		<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title">Editar Atividade</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div><!--/modal-header-->

		      	<div class="modal-body">

		      		<form id="activityAditForm" method="POST">
		      			<input type="hidden" class="form-control" name="id" id="id-modal">
		      			 <div class="form-group">
						    <label>Titulo:</label>
						    <input type="text" class="form-control" name="title" id="title-modal">
						  </div>

						  <div class="form-group">
						    <label>Descrição:</label>
						    <textarea class="form-control" name="description" rows="8" id="description-modal"></textarea>
						  </div>

						  <div id="ajaxResult"></div>
		      		</form>
		        	

		      	</div><!--/modal-body-->

		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-success" onclick="activityEdit()">Salvar
		        	</button>
		      	</div><!--/modal-footer-->
	    	</div><!--/modal-content-->
  		</div><!-- /modal-dialog -->
	</div><!--/modal -->


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


		//ajax
	    function activityEdit(){

	      	$.ajax({
	        	url:   'activityEdit.php',
	        	type:  'POST',
	        	cache: false,
	        	data :   $("#activityAditForm").serialize(),
	        	error: function() {
	         		alert('Erro ao tentar ação!');
	       		},	
	       		success: function(data) {
	       	 		//alert (data);
	              	$("#ajaxResult").html(data);
	            }
	        });
	      return false;
	    }

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



		$('#activityEditModal').on('show.bs.modal', function (event) {
		      var button = $(event.relatedTarget) // Button that triggered the modal
		      var id = button.data('id');
		      var title = button.data('title')
		      var description = button.data('description')

		      var modal = $(this)
		      modal.find('#id-modal').val(id);
		      modal.find('#title-modal').val(title)
		      modal.find('#description-modal').val(description)
    	})//adress edit

		$('#activityDeleteModal').on('show.bs.modal', function (event) {
		      var button = $(event.relatedTarget) // Button that triggered the modal
		      var id = button.data('id');

		      var modal = $(this)
		      modal.find('#activity_id_modal').val(id);
    	})//adress edit


    	function goToDiagram(id, status) {
    
    		if(status == 0 ){
    			alert('Está atividade ainda não foi concluida!');
    		}else{
    			location.href='./showDiagram.php?activity_id='+id;
    		}
    	}
	</script>

</body>
</html>