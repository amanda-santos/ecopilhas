<?php
  include("include/header.php"); // incluir arquivo com header do site
?>

<!-- Modal - Cadastrar Imagem-->
<div class="modal fade" id="cadastrarImagem" tabindex="-1" role="dialog" aria-labelledby="cadastrarImagem" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="imagemLabel">Cadastrar Nova Imagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form class="form-horizontal" action="inserirImagem.php" method="post" data-toggle="validator" enctype="multipart/form-data">

          <div class="form-group">
            <label class="control-label col-sm-12" for="titulo">Título:</label>
            <div class="col-sm-12">
              <input maxlength="100" type="text" class="form-control" id="titulo" name="titulo">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="legenda">Legenda:</label>
            <div class="col-sm-12">
              <textarea maxlength="300" class="form-control" id="legenda" name="legenda"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="img">Imagem:
              <span title="obrigatório">*</span> 
            </label>
            <div class="col-sm-12">
              <input required type="file" class="form-control" id="img" name="img[]">
            </div> <!--fim col-sm-5-->
          </div> <!--fim form-group-->

          <div class="form-group form-check">
            <div class="col-sm-12">
              <input type="checkbox" class="form-check-input" name="header" id="header">
              <label class="form-check-label" for="header">Exibir Imagem como Destaque</label>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-12" for="link">Ao clicar na imagem, redirecionar para:</label>
            <div class="col-sm-12">
              <input maxlength="200" type="text" placeholder="Ex.: http://ecopilhas.com.br/" class="form-control" id="link" name="link">
            </div>
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input type="submit" class="btn btn-primary" value="Cadastrar" name="cadastrar"></input>
      </div>

      </form>

    </div>
  </div>
</div>

<br>

<section class="gallery-block cards-gallery">
    <div class="container">

        <div class="heading">
          <h1>Galeria de Imagens</h1>
        </div>

        <?php
        if (isset($_SESSION['login'])){
          if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
        ?>
            <a class="btn btn-primary" data-toggle="modal" data-target="#cadastrarImagem" href="">
              <i class="fas fa-plus"></i>  
              Cadastrar Nova Imagem
            </a>
        <?php
          }
        }
        ?>

        <hr>

        <div class="row">

          <?php

            //paginação

            //A quantidade de imagens a serem exibidas
            $quantidade = 12;

            //a pagina atual
            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

            //calcula a pagina de qual valor será exibido
            $inicio = ($quantidade * $pagina) - $quantidade;

            $sqlGaleria = "SELECT * FROM Imagem 
                           ORDER BY data DESC
                           LIMIT $inicio, $quantidade;";

            $resultGaleria = $con->query($sqlGaleria);
            if ($resultGaleria->num_rows > 0){
              while ($exibirGaleria = $resultGaleria->fetch_assoc()){
                $idImagem = $exibirGaleria["idImagem"];
                $img = $exibirGaleria["imagem"];
                $titulo = $exibirGaleria["titulo"];
                $legenda = $exibirGaleria["legenda"];
                $header = $exibirGaleria["header"];
                $link = $exibirGaleria["link"];

                $datetimeImg = $exibirGaleria["data"];
                $datetime = new DateTime($datetimeImg);
                $datetime = $datetime->format('d/m/Y H:i:s');
                $data = substr($datetime, 0, 10); 
                $hora = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min";
          ?>
                <div style="padding-bottom: 30px;" class="col-md-6 col-lg-4">
                    <div class="card border-0 transform-on-hover">
                      <span class="border">
                        <a class="lightbox" href="upload/img-galeria/<?php echo $img; ?>">
                          <img src="upload/img-galeria/<?php echo $img; ?>" alt="<?php echo $titulo; ?>" class="card-img-top">
                        </a>
                        <p class="text-muted" style="font-size:12px; text-align: center">
                          Postada em <?php echo $data; ?> às <?php echo $hora; ?>
                        </p>
                        
                        <div class="card-body text-center" style="padding-top: 0px;">
                            <h6>
                              <b><?php echo $titulo; ?></b>
                            </h6>
                            <p class="text-muted card-text"><?php echo $legenda; ?></p>
                        

                        <?php
                        if (isset($_SESSION['login'])){ 
                        ?>
                          <div style="text-align: center;">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editarImagem-<?php echo $idImagem;?>"><i class="far fa-edit"></i> Editar</a>
                            <a class="btn btn-danger" href="#" onclick="apagar('<?php echo $idImagem ?>');"><i class="far fa-trash-alt"></i> Excluir</a>
                          </div>
                        <?php
                        }
                        ?>
                        
                      </div>

                      </span>
                    </div>
                </div>
                <br>

                <!-- Modal - Editar Imagem-->
                <div class="modal fade" id="editarImagem-<?php echo $idImagem;?>" tabindex="-1" role="dialog" aria-labelledby="editarImagem-<?php echo $idImagem;?>" aria-hidden="true">

                  <div class="modal-dialog" role="document">
                    <div class="modal-content">

                      <div class="modal-header">
                        <h5 class="modal-title" id="imagemLabel">Editar Imagem</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                      <form class="form-horizontal" action="atualizarImagem.php?id=<?php echo $idImagem;?>" method="post" data-toggle="validator" enctype="multipart/form-data">

                          <div class="form-group">
                            <label class="control-label col-sm-12" for="titulo">Título:</label>
                            <div class="col-sm-12">
                              <input maxlength="100" type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-12" for="legenda">Legenda:</label>
                            <div class="col-sm-12">
                              <textarea maxlength="300" class="form-control" id="legenda" name="legenda"><?php echo $legenda; ?></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-12" for="imagem">Imagem:
                              <span title="obrigatório">*</span> 
                              <br>
                              <img width="400px" src="upload/img-galeria/<?php echo $img; ?>" alt="">
                            </label>
                            <div class="col-sm-12">
                              <input type="file" class="form-control" id="imagem" name="imagem[]">
                            </div> <!--fim col-sm-5-->
                          </div> <!--fim form-group-->

                          <input hidden type="text" class="form-control" id="imgAntiga" name="imgAntiga" value="<?php echo $img; ?>">

                          <div class="form-group form-check">
                            <div class="col-sm-12">
                              <?php 
                                if ($header){
                              ?>
                                  <input type="checkbox" class="form-check-input" name="header" id="header" checked="checked">
                              <?php 
                                }else{
                              ?>
                                  <input type="checkbox" class="form-check-input" name="header" id="header">
                              <?php 
                                }
                              ?>
                              <label class="form-check-label" for="header">Exibir Imagem como Destaque</label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-sm-12" for="link">Ao clicar na imagem, redirecionar para:</label>
                            <div class="col-sm-12">
                              <input maxlength="200" type="text" placeholder="Ex.: http://ecopilhas.com.br/" class="form-control" id="link" name="link" value="<?php echo $link; ?>">
                            </div>
                          </div>

                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <input type="submit" class="btn btn-primary" value="Atualizar" name="atualizar"></input>
                      </div>

                      </form>

                    </div>
                  </div>
                </div>
                <!-- Fim Modal Editar Imagem -->

          <?php
              } //fim while
            } //fim if
          ?>
        </div>
    </div>
</section>

<?php

/**
* SEGUNDA PARTE DA PAGINAÇÃO
*/

//SQL para saber o total
$sqlTotalRegistros = "SELECT COUNT(idImagem) AS totalRegistros FROM Imagem;";

$resultTotalRegistros = $con->query($sqlTotalRegistros);

if ($resultTotalRegistros->num_rows > 0) { // Exibindo cada linha retornada com a consulta
  while ($exibirTotalRegistros = $resultTotalRegistros->fetch_assoc()){
    $totalRegistros = $exibirTotalRegistros["totalRegistros"];
  }
}

// o calculo do total de páginas a ser exibido
$totalPagina= ceil($totalRegistros / $quantidade);

// define o valor máximo a ser exibida na paginação tanto para direita quando para esquerda
$exibir = 3;

/**
* Aqui montará o link que voltará uma pagina
* Caso o valor seja zero, por padrão ficará o valor 1
*/
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;

/**
* Aqui montará o link que irá para a proxima pagina
* Caso pagina + 1 for maior ou igual ao total, ele terá o valor do total
* caso contrario, ele pegará o valor da página + 1
*/
$posterior = (($pagina+1) >= $totalPagina) ? $totalPagina : $pagina+1;

?>

<ul class="pagination justify-content-center"> <!-- inicio paginação -->

  <?php
  
    // exibindo a primeira página
    echo "
    <li class='page-item'>
      <a class='page-link' href='galeria.php?pagina=1'>Primeira Página</a>
    </li>";

    // exibindo a página anterior
    echo "
    <li class='page-item'>
      <a class='page-link' href='galeria.php?pagina=" . $anterior . "'>Anterior</a>
    </li>";

    // exibindo valores à esquerda
    for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
      if($i > 0)
        echo "
        <li class='page-item'>
          <a class='page-link' href='galeria.php?pagina=" . $i . "'>" . $i ."</a>
        </li>";
    }

    // exibindo a página atual
    echo "
        <li class='page-item'>
          <a class='page-link' href='galeria.php?pagina=" . $pagina . "'><strong>" . $pagina. "</strong></a>
        </li>";

    // exibindo valores à direita
    for($i = $pagina+1; $i < $pagina+$exibir; $i++){
         if($i <= $totalPagina)
          echo "
              <li class='page-item'>
                <a class='page-link' href='galeria.php?pagina=" . $i ."'>" . $i ."</a>
              </li>";
    }

    // exibindo a próxima página
    echo "
        <li class='page-item'>
          <a class='page-link' href='galeria.php?pagina=" . $posterior . "'>Próxima</a>
        </li>";

    // exibindo a última página
    echo "
        <li class='page-item'>
          <a class='page-link' href='galeria.php?pagina=" . $totalPagina . "'>Última Página</a>
        </li>";
?>

</ul> <!-- fim paginação -->

<script type="text/javascript">
  function apagar(id) {
    if (window.confirm('Deseja realmente excluir a imagem?')) {
      window.location = 'excluirImagem.php?id=' + id;
    }
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.cards-gallery', { animation: 'slideIn'});
</script>

<?php
  include("include/footer.php"); // incluir arquivo com header do site
?>