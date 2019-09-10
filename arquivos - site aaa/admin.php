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
      <div class="card-header"><a class="navbar-brand mr-1" href="index.php"><img class="img-fluid rounded" src="imagens/logo-aaa-preto.png" alt="" style="height: 20px;"></a>Login Administrativo</div>
      <div class="card-body">
        <form method="post" action="login_adm.php" id="formlogin" name="formlogin">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="login" id="login" class="form-control" placeholder="Nome de Usuário" required="required" autofocus="autofocus">
              <label for="login">Nome de Usuário</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required="required">
              <label for="senha">Senha</label>
            </div>
          </div>
          <!--<div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>-->
          <button class="btn btn-primary btn-block" type="submit">Entrar</button>
        </form>
        <div class="text-center">
          <!--<a class="d-block small mt-3" href="register.html">Register an Account</a>-->
          <a class="d-block small" href="recuperarSenhaAdm.php">Esqueceu sua senha?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
