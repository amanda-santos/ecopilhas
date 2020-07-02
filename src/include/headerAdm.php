<?php  
  include ("conexao.php"); 
  session_start();
  //Caso o usuário não esteja autenticado, limpa os dados e redireciona
  if ((!isset($_SESSION['login'])) && (!isset($_SESSION['senha']))) {
      //Limpa
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      unset($_SESSION['tipo']);
      session_destroy();
      //Redireciona para a página de autenticação
      echo "<script language='javascript' type='text/javascript'>alert('Para acessar esta página é preciso fazer login.');window.location.href='index.php';</script>";
  }else{
    $tipo = $_SESSION["tipo"];
    include("testaAdmin.php");
  }
?>

<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EcoPilhas</title>

  <script src="vendor-admin-website/jquery/jquery.min.js"></script>
  
  <!-- Custom fonts for this template-->
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor-admin-website/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- barra superior -->
  <nav style="background-color:#305522" class="navbar navbar-expand-lg navbar-light static-top">

    <a class="navbar-brand mr-1" href="index.php"><img class="img-fluid" src="imagens/mascote-ecopilhas.jpg" alt="" style="height: 50px; border-radius: 50%;"></a> 

    <div class="text-light d-none d-lg-block"> EcoPilhas</div>

    <button class="btn btn-link btn-sm text-light order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i> 
    </button>

    <button style="text-decoration: none;" title="Minimizar Menu" class="float-right btn btn-link text-white order-1 order-sm-0 ml-auto mr-0 mr-md-3 my-2 my-md-0" id="sidebarToggle" href="#">
      
    </button>

    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="text-light nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Meu Perfil
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="editarUsuario.php?id=<?php echo $_SESSION['id'];?>">Configurações</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- barra lateral -->
    <ul class="sidebar navbar-nav">

      <li class="nav-item">
          <a class="nav-link" href="indexAdmin.php">
            <i class="fas fa-chart-pie"></i>
            <span>Gráficos</span>
          </a>
      </li>

      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="marcas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-battery-full"></i>
              <span>Pilhas</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="marcas">
              <a class="dropdown-item" href="cadastrarMarca.php">Cadastrar Marca</a>
              <a class="dropdown-item" href="exibirMarca.php">Exibir Marcas</a>
            </div>
          </li>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="triagens" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-box-open"></i>
              <span>Triagens</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="triagens">
              <a class="dropdown-item" href="cadastrarTriagem.php">Cadastrar Triagem</a>
              <a class="dropdown-item" href="exibirTriagens.php">Exibir Triagens</a>
            </div>
          </li>
      <?php
        // configurações
        // para acessar, o tipo de perfil deve ser igual a 1 (professor)
        if (isAdmin($tipo)) {
      ?> 
          <li class="nav-item">
            <a class="nav-link" href="exibirSolicitacoes.php">
              <i class="fas fa-exclamation-circle"></i>
              <span>
                Solicitações
                <?php
                  $sqlSolicitacoesPendentes = "SELECT COUNT(concluido) AS cont 
                                                FROM Solicitacao 
                                                WHERE concluido = 0";

                  $resultSolicitacoesPendentes = $con->query($sqlSolicitacoesPendentes);

                  if ($resultSolicitacoesPendentes->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                    while ($exibirSolicitacoesPendentes = $resultSolicitacoesPendentes->fetch_assoc()){
                      if($exibirSolicitacoesPendentes["cont"] > 0){
                ?>
                        <button style="padding-top:0px; padding-bottom:0px; padding-left:3px; padding-right:3px;" class="btn btn-sm btn-danger"><?php echo $exibirSolicitacoesPendentes["cont"]; ?></button>
                <?php
                      }
                    }
                  }
                ?>
              </span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="configuracoes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog"></i>
              <span>Configurações</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="configuracoes">
              <a class="dropdown-item" href="cadastrarUsuario.php">Cadastrar Perfil <br>Administrativo</a>
              <a class="dropdown-item" href="exibirUsuarios.php">Exibir Perfis <br>Administrativos</a>
            </div>
          </li>
      <?php
        }
      ?>

      <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-arrow-circle-left"></i>
            <span>Retornar ao site institucional</span>
          </a>
      </li>

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        

      
