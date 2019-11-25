<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) {
      //if (isAdmin($_SESSION['tipo'])){ 
    
        if ((!isset($_GET['idSecao'])) || (!isset($_GET['idPost']))) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

          echo "<script>window.location = 'index.php';</script>";
          exit;

        } else {

          $idSecao = $_GET['idSecao'];
          $idPost = $_GET['idPost'];

          $SQL = "SELECT titulo, conteudo, img, autorAlteracao, nome, nomeSite, dataAlteracao FROM ecopilhas.PostPendente JOIN ecopilhas.Usuario ON autorAlteracao = idUsuario WHERE idPostPendente = $idPost;";

          $result = $con->query($SQL);

          if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
            while ($exibir = $result->fetch_assoc()){
              $titulo = $exibir["titulo"];
              $conteudo = $exibir["conteudo"];
              $img = $exibir["img"];
              $nomeSite = $exibir["nomeSite"];

              $idAutorAlteracao = $exibir["autorAlteracao"];

              $autorAlteracao = ucwords($exibir["nome"]);

              $datetimeAlteracao = $exibir["dataAlteracao"];
              $datetime = new DateTime($datetimeAlteracao);
              $datetime = $datetime->format('d/m/Y H:i:s');
              $dataAlteracao = substr($datetime, 0, 10); 
              $horaAlteracao = substr($datetime, 11, 2) . "h" . substr($datetime, 14, 2) . "min"; 
            }
          }else{
            echo "Nenhum post encontrado.";
          }
        }
?>

        <!-- Page Content -->
        <div class="container"> <!--início container do post-->
              <!--início grid do post-->
              <div class="row">
                <div class="col-md-12"> 
                  <!-- início do post -->
                  <div class = "post">
                    <h1>Editar Postagem Pendente</h1>
                    <hr>
                    <form class="form-horizontal" method="POST" action="inserirPostPendente.php?idPost=<?php echo $idPost; ?>&idSecao=<?php echo $idSecao; ?>" enctype="multipart/form-data">

                      <input hidden type="text" class="form-control" id="datetimeAlteracao" name="datetimeAlteracao" value="<?php echo $datetimeAlteracao; ?>">

                      <input hidden type="text" class="form-control" id="idAutorAlteracao" name="idAutorAlteracao" value="<?php echo $idAutorAlteracao; ?>">

                      <input hidden type="text" class="form-control" id="imagem" name="imagem" value="<?php echo $img; ?>">

                      <!--início do campo do formulário-->
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="titulo">Título:</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
                        </div> <!--fim col-sm-5-->
                      </div> <!--fim form-group-->
                      <!--fim do campo do formulário-->

                      <!--início do campo do formulário-->
                        <div class="form-group">
                        <label class="control-label col-sm-3" for="nome">Autor(a):</label>
                        <div class="col-sm-12">
                          <input readonly type="text" class="form-control" id="autor" name="autor" value="<?php echo $autorAlteracao;?>" required>
                        </div> <!--fim col-sm-5-->
                        </div> <!--fim form'-group-->
                      <!--fim do campo do formulário-->

                      <!--início do campo do formulário-->
                        <div class="form-group">
                        <label class="control-label col-sm-4" for="nomeSite">Nome do autor(a) a ser exibido no site:</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" id="nomeSite" name="nomeSite" value="<?php echo $nomeSite;?>" required>
                        </div> <!--fim col-sm-5-->
                        </div> <!--fim form'-group-->
                      <!--fim do campo do formulário-->

                      <!--início do campo do formulário-->
                        <div class="form-group">
                        <label class="control-label col-sm-3" for="nome">Data de alteração:</label>
                        <div class="col-sm-12">
                          <input readonly type="text" class="form-control" id="dataAlteracao" name="dataAlteracao" value="<?php echo $dataAlteracao;?> às <?php echo $horaAlteracao;?>" required>
                        </div> <!--fim col-sm-5-->
                        </div> <!--fim form'-group-->
                      <!--fim do campo do formulário-->

                      <div class="form-group">
                        <label class="control-label col-sm-12" for="img">Imagem:<br>
                          <img class="crop-image-post" src="upload/img-post/<?php echo $img; ?>" alt="">
                        </label>

                        <div class="col-sm-12">
                          <input type="file" class="form-control" id="img" name="img[]">
                          <small><i>Tamanho recomendado: 815x230px</i></small>
                        </div> <!--fim col-sm-5-->
                      </div> <!--fim form-group-->
                      
                      <div class="form-group">
                        <label class="control-label col-sm-3" for="conteudo">Descrição:</label>
                        <div class="col-sm-12">
                          <textarea class="form-control" id="conteudo" name="conteudo">
                            <?php echo $conteudo; ?>
                          </textarea>
                          <!--início editor de texto-->
                          <script type="text/javascript">
                            CKEDITOR.replace('conteudo');
                          </script>
                          <!--fim editor de texto-->
                        </div> <!--fim col-sm-5-->
                      </div> <!--fim form-group-->
                      
                      <br>

                      <script type="text/javascript">
                        function apagar(idSecao, idPost, nome) {
                          if (window.confirm('Deseja realmente excluir a postagem "' + nome + '"?')) {
                            window.location = 'excluirPost.php?idPost=' + idPost + '&idSecao=' + idSecao;
                          }
                        }
                      </script>
                      
                      <p>
                        <div class="row">
                          <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" name="atualizar" value="Atualizar"></input>
                            <a href="javascript:window.history.go(-1)"><input type="button" class="btn btn-default" value="Cancelar"></input></a>
                          </div>
                          <div class="col-sm-1">
                            <a class="btn btn-danger" href="#" onclick="apagar('<?php echo $idSecao ?>', '<?php echo $idPost ?>', '<?php echo $titulo ?>');">Excluir Postagem</a>
                          </div>
                        </div>
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
    /*}else {
      echo "<script>window.location = 'index.php';</script>";
    }*/
  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>