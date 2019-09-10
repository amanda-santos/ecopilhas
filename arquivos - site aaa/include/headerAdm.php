<?php 
  include ("conexao.php"); 
  session_start();
  include("testaAdmin.php");
  $tipo = $_SESSION["tipo"];

  //Caso o usuário não esteja autenticado, limpa os dados e redireciona
  if (!isset($_SESSION['login']) and ! isset($_SESSION['senha'])) {
      //Destrói
      session_destroy();

      //Limpa
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      unset($_SESSION['tipo']);

      //Redireciona para a página de autenticação
      echo"<script language='javascript' type='text/javascript'>alert('Para acessar esta página é preciso fazer login.');window.location.href='index.php';</script>";
      die();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Associação dos Aposentados e Pensionistas de Ouro Branco</title>

  <script src="vendor/components/jquery/jquery.min.js" type="text/javascript"></script>

  <script src="vendor/twitter/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

  <script src="vendor/wenzhixin/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js" type="text/javascript"></script>

  <script src="vendor/wenzhixin/bootstrap-table/src/extensions/filter/bootstrap-table-filter.js" type="text/javascript"></script>

  <!-- Custom fonts for this template-->
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor-admin-website/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">


  <link href="vendor/wenzhixin/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.css" rel="stylesheet" type="text/css"/>


  <script type="text/javascript">
    function id(el) {
        return document.getElementById(el);
    };

    window.onload = function () {
        id('telefone').onkeyup = function () {
            mascara(this, mtel);
        };

        id('telefone2').onkeyup = function () {
            mascara(this, mtel);
        };

        id('cpf').onkeyup = function () {
            mascara(this, cpf);
        };

        id('cep').onkeyup = function () {
            mascara(this, cep);
        };

        id('cep').onblur = function () {
            pesquisacep(this.value);
        };
    };
  </script>

  <!--início do modal para relatório financeiro-->
  <div class="modal fade bd-example-modal-sm" id="relatorioFinanceiro" tabindex="-1" role="dialog" aria-labelledby="relatorioFinanceiro" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Relatório Financeiro</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form target="_blank" class="form-horizontal" action="relatorioFinanceiro.php" method="post" data-toggle="validator">

            <div class="form-group">
              <label for="referenciaInicialFinanceiro">
                Referência <span title="obrigatório">*</span>
              </label>
              <input required lang="pt" type="month" value="aaaa-mm" class="form-control" onkeypress="mascara(this,ref)" minlength=7 maxlength="7" min="7" id="referenciaInicialFinanceiro" name="referenciaInicialFinanceiro">
            </div>

            <div class="form-group">
              <label for="referenciaFinalFinanceiro">
                Até <span title="obrigatório">*</span>
              </label>
              <input required lang="pt" type="month"  value="aaaa-mm" class="form-control" onkeypress="mascara(this,ref)" maxlength="7" id="referenciaFinalFinanceiro" name="referenciaFinalFinanceiro">
            </div>
           
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" value="Emitir Relatório" name = "emitirRelatorio"></input>
      </div>

      </form>

    </div>
    </div>
  </div>
  <!--fim do modal para relatório financeiro-->

  <!--início do modal para relatório de mensalidades-->
  <div class="modal fade bd-example-modal-sm" id="relatorioMensalidades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Relatório de Mensalidades</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form target="_blank" class="form-horizontal" action="relatorioMensalidades.php" method="post" data-toggle="validator">

            <div class="form-group">
              <label for="referenciaInicialModal">
                Referência <span title="obrigatório">*</span>
              </label>
              <input required lang="pt" type="month" value="aaaa-mm" class="form-control" onkeypress="mascara(this,ref)" minlength=7 maxlength="7" min="7" id="referenciaInicialModal" name="referenciaInicialModal">
            </div>

            <div class="form-group">
              <label for="referenciaFinalModal">
                Até <span title="obrigatório">*</span>
              </label>
              <input required lang="pt" type="month"  value="aaaa-mm" class="form-control" onkeypress="mascara(this,ref)" maxlength="7" id="referenciaFinalModal" name="referenciaFinalModal">
            </div>
           
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" value="Emitir Relatório" name = "emitirRelatorio"></input>
      </div>

      </form>

    </div>
    </div>
  </div>
  <!--fim do modal para relatório de mensalidades-->

  <!--início do modal para relatório de endereços-->
  <div class="modal fade bd-example-modal-sm" id="relatorioEnderecos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Relatório de Endereços</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form target="_blank" class="form-horizontal" action="gerarEndereco.php" method="post" data-toggle="validator">

            <div class="form-group">
              <label>
                Selecione a situação dos associados cujos endereços serão exibidos no relatório: <span title="obrigatório">*</span>
              </label>
              <label for="regular"><input id="regular" type="checkbox" name="regular" value="1"> Em dia</label>
              <br>
              <label for="atraso"><input id="atraso" type="checkbox" name="atraso" value="2"> Em atraso</label>
              <br>
              <label for="inadimplente"><input id="inadimplente" type="checkbox" name="inadimplente" value="3"> Inadimplente</label>
            </div>
           
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" value="Emitir Relatório de Endereços" name = "emitirRelatorio"></input>
      </div>

      </form>

    </div>
    </div>
  </div>
  <!--fim do modal para relatório de endereços-->

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img class="img-fluid rounded" src="imagens/logo-aaa-branco-2.png" alt="" style="height: 30px;"></a> 

    <div style="color:white;" class="d-none d-lg-block">Associação dos Aposentados e Pensionistas de Ouro Branco</div>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i> 
    </button>

    <button style="text-decoration: none;" title="Minimizar Menu" class="float-right btn btn-link text-white order-1 order-sm-0 ml-auto mr-0 mr-md-3 my-2 my-md-0" id="sidebarToggle" href="#">
      
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i> Meu Perfil
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php 
            if (($tipo == 'socio') || ($tipo == 'dependente')) {
          ?>
              <a class="dropdown-item" href="editarSenha.php">Editar Senha</a>
          <?php 
            }else{
          ?>
              <a class="dropdown-item" href="editarPerfil_adm.php?login=<?php echo $_SESSION['login'];?>">Configurações</a>
          <?php 
            }
          ?>   
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <?php
        // Área de cadastros
        // Verifica acesso para tipo de perfil == secretaria ou diretoria-presi
        if (($tipo == 1) || ($tipo == 4)) {
      ?> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="cadastrar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-plus"></i>
              <span>Cadastrar</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="cadastrar">
              <a class="dropdown-item" href="cadastrarSocio.php">Associado</a>
              <a class="dropdown-item" href="cadastrarDependente.php">Dependente</a>
            </div>
          </li>
      <?php
        }

        // Área de consultas de perfil
        // Verifica acesso para tipo de perfil == secretaria ou financeiro ou consulta ou diretorias (admin)
        if (($tipo == 1) || ($tipo == 2) || ($tipo == 5) || (isAdmin($tipo))) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="consultar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-table"></i>
              <span>Consultar</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="consultar">
              <!--<a class="dropdown-item" href="exibirUsuarios.php">Usuários</a>-->
              <a class="dropdown-item" href="exibirSocios.php">Associados</a>
              <a class="dropdown-item" href="exibirDependentes.php">Dependentes</a>
            </div>
          </li>
      <?php
        }

        // Área de finanças
        // Verifica acesso para tipo de perfil == financeiro ou diretoria-presi ou diretoria-finan
        if (($tipo == 2) || ($tipo == 4) || ($tipo == 6)) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="mensalidade" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-money-check"></i>
              <span>Mensalidades</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="mensalidade">
              <?php
                // Área de registro de finanças
                // Verifica acesso para tipo de perfil == financeiro
                if (($tipo == 2)) {
              ?>
                  <a class="dropdown-item" href="cadastrarMensalidade.php">Registrar Pagamento</a>
                  <a class="dropdown-item" href="cadastrarQuitacao.php">Quitar Dívida</a>
                  <a class="dropdown-item" href="cadastrarDesligamento.php">Editar Vínculo</a>
              <?php
                }
              ?>
              <a class="dropdown-item" href="exibirMensalidades.php">Histórico</a>
              <a class="dropdown-item" href="exibirQuitacoes.php">Quitações</a>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#relatorioMensalidades">Emitir Relatório</a>
            </div>
          </li>
      <?php
        }

        // Área de finanças
        // Verifica acesso para tipo de perfil == financeiro ou diretoria-presi ou diretoria-finan
        if (($tipo == 2) || ($tipo == 4) || ($tipo == 6)) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="financeiro" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-coins"></i>
              <span>Financeiro</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="financeiro">
              <?php
                // Área de registro de finanças
                // Verifica acesso para tipo de perfil == financeiro
                if (($tipo == 2)) {
              ?>
                <a class="dropdown-item" href="cadastrarRenda.php">Cadastrar Renda</a>
                <a class="dropdown-item" href="cadastrarDespesa.php">Cadastrar Despesa</a>
              <?php
                }
              ?>
              <a class="dropdown-item" href="exibirHistoricoFinanceiro.php">Histórico</a>
              <a class="dropdown-item" href="" data-toggle="modal" data-target="#relatorioFinanceiro">Emitir Relatório</a>
            </div>
          </li>
      <?php
        }

        // Área de relatórios
        // Verifica acesso para tipo de perfil == secretaria ou financeiro ou consulta ou diretorias (admin)
        if (($tipo == 1) || ($tipo == 2) || ($tipo == 5) || (isAdmin($tipo))) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="relatorios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-file-alt"></i>
              <span>Relatórios</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="relatorios">
              <a class="dropdown-item" href="relatorioSocios.php">Associados</a>
              <a class="dropdown-item" href="" data-toggle="modal" data-target="#relatorioEnderecos">Endereços</a>
              <a target="_blank" class="dropdown-item" href="gerarListaAniversario.php">Aniversariantes da <br>Semana</a>
            </div>
          </li>
      <?php
        }

        // Área de gerenciamento
        // Verifica acesso para tipo de perfil == diretoria
        if ($tipo == 4) {
      ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="mensalidade" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-cog"></i>
              <span>Configurações</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="mensalidade">
              <a class="dropdown-item" href="configurarSistema.php">Sistema</a>
              <a class="dropdown-item" href="cadastrarPerfil.php">Cadastrar Perfil <br>Administrativo</a>
              <a class="dropdown-item" href="exibirPerfis.php">Exibir Perfis <br>Administrativos</a>
            </div>
          </li>
      <?php
        }

        // Área de consulta do sócio
        // Verifica acesso para tipo de login foi de usuário sócio.
        if (($tipo == "socio") || ($tipo == "dependente")) {
      ?>
          <li class="nav-item">
              <a class="nav-link" href="exibirSocio.php?matricula=<?php echo $_SESSION['matricula']; ?>">
                <i class="fas fa-user"></i>
                <span>Meus dados</span>
              </a>
          </li>
      <?php
        }

        if (($tipo != "socio") && ($tipo != "dependente")) {
      ?>
          <li class="nav-item">
              <a class="nav-link" target="_blank" href="https://webmail-seguro.com.br/aapob.com.br/">
                <i class="fas fa-envelope"></i>
                <span>E-mail</span>
              </a>
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

        

      