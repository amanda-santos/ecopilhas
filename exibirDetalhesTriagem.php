<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
  $idTriagem = $_GET['id'];
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.php">Página Inicial</a>
  </li>
  <li class="breadcrumb-item active">Triagens</li>
  <li class="breadcrumb-item active">Exibir Triagens</li>
  <li class="breadcrumb-item active">Exibir Detalhes de Triagem</li>
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
            <th>Marca</th>
            <th>Quantidade</th>
            <th>Peso</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Marca</th>
            <th>Quantidade</th>
            <th>Peso</th>
            <th>Ações</th>
          </tr>
        </tfoot>
        <tbody>

          <?php
            $sqlSolicitacao = "SELECT idItemTriagem, quantidade, peso, nome FROM ecopilhas.ItemTriagem AS I JOIN ecopilhas.Marca AS M ON I.idMarca = M.idMarca WHERE idTriagem = ". $idTriagem;

            $resultSolicitacao = $con->query($sqlSolicitacao);

            if ($resultSolicitacao->num_rows > 0) {
              while ($row = $resultSolicitacao->fetch_assoc()) {
                $idItem = $row['idItemTriagem'];
                $marca = $row['nome'];
                $quantidade = $row["quantidade"];
                $peso = $row["peso"];
          ?>
              <tr>
                  <td><?php echo $marca; ?></td>
                  <td><?php echo $quantidade; ?></td>
                  <td><?php echo $peso; ?></td>
                  <td>
                    <a title='Editar Triagem' href='editarItem.php?id=<?php echo $idItem; ?>'><i class="fas fa-edit"></i></a>
                    <a href="#" onclick="apagar('<?php echo $idItem ?>');" title="Excluir" ><i style="color:red" class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
            <?php
            }
          }
          ?>
        </tbody>
      </table>
      <form enctype="multipart/form-data" role="form" data-toggle="validator" action="adicionarPilha.php?id=<?php echo $idTriagem; ?>" method="post">
      <button type="submit" name="cadastrar" class="float-center btn btn-primary">Cadastrar</button>
    </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function apagar(id) {
    if (window.confirm('Deseja realmente excluir?')) {
      window.location = 'excluirItemTriagem.php?id=' + id;
    }
  }
</script>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>
