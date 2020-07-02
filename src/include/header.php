<?php
include("conexao.php"); //incluir arquivo com conexão ao banco de dados
include("testaAdmin.php");
include("include/limitaTexto.php");
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
  $tipo = $_SESSION['tipo'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EcoPilhas</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor-main-website/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/main-website.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!--BOOTSTRAP-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!--EDITOR DE TEXTO CRKEDITOR-->
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

  <!-- GALERIA -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

  <style>
    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #1C2331 !important;
      }
    }

    .carousel,
    .carousel .carousel-inner,
    .carousel .carousel-inner .active,
    .carousel .carousel-inner .carousel-item,
    .view,
    body,
    html {
      height: 98%
    }

    .page-footer,
    .top-nav-collapse {
      background-color: #1C2331
    }
  </style>

  <script type="text/javascript">
    new WOW().init();
  </script>

  <script type="text/javascript">
      /* Máscaras ER */
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }
      function mtel(v){
          v=v.replace(/D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(d{2})(d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
          v=v.replace(/(d)(d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
          return v;
      }
      function id( el ){
          return document.getElementById( el );
      }
      window.onload = function(){
          id('telefone').onkeypress = function(){
              mascara( this, mtel );
          }
      }
  </script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">

    <a class="navbar-brand" href="index.php"><img class="img-fluid rounded" src="imagens/mascote-ecopilhas.jpg" alt="" style="height: 50px;"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">

        <!-- seções de páginas -->
        <?php
        $sqlSecaoPaginas = "SELECT idSecaoPaginas, titulo 
                              FROM ecopilhas.SecaoPaginas 
                              WHERE exibir = 1";

        $resultSecaoPaginas = $con->query($sqlSecaoPaginas);

        if ($resultSecaoPaginas->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPaginas = $resultSecaoPaginas->fetch_assoc()){
            $idSecaoPaginas = $exibirSecaoPaginas["idSecaoPaginas"];
            $nomeSecaoPaginas = $exibirSecaoPaginas["titulo"];
        ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navLink" id="dropdownSecao<?php echo $idSecaoPaginas; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $nomeSecaoPaginas; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownSecao<?php echo $idSecaoPaginas; ?>">

                <?php

                  $sqlPagina = "SELECT idPagina, nome 
                                  FROM Pagina 
                                  WHERE exibir = 1 
                                  AND SecaoPaginas_idSecaoPaginas = " . $idSecaoPaginas;

                  $resultPagina = $con->query($sqlPagina);

                  if ($resultPagina->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                    while ($exibirPagina = $resultPagina->fetch_assoc()){
                      $idPagina = $exibirPagina["idPagina"];
                      $nomePagina = ucwords($exibirPagina["nome"]);
                ?>

                      <a class="dropdown-item" href="pagina.php?id=<?php echo $idPagina; ?>"><?php echo $nomePagina; ?>

                      <?php

                        if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
                          if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR

                            $sqlPaginaAprov = "SELECT aprovacao FROM PaginaPendente WHERE aprovacao = 0 AND idPaginaPendente = " . $idPagina;

                            $resultPaginaAprov = $con->query($sqlPaginaAprov);

                            if ($resultPaginaAprov->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                      ?>
                              <span class="badge badge-danger">1</span>
                      <?php
                            }else{

                              if ($idPagina == 2) { // equipe

                                $sqlAprovacaoEquip = "SELECT aprovacao 
                                                        FROM MembroEquipePendente 
                                                        WHERE aprovacao = 0";
                                $resultAprovacaoEquip = $con->query($sqlAprovacaoEquip);

                                if ($resultAprovacaoEquip->num_rows > 0) {
                      ?>
                                  <span class="badge badge-danger">1</span>
                      <?php
                                }
                              }
                            }
                          }
                        }
                      ?>
                      
                      </a>

                <?php
                    } // fim while Pagina
                  } // fim if Pagina
                ?>

              </div>

            </li>
        <?php
          } // fim while SecaoPaginas
        } // fim if SecaoPaginas
        ?>

        <!-- fim seções de páginas -->

        <!-- seções de postagens -->

        <?php

          $sqlPostagens = "SELECT idSecaoPosts,titulo FROM ecopilhas.SecaoPosts WHERE exibir = 1;";

          $result = $con->query($sqlPostagens);

          if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($secaoPosts = $result->fetch_assoc()){
              $idSecaoPosts = $secaoPosts["idSecaoPosts"];
        ?>

              <li class="nav-item">
                <a class="nav-link" href="postagens.php?id=<?php echo $idSecaoPosts;?>" id="navLink">
                  <?php 

                  echo $secaoPosts["titulo"];

                  if (isset($_SESSION['login'])){

                    if (isAdmin($_SESSION['tipo'])){

                      $sqlPostsPendentes = "SELECT aprovacao FROM ecopilhas.PostPendente WHERE aprovacao = 0 AND idSecaoPosts = " . $idSecaoPosts;

                      $resultPendentes = $con->query($sqlPostsPendentes);

                      if ($resultPendentes->num_rows > 0) { // Exibindo cada linha retornada com a consulta  
                ?>
                        <span class="badge badge-danger">1</span>
                <?php
                      }
                    }
                  }
                  ?>
                </a>
              </li>
        <?php
            } // fim while
          }
        ?>

        <!-- fim seções de postagens -->
        <!-- seções -->

 <?php

    $sqlSecao = "SELECT idSecao, nome FROM ecopilhas.Secao WHERE exibir = 1;";

    $resultSecao = $con->query($sqlSecao);

    if ($resultSecao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
      while ($exibirSecao = $resultSecao->fetch_assoc()){
        $idSecao = $exibirSecao["idSecao"];
        $nomeSecao = $exibirSecao["nome"];
  ?>

  <li class="nav-item">
    <a class="nav-link" href="secao.php?id=<?php echo $idSecao;?>" id="navLink">

      <?php 

      echo $nomeSecao;

      if (isset($_SESSION['login'])){

        if (isAdmin($_SESSION['tipo'])){

          $sqlSecaoPendente = "SELECT aprovacao FROM ecopilhas.SecaoPendente WHERE aprovacao = 0 AND idSecaoPendente = " . $idSecao;

          $resultSecaoPendente = $con->query($sqlSecaoPendente);

          if ($resultSecaoPendente->num_rows > 0) { // Exibindo cada linha retornada com a consulta
      ?>
            <span class="badge badge-danger">1</span>
      <?php
          }
        }
      }
      ?>
    </a>
  </li>

  <?php
      } // fim while
    }
  ?>

<!-- fim seções -->

        <li class="nav-item">
          <a class="nav-link" href="cadastrarSolicitacao.php" id="navLink">Solicite um Coletor ou uma Palestra</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#map" id="navLink">Mapa de Coletores de Pilhas</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="galeria.php" id="navLink">Galeria</a>
        </li>

        <!-- configurações -->

        <?php
          if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
            if (isAdmin($tipo)){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR 
        ?>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navLink" id="dropdownConfiguracoes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Configurações</a>
                <div class="dropdown-menu" aria-labelledby="dropdownConfiguracoes">
                    
                    <a class="dropdown-item" data-toggle="modal" data-target="#secao" href="">Seções</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#secaoPaginas" href="">Seções de Páginas</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#secaoPosts" href="">Seções de Postagens</a>

                </div>
              </li>

        <?php
            }
          }
        ?>
        <!-- fim configurações -->

        <!-- início área admin/login -->
        <?php
          if (isset($_SESSION['login'])){
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="navLink" id="login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Área Administrativa</a>
            <div class="dropdown-menu" aria-labelledby="login">
              <a target="_blank" class="dropdown-item" href="indexAdmin.php">Acesse seu perfil</a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
            </div>
          </li>
        <?php
          }else{
        ?>
          <li class="nav-item">
            <a target="_blank" class="nav-link" href="login.html" id="navLink">Faça seu Login</a>
          </li>
        <?php
          }
        ?>
        <!-- fim área admin/login -->

      </ul>
    </div>

  </nav>

<!--MODAIS-->

<!-- Modal - Seções de Páginas -->
<div class="modal fade bd-example-modal-sm" id="secaoPaginas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seções de Páginas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        
        <?php

        $sqlSecaoPaginas = "SELECT idSecaoPaginas, titulo FROM SecaoPaginas";

        $resultSecaoPaginas = $con->query($sqlSecaoPaginas);

        if ($resultSecaoPaginas->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPaginas = $resultSecaoPaginas->fetch_assoc()){
            $idSecaoPaginas = $exibirSecaoPaginas["idSecaoPaginas"];
            $nomeSecaoPaginas = ucwords($exibirSecaoPaginas["titulo"]);

        ?>
            <label class="control-label col-sm-12" for="nomeSecaoPaginas">
              <?php echo $nomeSecaoPaginas; ?>
              <a href="editarSecaoPaginas.php?id=<?php echo $idSecaoPaginas; ?>">
                <i class="far fa-edit"></i>
              </a>
            </label>
        <?php
            } // fim while SecaoPaginas
          } // fim if SecaoPaginas
        ?>

        <div class="col-md-12"> 
          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastrarSecaoPaginas">
            <i class="fas fa-plus"></i>  
            Cadastrar Nova Seção de Páginas
          </button>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal - Cadastrar Seção de Páginas-->
<div class="modal fade" id="cadastrarSecaoPaginas" tabindex="-1" role="dialog" aria-labelledby="cadastrarSecaoPaginas" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="secaoPaginasLabel">Cadastrar Nova Seção de Páginas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form class="form-horizontal" action="inserirSecaoPaginas.php" method="post" data-toggle="validator">

          <div class="form-group">
            <label class="control-label col-sm-12" for="titulo">Título:</label>
            <div class="col-sm-12">
              <input required type="text" class="form-control" id="titulo" name="titulo">
            </div>
          </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar"></input>
      </div>

      </form>

    </div>
  </div>
</div>

    <!-- Modal - Seções -->
    <div class="modal fade bd-example-modal-sm" id="secao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seções</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            
            <?php

            $sqlSecaoModal = "SELECT idSecao, nome FROM ecopilhas.Secao";

            $resultSecaoModal = $con->query($sqlSecaoModal);

            if ($resultSecaoModal->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirSecaoModal = $resultSecaoModal->fetch_assoc()){
                $idSecao = $exibirSecaoModal["idSecao"];
                $nomeSecao = ucwords($exibirSecaoModal["nome"]);

            ?>
                <label class="control-label col-sm-12" for="nomeSecao">
                  <?php echo $nomeSecao; ?>
                  <a href="editarSecaoAdmin.php?id=<?php echo $idSecao; ?>">
                    <i class="far fa-edit"></i>
                  </a>
                </label>
            <?php
                } // fim while SecaoPaginas
              } // fim if SecaoPaginas
            ?>

            <div class="col-md-12"> 
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastrarSecao">
                <i class="fas fa-plus"></i>  
                Cadastrar Nova Seção
              </button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal - Cadastrar Seção-->
    <div class="modal fade" id="cadastrarSecao" tabindex="-1" role="dialog" aria-labelledby="cadastrarSecao" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="secaoPaginasLabel">Cadastrar Nova Seção</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
          <form class="form-horizontal" action="inserirSecao.php" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="titulo">Título:</label>
                <div class="col-sm-12">
                  <input required type="text" class="form-control" id="titulo" name="titulo">
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar"></input>
          </div>

          </form>

        </div>
      </div>
    </div>


<!-- Modal - Seções de Postagens -->
    <div class="modal fade bd-example-modal-sm" id="secaoPosts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Seções de Postagens</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            
            <?php

            $sqlSecaoPosts = "SELECT idSecaoPosts, titulo FROM ecopilhas.SecaoPosts";

            $resultSecaoPosts = $con->query($sqlSecaoPosts);

            if ($resultSecaoPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirSecaoPosts = $resultSecaoPosts->fetch_assoc()){
                $idSecaoPosts = $exibirSecaoPosts["idSecaoPosts"];
                $tituloSecaoPosts = $exibirSecaoPosts["titulo"];

            ?>
                <label class="control-label col-sm-12">
                  <?php echo $tituloSecaoPosts; ?>
                  <a href="editarSecaoPosts.php?id=<?php echo $idSecaoPosts; ?>">
                    <i class="far fa-edit"></i>
                  </a>
                </label>
            <?php
                } // fim while SecaoPaginas
              } // fim if SecaoPaginas
            ?>

            <div class="col-md-12"> 
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastrarSecaoPosts">
                <i class="fas fa-plus"></i>  
                Cadastrar Nova Seção de Postagens
              </button>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>

        </div>
      </div>
    </div>


<!-- Modal - Cadastrar Seção de Postagens-->
    <div class="modal fade" id="cadastrarSecaoPosts" tabindex="-1" role="dialog" aria-labelledby="cadastrarSecaoPosts" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="secaoPaginasLabel">Cadastrar Nova Seção de Postagens</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
          <form class="form-horizontal" action="inserirSecaoPosts.php" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="titulo">Título:</label>
                <div class="col-sm-12">
                  <input required type="text" class="form-control" id="titulo" name="titulo">
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar"></input>
          </div>

          </form>

        </div>
      </div>
    </div>

<!--Carousel Wrapper-->
<div style="height: 350px;" id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

<!--Slides-->
<div class="carousel-inner" role="listbox">

  <?php

  $cont = 0;

  $sqlHeader = "SELECT idImagem, imagem, titulo, legenda, link 
                FROM Imagem 
                WHERE header = 1";

  $resultHeader = $con->query($sqlHeader);

  if ($resultHeader->num_rows > 0) { // Exibindo cada linha retornada com a consulta
    while ($exibirHeader = $resultHeader->fetch_assoc()){
      $idImagem = $exibirHeader["idImagem"];
      $imagem = $exibirHeader["imagem"];
      $titulo = $exibirHeader["titulo"];
      $legenda = $exibirHeader["legenda"];
      $link = $exibirHeader["link"];
      $cont++;

      if ($cont == 1) {
  ?>
        <div class="carousel-item active">

  <?php
      }else{
  ?>
        <div class="carousel-item">
  <?php
      }
  ?>
          <div class="view" style="background-position: center; background-image: url('upload/img-galeria/<?php echo $imagem; ?>'); background-repeat: no-repeat; background-size: cover;">

            <!-- Mask & flexbox options-->
            <?php 
            if (($titulo != null) || ($legenda != null) || ($link != null)){
            ?>
              <div class="mask d-flex justify-content-center align-items-end">
                <div class="col-12 text-center white-text mx-5 wow fadeIn" style="background-color: rgba(0, 0, 0, 0.7)">
            <?php
            }else{
            ?>
              <div class="d-flex justify-content-center align-items-center">
                <div class="col-12 text-center white-text mx-5 wow fadeIn">
            <?php
            }
            ?>
              <!-- Content -->
                <h1 style="color:white;" class="mb-4">
                  <strong><?php echo $titulo; ?></strong>
                </h1>
                <p style="padding-top: 0px; color:white; font-size: 25px;">
                  <?php echo $legenda; ?>
                </p>
                <?php
                  if ($link != null) {
                ?>
                  <a target="_blank" href="<?php echo $link; ?>" style="color:white;" class="btn btn-outline-white btn-lg">
                    <strong>
                      Saiba Mais
                    </strong>
                  </a>
                <?php
                  }
                ?>
              </div>
              <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

          </div>
        </div>
        <!--/First slide-->
  <?php
    }
  }
  ?>

</div>
<!--/.Slides-->

<!--Controls-->
<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  <span class="sr-only">Próximo</span>
</a>
<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
  <span class="carousel-control-next-icon" aria-hidden="true"></span>
  <span class="sr-only">Anterior</span>
</a>
<!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->