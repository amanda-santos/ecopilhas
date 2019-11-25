<?php
	include("include/header.php");

  $id = $_GET["id"];

  $SQL = "SELECT idSecaoPosts, titulo, conteudo, img, usuario, nomeSite, dataAlteracao, dataAprovacao, dataPostagem FROM ecopilhas.Post JOIN ecopilhas.Usuario ON autorAlteracao = idUsuario WHERE idPost = $id;";

  $result = $con->query($SQL);

  if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
    while ($exibir = $result->fetch_assoc()){
      $idSecao = $exibir["idSecaoPosts"];
      $titulo = $exibir["titulo"];
      $conteudo = $exibir["conteudo"];
      $img = $exibir["img"];
      $autor = $exibir["nomeSite"];

      $datetimePost = $exibir["dataPostagem"];
      $datetime = new DateTime($datetimePost);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $data = substr($datetime, 0, 10); 
      $hora = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min"; 

      $autorAlteracao = ucwords($exibir["usuario"]);

      $datetimeAlt = $exibir["dataAlteracao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAlteracao = substr($datetime, 0, 10); 
      $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min"; 

      $datetimeAlt = $exibir["dataAprovacao"];
      $datetime = new DateTime($datetimeAlt);
      $datetime = $datetime->format('d/m/Y H:i:s');
      $dataAprovacao = substr($datetime, 0, 10); 
      $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

      $sql = "SELECT usuario FROM ecopilhas.Post JOIN ecopilhas.Usuario ON autorAprovacao = idUsuario WHERE idPost = $id;";

      $result = $con->query($sql);

      if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
        while ($exibir = $result->fetch_assoc()){
          $autorAprovacao = ucwords($exibir["usuario"]);
        }
      }
    }
  }else{
    echo "Nenhum post encontrado.";
  }
?>

<!-- Page Content -->
    <div class="container">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
            <h1 class="mt-4"><?php echo $titulo; ?>                     
          </h1>

          <!-- Author -->
          <p class="lead">
           por
           <?php echo $autor; ?>
          </p>

          <?php
          if (isset($_SESSION['login'])){
            if (isAdmin($_SESSION['tipo'])){

              $sql = "SELECT aprovacao FROM ecopilhas.PostPendente WHERE idPostPendente = $id";

              $result = $con->query($sql);

              if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibir = $result->fetch_assoc()){
                  $aprovacao = $exibir["aprovacao"];
                } // fim while
              }

              if ($aprovacao == 0) {
          ?>
                <div class="alert alert-danger" role="alert">
                  Existem alterações nesta postagem com aprovação pendente. <a href="editarPostPendente.php?idPost=<?php echo $id; ?>&idSecao=<?php echo $idSecao; ?>" class="alert-link">Clique aqui</a> para acessá-las.
                </div>
          <?php
              }
            }
          }
          ?>

          <?php

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

          ?>
            <p >
              <small><i>Última alteração realizada por <?php echo $autorAlteracao; ?> em <?php echo $dataAlteracao; ?> às <?php echo $horaAlteracao; ?></i></small>
              <br>
              <small><i>Aprovado por <?php echo $autorAprovacao; ?> em <?php echo $dataAprovacao; ?> às <?php echo $horaAprovacao; ?></i></small>
            </p>
          <?php

            }

          } 

          ?>

          <!-- Preview Image -->
          <img class="img-fluid rounded crop-image-post " src="upload/img-post/<?php echo $img; ?>" alt="">

          <hr>

          <!-- Date/Time -->
          <p>Postado em <?php echo $data; ?>, às  <?php echo $hora; ?></p>

          <hr>

          <!-- Post Content -->
          <?php echo $conteudo; 

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) {
          ?>
              <hr>

              <a class="btn btn-primary btn-block" href="editarPost.php?idPost=<?php echo $id;?>&idSecao=<?php echo $idSecao; ?>"><i class="far fa-edit"></i> Editar Postagem</a>
          <?php 
              if (isAdmin($_SESSION['tipo'])){ 
          ?>
                <script type="text/javascript">
                  function apagar(idSecao, idPost, nome) {
                    if (window.confirm('Deseja realmente excluir a postagem "' + nome + '"?')) {
                      window.location = 'excluirPost.php?idPost=' + idPost + '&idSecao=' + idSecao;
                    }
                  }
                </script>
                <div style="padding-top: 5px">
                  <a class="btn btn-danger btn-block" href="#" onclick="apagar('<?php echo $idSecao ?>', '<?php echo $id ?>', '<?php echo $titulo ?>');"><i class="far fa-trash-alt"></i> Excluir Postagem</a>
                </div>
          <?php
              }
            }
          }
          ?>

          <hr>

          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Deixe um comentário:</h5>
            <div class="card-body">
              <form class="form-horizontal" method="POST" action="inserirComentario.php?id=<?php echo $id; ?>">
                <div class="form-group">
                  <label class="control-label" for="nome">Nome: <span title="obrigatório">*</span> </label>
                  <input type="text" name="nome" id="nome" class="form-control" required></input>
                </div>
                <div class="form-group">
                  <label class="control-label" for="comentario">Comentário: <span title="obrigatório">*</span> </label>
                  <textarea maxlength="1000" required name="comentario" id="comentario" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
              </form>
            </div>
          </div>

          <?php
              $sql = "SELECT * FROM ecopilhas.Comentario WHERE idPost = $id ORDER BY dataEnvio DESC";

              $result = $con->query($sql);

              if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibir = $result->fetch_assoc()){
                  $idComentario = $exibir["idComentario"];
                  $nome = ucwords($exibir["nome"]);
                  $comentario = $exibir["comentario"];

                  $datetimeComentario = $exibir["dataEnvio"];
                  $datetime = new DateTime($datetimeComentario);
                  $datetime = $datetime->format('d/m/Y H:i:s');
                  $dataComentario = substr($datetime, 0, 10); 
                  $horaComentario = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min"; 
          ?>
                  <!-- Single Comment -->
                  <div class="media mb-4">
                    <div class="media-body">
                      <h5 class="mt-0">

                        <?php echo $nome; ?>

                        <small><small><i><?php echo $dataComentario . " às " . $horaComentario ;?> </i></small></small>

                        <?php
                          if (isset($_SESSION['login'])){
                            if (isAdmin($_SESSION['tipo'])){
                        ?>
                              <a title="Excluir comentário" style="float:right; margin-left:5px;" href="#" onclick="apagarComentario('<?php echo $idComentario ?>','<?php echo $id ?>' );" class="btn btn-sm btn-danger">
                                <i class="far fa-trash-alt"></i>
                              </a>
                        <?php
                            }
                          }
                        ?>

                      </h5>

                        <?php echo $comentario; ?>

                    </div>
                  </div>
          <?php
                } // fim while
              }
          ?>

          <script type="text/javascript">
            function apagarComentario(id_comentario, id_post) {
              if (window.confirm('Deseja realmente apagar o comentário?')) {
                window.location = 'excluirComentario.php?idComentario=' + id_comentario + '&idPost=' + id_post;
              }
            }
          </script>

          <!-- Comment with nested comments 
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Nome</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Nome</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Nome</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

            </div>
          </div>-->

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
	include("include/footer.php");
?>