<?php 
require_once "class/user.php";
require_once "class/studentGroup.php";

	User::autentication();

				
	$user = new User();
	$email = $_SESSION['usuario'];

	$currentUser = $user->getCurrentUser($email);
	
	$sql = "SELECT * FROM user where user_email = '$email'";

	$stmt = $user->conn->query($sql);
	$datas = $stmt->fetchAll(PDO::FETCH_OBJ);
	$teacher = $datas[0];
			

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Meus Alunos</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="./css/stylesheet.css">
	<link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">
	

</head>
<body>

	
	<?php include("./inc/navbarTeacher.php"); ?>

	<!-- Page Content -->
	<div class="content container mt-5 main-container">

		<div class="row ">
			
			<?php include("./inc/sidebarTeacher.php"); ?><!-- side bar col-md-3 -->

        	<div class="col-md-9 container-body">
        		<div class="table-responsive">
	        		<table class="table table-hover">

			          	<thead>
			                <tr>
			                    <th scope="col">#</th>
			                    <th scope="col">Alunos</th>
			                    <th scope="col"></th>
			                    <th scope="col"></th>
			                </tr>
			            </thead>

	            		<tbody>
	            			<?php

	            				$group = new StudentGroup();

	            				$data = $group->selectAllStudents($teacher->user_id);
	            				foreach ($data as $key => $value) {?>

	            					<tr>
			                        	<th scope="row"><?php echo $key+1; ?></th>
			                        	<td><?php echo $value->user_name;?></td>
			                        	<td><?php echo $value->user_email;?></td>
			                        	<td>
			                        		<a href="#" class="btn btn-danger">remover</a>
			                        		<a href="studentMy.php?group=<?php echo $value->student_group_id; ?>" class="btn btn-primary">mostrar</a>
			                       	 	</td>
			                    	</tr><?php

	            				}

	            			?>
	          			</tbody>
	        		</table>
        		</div>
        		<div class="text-right">
        			<a href="#" class="btn btn-success text-right" data-toggle="modal" data-target="#userAdd">Adicionar</a>
        		</div>
        		
        	</div><!-- /.col-lg-9 -->
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>




    <!--modal -->
    <div class="modal fade" id="userAdd">
  		<div class="modal-dialog modal-dialog-centered">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<h5 class="modal-title">Novo aluno</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		      	</div><!--/modal-header-->

		      	<div class="modal-body">

		        	<form class="form-inline" id="searchForm" method="GET" onsubmit="return pesquisar()">
      					<input class="form-control mr-sm-2" type="search" name="term" placeholder="Pesquisar" aria-label="Search">
      					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    				</form>

    				<div id="ajaxResult">

    				</div>

		      	</div><!--/modal-body-->

		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      	</div><!--/modal-footer-->
	    	</div><!--/modal-content-->
  		</div><!-- /modal-dialog -->
	</div><!--/modal -->


	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

	<script type="text/javascript">


		function add(fkStudent){

			$.ajax({
	        	url:   'addStudents.php?aluno='+fkStudent,
	       		type:  'GET',
	       		cache: false,
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



	    function pesquisar(){

	      	$.ajax({
	        	url:   'searchStudent.php',
	       		type:  'GET',
	       		cache: false,
	       		data :   $("#searchForm").serialize(),
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