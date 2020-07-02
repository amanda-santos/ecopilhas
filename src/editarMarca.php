<?php
include("include/headerAdm.php");

$id = $_GET["id"];

$sql = "SELECT * FROM ecopilhas.Marca 
        WHERE idMarca = '" . $id . "';";

$result = $con->query($sql) or die($con->error);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
        $pais = $row["pais"];
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
  <li class="breadcrumb-item active">Pilhas</li>
  <li class="breadcrumb-item active">Editar Marca</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="atualizarMarca.php?id=<?php echo $id; ?>" method="post">

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
                Nome<span title="obrigatório">*</span>
              </label>
              <input maxlength="50" type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Nome" name="nome" required>
            </div>

              
            <div class="form-group col-md-6">
              <label for="pais"> País<span title="obrigatório">*</span></label>
              <input maxlength="50" type="text" class="form-control" id="pais" placeholder="País" value="<?php echo $pais; ?>"name="pais" required>
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