<?php
include("include/headerAdm.php");

$idUsuario = $_GET["idUsuario"];
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
  <li class="breadcrumb-item active">Meu Perfil</li>
  <li class="breadcrumb-item active">Editar Senha</li>
</ol>

<form class="form-horizontal" enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarSenha.php?idUsuario=<?php echo $idUsuario; ?>" method="post">

  <div class="card mb-3">
    <a href="#dados" style="text-decoration: none" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dados">
      <i class="fas fa-lock"></i>
      Editar Senha
    </a>

    <div id="dados">
      <div class="card-body">

        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="atual">
              Digite sua senha atual <span title="obrigatório">*</span>
            </label>
            <input maxlength="45" type="password" class="form-control" id="atual" placeholder="Digite sua senha atual" name="atual" required>
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="nova">
              Digite sua nova senha <span title="obrigatório">*</span>
            </label>
            <input maxlength="45" type="password" data-minlength="6" class="form-control" id="nova" placeholder="Digite sua nova senha" name="nova" required>
            <span class="help-block">Minimo de seis (6) dígitos</span>
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="confSenha">
              Confirme sua nova senha <span title="obrigatório">*</span>
            </label>
            <input maxlength="45" type="password" class="form-control" id="confSenha" name="senhaConfirma" data-match="#nova" data-match-error="Atenção! As senhas não estão iguais." placeholder="Confirme sua nova senha" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-8">
      <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
    </div>

  </div>

  <br>

</form>

<?php
include("include/footerAdm.php");
?>