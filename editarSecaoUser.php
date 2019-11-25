<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    //if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente') && (isAdmin($_SESSION['tipo']) == false)) {
    if($_SESSION['tipo'] == 2){
    
      if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {

        $id = $_GET['id']; 

        $sql = "SELECT aprovacao FROM SecaoPendente WHERE idSecaoPendente = $id";

        $result = $con->query($sql);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibir = $result->fetch_assoc()){
            $aprovacao = $exibir["aprovacao"];
            if ($aprovacao == 0) {
              echo "<script>alert('ERRO: Por favor, aguarde a aprovação das atualizações pendentes.');
                            window.location.href='index.php';
                    </script>";
              exit;
            }
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='index.php';
                </script>";
          exit;
        }

        $sql = "SELECT * FROM Secao WHERE idSecao = $id";

        $result = $con->query($sql);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibir = $result->fetch_assoc()){
            $id = $exibir["idSecao"];
            $nome = ucwords($exibir["nome"]);
            $conteudo = $exibir["conteudo"];
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='index.php';
                </script>";
          exit;
        }

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

          $nome = addslashes($_POST["nome"]);
          $conteudo = addslashes($_POST["conteudo"]);

          $autor = $_SESSION['id'];

          $sql = "UPDATE SecaoPendente SET nome = '".$nome."', conteudo = '".$conteudo."', dataAlteracao = CURRENT_TIME(), autor = '".$autor."', aprovacao = 0 WHERE idSecaoPendente = ".$_GET["id"];
          
          if ($con->query($sql) === TRUE) {
            echo "<script>alert('Atualização realizada com sucesso! Por favor, aguarde a aprovação.');</script>";
            echo "<script>window.location = 'secao.php?id=" . $id . "';</script>";
          } else {
            echo "Erro: " . $sql . "<br>" . $con->error;
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
                <form class="form-horizontal" method="POST" action="editarSecaoUser.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                
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