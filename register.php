<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cadastre-se</title>
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
  <link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">
</head>
<body class="login-body" >


	<div class="content container">

		<form id="form-register" method="POST" action="autenticRegister.php" class="col-md-6 offset-md-3 login" style="margin-top: 200px;" onsubmit="return register()">
			<fieldset>
				<legend class="text-center">Cadastre-se</legend>
				<p class="text-center text-info">Preencha todos os campos do formulario corretamente</p>
				<div id="receptAjax"></div>
				<div class="form-group">
					<label>Nome Completo * </label>
					<input type="text" class="form-control" name="name" aria-describedby="nome completo" placeholder="Nome Completo">
					<span class="text-danger" id="errorName"></span>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label>CPF *</label>
						<input type="text" class="form-control" name="cpf" aria-describedby="cpf" placeholder="CPF" id="cpf">
						<span class="text-danger" id="errorCpf"></span>
					</div>
					<div class="form-group col-md-6">
						<label>RG *</label>
						<input type="text" class="form-control" name="rg" aria-describedby="RG" placeholder="RG">
						<span class="text-danger" id="errorRg"></span>
					</div>
				</div><!--form-row--> 

				<div class="form-group">
					<label>Tipo *</label>
					<select class="form-control" name="type">
						<option value="1">Professor</option>
						<option value="2">Aluno</option>
					</select>
				</div><!--select tipo -->

		
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Estado *</label>
						<!--<input type="text" class="form-control" name="state" aria-describedby="Estado" placeholder="Estado">-->
						<select class="form-control" name="state">
							<option value="ac">Acre</option> 
							<option value="al">Alagoas</option> 
							<option value="am">Amazonas</option> 
							<option value="ap">Amapá</option> 
							<option value="ba">Bahia</option> 
							<option value="ce">Ceará</option> 
							<option value="df">Distrito Federal</option> 
							<option value="es">Espírito Santo</option> 
							<option value="go">Goiás</option> 
							<option value="ma">Maranhão</option> 
							<option value="mt">Mato Grosso</option> 
							<option value="ms">Mato Grosso do Sul</option> 
							<option value="mg">Minas Gerais</option> 
							<option value="pa">Pará</option> 
							<option value="pb">Paraíba</option> 
							<option value="pr">Paraná</option> 
							<option value="pe">Pernambuco</option> 
							<option value="pi">Piauí</option> 
							<option value="rj">Rio de Janeiro</option> 
							<option value="rn">Rio Grande do Norte</option> 
							<option value="ro">Rondônia</option> 
							<option value="rs">Rio Grande do Sul</option> 
							<option value="rr">Roraima</option> 
							<option value="sc">Santa Catarina</option> 
							<option value="se">Sergipe</option> 
							<option value="sp">São Paulo</option> 
							<option value="to">Tocantins</option> 
						</select>
					</div>
					<div class="form-group col-md-6">
						<label>Cidade *</label>
						<input type="text" class="form-control" name="city" aria-describedby="Cidade" placeholder="Cidade">
						<span class="text-danger" id="errorCity"></span>
					</div>
				</div><!--form-row--> 

				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Logradouro *</label>
						<input type="text" class="form-control" name="publicSpace" aria-describedby="Logradouro" placeholder="Logradouro">
						<span class="text-danger" id="errorPublicSpace"></span>
					</div>
					<div class="form-group col-md-6">
						<label>Nº *</label>
						<input type="number" class="form-control" name="number" aria-describedby="numero" placeholder="0">
						<span class="text-danger" id="errorNumber"></span>
					</div>
				</div><!--form-row--> 

				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Email *</label>
						<input type="email" class="form-control" name="email" aria-describedby="email" placeholder="exemple@exemplo.com">
						<span class="text-danger" id="errorEmail"></span>
					</div>
					<div class="form-group col-md-6">
						<label>Senha *</label>
						<input type="password" class="form-control" name="password" aria-describedby="senha" placeholder="*********">
						<span class="text-danger" id="errorPassword"></span>
					</div>
				</div><!--form-row-->

				<div class="form-group">
					<label>Telefone *</label>
					<input type="text" class="form-control" name="phone" aria-describedby="Telefone" placeholder="Telefone" id="telefone">
					<span class="text-danger" id="errorPhone"></span>
				</div>

				<div id="receptAjax"></div>
				<div class="form-group text-right">
					<a class="btn btn-secondary btn-lg" href="login.php">Cancelar</a>
					<button type="submit" class="btn btn-success btn-lg right">Cadastrar</button>

				</div>
			</fieldset>
		</form> <!--form -->
	</div><!--end container -->

	<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="./node_modules/popper.js/dist/popper.min.js"></script>
	<script src="./node_modules/jquery/dist/jquery.js"></script>
	<script src="./node_modules/jquery/dist/jquery-masked-input.js"></script>
	<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


	<script type="text/javascript">
		jQuery(function($){
		       $("#telefone").mask("(99) 9999-9999");
		       $("#cpf").mask("999.999.999-99");
		});

		function register(){

			$.ajax({
				url:   'autenticRegister.php',
				type:  'POST',
				cache: false,
				data :   $("#form-register").serialize(),
				error: function() {
				 alert('Erro ao tentar ação!');
			},
				success: function(data) {
					//alert(data);
					$("#receptAjax").html(data);
				}
			});
			return false;
		}


		

</script>

</body>
</html>