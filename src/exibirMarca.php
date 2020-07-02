<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Pilhas</li>
  <li class="breadcrumb-item active">Exibir Marcas</li>
</ol>

<!-- DataTables Example -->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-battery-full"></i>
    Pilhas</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nome</th>
            <th>País</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nome</th>
            <th>País</th>
            <th>Ações</th>
          </tr>
        </tfoot>
        <tbody>

          <?php
            $sqlSolicitacao = "SELECT * FROM Marca";

            $resultSolicitacao = $con->query($sqlSolicitacao);

            if ($resultSolicitacao->num_rows > 0) {
              while ($row = $resultSolicitacao->fetch_assoc()) {
                $id = $row["idMarca"];
                $nome = $row["nome"];
                $pais = $row["pais"];
          ?>
              <tr>
                  <td><?php echo $nome; ?></td>
                  <td><?php echo $pais; ?></td>
                  <td>
                    <a title='Editar Marca' href='editarMarca.php?id=<?php echo $id; ?>'><i class="fas fa-edit"></i></a>
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
      window.location = 'excluirMarca.php?id=' + id;
    }
  }
</script>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>
