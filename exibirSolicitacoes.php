<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Solicitações</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-exclamation-circle"></i>
    Solicitações</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Tipo</th>
            <th>Local</th>
            <th>Observações</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Tipo</th>
            <th>Local</th>
            <th>Observações</th>
            <th>Situação</th>
            <th>Ações</th>
          </tr>
        </tfoot>
        <tbody>

          <?php
            $sqlSolicitacao = "SELECT * FROM Solicitacao";

            $resultSolicitacao = $con->query($sqlSolicitacao);

            if ($resultSolicitacao->num_rows > 0) {
              while ($row = $resultSolicitacao->fetch_assoc()) {
                $nome = $row["nome"];
                $email = $row["email"];
                $telefone = $row["telefone"];
                $local = $row["local"];
                $observacao = $row["observacao"];
                if ($row["tipo"] == 1) { 
                  $tipo = "Coletor de pilhas";
                }else{
                  $tipo = "Palestra";
                }
                $concluido = $row["concluido"];

                if ($concluido == 1) {
          ?>
                    <tr class="table-success">
          <?php
                }else{
          ?>
                    <tr>
          <?php
                }
          ?>
                  <td><?php echo $data; ?></td>
                  <td><?php echo $nome; ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $telefone; ?></td>
                  <td><?php echo $tipo; ?></td>
                  <td><?php echo $local; ?></td>
                  <td><?php echo $observacao; ?></td>
                  <?php
                  if ($concluido == 1) {
                  ?>
                    <td>Concluído</td>
                  <?php
                  }else{
                  ?>
                    <td>Pendente</td>
                  <?php
                  }
                  ?>
                  <td></td>
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
