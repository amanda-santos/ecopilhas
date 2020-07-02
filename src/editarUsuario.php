<?php
include("include/headerAdm.php");

$idUsuario = $_GET["id"];

$sql = "SELECT * FROM ecopilhas.Usuario 
        WHERE idUsuario = " . $idUsuario . ";";

$result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
        $sobrenome = $row["sobrenome"];
        $usuario = $row["usuario"];
        $email = $row["email"];
        $nomeSite = $row["nomeSite"];
        $tipoUsuario = $row["TipoUsuario_idTipoUsuario"];
        $ativo = $row['ativo'];
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
    <a href="indexAdmin.php" style="color: #4f8d2c;">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Configurações</li>
  <li class="breadcrumb-item active">Editar Perfil Administrativo</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarUsuario.php?idUsuario=<?php echo $idUsuario; ?>" method="post">

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
              <input value="<?php echo $nome; ?>" maxlength="50" type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required>
            </div>

            <div class="form-group col-md-6">
              <label for="sobrenome">
                Sobrenome <span title="obrigatório">*</span>
              </label>
              <input value="<?php echo $sobrenome; ?>" maxlength="200" type="text" class="form-control" id="sobrenome" placeholder="Sobrenome" name="sobrenome" required>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="usuario">
                Nome de Usuário <span title="obrigatório">*</span>
              </label>
              <input value="<?php echo $usuario; ?>" minlenght="6" maxlength="50" pattern="^[_A-z0-9]{1,}$" type="text" class="form-control" id="usuario" placeholder="Nome de Usuário" name="usuario" required>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors">Seu nome de usuário só pode conter letras, números e '_'.</div>
            </div>

            <div class="form-group col-md-6">
              <label for="email">
                E-mail <span title="obrigatório">*</span>
              </label>
              <input value="<?php echo $email; ?>" maxlength="45" required type="email" class="form-control" id="email" placeholder="E-mail" name="email">
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="nomeSite">
                Nome a ser exibido em postagens <span title="obrigatório">*</span>
              </label>
              <input value="<?php echo $nomeSite; ?>" type="text" class="form-control" id="nomeSite" placeholder="Nome a ser exibido em postagens" name="nomeSite" required value="Associação dos Aposentados e Pensionistas de Ouro Branco">
            </div>

            <?php
              if ($tipoUsuario == 1) {
            ?>

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
                    if ($tipoUsuario == $id) {
                        echo '<option selected value="' . $id . '">' . $tipo . '</option>';
                    }else{
                        echo '<option value="' . $id . '">' . $tipo . '</option>';
                    }
                  }
                ?>
              </select>
            </div>

            <?php
              }else{
            ?>
                <input hidden name="tipo" value="<?php echo $tipoUsuario; ?>">
            <?php
              }
            ?>

          </div>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col-8">
        <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
      </div>

      <div class="col-lg-4 col-sm-8 col-md-8 float-right">
        <a class = "btn btn-primary" href = "editarSenha.php?idUsuario=<?php echo $idUsuario; ?>"><i class="fas fa-lock"></i> Editar Senha</a>
        
        <?php 
        if ($ativo == 1){
        ?>
          <a class="btn btn-danger" href="#" onclick="inativar('<?php echo $idUsuario; ?>');"><i class="fas fa-user-slash"></i> Inativar Perfil</a>
        <?php
        }
        ?>
      </div>

    </div>
</form>

<!--início função inativar usuário-->
<script type="text/javascript">
    function inativar(id) {
        if (window.confirm('Deseja realmente inativar o seu perfil? Esta ação não poderá ser desfeita.')) {
            window.location = 'inativarUsuario.php?idUsuario=' + <?php echo $idUsuario?>;
        }
    }
</script>
<!--fim função inativar usuário-->

<?php
include("include/footerAdm.php");
?>