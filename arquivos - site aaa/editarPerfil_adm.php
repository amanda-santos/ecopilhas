<?php
include("include/headerAdm.php");
require __DIR__ . '/vendor/autoload.php';
if (isset($_SESSION['login'])){

  $login = $_GET['login'];

  $sqlPerfil = "SELECT p.idPerfil, p.usuario, p.nomeSite, p.fk_idTipoPerfil, p.ativo, p.email 
                FROM perfil as p 
                WHERE p.login = '" . $login . "';";

  $resultPerfil = $con->query($sqlPerfil);
  if ($resultPerfil->num_rows > 0) {
    while ($row = $resultPerfil->fetch_assoc()) {
      $nome = ucwords($row['usuario']);
      $nomeSite = ucwords($row['nomeSite']);
      $idPerfil = $row['idPerfil'];
      $idTipo = $row['fk_idTipoPerfil'];
      $ativo = $row['ativo'];
      $email = $row['email'];
    }
  }
?>

<style>
  a{
    color: #212529;
  }
</style>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="indexAdmin.php" style="color: #0056C0;">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Meu Perfil</li>
  <li class="breadcrumb-item active">Configurações</li>
</ol>

<form class="form-horizontal" enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarPerfil_adm.php?id=<?php echo $idPerfil; ?>" method="post">

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
            <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome" required value="<?php echo $nome; ?>">
          </div>

          <div class="form-group col-md-6">
            <label for="email">
              E-mail <span title="obrigatório">*</span>
            </label>
            <input required type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="usuario">
              Nome de Usuário <span title="obrigatório">*</span>
            </label>
            <input maxlength="45" pattern="^[_A-z0-9]{1,}$" type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" name="usuario" required value="<?php echo $login; ?>">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors">Seu nome de usuário só pode conter letras, números e '_'.</div>
          </div>

          <div class="form-group col-md-6">
            <label for="nomeSite">
              Nome a ser exibido em postagens <span title="obrigatório">*</span>
            </label>
            <input type="text" class="form-control" id="nomeSite" placeholder="Nome a ser exibido em postagens" name="nomeSite" required value="<?php echo $nomeSite; ?>">
          </div>

        </div>

        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="tipo">
              Nível de Acesso
            </label>
            <select selected="<?php echo $idTipo; ?>" class="form-control" id="tipo" required="required" name="tipo">
              <?php
                $result = $con->query("SELECT idTipoPerfil, tipo 
                                        FROM tipoPerfil 
                                        ORDER BY idTipoPerfil ASC");
                while ($row = $result->fetch_assoc()) {
                  unset($id, $name);
                  $id = $row['idTipoPerfil'];
                  $name = $row['tipo'];
                  if ($idTipo == $id) {
                    echo '<option selected value="' . $id . '">' . $name . '</option>';
                  }else{
                    echo '<option value="' . $id . '">' . $name . '</option>';
                  }
                }
              ?>
            </select>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-8">
      <button type="submit" name="atualizePerfil" class="btn btn-primary">Atualizar</button>
    </div>

    <div class="col-lg-4 col-sm-8 col-md-8 float-right">
      <a class = "btn btn-primary" href = "editarSenha_adm.php?login=<?php echo $login; ?>"><i class="fas fa-lock"></i> Editar Senha</a>

      <?php 
      if ($ativo == 1){
      ?>
        <a class="btn btn-danger" href="#" onclick="inativar('<?php echo $login; ?>');"><i class="fas fa-user-slash"></i> Inativar perfil</a>
      <?php
      }
      ?>
    </div>

  </div>

  <br>

</form>

<!--início função inativar usuário-->
<script type="text/javascript">
    function inativar(login) {
        if (window.confirm('Deseja realmente inativar o seu perfil? Essa ação não poderá ser desfeita.')) {
            window.location = 'inativarPerfil.php?login=' + login;
        }
    }
</script>
<!--fim função inativar usuário-->

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>