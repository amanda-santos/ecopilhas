<?php
include("include/headerAdm.php");
if (isset($_SESSION['login'])){
  $sqlNumSocios = "SELECT COUNT(*) AS 'qtdSocios' 
                    FROM associado;";
  $resultNumSocios = $con->query($sqlNumSocios);
  if ($resultNumSocios->num_rows > 0){
    while ($exibirNumSocios = $resultNumSocios->fetch_assoc()){
      $numSocios = $exibirNumSocios["qtdSocios"];
    } //fim while
  } //fim if

  $sqlNumSociosAtivos = "SELECT COUNT(*) AS 'qtdSociosAtivos' 
                            FROM associado
                            WHERE ativo = 1;";
  $resultNumSociosAtivos = $con->query($sqlNumSociosAtivos);
  if ($resultNumSociosAtivos->num_rows > 0){
    while ($exibirNumSociosAtivos = $resultNumSociosAtivos->fetch_assoc()){
      $numSociosAtivos = $exibirNumSociosAtivos["qtdSociosAtivos"];
    } //fim while
  } //fim if

  $sqlNumSociosInativos = "SELECT COUNT(*) AS 'qtdSociosInativos' 
                            FROM associado
                            WHERE ativo = 0;";
  $resultNumSociosInativos = $con->query($sqlNumSociosInativos);
  if ($resultNumSociosInativos->num_rows > 0){
    while ($exibirNumSociosInativos = $resultNumSociosInativos->fetch_assoc()){
      $numSociosInativos = $exibirNumSociosInativos["qtdSociosInativos"];
    } //fim while
  } //fim if

  $pSociosAtivos = round((($numSociosAtivos * 100) / $numSocios), 1);
  $pSociosInativos = round((($numSociosInativos * 100) / $numSocios), 1);

  $sqlNumSociosRegulares = "SELECT COUNT(*) AS 'qtdSociosRegulares' FROM associado
                              WHERE ativo = 1 
                              AND fk_idSituacao = 1;";
  $resultNumSociosRegulares = $con->query($sqlNumSociosRegulares);
  if ($resultNumSociosRegulares->num_rows > 0){
    while ($exibirNumSociosRegulares = $resultNumSociosRegulares->fetch_assoc()){
      $numSociosRegulares = $exibirNumSociosRegulares["qtdSociosRegulares"];
    } //fim while
  } //fim if

  $sqlNumSociosAtraso = "SELECT COUNT(*) AS 'qtdSociosAtraso' FROM associado
                            WHERE ativo = 1
                            AND fk_idSituacao = 2;";
  $resultNumSociosAtraso = $con->query($sqlNumSociosAtraso);
  if ($resultNumSociosAtraso->num_rows > 0){
    while ($exibirNumSociosAtraso = $resultNumSociosAtraso->fetch_assoc()){
      $numSociosAtraso = $exibirNumSociosAtraso["qtdSociosAtraso"];
    } //fim while
  } //fim if

  $sqlNumSociosInadimplentes = "SELECT COUNT(*) AS 'qtdSociosInadimplentes' FROM associado
                            WHERE ativo = 1
                            AND fk_idSituacao = 3;";
  $resultNumSociosInadimplentes = $con->query($sqlNumSociosInadimplentes);
  if ($resultNumSociosInadimplentes->num_rows > 0){
    while ($exibirNumSociosInadimplentes = $resultNumSociosInadimplentes->fetch_assoc()){
      $numSociosInadimplentes = $exibirNumSociosInadimplentes["qtdSociosInadimplentes"];
    } //fim while
  } //fim if

  $pSociosRegulares = round((($numSociosRegulares * 100) / $numSociosAtivos), 1);
  $pSociosAtraso = round((($numSociosAtraso * 100) / $numSociosAtivos), 1);
  $pSociosInadimplentes = round((($numSociosInadimplentes * 100) / $numSociosAtivos), 1);
?>

<input type="text" id="numSociosAtivos" hidden value="<?php echo $numSociosAtivos; ?>">
<input type="text" id="numSociosInativos" hidden value="<?php echo $numSociosInativos; ?>">
<input type="text" id="numSociosRegulares" hidden value="<?php echo $numSociosRegulares; ?>">
<input type="text" id="numSociosAtraso" hidden value="<?php echo $numSociosAtraso; ?>">
<input type="text" id="numSociosInadimplentes" hidden value="<?php echo $numSociosInadimplentes; ?>">

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Página Inicial</li>
</ol>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-pie"></i>
        Relação de Associados por Vínculo
      </div>
      <div class="card-body">
        <canvas id="vinculo" width="100%" height="70"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-pie"></i>
        Relação de Associados Ativos por Situação
      </div>
      <div class="card-body">
        <canvas id="situacao" width="100%" height="70"></canvas>
      </div>
    </div>
  </div>
</div>

<?php
include("include/footerAdm.php");

}else{
  echo "<script>window.location.href='index.php';</script>";
}
?>


