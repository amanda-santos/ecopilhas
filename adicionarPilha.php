<?php
include("include/headerAdm.php");

$id = $_GET["id"];

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
  <li class="breadcrumb-item active">Triagem</li>
  <li class="breadcrumb-item active">Editar Triagem</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="inserirPilha.php?id=<?php echo $id; ?>" method="post">

    <div class="card mb-3">
      <a href="#dados" style="text-decoration: none" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dados">
        <i class="fas fa-add-circle"></i>
        Dados das Pilhas
      </a>

      <div id="dados">
        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="marca">
                Marca<span title="obrigatório">*</span>
              </label>
            <select class="form-control" id="marca" required="required" name="marca">
                <?php
                  $result = $con->query("SELECT idMarca, nome 
                                          FROM Marca
                                          ORDER BY nome ASC");
                  while ($row = $result->fetch_assoc()) {
                    unset($id, $tipo);
                    $id = $row['idMarca'];
                    $nome = $row['nome'];
                    //if ($tipoUsuario == $id) {
                        //echo '<option selected value="' . $id . '">' . $tipo . '</option>';
                    //}else{
                        echo '<option value="' . $id . '">' . $nome . '</option>';
                    //}
                  }
                ?>
              </select>
            </div>

            <div class="form-group col-md-3">
              <label for="quantidade"> Quantidade<span title="obrigatório">*</span></label>
              <input class="form-control" type="number" name="quantidade" id="quantidade" required>
            </div>

            <div class="form-group col-md-3">
              <label for="peso"> Peso</label>
              <input class="form-control" type="number" name="peso" id="peso" step="0.01">
            </div>
          </div>

          </div>
        </div>
      </div>

    <button type="submit" name="adicionar" class="btn btn-primary">Adicionar</button>
</form>


<?php
include("include/footerAdm.php");
?>