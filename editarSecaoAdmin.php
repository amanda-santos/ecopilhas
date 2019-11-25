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

        $sqlSecao = "SELECT * FROM ecopilhas.Secao WHERE idSecao = $id";

        $resultSecao = $con->query($sqlSecao);

        if ($resultSecao->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibirSecao = $resultSecao->fetch_assoc()){
            $id = $exibirSecao["idSecao"];
            $nome = ucwords($exibirSecao["nome"]);
            $conteudo = $exibirSecao["conteudo"];
            $exibir = $exibirSecao["exibir"];
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='index.php';
                </script>";
          exit;
        }

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $nomeAtualizado = addslashes($_POST["nome"]);
          $conteudoAtualizado = addslashes($_POST["conteudo"]);

          if (isset($_POST['exibir'])){
            $exibirAtualizado = 1;
          }else{
            $exibirAtualizado = 0;
          }

          $autor = $_SESSION['id'];

          $sqlAtualizarSecao = "UPDATE ecopilhas.Secao SET nome = '".$nomeAtualizado."', conteudo = '".$conteudoAtualizado."', dataAlteracao = CURRENT_TIME(), autor = '".$autor."', dataAprovacao = CURRENT_TIME(), autorAprovacao = '".$autor."', exibir = " . $exibirAtualizado . " WHERE idSecao = ".$id;
          
          if ($con->query($sqlAtualizarSecao) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso!');</script>";
            echo "<script>window.location = 'secao.php?id=" . $id . "';</script>";
          } else {
            echo "Erro: " . $sqlAtualizarSecao . "<br>" . $con->error;
          }
          $con->close();
              
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
                <h1>Editar <?php echo ucwords($nome); ?></h1>
                <hr>
                <form class="form-horizontal" method="POST" action="editarSecaoAdmin.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                
                  <!--início do campo do formulário-->
                  <div class="form-group">
                  <label class="control-label col-sm-3" for="nome">Título da seção:</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome;?>" required>
                  </div> <!--fim col-sm-5-->
                  </div> <!--fim form'-group-->
                <!--fim do campo do formulário-->
                
                <div class="form-group">
                  <label class="control-label col-sm-3" for="conteudo">Conteúdo:</label>
                  <div class="col-sm-12">
                    <textarea class="form-control" id="conteudo" name="conteudo"><?php echo $conteudo;?></textarea>
                    <!--início editor de texto-->
                    <script type="text/javascript">
                      CKEDITOR.replace('conteudo');
                    </script>
                    <!--fim editor de texto-->
                  </div> <!--fim col-sm-5-->
                </div> <!--fim form-group-->

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
                    <label class="form-check-label" for="exibir">Exibir Seção</label>
                  </div>
                </div>
                
                <br>
                
                <p>
                  <input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar"></input>
                  <a href="javascript:window.history.go(-1)"><input type="button" class="btn btn-default" value="Cancelar"></input></a>
                </p>
                
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