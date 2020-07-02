<?php
include("include/headerAdm.php");

if (isset($_SESSION['login'])){

	$sqlNumMarcas = "SELECT COUNT(*) AS 'totalMarcas' 
                    FROM ecopilhas.Marca;";
  $resultMarcas = $con->query($sqlNumMarcas);
  if ($resultMarcas->num_rows > 0){
    while ($exibirMarcas = $resultMarcas->fetch_assoc()){
      $numMarcas = $exibirMarcas["totalMarcas"];
    } //fim while
  } //fim if


  $sqlNumBrasil = "SELECT COUNT(*) AS 'qtdBrasil' 
                    FROM ecopilhas.Marca WHERE pais='Brasil';";
  $resultNumBrasil = $con->query($sqlNumBrasil);
  if ($resultNumBrasil->num_rows > 0){
    while ($exibirBrasil = $resultNumBrasil->fetch_assoc()){
      $numBrasil = $exibirBrasil["qtdBrasil"];
    } //fim while
  } //fim if

  $sqlNumChina = "SELECT COUNT(*) AS 'qtdChina' 
                    FROM ecopilhas.Marca WHERE pais='China';";
  $resultNumChina = $con->query($sqlNumChina);
  if ($resultNumChina->num_rows > 0){
    while ($exibirChina = $resultNumChina->fetch_assoc()){
      $numChina = $exibirChina["qtdChina"];
    } //fim while
  } //fim if

  $sqlNumJapao = "SELECT COUNT(*) AS 'qtdJapao' 
                    FROM ecopilhas.Marca WHERE pais='Japão';";
  $resultNumJapao = $con->query($sqlNumJapao);
  if ($resultNumJapao->num_rows > 0){
    while ($exibirJapao = $resultNumJapao->fetch_assoc()){
      $numJapao = $exibirJapao["qtdJapao"];
    } //fim while
  } //fim if

  $sqlNumEUA = "SELECT COUNT(*) AS 'qtdEUA' 
                    FROM ecopilhas.Marca WHERE pais='EUA';";
  $resultNumEUA = $con->query($sqlNumEUA);
  if ($resultNumEUA->num_rows > 0){
    while ($exibirEUA = $resultNumEUA->fetch_assoc()){
      $numEUA = $exibirEUA["qtdEUA"];
    } //fim while
  } //fim if

  $sqlNumOutros = "SELECT COUNT(*) AS 'qtdOutros' 
                    FROM ecopilhas.Marca WHERE pais='Outros';";
  $resultNumOutros = $con->query($sqlNumOutros);
  if ($resultNumOutros->num_rows > 0){
    while ($exibirOutros = $resultNumOutros->fetch_assoc()){
      $numOutros = $exibirOutros["qtdOutros"];
    } //fim while
  } //fim if

  $pBrasil = round((($numBrasil * 100) / $numMarcas), 1);
  $pChina = round((($numChina * 100) / $numMarcas), 1);
  $pEUA = round((($numEUA * 100) / $numMarcas), 1);
  $pJapao = round((($numJapao * 100) / $numMarcas), 1);
  $pOutros = round((($numOutros * 100) / $numMarcas), 1);
  

  $sqlPesoTotal = "SELECT SUM(pesoTotal) AS 'somaPesoTotal' 
                    FROM ecopilhas.Triagem;";
  $resultPesoTotal = $con->query($sqlPesoTotal);
  if ($resultPesoTotal->num_rows > 0){
    while ($exibirPesoTotal = $resultPesoTotal->fetch_assoc()){
      $pesoTotal = $exibirPesoTotal["somaPesoTotal"];
    } //fim while
  } //fim if

  $sqlPeso2017 = "SELECT SUM(pesoTotal) AS 'peso2017' 
                    FROM ecopilhas.Triagem WHERE data >= '2017-01-01' and data <= '2017-12-31';";
  $resultPeso2017 = $con->query($sqlPeso2017);
  if ($resultPeso2017->num_rows > 0){
    while ($exibirPeso2017 = $resultPeso2017->fetch_assoc()){
      $peso2017 = $exibirPeso2017["peso2017"];
    } //fim while
  } //fim if

  $sqlPeso2018 = "SELECT SUM(pesoTotal) AS 'peso2018' 
                    FROM ecopilhas.Triagem WHERE data >= '2018-01-01' and data <= '2018-12-31';";
  $resultPeso2018 = $con->query($sqlPeso2018);
  if ($resultPeso2018->num_rows > 0){
    while ($exibirPeso2018 = $resultPeso2018->fetch_assoc()){
      $peso2018 = $exibirPeso2018["peso2018"];
    } //fim while
  } //fim if

  $sqlPeso2019 = "SELECT SUM(pesoTotal) AS 'peso2019' 
                    FROM ecopilhas.Triagem WHERE data >= '2019-01-01'and data <= '2019-11-20';";
  $resultPeso2019 = $con->query($sqlPeso2019);
  if ($resultPeso2019->num_rows > 0){
    while ($exibirPeso2019 = $resultPeso2019->fetch_assoc()){
      $peso2019 = $exibirPeso2019["peso2019"];
    } //fim while
  } //fim if

  $pPesoTotal2017 = round((($peso2017 * 100) / $pesoTotal), 1);
  $pPesoTotal2018 = round((($peso2018 * 100) / $pesoTotal), 1);
  $pPesoTotal2019 = round((($peso2019 * 100) / $pesoTotal), 1);
?>
<input type="text" id="numBrasil" hidden value="<?php echo $numBrasil; ?>">
<input type="text" id="numChina" hidden value="<?php echo $numChina; ?>">
<input type="text" id="numJapao" hidden value="<?php echo $numJapao; ?>">
<input type="text" id="numEUA" hidden value="<?php echo $numEUA; ?>">
<input type="text" id="numOutros" hidden value="<?php echo $numOutros; ?>">
<input type="text" id="peso2017" hidden value="<?php echo round($peso2017); ?>">
<input type="text" id="peso2018" hidden value="<?php echo round($peso2018); ?>">
<input type="text" id="peso2019" hidden value="<?php echo round($peso2019); ?>">


<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Página Inicial</li>
</ol>

<div class="row">
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-pie"></i>
        Relação de Marcas por País
      </div>
      <div class="card-body">
        <canvas id="marcasChart" width="100%" height="70"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-pie"></i>
        Relação de Pilhas Recolhidas por Ano
      </div>
      <div class="card-body">
        <canvas id="pesosChart" width="100%" height="70"></canvas>
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
