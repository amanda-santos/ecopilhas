<?php
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
    
      if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {

        $id = $_GET['id']; 

        $sqlSecaoPaginas = "SELECT titulo, exibir FROM SecaoPaginas WHERE idSecaoPaginas = " . $id;

        $resultSecaoPaginas = $con->query($sqlSecaoPaginas);

        if ($resultSecaoPaginas->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPaginas = $resultSecaoPaginas->fetch_assoc()){
            $titulo = ucwords($exibirSecaoPaginas["titulo"]);
            $exibir = $exibirSecaoPaginas["exibir"];
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='index.php';
                </script>";
          exit;
        }

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $tituloAtualizado = addslashes($_POST["titulo"]);

          if (isset($_POST['exibir'])){
            $exibirAtualizado = 1;
          }else{
            $exibirAtualizado = 0;
          }

          $sqlAtualizarSecaoPaginas = "UPDATE SecaoPaginas SET titulo = '".$tituloAtualizado."', exibir = ".$exibirAtualizado." WHERE idSecaoPaginas = ".$id;
          
          if ($con->query($sqlAtualizarSecaoPaginas) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso!');</script>";
            echo "<script>window.location = 'editarSecaoPaginas.php?id='" . $id . ";</script>";
          } else {
            echo "Erro: " . $sqlAtualizarSecaoPaginas . "<br>" . $con->error;
          }
              
        } //fim se atualizar post
    }

?>

<!-- Page Content -->
    <div class="container"> <!--início container do post-->
      <!--início grid do post-->
      <div class="row">
        <div class="col-md-12"> 
          <!-- início do post -->
          <div class = "post">
            <h1>Editar <?php echo ucwords($titulo); ?></h1>
            <hr>
            <form class="form-horizontal" method="POST" action="editarSecaoPaginas.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            
              <!--início do campo do formulário-->
                <div class="form-group">
                <label class="control-label col-sm-3" for="titulo">Título da seção de páginas:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>" required>
                </div> <!--fim col-sm-5-->
                </div> <!--fim form'-group-->
              <!--fim do campo do formulário-->

              <label class="control-label col-sm-12">
                <b>Páginas cadastradas na seção: </b>
              
                <?php

                  $sqlPagina = "SELECT idPagina, nome FROM Pagina WHERE SecaoPaginas_idSecaoPaginas = " . $id;

                  $resultPagina = $con->query($sqlPagina);

                  if ($resultPagina->num_rows > 0) { // Exibindo cada linha retornada com a consulta
                    while ($exibirPagina = $resultPagina->fetch_assoc()){
                      $idPagina = $exibirPagina["idPagina"];
                      $nomePagina = ucwords($exibirPagina["nome"]);
                ?>

                      <label class="control-label col-sm-11" for="nomeSecaoPaginas">
                        <?php echo $nomePagina; ?>
                        <a href="editarPaginaAdmin.php?id=<?php echo $idPagina; ?>">
                          <i class="far fa-edit"></i>
                        </a>
                      </label>

                <?php
                    } // fim while Pagina
                  } // fim if Pagina
                ?>

                <br><br>

                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cadastrarPagina">
                    <i class="fas fa-plus"></i>  
                    Cadastrar Nova Página
                </button>

              </label>

              <div class="form-check">
                <div class="col-sm-12"><br>
                  <?php 
                    if ($exibir){
                  ?>
                      <input type="checkbox" class="form-check-input" name="exibir" id="exibir" checked="checked">
                  <?php 
                    }else{
                  ?>
                      <input type="checkbox" class="form-check-input" name="exibir" id="exibir">
                  <?php 
                    }
                  ?>
                  <label class="form-check-label" for="exibir">Exibir Seção de Páginas</label>
                </div>
              </div>
            
            <br>
            
            <div class="col-sm-12">
              <input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar"></input>
            </div>
            
            <br>

            </form>
            
          </div> <!-- fim da div post -->
          <!-- fim do post -->  
            
        </div><!--fim col-md-8-->
        
      </div> <!--fim row -->
    </div>

    <!-- Modal - Cadastrar Página -->
    <div class="modal fade" id="cadastrarPagina" tabindex="-1" role="dialog" aria-labelledby="cadastrarPagina" aria-hidden="true">

      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="cadastrarPaginaLabel">Cadastrar Nova Página</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
          <form class="form-horizontal" action="inserirPagina.php?idSecaoPaginas=<?php echo $id ; ?>" method="post" data-toggle="validator">

              <div class="form-group">
                <label class="control-label col-sm-12" for="titulo">Título:</label>
                <div class="col-sm-12">
                  <input required type="text" class="form-control" id="titulo" name="titulo">
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

<?php
	include("include/footer.php");
  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>