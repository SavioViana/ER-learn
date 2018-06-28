<?php 
require_once "class/user.php";

	User::autentication();

	$idActivity = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Criar Entidades e Atributos</title>
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
		<div class="text-right col-md-10 offset-1">
			<button type="button" class="btn btn-secondary btn-lg">Ouvir Atividade</button>
		</div><!--button-->
		
		<form class="col-md-10 offset-1 mb-5"  id="formEntity" method="POST" action="autenticEntitesAtributes.php">
			<div class="form-body">
			<div class="form-row">
				<div class="form-group col-md-4">
					<label>Nome do Diagrama</label>
					<input type="text" class="form-control" name="nameDer">
					<input type="hidden" class="form-control" name="fkActivity" value="<?php echo isset($_GET['activity_id']) ? $_GET['activity_id'] : "" ?>">
				</div><!--form-group nome -->

				<div class="form-group col-md-6 offset-2">
					<label>Descrição do Diagrama</label>
					<textarea class="form-control" rows="3" name="descriptionDer"></textarea>
				</div><!--form-group nome -->
			</div><!--/form-row-->
			</div>

			

			<div  class="form-body">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label>Entidade</label>
						<input type="text" class="form-control" name="entities[0][name]">
					</div><!--form-group nome -->

					<div class="col-md-6 offset-2 " id="pae" >
				
	    				<div id="dynamicAtributes0" >
	    					<input type="text" class="form-control" placeholder="Atributo" name="entities[0][0]">
						    <div class="form-check">
	      						<input class="form-check-input" type="checkbox" id="keyCheck" name="entities[0][1]">
	     		 				<label class="form-check-label" for="gridCheck">
	        						Primary key
	      						</label>
	    					</div>
	    					<input type="text" class="form-control mb-2" placeholder="Atributo" name="entities[0][2]">
						   
	    					<input type="text" class="form-control mb-2" placeholder="Atributo" name="entities[0][3]">
	    				</div>

	    				<button class="btn btn-danger" id="removeInput">remove</button>
	    				<button class="btn btn-primary" id="addInput">adicionar</button>
						   
					</div><!--form-entidade -->
				</div><!--/form-row-->

			</div>

			
		</form><!--/form -->

			<div class="row">
				<div class="col-md-6">
					<button class="btn btn-info btn-lg" type="button" onclick="addEntity()">adicionar entidade</button>
				</div>
				<div class="col-md-6 text-right">
					
					<a class="btn btn-secondary btn-lg" href="./activitySelected.php?activity_id=<?php echo($idActivity) ?>">Cancelar</a>
					<button class="btn btn-success btn-lg" type="button" onclick="createEntities(<?php echo $idActivity ?>)">Salvar</button>
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
		var qtdDynamicAtributes = 0;
		var qtdEntites = 0;
		function addEntity(){
			/*var $clone = $('#entity').clone(true);

			$('#formEntity').append($clone);
			*/
			
			qtdDynamicAtributes++;
			qtdEntites++;

			let form = $('#formEntity');

			$('<div  class="form-body">'+
				'<div class="form-row">'+
					'<div class="form-group col-md-4">'+
					'	<label>Entidade</label>'+
					'	<input type="text" class="form-control" name="entities['+qtdEntites+'][name]">'+
					'</div><!--form-group nome -->'+

					'<div class="col-md-6 offset-2" >'+
				
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
	        		'<input type="text" class="form-control mb-2"  value="" name="entidade['+selectedEntity+']['+qtdatribute+']" placeholder="Atributo" /> ').appendTo(scntDiv);
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


		function createEntities(id){

      		$.ajax({
        	url:   'autenticEntitesAtributes.php?activity_id='+id,
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