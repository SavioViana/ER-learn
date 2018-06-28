<?php 
require_once "class/user.php";
require "class/activity.php";

	User::autentication();

				
	$activityId = isset($_GET['activity_id']) ? $_GET['activity_id'] : "";


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
        		
        				<div class="comments">
							<h2>Comentati 01</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

							<div class="">
								<div class="row">
									<div class="col-md-2 text-right">
										<i class="fab fa-android"></i>
									</div>

									<div class="col-md-10 comments-answer">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									</div>
								</div>

								<div class="row">
									<div class="col-md-2 text-right">
										<i class="fab fa-android"></i>
									</div>

									<div class="col-md-10 comments-answer">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									</div>
								</div>
								
							</div>

							<form class="">

								<div class="row">
									<div class="col-md-10">
										 <div class="form-group">
										    <textarea class="form-control" placeholder="Reponda uma duvida" id="descricao" rows="2"></textarea>
										 </div>
									</div>

									<div class="col-md-2 text-center">	
									  	<a href="#" class="btn btn-success">Enviar</a>
									</div>
								</div>
							  
							</form>

							<a href="#"> Responder</a>
						</div>


				<div class="comments">
							<h2>Comentati 01</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

							<div class="">
								<div class="row">
									<div class="col-md-2 text-right">
										<i class="fab fa-android"></i>
									</div>

									<div class="col-md-10 comments-answer">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									</div>
								</div>

								<div class="row">
									<div class="col-md-2 text-right">
										<i class="fab fa-android"></i>
									</div>

									<div class="col-md-10 comments-answer">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
									</div>
								</div>
								
							</div>

							<form class="">

								<div class="row">
									<div class="col-md-10">
										 <div class="form-group">
										    <textarea class="form-control" placeholder="Reponda uma duvida" id="descricao" rows="2"></textarea>
										 </div>
									</div>

									<div class="col-md-2 text-center">	
									  	<a href="#" class="btn btn-success">Enviar</a>
									</div>
								</div>
							  
							</form>

							<a href="#"> Responder</a>
						</div>


						<!--fazer uma nova duvida-->
						<form class="form-comments">
						  <div class="form-group">
						    <label for="exampleFormControlInput1">Titulo</label>
						    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
						  </div>
					
						  <div class="form-group">
						    <label for="descricao">Descrição</label>
						    <textarea class="form-control" id="descricao" rows="2"></textarea>
						  </div>

						  <div class="text-right">
						  	<a href="#" class="btn btn-success btn-lg">Enviar</a>
						  </div>
						  
						</form>
        		
        	
        	</div><!-- /.col-lg-6 -->

     
		</div><!--row -->

	</div><!-- /.container -->


	  <!-- Footer -->
    <?php include("./inc/footer.php"); ?>




	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">
		

	</script>

</body>
</html>