<?php 
require_once "class/user.php";
require "class/activity.php";
require_once "class/diagram.php";

	User::autentication();

	$activity = new Activity();

	$diagramObj = new Diagram();

	$idActivity = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";

	$actividySelected = $activity->selectActivity($idActivity);

	$hasRelationships = $diagramObj->hasDiagramRelationships($idActivity);
	$hasEntities = $diagramObj->hasDiagramEntities($idActivity);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Atividade Selecionada</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5 main-container container-body">
		
		<h1 class="text-center"><?php echo($actividySelected->activity_title) ?></h1>

		<p><?php echo($actividySelected->activity_description) ?></p>

		
		<div class="list-group text-center col-md-8 offset-md-2 mb-5 mt-5">
  			<a href="#" class="list-group-item  list-group-item-dark list-group-item-action")">
    			Ouvir Atividade
  			</a>
  			
		  <a href="#" class="list-group-item  list-group-item-dark list-group-item-action" onclick="goToCreateEntityAtribute()" >Criar Entidades e Atributos</a>
		  <a href="#" class="list-group-item list-group-item-dark list-group-item-action" onclick="goToCreateRelationships()">Criar Relacionamentos</a>


		  	
		  	<a href="#" class="list-group-item list-group-item-dark list-group-item-action" onclick="goEditDiagram()" >Edidar DER</a>
		  	<a href="#" class="list-group-item list-group-item-dark list-group-item-action" id="toggleActivityOnOff" onclick="toggleConcluidaOnOff(<?php echo($idActivity) ?>)">Marcar como Concluido</a>

		  	 <a href="./commentsStudent.php?activity_id=<?php echo($idActivity) ?>" class="list-group-item list-group-item-dark list-group-item-action">Duvidas</a>

		  	<a href="./homeStudent.php" class="list-group-item list-group-item-dark list-group-item-action">Voltar ao menu de atividades</a>
		</div><!-- /list-group menu-->

	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

	<script type="text/javascript">

		
		
		function goToCreateEntityAtribute(){

			let activityId = <?php echo($idActivity) ?>;
			let hasEntities = <?php echo($hasEntities) ?>;

			if (hasEntities > 0 ){
				alert('Está Atividade ja possui entidades e atributos cadastrados. Para editar entra no menu EDITAR DER');
			}else{
				location.href='./createEntityAtribute.php?activity_id='+activityId;
			}
			
		}


		function goToCreateRelationships(){
			
			let activityId = <?php echo($idActivity) ?>;
			let hasRelationships = <?php echo($hasRelationships) ?>;
			let hasEntities = <?php echo($hasEntities) ?>;
			//alert(hasRelationships);

			
			if(hasEntities <= 0){
				alert('Está Atividade NÂO possui nenhuma entidade cadastrata. Para cadastrar suas entidades acesse o menu CRIAR ENTIDADES E ATRIBUTOS!');
			}else if (hasRelationships > 0){
				alert('Está Atividade ja possui Relacionamentos cadastrados. Para editar entra no menu EDITAR DER');
			}else{
				location.href='./createRalationships.php?activity_id='+activityId;
			}


		}

		function goEditDiagram(){
			
			let activityId = <?php echo($idActivity) ?>;
			//let hasRelationships = <?php echo($hasRelationships) ?>;
			let hasEntities = <?php echo($hasEntities) ?>;
			//alert(hasRelationships);

			
			if(hasEntities <= 0){
				alert('Está Atividade NÂO possui nenhuma entidade para ser editada. Para cadastrar suas entidades acesse o menu CRIAR ENTIDADES E ATRIBUTOS!');
			}else{
				location.href='./editDiagram.php?activity_id='+activityId;
			}
		}


		function toggleConcluidaOnOff(id){

			
	    	$.ajax({

	        url:   'toogleActivityConcluidaOnOff.php?activity_id='+id,
	    	type:  'GET',
	    	cache: false,
	    	//data :   $("#toggleActivityOnOff").serialize(),
	    	error: function() {
	    	alert('Erro ao tentar ação!');
	       	},
	       	success: function(data) {
	              alert(data);
	              //$("#recebeResultadoAjax").html(data);
	            }
	        });
		    return false;
		}


		



	</script>
</body>
</html>