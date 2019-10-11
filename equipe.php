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

        <form class="form-horizontal" action="inserirMembroEquipe.php" method="post" enctype="multipart/form-data" data-toggle="validator">

          <div class="form-group">
            <label class="control-label col-sm-12" for="nome">Nome: <span title="obrigatório">*</span> </label>
            <div class="col-sm-12">
              <input maxlength="200" type="text" class="form-control" id="nome" name="nome" required></input>
            </div>
          </div> 

          <div class="form-group">
            <label class="control-label col-sm-12" for="cargo">Cargo: <span title="obrigatório">*</span> </label>
            <div class="col-sm-12">
              <input maxlength="200" type="text" class="form-control" id="cargo" name="cargo" required></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="descricao">Descrição:</label>
            <div class="col-sm-12">
              <textarea maxlength="500" class="form-control" id="descricao" name="descricao"></textarea> 
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="email">E-mail:</label>
            <div class="col-sm-12">
              <input maxlength="200" type="email" class="form-control" id="email" name="email"></input>
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

          $sqlPagina = "SELECT P.nome, P.conteudo, P.dataAlteracao, U.idUsuario, U.nome AS Unome, dataAprovacao 
                          FROM Pagina AS P 
                          JOIN Usuario AS U 
                          ON P.Usuario_idUsuario_autor = U.idUsuario 
                          WHERE idPagina = 2";

          $resultPagina = $con->query($sqlPagina);

          if ($resultPagina->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibirPagina = $resultPagina->fetch_assoc()){
              $nome = $exibirPagina["nome"];
              $conteudo = $exibirPagina["conteudo"];
              $autor = ucwords($exibirPagina["Unome"]);

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

              $sqlAutorAprovacao = "SELECT U.nome 
                                      FROM Pagina AS P 
                                      JOIN Usuario AS U 
                                      ON P.Usuario_idUsuario_autorAprovacao = U.idUsuario 
                                      WHERE idPagina = 2";

              $resultAutorAprovacao = $con->query($sqlAutorAprovacao);

              if ($resultAutorAprovacao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirAutorAprovacao = $resultAutorAprovacao->fetch_assoc()){
                  $autorAprovacao = ucwords($exibirAutorAprovacao["nome"]);
                }
              }

            } // fim while
          }

          // select de alterações no cadastro/edição de diretores

          $sqlEquipe = "SELECT ME.dataAlteracao, U.idUsuario, U.nome AS Unome, ME.dataAprovacao 
                          FROM MembroEquipe AS ME
                          JOIN Usuario AS U 
                          ON ME.Usuario_idUsuario_autor = U.idUsuario 
                          ORDER BY ME.dataAprovacao DESC LIMIT 1;";

          $resultEquipe = $con->query($sqlEquipe);

          if ($resultEquipe->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibirEquipe = $resultEquipe->fetch_assoc()){

              if($exibirEquipe["dataAprovacao"] > $datetimeAprov) {
                $autor = ucwords($exibirEquipe["Unome"]);

                $datetimeAlt = $exibirEquipe["dataAlteracao"];
                $datetime = new DateTime($datetimeAlt);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $dataAlteracao = substr($datetime, 0, 10); 
                $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

                $datetimeAprov = $exibirEquipe["dataAprovacao"];
                $datetime = new DateTime($datetimeAlt);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $dataAprovacao = substr($datetime, 0, 10); 
                $horaAprovacao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";

                $sqlAutorAprovacaoEquip = "SELECT U.nome 
                                          FROM MembroEquipe AS ME 
                                          JOIN Usuario AS U
                                          ON ME.Usuario_idUsuario_autorAprovacao = U.idUsuario 
                                          ORDER BY ME.dataAlteracao DESC LIMIT 1";

                $resultAutorAprovacaoEquip = $con->query($sqlAutorAprovacaoEquip);

                if ($resultAutorAprovacaoEquip->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                  while ($exibirAutorAprovacaoEquip = $resultAutorAprovacaoEquip->fetch_assoc()){
                    $autorAprovacao = ucwords($exibirAutorAprovacaoEquip["nome"]);
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
            ?>
              <div class="float-right col-md-4">
            <?php
                if (isAdmin($_SESSION['tipo'])){
            ?>
                  <a class="btn btn-primary btn-block" href="editarPaginaAdmin.php?id=2"><i class="far fa-edit"></i> Editar</a>
            <?php     
                }else{
            ?>
                  <a class="btn btn-primary btn-block" href="editarPaginaUser.php?id=2"><i class="far fa-edit"></i> Editar</a>
            <?php     
                }
            ?>      
              </div>
            <?php
            }
            ?>

          </h1>

      <?php
      if (isset($_SESSION['login'])){
          if (($autor != null) && ($autorAprovacao != null) && ($dataAlteracao != null) && ($dataAprovacao != null) && ($horaAlteracao != null) && ($horaAprovacao != null)) { 
      ?>
          <div style="padding-bottom: 10px;">
            <small><i>Última alteração realizada por <?php echo $autor; ?> em <?php echo $dataAlteracao; ?> às <?php echo $horaAlteracao; ?></i></small>
            <br>
            <small><i>Aprovado por <?php echo $autorAprovacao; ?> em <?php echo $dataAprovacao; ?> às <?php echo $horaAprovacao; ?></i></small>
          </div>
      <?php
          } 
        if (isAdmin($_SESSION['tipo'])){
          $sqlAprovacao = "SELECT aprovacao FROM PaginaPendente WHERE idPaginaPendente = 2";
          $resultAprovacao = $con->query($sqlAprovacao);

          if ($resultAprovacao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibirAprovacao = $resultAprovacao->fetch_assoc()){
              $aprovacao = $exibirAprovacao["aprovacao"];
            } // fim while
          }

          if ($aprovacao == 0) {
      ?>
            <div class="alert alert-danger" role="alert">
              Existem alterações nesta página com aprovação pendente. <a href="editarPaginaPendente.php?id=2" class="alert-link">Clique aqui</a> para acessá-las.
            </div>
      <?php
          }
        }
      } 
      ?>

      <p style="text-align: justify;"><?php echo $conteudo; ?></p>
      
      <div class="row">

          <?php

              $sqlMembros = "SELECT ME.idMembroEquipe, ME.nome, ME.email, ME.descricao, ME.cargo, ME.img, ME.dataAlteracao, U.idUsuario, U.nome AS Unome, ME.dataAprovacao 
                              FROM MembroEquipe AS ME 
                              JOIN Usuario AS U 
                              ON ME.Usuario_idUsuario_autor = U.idUsuario 
                              ORDER BY ME.idMembroEquipe";

              $resultMembros = $con->query($sqlMembros);

              if ($resultMembros->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibirMembros = $resultMembros->fetch_assoc()){
                  $id = $exibirMembros["idMembroEquipe"];
                  $nome = ucwords($exibirMembros["nome"]);
                  $email = $exibirMembros["email"];
                  $descricao = $exibirMembros["descricao"];
                  $cargo = $exibirMembros["cargo"];
                  $img = $exibirMembros["img"];
            ?>
                  <div class="col-lg-4 mb-4">
                    <div class="card h-100 text-center">
                      <img class="img-fluid rounded card-img-top crop-image-diretor" src="upload/img-membro-equipe/<?php echo $img; ?>" alt="">
                      <div class="card-body">

                        <?php

                        if (isset($_SESSION['login'])){

                          if (isAdmin($_SESSION['tipo'])){

                            $sqlAprovacaoMem = "SELECT aprovacao 
                                                  FROM MembroEquipePendente 
                                                  WHERE idMembroEquipePendente = " . $id;

                            $resultAprovacaoMem = $con->query($sqlAprovacaoMem);

                            if ($resultAprovacaoMem->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                              while ($exibirAprovacaoMem = $resultAprovacaoMem->fetch_assoc()){
                                $aprovacao = $exibirAprovacaoMem["aprovacao"];
                              }
                            }

                            if ($aprovacao == 0) {
                        ?>

                              <div class="alert alert-danger" role="alert">
                                  Existem alterações com aprovação pendente. <a href="editarMembroEquipePendente.php?id=<?php echo $id; ?>" class="alert-link">Clique aqui</a> para acessá-las.
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
                      ?>

                          <script type="text/javascript">
                            function apagar(id, nome) {
                              if (window.confirm('Deseja realmente excluir o membro "' + nome + '"?')) {
                                window.location = 'excluirMembroEquipe.php?id=' + id;
                              }
                            }
                          </script>

                          <div class="card-footer">
                            
                            <?php
                                if (isAdmin($_SESSION['tipo'])){
                            ?>
                                  <a class="btn btn-primary btn-block" href="editarMembroEquipeAdmin.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
                                  <a class="btn btn-danger btn-block" href="#" onclick="apagar('<?php echo $id ?>', '<?php echo $nome ?>');"><i class="far fa-trash-alt"></i> Excluir</a>
                            <?php     
                                }else{
                            ?>
                                  <a class="btn btn-primary btn-block" href="editarMembroEquipeUser.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i> Editar</a>
                            <?php     
                                }
                            ?> 

                          </div>
                      <?php
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
        ?>
            <div style="text-align: center;" class="col-12">
        <?php
              if (isAdmin($_SESSION['tipo'])){
        ?>
                <a class="btn btn-primary" data-toggle="modal" data-target="#cadastrar" href="">
                  <i class="fas fa-plus"></i>  
                  Cadastrar novo membro da equipe
                </a>
        <?php     
              }
        ?>      
            </div>
        <?php
        }
        ?>

      </div>
    </div> <!-- /.container -->
    <br>

<?php
  include("include/footer.php");
?>