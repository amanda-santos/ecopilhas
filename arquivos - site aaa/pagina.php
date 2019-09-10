<?php
  include("include/header.php");

  $id = $_GET["id"];
  
  if ($id == 3) { // diretoria
    echo "<script>
            window.location.href='diretoria.php';
          </script>";
  }

  $sqlPagina = "SELECT nome, conteudo, dataAlteracao, autor, usuario, autorAprovacao, dataAprovacao FROM pagina JOIN perfil ON autor = idPerfil WHERE idPagina = " . $id;

  $resultPagina = $con->query($sqlPagina);

  if ($resultPagina->num_rows > 0) { // Exibindo cada linha retornada com a consulta
    while ($exibirPagina = $resultPagina->fetch_assoc()){
      $nome = $exibirPagina["nome"];
      $conteudo = $exibirPagina["conteudo"];
      $autor = ucwords($exibirPagina["usuario"]);

      $datetimeAlt = $exibirPagina["dataAlteracao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAlteracao = substr($datetime, 0, 10); 
      $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

      $datetimeAlt = $exibirPagina["dataAprovacao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAprovacao = substr($datetime, 0, 10); 
      $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

      $sqlAutorAprovacao = "SELECT usuario FROM pagina JOIN perfil ON autorAprovacao = idPerfil WHERE idPagina = " . $id;

      $resultAutorAprovacao = $con->query($sqlAutorAprovacao);

      if ($resultAutorAprovacao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
        while ($exibirAutorAprovacao = $resultAutorAprovacao->fetch_assoc()){
          $autorAprovacao = ucwords($exibirAutorAprovacao["usuario"]);
        }
      }

    } // fim while
  }
?>

<!-- Page Content -->
    <br>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <h1><?php echo $nome; ?></h1>

          <?php

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

          ?>
            <small><i>Última alteração realizada por <?php echo $autor; ?> em <?php echo $dataAlteracao; ?> às <?php echo $horaAlteracao; ?></i></small>
            <br>
            <small><i>Aprovado por <?php echo $autorAprovacao; ?> em <?php echo $dataAprovacao; ?> às <?php echo $horaAprovacao; ?></i></small>
          <?php

            }

          } 

          ?>
          
        </div>

        <?php

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

          ?>
            <div class="float-right col-md-4">
          <?php
              if (isAdmin($_SESSION['tipo'])){
          ?>
                <a class="btn btn-primary btn-block" href="editarPaginaAdmin.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
          <?php     
              }else{
          ?>
                <a class="btn btn-primary btn-block" href="editarPaginaUser.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
          <?php     
              }
          ?>      
            </div>
          <?php
            }
          }
          ?>
      </div>

      <!-- Page Heading/Breadcrumbs -->
      
      <!-- Intro Content -->

      <?php

        if (isset($_SESSION['login'])){

          if (isAdmin($_SESSION['tipo'])){

            $sqlPaginaPendente = "SELECT aprovacao FROM paginapendente WHERE idPaginaPendente = " . $id;

            $resultPaginaPendente = $con->query($sqlPaginaPendente);

            if ($resultPaginaPendente->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirPaginaPendente = $resultPaginaPendente->fetch_assoc()){
                $aprovacao = $exibirPaginaPendente["aprovacao"];
              } // fim while
            }

              if ($aprovacao == 0) {
      ?>

                <div class="alert alert-danger" role="alert">
                  Existem alterações nesta página com aprovação pendente. <a href="editarPaginaPendente.php?id=<?php echo $id; ?>" class="alert-link">Clique aqui</a> para acessá-las.
                </div>

      <?php
            }
          }
        }
      ?>

      <p style="text-align: justify;">
        <?php echo $conteudo; ?>
      </p>
    
    </div>
    <!-- /.container -->
    <br>
<?php
  include("include/footer.php");
?>