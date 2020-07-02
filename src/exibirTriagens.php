<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Triagens</li>
  <li class="breadcrumb-item active">Exibir Triagens</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-box-open"></i>
    Triagens</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Data</th>
            <th>Quantidade Total</th>
            <th>Peso Total</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Data</th>
            <th>Quantidade Total</th>
            <th>Peso Total</th>
            <th>Ações</th>
          </tr>
        </tfoot>
        <tbody>

          <?php
            $sqlSolicitacao = "SELECT * FROM Triagem";

            $resultSolicitacao = $con->query($sqlSolicitacao);

            if ($resultSolicitacao->num_rows > 0) {
              while ($row = $resultSolicitacao->fetch_assoc()) {
                $id = $row['idTriagem'];
                $data = $row["data"];
                $quantTotal = $row["quantTotal"];
                $pesoTotal = $row["pesoTotal"];
                $datetime = new DateTime($data);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $dataEdit = substr($datetime, 0, 10);
          ?>
              <tr>
                  <td><?php echo $dataEdit; ?></td>
                  <td><?php echo $quantTotal; ?></td>
                  <td><?php echo $pesoTotal; ?></td>
                  <td>
                    <a title='Editar Triagem' href='editarTriagem.php?id=<?php echo $id; ?>'><i class="fas fa-edit"></i></a>
                    <a title='Adicionar Pilhas' href='exibirDetalhesTriagem.php?id=<?php echo $id; ?>'><i class="fas fa-info"></i></a>
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
      window.location = 'excluirTriagem.php?id=' + id;
    }
  }
</script>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>
