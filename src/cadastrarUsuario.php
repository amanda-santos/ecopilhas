<?php
include("include/headerAdm.php");
?>

<style>
  a{
    color: #212529;
  }
</style>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="indexAdmin.php" style="color: #4f8d2c;">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Configurações</li>
  <li class="breadcrumb-item active">Cadastrar Perfil Administrativo</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="inserirUsuario.php" method="post">

    <div class="card mb-3">
      <a href="#dados" style="text-decoration: none" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dados">
        <i class="fas fa-user"></i>
        Dados do Perfil Administrativo
      </a>

      <div id="dados">
        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="nome">
                Nome <span title="obrigatório">*</span>
              </label>
              <input maxlength="50" type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
            </div>

            <div class="form-group col-md-6">
              <label for="sobrenome">
                Sobrenome <span title="obrigatório">*</span>
              </label>
              <input maxlength="200" type="text" class="form-control" id="sobrenome" placeholder="Sobrenome" name="sobrenome" required>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="usuario">
                Nome de Usuário <span title="obrigatório">*</span>
              </label>
              <input minlenght="6" maxlength="50" pattern="^[_A-z0-9]{1,}$" type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" name="usuario" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors">Seu nome de usuário só pode conter letras, números e '_'.</div>
            </div>

            <div class="form-group col-md-6">
              <label for="email">
                E-mail <span title="obrigatório">*</span>
              </label>
              <input maxlength="45" required type="email" class="form-control" id="email" placeholder="E-mail" name="email">
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="nomeSite">
                Nome a ser exibido em postagens <span title="obrigatório">*</span>
              </label>
              <input type="text" class="form-control" id="nomeSite" placeholder="Nome a ser exibido em postagens" name="nomeSite" required value="EcoPilhas">
            </div>

            <div class="form-group col-md-6">
              <label for="tipo">
                Nível de Acesso
              </label>
              <select class="form-control" id="tipo" required="required" name="tipo">
                <?php
                  $result = $con->query("SELECT idTipoUsuario, tipo 
                                          FROM TipoUsuario
                                          ORDER BY idTipoUsuario ASC");
                  while ($row = $result->fetch_assoc()) {
                    unset($id, $tipo);
                    $id = $row['idTipoUsuario'];
                    $tipo = $row['tipo'];
                    echo '<option value="' . $id . '">' . $tipo . '</option>';
                  }
                ?>
              </select>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="senha">
                Senha <span title="obrigatório">*</span>
                <span href="#" title="Mínimo de 6 dígitos" data-toggle="popover" data-placement="left" data-content="Content"><i class="fas fa-question-circle"></i></span>
              </label>
              <input maxlength="45" placeholder="Digite a senha" type="password" class="form-control" id="senha" name="senha" data-minlength="6" required>
            </div>

            <div class="form-group col-md-6">
              <label for="senha">
                Confirme a Senha <span title="obrigatório">*</span>
                <span href="#" title="Mínimo de 6 dígitos" data-toggle="popover" data-placement="left" data-content="Content"><i class="fas fa-question-circle"></i></span>
              </label>
              <input maxlength="45" placeholder="Confirme a senha" type="password" class="form-control" id="confSenha" name="senhaConfirma" data-match="#senha" data-match-error="Atenção! As senhas não estão iguais." required>
              <div class="help-block with-errors"></div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="cadastrar" class="float-center btn btn-primary">Cadastrar</button>
</form>

<?php
include("include/footerAdm.php");
?>
