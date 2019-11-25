<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (($_SESSION['tipo'] != 'socio') && ($_SESSION['tipo'] != 'dependente')) { 
    
      if ((!isset($_GET['idSecao'])) || (!isset($_GET['idPost']))) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {
        $idPost = $_GET['idPost'];
        $idSecao = $_GET['idSecao'];

        $sql = "SELECT aprovacao FROM ecopilhas.PostPendente WHERE aprovacao = 0 AND idPostPendente = " . $idPost;

        $result = $con->query($sql);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          echo "<script>alert('ERRO: Existem atualizações pendentes nesta postagem.');
                        javascript:window.history.go(-1);
                </script>";
          exit;
        }

        $SQL = "SELECT titulo, conteudo, img FROM ecopilhas.Post WHERE idPost = $idPost;";

        $result = $con->query($SQL);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibir = $result->fetch_assoc()){
            $titulo = $exibir["titulo"];
            $conteudo = $exibir["conteudo"];
            $img = $exibir["img"];
          }
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
                <h1>Editar Postagem</h1>
                <hr>

                <?php
                  if (isAdmin($_SESSION['tipo'])){
                ?>
                    <form class="form-horizontal" method="POST" action="atualizarPostAdmin.php?idPost=<?php echo $idPost;?>&idSecao=<?php echo $idSecao; ?>" enctype="multipart/form-data">
                <?php
                  }else{
                ?>
                    <form class="form-horizontal" method="POST" action="atualizarPostUser.php?idPost=<?php echo $idPost;?>&idSecao=<?php echo $idSecao; ?>" enctype="multipart/form-data">
                <?php
                  }
                ?>

                  <input hidden type="text" class="form-control" id="imagem" name="imagem" value="<?php echo $img; ?>">

                  <!--início do campo do formulário-->
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="titulo">Título:</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>
                    </div> <!--fim col-sm-5-->
                  </div> <!--fim form-group-->
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
                      <textarea class="form-control" id="conteudo" name="conteudo"><?php echo $conteudo; ?></textarea>
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