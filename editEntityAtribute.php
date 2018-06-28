<?php 
require_once "class/user.php";
require_once "class/diagram.php";

	User::autentication();

	$diagramObj = new Diagram();

	$idActivity = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";

	$diagram = $diagramObj->getDiagram($idActivity);
	$diagram = $diagram[0];

	$entities = json_decode($diagram->diagram_json);
	//print_r($entities);

	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Editar Entidades e Atributos</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<script type="text/javascript">
		//var qtdAtributes = 0;
	</script>
</head>
<body>

	<!--navbar-->
	<?php include("./inc/navbarStudent.php"); ?>

	<div class="content container mt-5 main-container">
		<h1 class="text-center">Editar Entidades e Atributos da Atividade ATIVIDADE 1</h1>
		<div class="text-right col-md-10 offset-1">

			<button type="button" class="btn btn-secondary btn-lg">Ouvir Atividade</button>
		</div><!--button-->

		
		<form class="col-md-10 offset-1 mb-5"  id="formEntity" method="POST" action="autenticEntitesAtributes.php">
			<div class="form-body">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label>Nome do Diagrama</label>
						<input type="text" class="form-control" name="nameDer" value="<?php echo($diagram->diagram_name) ?>">
						<input type="hidden" class="form-control" name="fkActivity" value="<?php echo isset($_GET['activity_id']) ? $_GET['activity_id'] : "" ?>">
					</div><!--form-group nome -->

					<div class="form-group col-md-6 offset-2">
						<label>Descrição do Diagrama</label>
						<textarea class="form-control" rows="3" name="descriptionDer"><?php echo($diagram->diagram_description) ?></textarea>
					</div><!--form-group nome -->
				</div><!--/form-row-->
			</div>


			<?php 
			foreach ($entities as $key => $entity) { ?>

			<div  class="form-body">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label>Entidade</label>
						<input type="text" class="form-control" name="entities[<?php echo($key) ?>][name]" value="<?php echo ($entity->name) ?>">
					</div><!--form-group nome -->

					<div class="col-md-6 offset-md-2 " id="pae" >
				
	    				<div id="dynamicAtributes<?php echo($key) ?>" >
	    					<?php
		    					$atributies = json_encode($entity);
		    					$atributies = json_decode($atributies, true);
		    					
		    					unset($atributies['name']);
		    					
		    					foreach ($atributies as $key1 => $atributy) { ?>
		    						
		    						
		    						<?php if ($key1 === 1){ ?>
		    							 <div class="form-check">
				      						<input class="form-check-input" type="checkbox" id="keyCheck" name="entities[<?php echo($key) ?>][<?php echo($key1) ?>]" checked="<?php echo($atributy) ?>">
				     		 				<label class="form-check-label" for="gridCheck">
				        						Primary key
				      						</label>
				    					</div>
		    						<?php }else{ ?>	
		    							<input type="text" class="form-control mt-2" placeholder="Atributo" name="entities[<?php echo($key) ?>][<?php echo($key1) ?>]" value="<?php echo($atributy) ?>">
		    						<?php } ?>
		    							
		    				<?php } ?>

	    					


	    				</div>

	    				<button class="btn btn-danger mt-2" type="button" id="removeInput">Remover</button>
	    				<button class="btn btn-primary mt-2" type="button" id="addInput">Adicionar</button>
						   
					</div><!--form-entidade -->
				</div><!--/form-row-->

			</div>
			<?php
			}	
			?>
		</form><!--/form -->

			<div class="row">
				<div class="col-md-6">
					<button class="btn btn-default btn-info btn-lg" type="button" onclick="addEntity()">adicionar entidade</button>
				</div>
				<div class="col-md-6 text-right">
					
					<a class="btn btn-secondary btn-lg" href="./editDiagram.php?activity_id=<?php echo($idActivity) ?>">Cancelar</a>
					<button class="btn btn-success btn-lg" type="button" onclick="editEntities(<?php echo $idActivity ?>)">Salvar</button>
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
		
		var qtdDynamicAtributes = 0
		var qtdEntites = <?php echo(count($entities) - 1); ?>;


		function addEntity(){
			

			qtdDynamicAtributes++;
			qtdEntites++;

			let form = $('#formEntity');

			$('<div  class="form-body">'+
				'<div class="form-row">'+
					'<div class="form-group col-md-4">'+
					'	<label>Entidade</label>'+
					'	<input type="text" class="form-control" name="entities['+qtdEntites+'][name]">'+
					'</div><!--form-group nome -->'+

					'<div class="col-md-6 offset-md-2" >'+
				
	    				'<div id="dynamicAtributes'+qtdDynamicAtributes+'" > '+
	    					'<input type="text" class="form-control" placeholder="Atributo" name="entities['+qtdEntites+'][0]">'+
						    '<div class="form-check">'+
	      						'<input class="form-check-input" type="checkbox" id="gridCheck" name="entities['+qtdEntites+'][1]" >'+
	     		 				'<label class="form-check-label" for="gridCheck">'+
	        						'Primary key'+
	      						'</label>'+
	    					'</div>'+
	    					'<input type="text" class="form-control mb-2" placeholder="Atributo" name="entities['+qtdEntites+'][2]">'+
						   
	    					'<input type="text" class="form-control mb-2" placeholder="Atributo" name="entities['+qtdEntites+'][3]">'+
	    				'</div>'+

	    				'<button class="btn btn-danger" id="removeInput">remove</button>'+
	    				'<button class="btn btn-primary" id="addInput">adicionar</button>'+
						   
					'</div><!--form-entidade -->'+
				'</div><!--/form-row-->'+

			'</div>').appendTo(form);

			return false;
		}


	
		$(function () {
			//var en = 1;
		    //var scntDiv = $('#dynamicAtributes');
		    var scntDiv = $(this).parents;
		    //var camp = 4;
		    $(document).on('click', '#addInput', function () {
		    	let scntDiv = $(this﻿).parent().children('div');

		    	let qtdatribute = $('#'+scntDiv.attr('id')+' input').length;


		    	
		    	let selectedEntity = scntDiv.attr('id');
		    	selectedEntity = parseInt(selectedEntity.charAt(selectedEntity.length - 1));
		    	
		    	//alert(selectedEntity)
		    	
		       $(
	        		'<input type="text" class="form-control mt-2"  value="" name="entities['+selectedEntity+']['+qtdatribute+']" placeholder="Atributo" /> ').appendTo(scntDiv);
		       		//camp++;
		        return false;
		        
		       
		    });
		    
		    $(document).on('click', '#removeInput', function () {
		    	let scntDiv = $(this﻿).parent().children('div').attr('id');
		    	let qtd= $('#'+scntDiv+' input').length;
		    	//alert(qtd);
	            //if (camp > 3){
	            	
	            if (qtd > 3){
		        	//$('#dynamicAtributes'+qtdDynamicAtributes+' input:last').remove();
		        	$('#'+scntDiv+' input:last').remove();
		        	//camp--;
		        	return false;
		    	}else{
		    		alert("O numero minino de atributos e 2")
		    		return false;
		    	}

		    });
		    
		});


		function editEntities(id){
		
      		$.ajax({
        	url:   'autenticEntitesAtributesEdit.php?activity_id='+id,
       		type:  'POST',
       		cache: false,
       		data :   $("#formEntity").serialize(),
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