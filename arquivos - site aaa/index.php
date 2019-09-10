<?php
  include("include/header.php"); // incluir arquivo com header do site
  include("include/limitaTexto.php");
?>

    <!--início do modal para edição do título do index-->
    <div class="modal fade bd-example-modal-sm" id="editarTituloIndex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">

      <?php
          $sqlTituloIndex = "SELECT conteudo FROM itemsite WHERE idItemSite = 1;";
          $resultTituloIndex = $con->query($sqlTituloIndex);
          if ($resultTituloIndex->num_rows > 0){
            while ($exibirTituloIndex = $resultTituloIndex->fetch_assoc()){
              $tituloIndex = $exibirTituloIndex["conteudo"];
            } //fim while
          } //fim if
        ?>

      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Editar</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form class="form-horizontal" action="atualizarTituloIndex.php" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="conteudoTituloIndex">Texto:</label>
                <div class="col-sm-12">
                  <textarea class="form-control" id="conteudoTituloIndex" name="conteudoTituloIndex" placeholder="Insira o texto"><?php echo $tituloIndex;?></textarea> 
                </div>
              </div>
             
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Atualizar" name = "atualizar"></input>
        </div>

        </form>

      </div>
      </div>
    </div>
    <!--fim do modal para edição do título do index-->

    <!-- Page Content -->
    <div class="container">

      <h3 class="my-4">

        <?php 

          echo $tituloIndex;

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
        ?>
              <a href="" data-toggle="modal" data-target="#editarTituloIndex"><i class="far fa-edit"></i></a>
        <?php    
            }
          }
        ?>

      </h3>

      <!-- seções de páginas -->

      <?php

        $sqlSecaoPaginasIndex = "SELECT idSecaoPaginas, titulo FROM secaopaginas WHERE exibir = 1";

        $resultSecaoPaginasIndex = $con->query($sqlSecaoPaginasIndex);

        if ($resultSecaoPaginasIndex->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPaginasIndex = $resultSecaoPaginasIndex->fetch_assoc()){
            $idSecaoPaginasIndex = $exibirSecaoPaginasIndex["idSecaoPaginas"];
            $nomeSecaoPaginasIndex = ucwords($exibirSecaoPaginasIndex["titulo"]);
      ?>
            <h3><?php echo $nomeSecaoPaginasIndex; ?></h3><br>
          
            <div class="row">
              
              <?php

                $sqlPaginaIndex = "SELECT idPagina, nome, conteudo FROM pagina WHERE exibir = 1 AND idSecaoPaginas = " . $idSecaoPaginasIndex;

                $resultPaginaIndex = $con->query($sqlPaginaIndex);

                if ($resultPaginaIndex->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                  while ($exibirPaginaIndex = $resultPaginaIndex->fetch_assoc()){
                    $idPaginaIndex = $exibirPaginaIndex["idPagina"];
                    $nomePaginaIndex = ucwords($exibirPaginaIndex["nome"]);
                    $conteudoPaginaIndex = $exibirPaginaIndex["conteudo"];
              ?>

                    <div class="col-lg-4 mb-4">
                      <div class="card h-100">
                        <h4 class="card-header"><?php echo $nomePaginaIndex; ?></h4>
                        <div class="card-body">
                          <p style="padding-top: -50px;" class="card-text"><?php echo limitarTexto($conteudoPaginaIndex, $limite=200);?></p>
                        </div>
                        <div class="card-footer">
                          <a href="pagina.php?id=<?php echo $idPaginaIndex; ?>" class="btn btn-primary">Saiba Mais</a>
                        </div>
                      </div>
                    </div>

              <?php
                  } // fim while pagina
                } // fim if pagina
              ?>
              
            </div>
            <!-- /.row -->
            <hr>

      <?php
          } // fim while SecaoPaginas
        } // fim if SecaoPaginas
      ?>

      <!-- fim seções de páginas -->

      <!-- associe-se -->
      <div class="row mb-4">
        <div class="col-md-4">
        </div>
        <div class="col-md-4" >
          <a class="btn btn-lg btn-primary btn-block" style="text-align: center;" href="associar.php">Associe-se</a>
        </div>
      </div>

      <!-- seções de postagens -->

      <?php
        
        $sqlSecaoPosts = "SELECT id,titulo FROM secaoposts WHERE exibir = 1;";

        $resultSecaoPosts = $con->query($sqlSecaoPosts);

        if ($resultSecaoPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPosts = $resultSecaoPosts->fetch_assoc()){
            $idSecao = $exibirSecaoPosts["id"];
            $tituloSecao = $exibirSecaoPosts["titulo"];
      ?>
            <hr>

            <div class="row">
              <div class="col-lg-8 col-sm-6 ">
                <h2><?php echo $tituloSecao;?></h2>
              </div>
              <div class="col-lg-4 col-sm-6">
                <a class="float-right" href="postagens.php?id=<?php echo $idSecao;?>">Ver todas as postagens</a>
              </div>
            </div>

            <div class="row">

            <?php

              $sqlPosts = "SELECT idPost, titulo, conteudo, img FROM post WHERE cadastro = 1 AND idSecaoPosts = " . $idSecao . " ORDER BY dataAprovacao DESC LIMIT 3;";

              $resultPosts = $con->query($sqlPosts);

              if ($resultPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirPosts = $resultPosts->fetch_assoc()){
                  $idPost = $exibirPosts["idPost"];
                  $titulo = $exibirPosts["titulo"];
                  $conteudo = $exibirPosts["conteudo"];
                  $img = $exibirPosts["img"];
            ?>
                  <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                      <a href="post.php?id=<?php echo $idPost; ?>">
                        <img class="card-img-top crop-image-post-index" src="upload/img-post/<?php echo $img; ?>" alt="">
                      </a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="post.php?id=<?php echo $idPost; ?>"><?php echo $titulo; ?></a>
                        </h4>
                        <p class="card-text"><?php echo limitarTexto($conteudo, $limite=270); ?></p>
                      </div>
                      <div class="card-footer">
                        <a href="post.php?id=<?php echo $idPost; ?>" class="btn btn-primary">Saiba Mais</a>
                      </div>
                    </div>
                  </div>

            <?php

                } // fim while
              } // fim if

            ?>
                  
        </div>
        <!-- /.row -->

      <?php

          } // fim while
        } // fim if

      ?>

      <!-- fim seções de postagens -->

      <br>

    </div>
    <!-- /.container -->

<?php
  include("include/footer.php");
?>