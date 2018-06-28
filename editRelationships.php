<?php 
require_once "class/user.php";
require_once "class/diagram.php";

	User::autentication();

	$activity_id = $_GET['activity_id'];

	$diagramObj = new Diagram();

	$diagram = $diagramObj->getDiagram($activity_id);

	$diagram = $diagram[0];

	$entities = $diagram->diagram_json;

	$entities = json_decode($entities);

	$relationships = $diagram->relatioship_json;
	$relationships = json_decode($relationships);


	//print_r($entities);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar-Relacionamentos</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5">
		<h1 class="text-center">Editar Relacionamentos da atividade ATIVIDADE01</h1>
		<div class="text-right col-md-10 offset-md-1">
			<button type="button" class="btn btn-secondary btn-lg">Ouvir Atividade</button>
		</div><!--button-->

		<form class="col-md-10 offset-md-1 mb-5"  id="formRelationships" method="POST">
			
			<?php foreach ($relationships as $key => $relationship) { ?>
			<div class="relationships-form form-body">
				<div class="form-row">
					<div class="form-group col-md-4 offset-md-0 ">
						
						<label for="">Entidade 1</label>
						<select class="form-control" id="pe<?php echo($key) ?>" name="relationship[<?php echo($key) ?>][pe]">
						

						 <?php 

						foreach ($entities as $key1 => $value) { ?>

							<?php if ($relationship->pe == $value->name) { ?>
								<option selected=""><?php echo $value->name; ?></option>
								<?php
							
							}else{?>

						  <option><?php echo $value->name; ?></option>

								<?php
							}
						}
						?>

							
						</select>
	  					
					</div><!--form-group entidade 1 -->

					<div class="form-group col-md-4 offset-md-1">
						
						<label for="">Cardinalidade</label>
						<select class="form-control"  name="relationship[<?php echo($key) ?>][cardinalityP]">
							<option><?php echo($relationship->cardinalityP) ?></option>
						  <option>(0..N))</option>
						  <option>(1..N)</option>
						  <option>(0..1)</option>
						  <option>(1..1)</option>
						</select>
	  					
					</div><!--form-group entidade 1 -->
				</div><!--/form-row entidade 1-->

				<div class="form-row">
					<div class="form-group col-md-4 offset-md-0 ">
						
						<label for="">Entidade 2</label>
						<select class="form-control" id="se<?php echo($key) ?>" name="relationship[<?php echo($key) ?>][se]">
						

					 <?php 

						foreach ($entities as $key1 => $value) { ?>

							<?php if ($relationship->se == $value->name) { ?>
								<option selected=""><?php echo $value->name; ?></option>
								<?php
							
							}else{?>

						  <option><?php echo $value->name; ?></option>

								<?php
							}
						}
						?>

						</select>
	  					
					</div><!--form-group entidade 1 -->

					<div class="form-group col-md-4 offset-md-1">
						
						<label for="">Cardinalidade</label>
						<select class="form-control"  name="relationship[<?php echo($key) ?>][cardinalityS]">
						  <option selected=""><?php echo($relationship->cardinalityS) ?></option>
						  <option>(0..N))</option>
						  <option>(1..N)</option>
						  <option>(0..1)</option>
						  <option>(1..1)</option>
						</select>
	  					
					</div><!--form-group entidade 2 -->
				</div><!--/form-row  entidade 2-->
			</div><!--relacionamentos --> 

		<?php } ?>
			
			

			
	    	
	    	
		</form><!--/form -->

		
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-primary btn-lg" type="button" id="" onclick="NewRelationship()">Novo Relacionamento</button>
				
			</div>
			<div class="col-md-6 text-right">
				<a class="btn btn-secondary btn-lg" href="editDiagram.php?activity_id=<?php echo($_GET['activity_id']) ?>"> Cancelar</a>
				<button class="btn btn-success btn-lg" type="button" onclick="editRelationship(<?php echo($_GET['activity_id']) ?>)" >Salvar</button>
			</div>			
				
		</div>
		
	</div><!--/container-->

	<!-- Footer -->
   	<?php include("./inc/footer.php"); ?>


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">

		var idE = <?php echo(count($relationships)) ?> ;
		var countRelationship = <?php echo(count($relationships)) ?>;
		

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


		function editRelationship(id){
			
			
      		$.ajax({
        	url:   'autenticRetioshipsEdit.php?activity_id='+id,
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