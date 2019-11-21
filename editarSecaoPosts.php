<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
    
      if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {

        $id = $_GET['id']; 

        $sqlSecaoPosts = "SELECT titulo, exibir FROM ecopilhas.SecaoPosts WHERE idSecaoPosts = " . $id;

        $resultSecaoPosts = $con->query($sqlSecaoPosts);

        if ($resultSecaoPosts->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecaoPosts = $resultSecaoPosts->fetch_assoc()){
            $titulo = ucwords($exibirSecaoPosts["titulo"]);
            $exibir = $exibirSecaoPosts["exibir"];
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

          $sqlAtualizarSecaoPosts = "UPDATE ecopilhas.SecaoPosts SET titulo = '".$tituloAtualizado."', exibir = ".$exibirAtualizado." WHERE idSecaoPosts = ".$id;
          
          if ($con->query($sqlAtualizarSecaoPosts) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso!');</script>";
            echo "<script>window.location = 'editarSecaoPosts.php?id='" . $id . ";</script>";
          } else {
            echo "Erro: " . $sqlAtualizarSecaoPosts . "<br>" . $con->error;
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
            <form class="form-horizontal" method="POST" action="editarSecaoPosts.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
            
              <!--início do campo do formulário-->
                <div class="form-group">
                <label class="control-label col-sm-3" for="titulo">Título da seção de postagens:</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>" required>
                </div> <!--fim col-sm-5-->
                </div> <!--fim form'-group-->
              <!--fim do campo do formulário-->

              <div class="form-check">
                <div class="col-sm-12">
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
                  <label class="form-check-label" for="exibir">Exibir Seção de Postagens</label>
                </div>
              </div>
            
            <br>
            
            <div class="col-sm-12">
              <input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar"></input>
              <a href="javascript:window.history.go(-1)"><input type="button" class="btn btn-default" value="Cancelar"></input></a>
            </div>
            
            <br>

            </form>
            
          </div> <!-- fim da div post -->
          <!-- fim do post -->  
            
        </div><!--fim col-md-8-->
        
      </div> <!--fim row -->
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