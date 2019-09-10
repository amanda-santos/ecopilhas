<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
  $login = $_GET['login'];
    
  $sqlPerfil = "SELECT p.idPerfil, p.nomeSite, p.usuario, p.senha, p.fk_idTipoPerfil, p.ativo, p.email 
                FROM perfil as p 
                WHERE p.login = '" . $login . "';";

    $resultPerfil = $con->query($sqlPerfil);

    if ($resultPerfil->num_rows > 0) {
      while ($row = $resultPerfil->fetch_assoc()) {
        $idPerfil = $row['idPerfil'];
        $nomeSite = ucwords($row['nomeSite']);
        $usuario = ucwords($row['usuario']);
        $email = $row['email'];
        $idTipo = $row['fk_idTipoPerfil'];
        $senha = $row['senha'];
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
    <a href="indexAdmin.php" style="color: #0056C0;">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Configurações</li>
  <li class="breadcrumb-item">
    <a href="exibirPerfis.php" style="color: #0056C0;">Exibir Perfis Administrativos</a>
  </li>
  <li class="breadcrumb-item active">Editar Perfil Administrativo</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarPerfil_Adm_Dir.php?idPerfil=<?php echo $idPerfil; ?>" method="post">

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
              <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome" required value="<?php echo $usuario; ?>">
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

            <div class="form-group col-md-6">
              <label for="ativo">
                Situação
              </label>
              <select selected="<?php echo $ativo; ?>" class="form-control" id="ativo" required="required" name="ativo">
                <?php
                  if ($ativo == 1){ 
                ?>
                    <option selected value="1">Ativo</option>
                    <option value="0">Inativo</option>
                <?php
                  }else{
                ?>
                    <option value="1">Ativo</option>
                    <option selected value="0">Inativo</option>
                <?php
                  }
                ?>
              </select>
            </div>

          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="atualizePerfil" class="float-center btn btn-primary">Atualizar</button>
</form>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>