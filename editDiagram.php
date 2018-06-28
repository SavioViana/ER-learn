<?php 
require_once "class/user.php";
require_once "class/diagram.php";

	User::autentication();

	$diagramObj = new Diagram();

	$idActivity = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";

	$hasRelationships = $diagramObj->hasDiagramRelationships($idActivity);

	

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Diagrama</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5 main-container container-body">
		
		<h1 class="text-center">Editar Diagrama da ATIVIDADE 01</h1>

		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<div class="list-group text-center col-md-8 offset-md-2 mb-5 mt-5">
  			<a href="#" class="list-group-item  list-group-item-dark list-group-item-action")">
    			Ouvir Atividade
  			</a>
  			<!--
		  	<a href="./createEntityAtribute.php?activity_id=<?php echo($actividySelected->activity_id) ?>" class="list-group-item  list-group-item-dark list-group-item-action" onclick="verify()" >Criar Entidades e Atributos</a>
		  -->
		  <a href="./editEntityAtribute.php?activity_id=<?php echo($idActivity) ?>" class="list-group-item  list-group-item-dark list-group-item-action">Editar entidades e atributos</a>
		  <a href="#" class="list-group-item list-group-item-dark list-group-item-action" onclick="goEditRelashionships()">Editar Relacionamentos</a>
		
		  	<a href="./activitySelected.php?activity_id=<?php echo($idActivity) ?>" class="list-group-item list-group-item-dark list-group-item-action">Voltar ao menu da atividade</a>
		</div><!-- /list-group menu-->

	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

	<script type="text/javascript">




			/*
			let activityId = <?php echo($idActivity) ?>;
			alert('oli');
			//let hasRelationships = <?php echo($hasRelationships) ?>;
			//let hasEntities = <?php echo($hasEntities) ?>;
			//alert(hasRelationships);

			
			
			if(hasRelationships <= 0){
				alert('Está Atividade NÂO possui nenhuma relacionamento para ser editado. Para crirar um relacionamento acesse o menu CRIAR RELACIONAMENTOS!');
			}else{
				location.href='./editRelationships.php?activity_id='+activityId;
			}
		}
*/

		function goEditRelashionships(){
			let activityId = <?php echo($idActivity) ?>;
			let hasRelationships = <?php echo($hasRelationships) ?>;
			

			if(hasRelationships <= 0){
				alert('Está Atividade NÂO possui nenhum relacionamento para ser editado. Para crirar um relacionamento acesse o menu CRIAR RELACIONAMENTOS!');
			}else{
				location.href='./editRelationships.php?activity_id='+activityId;
			}
	
			
		}
	</script>
</body>
</html>