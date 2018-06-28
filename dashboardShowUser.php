<?php 
require_once "class/user.php";
require_once "class/admin.php";
Admin::autentication();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Template Bootstrap</title>
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">

</head>
<body>

    <?php include 'inc/navbarDashboard.php'; ?>


    <div class="content container">
        <div class="col-md-8 offset-2">
        <table class="table table-hover table-light">
          <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dados de usuario</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $user = new User();

                    $data = $user->selectOne($id);
                    $data = $data[0];
                }
            
             ?>

            <tbody>

                <tr>
                    <th scope="row">NOME COMPLETO</th>
                    <td><?php echo $data->user_name ?></td>
                </tr>

                <tr>
                    <th scope="row">CPF</th>
                    <td><?php echo $data->user_cpf ?></td>
                </tr>

                <tr>
                    <th scope="row">RG</th>
                    <td><?php echo $data->user_rg ?></td>
                </tr>

                <tr>
                    <th scope="row">TIPO</th>
                    <td><?php echo $data->user_type ?></td>
                </tr>

                <tr>
                    <th scope="row">ESTADO</th>
                    <td><?php echo $data->user_state ?></td>
                </tr>

                <tr>
                    <th scope="row">CIDATE</th>
                    <td><?php echo $data->user_city ?></td>
                </tr>

                <tr>
                    <th scope="row">LOGRADOURO</th>
                    <td><?php echo $data->user_public_space ?></td>
                </tr>

                <tr>
                    <th scope="row">Nº</th>
                    <td><?php echo $data->user_number ?></td>
                </tr>

                <tr>
                    <th scope="row">EMAIL</th>
                    <td><?php echo $data->user_email ?></td>
                </tr>

                <tr>
                    <th scope="row">PASSWORD</th>
                    <td>**********</td>
                </tr>

                <tr>
                    <th scope="row">TELEFONE</th>
                    <td><?php echo $data->user_phone ?></td>
                </tr>
                
          </tbody>
        </table>

        <a class="btn btn-secondary"  href="dashboard.php" >Voltar</a>
    </div>
    </div>





<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="./node_modules/popper.js/dist/popper.min.js"></script>
<script src="./node_modules/jquery/dist/jquery.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>
</html>