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
            <th>Data</th>
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
            <th>Data</th>
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
                $id = $row["idSolicitacao"];
                $nome = $row["nome"];
                $email = $row["email"];
                $telefone = $row["telefone"];
                $local = $row["local"];
                $observacao = $row["observacao"];
                $data = $row["data"];
                $datetime = new DateTime($data);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $data = substr($datetime, 0, 10); 
                $hora = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";
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
                  <td><?php echo $data . " às " . $hora; ?></td>
                  <td><?php echo ucwords($nome); ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $telefone; ?></td>
                  <td><?php echo $tipo; ?></td>
                  <td><?php echo ucwords($local); ?></td>
                  <td><?php echo $observacao; ?></td>
                  <?php
                  if ($concluido == 1) {
                  ?>
                    <td>Concluído</td>
                    <td>
                    <a href="editarSolicitacao.php?id=<?php echo $id; ?>&c=0" title="Marcar como pendente" ><i style="color:black" class="fas fa-times-circle"></i></a>
                  <?php
                  }else{
                  ?>
                    <td>Pendente</td>
                    <td>
                    <a href="editarSolicitacao.php?id=<?php echo $id; ?>&c=1" title="Marcar como concluída" ><i style="color:green" class="fas fa-check"></i></a>
                  <?php
                  }
                  ?>
                    <a href="#" onclick="apagar('<?php echo $id ?>');" title="Excluir" ><i style="color:red" class="fas fa-trash-alt"></i></a>
                  </td>
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

<script type="text/javascript">
  function apagar(id) {
    if (window.confirm('Deseja realmente excluir?')) {
      window.location = 'excluirSolicitacao.php?id=' + id;
    }
  }
</script>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>
