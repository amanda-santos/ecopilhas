<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Associação dos Aposentados e Pensionistas de Ouro Branco</title>

  <!-- Custom fonts for this template-->
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
    <div class="card-header"><a class="navbar-brand mr-1" href="index.php"><img class="img-fluid rounded" src="imagens/mascote-ecopilhas.jpg" alt="" style="height: 30px;"></a>Recuperar Senha</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Esqueceu sua senha?</h4>
          <p>Digite o seu endereço de e-mail e iremos lhe enviar instruções para recuperar a sua senha.</p>
        </div>
        <form method="post" action="mail/enviarEmailRecuperacao.php">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Digite seu endereço de e-mail" required="required" autofocus="autofocus">
              <label for="inputEmail">Digite seu endereço de e-mail</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" href="login.html">Recuperar senha</button>
        </form>
        <div class="text-center">
          <a class="d-block small" href="index.php">Retornar à página inicial</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor-admin-website/jquery/jquery.min.js"></script>
  <script src="vendor-admin-website/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor-admin-website/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
