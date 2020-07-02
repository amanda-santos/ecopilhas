<?php
  include("include/header.php");

  $id = $_GET["id"];

  $sqlSecao = "SELECT ecopilhas.Secao.nome, conteudo, dataAlteracao, autor, autorAprovacao, dataAprovacao, usuario FROM ecopilhas.Secao JOIN ecopilhas.Usuario ON autor = idUsuario WHERE idSecao = " . $id;

  $resultSecao = $con->query($sqlSecao);

  if ($resultSecao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
    while ($exibirSecao = $resultSecao->fetch_assoc()){
      $nome = ucwords($exibirSecao["nome"]);
      $conteudo = $exibirSecao["conteudo"];
      $autor = ucwords($exibirSecao["usuario"]);

      $datetimeAlt = $exibirSecao["dataAlteracao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAlteracao = substr($datetime, 0, 10); 
      $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

      $datetimeAlt = $exibirSecao["dataAprovacao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAprovacao = substr($datetime, 0, 10); 
      $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

      $sqlAutorAprovacao = "SELECT usuario FROM ecopilhas.Secao JOIN ecopilhas.Usuario ON autorAprovacao = idUsuario WHERE idSecao = " . $id;

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

            //if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

          ?>
            <small><i>Última alteração realizada por <?php echo $autor; ?> em <?php echo $dataAlteracao; ?> às <?php echo $horaAlteracao; ?></i></small>
            <br>
            <small><i>Aprovado por <?php echo $autorAprovacao; ?> em <?php echo $dataAprovacao; ?> às <?php echo $horaAprovacao; ?></i></small>
          <?php

            }

          //} 

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
                <a class="btn btn-primary btn-block" href="editarSecaoAdmin.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
          <?php     
              }else{
          ?>
                <a class="btn btn-primary btn-block" href="editarSecaoUser.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
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

            $sqlSecaoPendente = "SELECT aprovacao FROM ecopilhas.SecaoPendente WHERE idSecaoPendente = " . $id;

            $resultSecaoPendente = $con->query($sqlSecaoPendente);

            if ($resultSecaoPendente->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirSecaoPendente = $resultSecaoPendente->fetch_assoc()){
                $aprovacao = $exibirSecaoPendente["aprovacao"];
              } // fim while
            }

              if ($aprovacao == 0) {
      ?>

                <div class="alert alert-danger" role="alert">
                  Existem alterações nesta página com aprovação pendente. <a href="editarSecaoPendente.php?id=<?php echo $id; ?>" class="alert-link">Clique aqui</a> para acessá-las.
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