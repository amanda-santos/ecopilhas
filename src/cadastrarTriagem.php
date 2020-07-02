<?php
include("include/headerAdm.php");
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
  <li class="breadcrumb-item active">Cadastrar Triagem</li>
</ol>

<form enctype="multipart/form-data" role="form" data-toggle="validator" action="inserirTriagem.php" method="post">

    <div class="card mb-3">
      <a href="#dados" style="text-decoration: none" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dados">
        <i class="fas fa-box-open"></i>
        Dados da Triagem
      </a>

      <div id="dados">
        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="data">
                Data<span title="obrigatório">*</span>
              </label>
              <input class="form-control" type="date" name="data" id="data" required>
            </div>

              
            <div class="form-group col-md-4">
              <label for="quantTotal"> Quantidade Total<span title="obrigatório">*</span></label>
              <input class="form-control" type="number" name="quantTotal" id="quantTotal" required>
            </div>

            <div class="form-group col-md-4">
              <label for="pesoTotal"> Peso Total (kg)<span title="obrigatório">*</span></label>
              <input class="form-control" type="number" name="pesoTotal" id="pesoTotal" step="0.01" required>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="submit" name="cadastrar" class="float-center btn btn-primary">Cadastrar</button>
</form>

<?php
include("include/footerAdm.php");
?>
