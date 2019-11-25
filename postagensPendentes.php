<?php
  include("include/header.php");
 // include("include/limitaTexto.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
      if (isAdmin($_SESSION['tipo'])){

        $idSecao = $_GET["id"];

        $sqlSecao = "SELECT * FROM ecopilhas.SecaoPosts WHERE idSecaoPosts = $idSecao;";

        $resultSecao = $con->query($sqlSecao);

        if ($resultSecao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecao = $resultSecao->fetch_assoc()){
            $tituloSecao = $exibirSecao["titulo"];
          }
        }

?>

          <!-- Page Content -->
          <div class="container">

            <!-- Page Heading/Breadcrumbs -->
            <h1 style="padding-bottom: 10px;">

            <?php 

            echo $tituloSecao;

            ?>

            </h1>

            <?php

              //paginação

              //A quantidade de páginas a serem exibidas
              $quantidade = 5;

              //a pagina atual
              $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

              //calcula a pagina de qual valor será exibido
              $inicio = ($quantidade * $pagina) - $quantidade;

              $SQL = "SELECT idPostPendente, titulo, conteudo, img, nomeSite, dataAlteracao FROM ecopilhas.PostPendente JOIN ecopilhas.Usuario ON autorAlteracao = idUsuario WHERE aprovacao = 0 AND cadastro = 0 AND idSecaoPosts = " . $idSecao . " ORDER BY dataAlteracao DESC LIMIT $inicio, $quantidade;";

              $result = $con->query($SQL);

              if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibir = $result->fetch_assoc()){
                  $idPost = $exibir["idPostPendente"];
                  $titulo = $exibir["titulo"];
                  $conteudo = $exibir["conteudo"];
                  $img = $exibir["img"];
                  $autor = $exibir["nomeSite"];
                  $datetimeAlt = $exibir["dataAlteracao"];
                  $datetime = new DateTime($datetimeAlt);
                  $datetime = $datetime->format('d/m/Y H:i:s');
                  $dataAlteracao = substr($datetime, 0, 10);
            ?>

                  <!-- Blog Post -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                          <a href="editarPostPendente.php?idPost=<?php echo $idPost; ?>&idSecao=<?php echo $idSecao; ?>">
                            <img class="img-fluid rounded crop-image-postagens" src="upload/img-post/<?php echo $img; ?>" alt="">
                          </a>
                        </div>
                        <div class="col-lg-6">
                          <h2 class="card-title"><?php echo $titulo; ?></h2>
                          <p class="card-text"><?php echo limitarTexto($conteudo, $limite=270); ?></p>
                          <a href="editarPostPendente.php?idPost=<?php echo $idPost; ?>&idSecao=<?php echo $idSecao; ?>" class="btn btn-primary">Leia mais &rarr;</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-muted">
                      Postado em <?php echo $dataAlteracao; ?> por
                      <a href="#"><?php echo $autor; ?></a>
                    </div>
                  </div>

            <?php
                } // fim while
              } // fim if
            
            /**
             * SEGUNDA PARTE DA PAGINAÇÃO
             */

            //SQL para saber o total
            $sqlTotalRegistros = "SELECT COUNT(idPostPendente) AS totalRegistros FROM ecopilhas.PostPendente WHERE aprovacao = 0 AND cadastro = 0 AND idSecaoPosts = " . $idSecao . ";";

            $resultTotalRegistros = $con->query($sqlTotalRegistros);

            if ($resultTotalRegistros->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibirTotalRegistros = $resultTotalRegistros->fetch_assoc()){
                $totalRegistros = $exibirTotalRegistros["totalRegistros"];
              }
            }

            // o calculo do total de páginas a ser exibido
            $totalPagina= ceil($totalRegistros / $quantidade);

            // define o valor máximo a ser exibida na paginação tanto para direita quando para esquerda
            $exibir = 3;

            /**
            * Aqui montará o link que voltará uma pagina
            * Caso o valor seja zero, por padrão ficará o valor 1
            */
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;

            /**
            * Aqui montará o link que irá para a proxima pagina
            * Caso pagina + 1 for maior ou igual ao total, ele terá o valor do total
            * caso contrario, ele pegará o valor da página + 1
            */
            $posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;

            ?>

            <ul class="pagination justify-content-center"> <!-- inicio paginação -->

              <?php
              
                // exibindo a primeira página
                echo "
                <li class='page-item'>
                  <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=1'>Primeira Página</a>
                </li>";

                // exibindo a página anterior
                echo "
                <li class='page-item'>
                  <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $anterior . "'>Anterior</a>
                </li>";

                // exibindo valores à esquerda
                for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
                  if($i > 0)
                    echo "
                    <li class='page-item'>
                      <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $i . "'>" . $i ."</a>
                    </li>";
                }

                // exibindo a página atual
                echo "
                    <li class='page-item'>
                      <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $pagina . "'><strong>" . $pagina. "</strong></a>
                    </li>";

                // exibindo valores à direita
                for($i = $pagina+1; $i < $pagina+$exibir; $i++){
                     if($i <= $totalPagina)
                      echo "
                          <li class='page-item'>
                            <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $i ."'>" . $i ."</a>
                          </li>";
                }

                // exibindo a próxima página
                echo "
                    <li class='page-item'>
                      <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $posterior . "'>Próxima</a>
                    </li>";

                // exibindo a última página
                echo "
                    <li class='page-item'>
                      <a class='page-link' href='postagensPendentes.php?id=" . $idSecao . "&pagina=" . $totalPagina . "'>Última Página</a>
                    </li>";
            ?>

            </ul> <!-- fim paginação -->

            <br>

          </div>

        </div>
        <!-- /.container -->

<?php
      include("include/footer.php");
    }else {
      echo "<script>window.location = 'index.php';</script>";
    }
  } else {
    echo "<script>window.location = 'index.php';</script>";
  }
?>