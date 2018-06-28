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
        <table class="table table-hover">
          <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $idUser = "ola";
                    $user = new user();
                    $users = $user->selectAll();


                    foreach ($users as $key => $value) {
                
                ?>
                    <tr>
                        <th scope="row"><?php echo $key; ?></th>
                        <td><?php echo $value->user_name; ?></td>
                        <td><a href="dashboardShowUser.php?id=<?php echo $value->user_id ?>">mostar</a></td>
                    </tr>
                <?php } ?>    
          </tbody>
        </table>
    </div>





<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="./node_modules/popper.js/dist/popper.min.js"></script>
<script src="./node_modules/jquery/dist/jquery.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>


</body>
</html>