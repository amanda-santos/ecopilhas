<?php
include("include/headerAdm.php");

$id = $_GET["id"];

$sql = "SELECT * FROM ecopilhas.Triagem 
        WHERE idTriagem = '" . $id . "';";

$result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pesoTotal = $row["pesoTotal"];
        $quantTotal = $row["quantTotal"];
        $data = $row["data"];
        $dataVal = new Datetime($data);
        $dataVal = $dataVal->format("Y-m-d");

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
  <li class="breadcrumb-item active">Triagem</li>
  <li class="breadcrumb-item active">Editar Triagem</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarTriagem.php?id=<?php echo $id; ?>" method="post">

    <div class="card mb-3">
      <a href="#dados" style="text-decoration: none" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dados">
        <i class="fas fa-box-open"></i>
        Dados da triagem
      </a>

      <div id="dados">
        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="nome">
                Data <span title="obrigatório">*</span>
              </label>
              <input class="form-control" type="date" value="<?php echo $dataVal; ?>" name="data" id="data" required>
            </div>

            <div class="form-group col-md-3">
              <label for="quantTotal"> Quantidade Total<span title="obrigatório">*</span></label>
              <input class="form-control" type="number" value="<?php echo $quantTotal; ?>" name="quantTotal" id="quantTotal" required>
            </div>

            <div class="form-group col-md-3">
              <label for="pesoTotal"> Peso Total<span title="obrigatório">*</span></label>
              <input class="form-control" type="number" value="<?php echo $pesoTotal; ?>" name="pesoTotal" id="pesoTotal" step="0.01"required>
            </div>
          </div>

            

          </div>
        </div>
      </div>

    <button type="submit" name="atualizar" class="btn btn-primary">Atualizar</button>
</form>


<?php
include("include/footerAdm.php");
?>