<?php
  include("include/header.php"); //incluir arquivo com conexão ao banco de dados
?>

<?php

$id = 1;

?>

<!--início do modal para edição de dados de contato-->
<div class="modal fade bd-example-modal-sm" id="editarDadosContato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLabel">Contato</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <?php

        $SQL = "SELECT C.endereco, C.telefone, C.email, C.horarioFunc, P.usuario, C.dataAlteracao, C.dataAprovacao FROM contato AS C JOIN perfil AS P ON C.autor = P.idPerfil WHERE idContato = 1;";
        $result = $con->query($SQL);
        if ($result->num_rows > 0){
          while ($exibir = $result->fetch_assoc()){
            $endereco = $exibir["endereco"];
            $telefone = $exibir["telefone"];
            $email = $exibir["email"];
            $horarioFunc = $exibir["horarioFunc"];

            $autorCont = ucwords($exibir["usuario"]);

            $datetimeAltCont = $exibir["dataAlteracao"];
            $datetimeCont = new DateTime($datetimeAltCont);
            $datetimeCont = $datetimeCont->format('d/m/Y H:i:s');
            $dataAlteracaoCont = substr($datetimeCont, 0, 10); 
            $horaAlteracaoCont = substr($datetimeCont, 11, 2) . "h" . substr($datetimeCont, 14, 2) . "min"; 

            $datetimeAltCont = $exibir["dataAprovacao"];
            $datetimeCont = new DateTime($datetimeAltCont);
            $datetimeCont = $datetimeCont->format('d/m/Y H:i:s');
            $dataAprovacaoCont = substr($datetimeCont, 0, 10); 
            $horaAprovacaoCont = substr($datetimeCont, 11, 2) . "h" . substr($datetimeCont, 14, 2) . "min"; 

            $sql = "SELECT usuario FROM contato JOIN perfil ON autorAprovacao = idPerfil WHERE idContato = 1";

            $result = $con->query($sql);

            if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
              while ($exibir = $result->fetch_assoc()){
                $autorAprovacaoCont = ucwords($exibir["usuario"]);
              }
            }

          } //fim while
        } //fim if

        if (isset($_SESSION['login'])){

          if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

            if (isAdmin($_SESSION['tipo'])){
      ?>
              <form class="form-horizontal" action="atualizarContatoAdmin.php" method="post" data-toggle="validator">

      <?php     
            }else{
      ?>
              <form class="form-horizontal" action="atualizarContatoUser.php" method="post" data-toggle="validator">
      <?php     
            }
          }
        }
      ?>          

          <div class="form-group">
            <label class="control-label col-sm-12" for="endereco">Endereço:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="endereco" name="endereco" required value="<?php echo $endereco;?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="telefone">Telefone:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="telefone" name="telefone" required value="<?php echo $telefone;?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="email">E-mail:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="email" name="email" required value="<?php echo $email;?>"></input>
            </div>
          </div>
      
          <div class="form-group">
            <label class="control-label col-sm-12" for="horarioFunc">Horário de Funcionamento:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="horarioFunc" name="horarioFunc" required value="<?php echo $horarioFunc;?>"></input>
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
<!--fim do modal para edição de dados de contato-->

<!--início do modal para edição de dados de contato pendentes-->
<div class="modal fade bd-example-modal-sm" id="editarDadosContatoPendente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLabel">Contato</h3>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">

      <?php
        $SQL = "SELECT C.endereco, C.telefone, C.email, C.horarioFunc, P.usuario, P.idPerfil, C.dataAlteracao FROM contatopendente AS C JOIN perfil AS P ON autor = idPerfil WHERE idContatoPendente = 1;";
        $result = $con->query($SQL);
        if ($result->num_rows > 0){
          while ($exibir = $result->fetch_assoc()){
            $enderecoP = $exibir["endereco"];
            $telefoneP = $exibir["telefone"];
            $emailP = $exibir["email"];
            $horarioFuncP = $exibir["horarioFunc"];
            $autorId = $exibir["idPerfil"];
            $autorP = ucwords($exibir["usuario"]);
            $datetimeAlt = $exibir["dataAlteracao"];
            $datetime = new DateTime($datetimeAlt);
            $datetime = $datetime->format('d/m/Y H:i:s');
            $dataAlteracaoP = substr($datetime, 0, 10); 
            $horaAlteracaoP = substr($datetime, 11, 8);
          } //fim while
        } //fim if

        ?>
                
        <form class="form-horizontal" action="atualizarContatoPendente.php" method="post" data-toggle="validator"> 

          <div class="form-group">
            <label class="control-label col-sm-12" for="autorAprovacao">Autor(a):</label>
            <div class="col-sm-12">
              <input readonly type="text" class="form-control" id="autorAprovacao" name="autorAprovacao" required value="<?php echo $autorP;?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="dataEhoraAlt">Data de alteração:</label>
            <div class="col-sm-12">
              <input readonly type="text" class="form-control" id="dataEhoraAlt" name="dataEhoraAlt" required value="<?php echo $dataAlteracaoP;?> às <?php echo $horaAlteracaoP;?>"></input>
            </div>
          </div>

          <input hidden type="text" id="autor" name="autor" required value="<?php echo $autorId;?>"></input>

          <input hidden type="text" id="dataAlteracao" name="dataAlteracao" required value="<?php echo $datetimeAlt;?>"></input>

          <div class="form-group">
            <label class="control-label col-sm-12" for="endereco">Endereço:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="endereco" name="endereco" required value="<?php echo $enderecoP;?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="telefone">Telefone:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="telefone" name="telefone" required value="<?php echo $telefoneP;?>"></input>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="email">E-mail:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="email" name="email" required value="<?php echo $emailP;?>"></input>
            </div>
          </div>
      
          <div class="form-group">
            <label class="control-label col-sm-12" for="horarioFunc">Horário de Funcionamento:</label>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="horarioFunc" name="horarioFunc" required value="<?php echo $horarioFuncP;?>"></input>
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
<!--fim do modal para edição de dados de contato pendentes-->

<!-- Page Content -->
    <div class="container">

      <?php

        $sqlSecao = "SELECT nome, conteudo, dataAlteracao, autor, usuario, autorAprovacao, dataAprovacao FROM secao JOIN perfil ON autor = idPerfil WHERE idSecao = " . $id;

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

            $sqlAutorAprovacao = "SELECT usuario FROM secao JOIN perfil ON autorAprovacao = idPerfil WHERE idSecao = " . $id;

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

            $sqlSecaoPendente = "SELECT aprovacao FROM secaopendente WHERE idSecaoPendente = " . $id;

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

      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d934.2359266976481!2d-43.70846129796371!3d-20.508533801633885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa3fb53137c02d5%3A0x175caa8475aa5823!2sR.+Joaquim+Queir%C3%B3s+Jr%2C+21%2C+Ouro+Branco+-+MG%2C+36420-000%2C+Brazil!5e0!3m2!1sen!2sus!4v1547594836649" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Faça-nos uma visita ou entre em contato</h3>

          <?php

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

          ?>
              <small><i>Última alteração realizada por <?php echo $autorCont; ?> em <?php echo $dataAlteracaoCont; ?> às <?php echo $horaAlteracaoCont; ?></i></small>
              <br>
              <small><i>Aprovado por <?php echo $autorAprovacaoCont; ?> em <?php echo $dataAprovacaoCont; ?> às <?php echo $horaAprovacaoCont; ?><br><br></i></small>
          <?php

            }

            if (isAdmin($_SESSION['tipo'])){

              $sql = "SELECT aprovacao FROM contatopendente WHERE idContatoPendente = 1";

              $result = $con->query($sql);

              if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                while ($exibir = $result->fetch_assoc()){
                  $aprovacaoCont = $exibir["aprovacao"];
                } // fim while
              }

              if ($aprovacaoCont == 0) {
          ?>

                <div class="alert alert-danger" role="alert">
                  Existem alterações nos dados de contato com aprovação pendente. <a href="" data-toggle="modal" data-target="#editarDadosContatoPendente" class="alert-link">Clique aqui</a> para acessá-las.
                </div>

          <?php
              }
            }
          } 
          ?>

          <p>
            <?php echo $endereco;?>
          </p>
          <p>
            <abbr title="Telefone">Tel</abbr>: <?php echo $telefone;?>
          </p>
          <p>
            <abbr title="Email">E</abbr>:
            <a href="mailto:<?php echo $email;?>"><?php echo $email;?>
            </a>
          </p>
          <p>
            <abbr title="Horário de Funcionamento">H</abbr>: <?php echo $horarioFunc;?>
          </p>

          <?php

          if (isset($_SESSION['login'])){

            if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 

              if (isAdmin($_SESSION['tipo'])){
          ?>
                <a class="btn btn-primary btn-block" href="" data-toggle="modal" data-target="#editarDadosContato"><i class="far fa-edit"></i> Editar Dados de Contato</a>
          <?php     
              }else{
          ?>
                <a class="btn btn-primary btn-block" href="" data-toggle="modal" data-target="#editarDadosContato"><i class="far fa-edit"></i> Editar Dados de Contato</a>
          <?php     
              }
            }
          }
          ?>

        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Envie-nos uma mensagem</h3>
          <form action="mail/enviarMensagem.php" method="post" data-toggle="validator">
            <div class="control-group form-group">
              <div class="controls">
                <label>Nome completo:</label>
                <input type="text" class="form-control" id="nome" name="nome" required data-validation-required-message="Por favor, digite o seu nome completo.">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" required data-validation-required-message="Por favor, digite o seu telefone.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Endereço de e-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Por favor, digite o seu endereço de e-mail.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Mensagem:</label>
                <textarea rows="10" cols="100" class="form-control" id="mensagem" name="mensagem" required data-validation-required-message="Por favor, digite a sua mensagem." maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" name="enviarMensagem">Enviar mensagem</button>
          </form>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
  include("include/footer.php");
?>