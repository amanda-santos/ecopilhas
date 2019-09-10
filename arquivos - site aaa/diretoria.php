<?php
  include("include/header.php");
?>

<!--início do modal para cadastrar novo membro da diretoria-->
<div class="modal fade bd-example-modal-sm" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLabel">Cadastrar</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

        <form class="form-horizontal" action="inserirDiretor.php" method="post" enctype="multipart/form-data" data-toggle="validator">

          <div class="form-group">
            <label class="control-label col-sm-12" for="nome">Nome: <span title="obrigatório">*</span> </label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="nome" name="nome" required></input>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-sm-12" for="cargo">Cargo: <span title="obrigatório">*</span> </label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="cargo" name="cargo" required></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="descricao">Descrição:</label>
            <div class="col-sm-12">
              <textarea class="form-control" id="descricao" name="descricao"></textarea> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="email">E-mail:</label>
            <div class="col-sm-12">
              <input type="email" class="form-control" id="email" name="email"></input>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-sm-12" for="imgPerfil">Imagem de perfil:</label>
            <div class="col-sm-12">
              <input type="file" class="form-control" id="imgPerfil" name="img[]">
              <small><i>Tamanho recomendado: 500x300px</i></small>
            </div> <!--fim col-sm-5-->
          </div> <!--fim form-group-->
         
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <input type="submit" class="btn btn-primary" value="Cadastrar" name = "cadastrar"></input>
    </div>

    </form>

  </div>
  </div>
</div>
<!--fim do modal para cadastrar novo membro da diretoria-->

<!-- Page Content -->
    <br>
    <div class="container">

        <?php

          // select do texto da seção

          $sqlPagina = "SELECT nome, conteudo, dataAlteracao, autor, usuario, autorAprovacao, dataAprovacao FROM pagina JOIN perfil ON autor = idPerfil WHERE idPagina = 3";

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

              $datetimeAprov = $exibirPagina["dataAprovacao"];
              $datetime = new DateTime($datetimeAprov);
              $datetime = $datetime->format('d/m/Y H:i:s');
              $dataAprovacao = substr($datetime, 0, 10); 
              $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

              $sqlAutorAprovacao = "SELECT usuario FROM pagina JOIN perfil ON autorAprovacao = idPerfil WHERE idPagina = 3";

              $resultAutorAprovacao = $con->query($sqlAutorAprovacao);

              if ($resultAutorAprovacao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirAutorAprovacao = $resultAutorAprovacao->fetch_assoc()){
                  $autorAprovacao = ucwords($exibirAutorAprovacao["usuario"]);
                }
              }

            } // fim while
          }

          // select de alterações no cadastro/edição de diretores

          $sqlDiretoria = "SELECT dataAlteracao, autor, usuario, dataAprovacao FROM diretoria JOIN perfil ON autor = idPerfil ORDER BY dataAprovacao DESC LIMIT 1;";

          $resultDiretoria = $con->query($sqlDiretoria);

          if ($resultDiretoria->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibirDiretoria = $resultDiretoria->fetch_assoc()){

              if($exibirDiretoria["dataAprovacao"] > $datetimeAprov) {
                $autor = ucwords($exibirDiretoria["usuario"]);

                $datetimeAlt = $exibirDiretoria["dataAlteracao"];
                $datetime = new DateTime($datetimeAlt);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $dataAlteracao = substr($datetime, 0, 10); 
                $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

                $datetimeAprov = $exibirDiretoria["dataAprovacao"];
                $datetime = new DateTime($datetimeAlt);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $dataAprovacao = substr($datetime, 0, 10); 
                $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

                $sqlAutorAprovacaoDir = "SELECT usuario FROM diretoria JOIN perfil ON autorAprovacao = idPerfil ORDER BY dataAlteracao DESC LIMIT 1";

                $resultAutorAprovacaoDir = $con->query($sqlAutorAprovacaoDir);

                if ($resultAutorAprovacaoDir->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                  while ($exibirAutorAprovacaoDir = $resultAutorAprovacaoDir->fetch_assoc()){
                    $autorAprovacao = ucwords($exibirAutorAprovacaoDir["usuario"]);
                  }
                }
              }
            } // fim while
          }

          ?>

          <!-- Team Members -->
          <h1><?php echo $nome; ?>

            <?php

            //botão editar

            if (isset($_SESSION['login'])){

              if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

            ?>
              <div class="float-right col-md-4">
            <?php
                if (isAdmin($_SESSION['tipo'])){
            ?>
                  <a class="btn btn-primary btn-block" href="editarPaginaAdmin.php?id=3"><i class="far fa-edit"></i> Editar</a>
            <?php     
                }else{
            ?>
                  <a class="btn btn-primary btn-block" href="editarPaginaUser.php?id=3"><i class="far fa-edit"></i> Editar</a>
            <?php     
                }
            ?>      
              </div>
            <?php
              }
            }
            ?>

          </h1>

      <?php
      if (isset($_SESSION['login'])){
        if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
          if (($autor != null) && ($autorAprovacao != null) && ($dataAlteracao != null) && ($dataAprovacao != null) && ($horaAlteracao != null) && ($horaAprovacao != null)) { 
      ?>
          <div style="padding-bottom: 10px;">
            <small><i>Última alteração realizada por <?php echo $autor; ?> em <?php echo $dataAlteracao; ?> às <?php echo $horaAlteracao; ?></i></small>
            <br>
            <small><i>Aprovado por <?php echo $autorAprovacao; ?> em <?php echo $dataAprovacao; ?> às <?php echo $horaAprovacao; ?></i></small>
          </div>
      <?php
          } 
        }
        if (isAdmin($_SESSION['tipo'])){

          $sqlAprovacao = "SELECT aprovacao FROM paginapendente WHERE idPaginaPendente = 3";

          $resultAprovacao = $con->query($sqlAprovacao);

          if ($resultAprovacao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibirAprovacao = $resultAprovacao->fetch_assoc()){
              $aprovacao = $exibirAprovacao["aprovacao"];
            } // fim while
          }

          if ($aprovacao == 0) {
      ?>
            <div class="alert alert-danger" role="alert">
              Existem alterações nesta página com aprovação pendente. <a href="editarPaginaPendente.php?id=3" class="alert-link">Clique aqui</a> para acessá-las.
            </div>
      <?php
          }
        }
      } 
      ?>

      <p style="text-align: justify;"><?php echo $conteudo; ?></p>
      
      <div class="row">

          <?php

              $sqlDiretores = "SELECT d.idDiretor, d.nome, d.email, d.descricao, d.cargo, d.img, d.dataAlteracao, d.autor, p.usuario, d.dataAprovacao FROM diretoria AS d JOIN perfil AS p ON d.autor = p.idPerfil ORDER BY idDiretor";

              $resultDiretores = $con->query($sqlDiretores);

              if ($resultDiretores->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirDiretores = $resultDiretores->fetch_assoc()){
                  $id = $exibirDiretores["idDiretor"];
                  $nome = ucwords($exibirDiretores["nome"]);
                  $email = $exibirDiretores["email"];
                  $descricao = $exibirDiretores["descricao"];
                  $cargo = $exibirDiretores["cargo"];
                  $img = $exibirDiretores["img"];
            ?>
                  <div class="col-lg-4 mb-4">
                    <div class="card h-100 text-center">
                      <img class="img-fluid rounded card-img-top crop-image-diretor" src="upload/img-diretor/<?php echo $img; ?>" alt="">
                      <div class="card-body">

                        <?php

                        if (isset($_SESSION['login'])){

                          if (isAdmin($_SESSION['tipo'])){

                            $sqlAprovacaoDir = "SELECT aprovacao FROM diretoriapendente WHERE idDiretorPendente = " . $id;

                            $resultAprovacaoDir = $con->query($sqlAprovacaoDir);

                            if ($resultAprovacaoDir->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                              while ($exibirAprovacaoDir = $resultAprovacaoDir->fetch_assoc()){
                                $aprovacao = $exibirAprovacaoDir["aprovacao"];
                              }
                            }

                            if ($aprovacao == 0) {
                        ?>

                              <div class="alert alert-danger" role="alert">
                                  Existem alterações com aprovação pendente. <a href="editarDiretorPendente.php?id=<?php echo $id; ?>" class="alert-link">Clique aqui</a> para acessá-las.
                              </div>

                        <?php
                            }
                          }
                        }
                        ?>

                        <h4 class="card-title"><?php echo $nome; ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $cargo; ?></h6>
                        <p class="card-text"><?php echo $descricao; ?></p>
                      </div>
                      <div class="card-footer">
                        <a href="#"><?php echo $email; ?></a>
                      </div>

                      <?php

                      if (isset($_SESSION['login'])){

                        if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

                      ?>

                          <script type="text/javascript">
                            function apagar(id, nome) {
                              if (window.confirm('Deseja realmente excluir o diretor "' + nome + '"?')) {
                                window.location = 'excluirDiretor.php?id=' + id;
                              }
                            }
                          </script>

                          <div class="card-footer">
                            
                            <?php
                                if (isAdmin($_SESSION['tipo'])){
                            ?>
                                  <a class="btn btn-primary btn-block" href="editarDiretorAdmin.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>

                                  <a class="btn btn-danger btn-block" href="#" onclick="apagar('<?php echo $id ?>', '<?php echo $nome ?>');"><i class="far fa-trash-alt"></i> Excluir</a>
                            <?php     
                                }else{
                            ?>
                                  <a class="btn btn-primary btn-block" href="editarDiretorUser.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
                            <?php     
                                }
                            ?> 

                          </div>
                      <?php
                        }
                      }
                      ?>    
                    </div>
                  </div>
          <?php
                } // fim while
              }
          ?>

      </div>
      <!-- /.row -->

      <div>

        <?php
        if (isset($_SESSION['login'])){
          if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
        ?>
            <div style="text-align: center;" class="col-12">
        <?php
              if (isAdmin($_SESSION['tipo'])){
        ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#cadastrar" href="">
                  <i class="fas fa-plus"></i>  
                  Cadastrar novo membro da diretoria
                </a>
        <?php     
              }
        ?>      
            </div>
        <?php
          }
        }
        ?>

      </div>
    </div> <!-- /.container -->
    <br>

<?php
  include("include/footer.php");
?>