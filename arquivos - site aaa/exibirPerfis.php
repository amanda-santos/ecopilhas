<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Configurações</li>
  <li class="breadcrumb-item active">Exibir Perfis Administrativos</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-user"></i>
    Perfis Administrativos</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Nome de Usuário</th>
            <th>Nível de Acesso</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Nome de Usuário</th>
            <th>Nível de Acesso</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </tfoot>
        <tbody>

          <?php
            $sqlPerfil = "SELECT P.usuario, P.email, P.login, TP.tipo, P.ativo
                        FROM perfil AS P, tipoPerfil AS TP
                        WHERE P.fk_idTipoPerfil = TP.idTipoPerfil;";

            $resultPerfil = $con->query($sqlPerfil);

            if ($resultPerfil->num_rows > 0) {
              while ($row = $resultPerfil->fetch_assoc()) {
                $nome = ucwords($row["usuario"]);
                $email = $row["email"];
                $usuario = $row["login"];
                $tipo = $row["tipo"];
                if ($row["ativo"] == 1) { 
                  $situacao = "Ativo";
          ?>
                  <tr>
          <?php
                }else{
                  $situacao = "Inativo";
          ?>
                  <tr class="table-danger">
          <?php
                }
          ?>
                  <td><?php echo $nome; ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $usuario; ?></td>
                  <td><?php echo $tipo; ?></td>
                  <td><?php echo $situacao; ?></td>
                  <td><a title='Editar Perfil' href='editarPerfil_Adm_Dir.php?login=<?php echo $usuario; ?>'><i class="fas fa-edit" style="color:#0069d9"></i></a></td>
                </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>