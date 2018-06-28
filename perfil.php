<?php  
require_once "class/user.php";
User::autentication();
$user = new User();

$email = $_SESSION['usuario'];

$sql = "SELECT * FROM user where user_email = '$email'";

$stmt = $user->conn->query($sql);
$values = $stmt->fetchAll(PDO::FETCH_OBJ);
$values = $values[0];
//$values = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perfil</title>
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="./css/stylesheet.css">
</head>
<body>

  <?php 
  if(isset($_GET['type']) and $_GET['type'] == 1){
    include("./inc/navbarTeacher.php");

  }else if (isset($_GET['type']) and $_GET['type'] == 2){
    include("./inc/navbarStudent.php");
  }

  ?>

  <div class="content container main-container container-body mt-5">


    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
           <h2>Dados do Pessoais</h2>
        </thead>
        <tbody>
          <tr>
            <td>Nome Completo</td>
            <td><?php echo $values->user_name; ?></td>
            <td><a href="#" data-toggle="modal" data-target="#nameEdit" data-label="Nome Completo" data-id="<?php echo $values->user_id; ?>" data-input="<?php echo $values->user_name; ?>">Editar</a></td>
          </tr>

          <tr>
            <td>CPF</td>
            <td><?php echo $values->user_cpf; ?></td>
            <td><td>
            </tr>

            <tr>
              <td>RG</td>
              <td><?php echo $values->user_rg; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Tipo</td>
              <td><?php if($values->user_type == 1) echo "Professor"; if($values->user_type == 2) echo "Aluno"; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Email</td>
              <td><?php echo $values->user_email; ?></td>
              <td><a href="#" data-toggle="modal" data-target="#emailEdit" data-label="Novo Email" data-id="<?php echo $values->user_id; ?>" data-email="<?php echo $values->user_email; ?>">Editar</a></td>
            </tr>

            <tr>
              <td>Senha</td>
              <td>********</td>
              <td><a href="#" data-toggle="modal" data-target="#passwordEditModal" data-id="<?php echo $values->user_id; ?>" >Editar</a></td>
            </tr>

            <tr >
              <td  class="font-weight-bold" colspan="2"><span>Endereço</span></td>
              <td><a href="#" data-toggle="modal" data-target="#addressEditModal" data-id="<?php echo $values->user_id; ?>" data-state="<?php echo $values->user_state; ?>" data-city="<?php echo $values->user_city; ?>"  data-logradouro="<?php echo $values->user_public_space; ?>" data-number="<?php echo $values->user_number; ?>" data-phone="<?php echo $values->user_phone; ?>">Editar</a></td>
            </tr>

            <tr>
              <td>Estado</td>
              <td><?php echo $values->user_state; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Cidade</td>
              <td><?php echo $values->user_city; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Logradouro</td>
              <td><?php echo $values->user_public_space; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Nº</td>
              <td><?php echo $values->user_number; ?></td>
              <td></td>
            </tr>

            <tr>
              <td>Telefone</td>
              <td><?php echo $values->user_phone; ?></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="text-left">
        <!-- <button class="btn btn-secondary left">Desativar minha conta</button> -->
      </div>

    </div><!--end container -->

    <!--footer-->
    <?php include("./inc/footer.php"); ?>


    <!--modal name -->
    <div class="modal fade" id="nameEdit" tabindex="-1" role="dialog" aria-labelledby="modalNameEdit" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalNameEdit">Alterar Nome</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!--modal-header-->
          <div class="modal-body">
            <form method="POST" id="formNameEdit" onsubmit="return nameEdit()">
              <div class="form-group">
                <input type="hidden" class="form-control" name="id" id="id">
                <label class="col-form-label"></label>
                <input type="text" class="form-control" name="name" id="name">
              </div> <!--form-group-->

            </div><!-- modal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Salvar Alteração</button>
            </div><!--modal-footer -->
          </form><!--form -->
        </div> <!--modal-content-->
      </div><!-- modal-dialog-->
    </div><!--fim modal name-->


    <!--modal email -->
    <div class="modal fade" id="emailEdit" tabindex="-1" role="dialog" aria-labelledby="modalEmailEdit" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEmailEdit">Alterar Email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!--modal-header-->
          <div class="modal-body">
            <form method="POST" id="formEmailEdit" onsubmit="return emailEdit()">
              <input type="hidden" class="form-control" name="id" id="id">
              <div class="form-group">
                <label class="col-form-label"></label>
                <input type="text" class="form-control" name="email" id="email">
              </div> <!--form-group-->

            </div><!-- modal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
              <button type="submit" class="btn btn-primary">Salvar Alteração</button>
            </div><!--modal-footer -->
          </form><!--form -->
        </div> <!--modal-content-->
      </div><!-- modal-dialog-->
    </div><!--fim modal email-->

    <!--modal dados endereços -->
    <div class="modal fade" id="addressEditModal" tabindex="-1" role="dialog" aria-labelledby="modalAddressEdit" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddressEdit">Alterar Endereço</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!--modal-header-->
          <div class="modal-body">
            <form method="POST" id="addressEdit" action="#" onsubmit="return addressEdit()">
              <input type="hidden" name="id" class="form-control" id="idAddress">
              <div class="form-group">
                <label class="col-form-label">Estado:</label>
                <input type="text" name="state" class="form-control" id="address-state">
              </div> <!--form-group-->
              <div class="form-group">
                <label  class="col-form-label">Cidade:</label>
                <input type="text" name="city" class="form-control" id="address-city">
              </div> <!--form-group-->
              <div class="form-group">
                <label  class="col-form-label">Logradouro:</label>
                <input type="text" name="publicSpace" class="form-control" id="address-publicSpace">
              </div> <!--form-group-->
              <div class="form-group">
                <label  class="col-form-label">Nº:</label>
                <input type="number" name="number" class="form-control" id="address-number">
              </div> <!--form-group-->
              <div class="form-group">
                <label  class="col-form-label">Telefone:</label>
                <input type="number" name="phone" class="form-control" id="address-phone">
              </div> <!--form-group-->

            </div><!-- modal body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Salvar Alteração</button>
            </div><!--modal-footer -->
          </form><!--form -->
        </div> <!--modal-content-->
      </div><!-- modal-dialog-->
    </div><!--fim modal dados endereçoc-->

    <!--modal Senha -->
    <div class="modal fade" id="passwordEditModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="passwordModalLabel">Alterar Senha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="passwordEdit" method="POST" action="passwordEdit.php" onsubmit="return passwordEdit()">
             <input type="hidden" class="form-control"  name="id" id="id">
             <div class="form-group">
              <label  class="col-form-label">Nova Senha:</label>
              <input type="password" name="password" id="password" class="form-control">
            </div> <!--form-group-->
            <div class="form-group">
              <label  class="col-form-label">Digite Novamente</label>
              <input type="password" name="passwordNew" id="passwordNew" class="form-control">
            </div> <!--form-group-->
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Salvar altereçãoes</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
  <script src="./node_modules/popper.js/dist/popper.min.js"></script>
  <script src="./node_modules/jquery/dist/jquery.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>



  <script type="text/javascript">
    $('#addressEditModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id');
      var state = button.data('state')
      var city = button.data('city')
      var publicSpace = button.data('logradouro')
      var number = button.data('number')
      var phone = button.data('phone')

      var modal = $(this)
      modal.find('#idAddress').val(id);
      modal.find('#address-state').val(state)
      modal.find('#address-city').val(city)
      modal.find('#address-publicSpace').val(publicSpace)
      modal.find('#address-number').val(number)
      modal.find('#address-phone').val(phone)

    })//adress edit


    $('#nameEdit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('input')
      var label = button.data('label')
      var id = button.data('id');

      var modal = $(this)
      modal.find('.col-form-label').text(label)
      modal.find('#name').val(recipient)
      modal.find('#id').val(id);
    })//dados name


    $('#emailEdit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('email')
      var label = button.data('label')
      var id = button.data('id');

      var modal = $(this)
      modal.find('.col-form-label').text(label)
      modal.find('#email').val(recipient)
      modal.find('#id').val(id);
    })//dados email


    //passwordEdir
    $('#passwordEditModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id');

      var modal = $(this);
      modal.find('#id').val(id);
    })//dados principais


    //ajax
    function passwordEdit(){

      let type = "<?php echo (isset($_GET['type']) ? $_GET['type'] : ""); ?>";

      $.ajax({
        url:   'passwordEdit.php',
        type:  'POST',
        cache: false,
        data :   $("#passwordEdit").serialize(),
        error: function() {
         alert('Erro ao tentar ação!');
       },
       success: function(data) {
        alert (data);
        location.href = "logout.php";
              //$("#recebeResultadoAjax").html(data);
            }
          });
      return false;
    }


    function addressEdit(){

      let type = "<?php echo (isset($_GET['type']) ? $_GET['type'] : ""); ?>";

      $.ajax({
        url:   'addressEdit.php',
        type:  'POST',
        cache: false,
        data :   $("#addressEdit").serialize(),
        error: function() {
         alert('Erro ao tentar ação!');
       },
       success: function(data) {
        alert (data);
        location.href = "perfil.php?type="+type;
              //$("#recebeResultadoAjax").html(data);
            }
          });
      return false;
    }


    function nameEdit(){

      let type = "<?php echo (isset($_GET['type']) ? $_GET['type'] : ""); ?>";

      
      $.ajax({
        url:   'nameEdit.php',
        type:  'POST',
        cache: false,
        data :   $("#formNameEdit").serialize(),
        error: function() {
         alert('Erro ao tentar ação!');
       },
       success: function(data) {
        alert (data);
        location.href = "perfil.php?type="+type;

              //$("#recebeResultadoAjax").html(data);
            }
          });
      return false;
      
    }


    function emailEdit(){

      let type = "<?php echo (isset($_GET['type']) ? $_GET['type'] : ""); ?>";

      $.ajax({
        url:   'emailEdit.php',
        type:  'POST',
        cache: false,
        data :   $("#formEmailEdit").serialize(),
        error: function() {
         alert('Erro ao tentar ação!');
       },
       success: function(data) {
        alert (data);
        location.href = "logout.php";
              //$("#recebeResultadoAjax").html(data);
            }
          });
      return false;
    }
  </script>
</body>
</html>