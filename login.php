
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
  <link rel="stylesheet" href="./node_modules/fontwesome/web-fonts-with-css/css/fontawesome-all.min.css">
</head>
<body class="login-body">


  <div class="content container" >
    <form class="col-md-4 offset-md-4 login" method="POST" id="loginForm" onsubmit="return login()">
      <div class="text-center">
          <i class="fas fa-user-circle"></i>
      </div>
      <fieldset>
  
        <legend class="text-center login-title">Login</legend>
        <?php if (isset($_GET['msg']) && $_GET['msg']=='registed' ){ ?>
        <div class="alert alert-success fade show" role="alert">
          <a  data-dismiss="alert" class="close">&times;</a>
          Usuario cadastrado, por favor entre com o seu login e senha
        </div><!--alert -->
        <?php } ?>

        <?php if (isset($_GET['error']) ){ ?>
        <div class="alert alert-danger fade show" role="alert">
          <a  data-dismiss="alert" class="close">&times;</a>
           <?php  echo $_GET['error'] ?> 
        </div><!--alert -->
        <?php } ?> 

        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" aria-describedby="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label>Senha</label>
          <input type="password"  name="password" class="form-control" placeholder="Senha">
        </div>
        <div id="recebeResultadoAjax"></div>
        <button type="submit" class="btn btn-primary btn-block ">Entrar</button>
        <a href="./register.php">Cadastre-se</a>
      </fieldset>
    </form>
  </div><!--end container -->

  <script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
  <script src="./node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./node_modules/jquery/dist/jquery.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


  <script type="text/javascript">

    function login(){

      $.ajax({
        url:   'autenticLogin.php',
       type:  'POST',
       cache: false,
       data :   $("#loginForm").serialize(),
       error: function() {
         alert('Erro ao tentar ação!');
       },
       success: function(data) {
              //alert(data);
              $("#recebeResultadoAjax").html(data);
            }
          });
      return false;
    }

  </script>
</body>
</html>