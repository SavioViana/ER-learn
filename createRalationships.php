<?php 
require_once "class/user.php";
require_once "class/diagram.php";

	User::autentication();

	$activity_id = $_GET['activity_id'];

	$diagramObj = new Diagram();

	$diagram = $diagramObj->getDiagram($activity_id);

	
	$entities = $diagram[0]->diagram_json;

	$entities = json_decode($entities);
	//$entities = $entities[0];

	//print_r($entities);

/*
	foreach ($entities as $key => $value) {
			print_r($value);
			
	}*/

	//echo($entities[0]);
					
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Criar Relacionamentos</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5">
		
		<div class="text-right col-md-10 offset-1">
			<h1 class="text-left">Criar Relacionamentos</h1>
			<button type="button" class="btn btn-secondary btn-lg">Ouvir Atividade</button>
		</div><!--button-->

		<form class="col-md-10 offset-1 mb-5"  id="formRelationships" method="POST">
			
			<div class="relationships-form form-body">
				<div class="form-row">
					<div class="form-group col-md-4 offset-0 ">
						
						<label for="">Entidade 1</label>
						<select class="form-control" id="pe1" name="relationship[0][pe]">
						  <?php 

						foreach ($entities as $key => $value) {?>

						  <option><?php echo $value->name; ?></option>

								<?php
						}
						?>
						</select>
	  					
					</div><!--form-group entidade 1 -->

					<div class="form-group col-md-4 offset-1">
						
						<label for="">Cardinalidade</label>
						<select class="form-control"  name="relationship[0][cardinalityP]">
						  <option>(0..N))</option>
						  <option>(1..N)</option>
						  <option>(0..1)</option>
						  <option>(1..1)</option>
						</select>
	  					
					</div><!--form-group entidade 1 -->
				</div><!--/form-row entidade 1-->

				<div class="form-row">
					<div class="form-group col-md-4 offset-0 ">
						
						<label for="">Entidade 2</label>
						<select class="form-control" id="se1" name="relationship[0][se]">
						
						<?php 

						foreach ($entities as $key => $value) {?>

						  <option><?php echo $value->name; ?></option>

								<?php
						}
						?>
						</select>
	  					
					</div><!--form-group entidade 1 -->

					<div class="form-group col-md-4 offset-1">
						
						<label for="">Cardinalidade</label>
						<select class="form-control"  name="relationship[0][cardinalityS]">>
						  <option>(0..N))</option>
						  <option>(1..N)</option>
						  <option>(0..1)</option>
						  <option>(1..1)</option>
						</select>
	  					
					</div><!--form-group entidade 2 -->
				</div><!--/form-row  entidade 2-->
			</div><!--relacionamentos --> 


			
			

			
	    	
	    	
		</form><!--/form -->
		<a class="btn btn-primary" href="activitySelected.php?activity_id=<?php echo($_GET['activity_id']) ?>"> Cancelar</a>
		
		<button class="btn btn-primary" type="button" id="" onclick="NewRelationship();">Novo Relacionamento</button>

		<button class="btn btn-primary" type="button" onclick="createRelationship(<?php echo($_GET['activity_id']) ?>)" id="#">Salvar</button>
	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">

		var idE = 2;
		var countRelationship = 1;
		

		function NewRelationship(){
			
						
			let form = $('#formRelationships');
			
			let div = $('<div class="relationships-form form-body">'+
				'<div class="form-row">'+
					'<div class="form-group col-md-4 offset-0 ">'+
						
						'<label for="">Entidade 1</label>'+
						'<select class="form-control" id="pe'+idE+'" name="relationship['+countRelationship+'][pe]" >'+
							
						'</select>'+
	  					
					'</div><!--form-group entidade 1 -->'+

					'<div class="form-group col-md-4 offset-1">'+
						
						'<label for="">Cardinalidade</label>'+
						'<select class="form-control"  name="relationship['+countRelationship+'][cardinalityP]">'+
						  '<option>(0..N))</option>'+
						  '<option>(1..N)</option>'+
						  '<option>(0..1)</option>'+
						  '<option>(1..1)</option>'+
						'</select>'+
	  					
					'</div><!--form-group entidade 1 -->'+
				'</div><!--/form-row entidade 1-->'+

				'<div class="form-row">'+
					'<div class="form-group col-md-4 offset-0 ">'+
						
						'<label for="">Entidade 2</label>'+
						'<select class="form-control" id="se'+idE+'" name="relationship['+countRelationship+'][se]">'+
				

						  '<option> sdsdsdsd </option>'+
						
						'</select>'+
	  					
					'</div> <!--form-group entidade 1 -->'+

					'<div class="form-group col-md-4 offset-1">'+
						
						'<label for="">Cardinalidade</label>'+
						'<select class="form-control" name="relationship['+countRelationship+'][cardinalityS]" >'+
						  '<option>(0..N))</option>'+
						  '<option>(1..N)</option>'+
						  '<option>(0..1)</option>'+
						  '<option>(1..1)</option>'+
						'</select>'+
	  					
					'</div><!--form-group entidade 2 -->'+
				'</div><!--/form-row  entidade 2-->'+
			'</div><!--relacionamentos --> ').appendTo(form);




			var json = <?php echo(json_encode($entities)) ?>;


			var entityPrimary = $('#pe'+idE+'');
			var entitySecondary = $('#se'+idE+'');

			
			entityPrimary.find('option').remove();
			entitySecondary.find('option').remove();

			$.each(json, function (key, value) {
				console.log(value.name);
                $('<option>').text(value.name).appendTo(entityPrimary);
                $('<option>').text(value.name).appendTo(entitySecondary);
        		//options += '<option value="' + key + '">' + value + '</option>';
	        });


	        idE++;
	        countRelationship++;

			return false;
			
			
		}


		function createRelationship(id){
			
			
      		$.ajax({
        	url:   'autenticRetioships.php?activity_id='+id,
       		type:  'POST',
       		cache: false,
       		data :   $("#formRelationships").serialize(),
       		error: function() {
         		alert('Erro ao tentar ação!');
       		},
       		success: function(data) {
              	alert(data)
              	
              	location.href="activitySelected.php?activity_id="+id;
              	//$("#recebeResultadoAjax").html(data);
              	
            }
          	});

      		return false;
      		
      	}


      	

	</script>
</body>
</html>