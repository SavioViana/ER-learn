
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Area Administrativa</title>
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
</head>
<body style="background: #e6e6e6;">


  <div class="content container" style="margin-top: 12%; margin-bottom: 12%;">
    <form class="col-md-4 offset-4" method="POST" id="loginForm" onsubmit="return login()">
      <fieldset>
        <legend class="text-center">Area administrativa</legend>


        <?php if (isset($_GET['error']) ){ ?>
        <div class="alert alert-danger fade show" role="alert">
          <a  data-dismiss="alert" class="close">&times;</a>
           <?php  echo $_GET['error'] ?> 
        </div><!--alert -->
        <?php } ?> 

        <div class="form-group">
          <label>Usuario</label>
          <input type="text" class="form-control" name="username" aria-describedby="usuario" placeholder="Enter Usuario">
        </div>
        <div class="form-group">
          <label>Senha</label>
          <input type="password"  name="password" class="form-control" placeholder="Senha">
        </div>
        <div id="recebeResultadoAjax"></div>
        <button type="submit" class="btn btn-primary btn-block ">Entrar</button>
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
        url:   'autenticDashboardLogin.php',
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