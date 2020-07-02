<?php
  include 'conexao.php';

  $id = $_GET["id"];

  //verifica se foi enviado algum valor
  if (isset($_POST["atualizar"])) {
    //recebe os valores enviados pelo formulário
    $senha = $_POST['senha'];

    $sql = 'UPDATE ecopilhas.Usuario SET senha="' . $senha .'" WHERE idUsuario = ' . $id . ';';
    if ($con->query($sql) === true) {
      echo "<script language='javascript' type='text/javascript'>alert('Senha atualizada com sucesso!');</script>";
      echo "<script>window.location = 'login.html';</script>";
      die();
    } else {
      $errMSG = "1 error while inserting....2";
      echo $errMSG;
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Associação dos Aposentados e Pensionistas de Ouro Branco</title>

  <script src="vendor-admin-website/components/jquery/jquery.min.js" type="text/javascript"></script>

  <!-- Custom fonts for this template-->
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header"><a class="navbar-brand mr-1" href="index.php"><img class="img-fluid rounded" src="imagens/mascote-ecopilhas.jpg" alt="" style="height: 30px;"></a>Redefinir Senha</div>
      <div class="card-body">
        <form data-toggle="validator" method="post" action="redefinirSenha.php?id=<?php echo $id; ?>" id="formlogin" name="formlogin">
          <div class="form-group">
            <div class="form-label-group">
              <input maxlength="45" minlength="6" type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua nova senha" required="required">
              <label for="senha">Digite sua nova senha</label>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input maxlength="45" minlength="6" type="password" name="senha" id="senha" class="form-control" placeholder="Confirme sua nova senha" required="required" id="confSenha" name="senhaConfirma" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais.">
              <label for="senha">Confirme sua nova senha</label>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="atualizar" type="submit">Atualizar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="js/validator.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor-admin-website/jquery/jquery.min.js"></script>
  <script src="vendor-admin-website/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor-admin-website/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
