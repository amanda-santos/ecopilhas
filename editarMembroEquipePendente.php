<?php
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isAdmin($_SESSION['tipo'])){ //SE O USUÁRIO LOGADO FOR DO TIPO ADMINISTRADOR
    
      if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {

        $id = $_GET['id']; 

        $sql = "SELECT MEP.idMembroEquipePendente, MEP.nome, MEP.email, MEP.descricao, MEP.cargo, MEP.img, U.idUsuario, U.nome AS Unome, MEP.dataAlteracao 
                  FROM MembroEquipePendente AS MEP 
                  JOIN Usuario AS U 
                  ON MEP.Usuario_idUsuario = U.idUsuario 
                  WHERE idMembroEquipePendente = " . $id;

        $result = $con->query($sql);

        if ($result->num_rows > 0) { // Exibindo cada linha retornada com a consulta
          while ($exibir = $result->fetch_assoc()){
            $id = $exibir["idMembroEquipePendente"];
            $nome = ucwords($exibir["nome"]);
            $email = $exibir["email"];
            $descricao = $exibir["descricao"];
            $cargo = $exibir["cargo"];
            $img = $exibir["img"];

            $autor = ucwords($exibir["Unome"]);
            $autorId = $exibir["idUsuario"];

            $datetimeAlt = $exibir["dataAlteracao"];
            $datetime = new DateTime($datetimeAlt);
            $datetime = $datetime->format('d/m/Y H:i:s');
            $dataAlteracao = substr($datetime, 0, 10); 
            $horaAlteracao = substr($datetime, 11, 8);
          } // fim while
        } else { //se não achar nenhum registro
          echo "<script>alert('Não há dados cadastrados com o id informado.');
                        window.location.href='equipe.php';
                </script>";
          exit;
        }

        //SE ATUALIZAR POST
        if (isset($_POST["atualizar"])) {

            $nome = addslashes($_POST["nome"]);
            $cargo = addslashes($_POST["cargo"]);
            $descricao = addslashes($_POST["descricao"]);
            $email = addslashes($_POST["email"]);
            $autorAprovacao = $_SESSION["id"];

            if(!empty($_FILES['img']['name'])) { // se o input file não estiver vazio, ou seja, se a imagem também foi editada

              //recebe os valores enviados pelo formulário
              $file = $_FILES['img'];

              //permite debugar e ver o que foi enviado
              //var_dump($file);

              //conta quantas imagens foram enviadas
              $numFile = count(array_filter($file['name']));

              //define qual pasta a imagem será salva
              $folder = 'upload/img-membro-equipe';;

              //define os tipos suportados de arquivos enviados
              $permite = array("image/tif", "image/jpeg","image/png");
              $maxSize = 1024 * 1024 * 5;

              //Mensagens
              $msg = array(); //cria um array vazio
              //cria um array e já atribui valores das mensagens a ele.
              $erro = array(
                1 =>"O arquivo é maior que o limite definido no max_filesize.",
                2 => "O aquivo ultrapassa o limite de tamanho permitido no MAX_FILE_SIZE.",
                3 => "O upload do arquivo foi feito parcialmente.",
                4 => "Não foi feito o upload do arquivo."
              );

              if ($numFile<=0) {

              } else {
                for ($i=0; $i < $numFile; $i++) {

                  $name = $file["name"][$i]; //pega o nome
                  $type = $file["type"][$i]; //pega o tipo
                  $size = $file["size"][$i]; //pega o tamanho
                  $error = $file["error"][$i]; //pega os erros
                  $tmp = $file["tmp_name"][$i]; //pega o nome temporário do arquivo quando ele está sendo passado do cliente para o servidor
                  $extensao = @end(explode(".", $name)); //pega extensão de cada arquivo

                  //var_dump($extensao); //para debugar e ver se está pegando a extensão dos arquivos

                  $img = rand().".$extensao"; //gera um novo nome único para os arquivos. Poderia também usar a função md5 do php 

                  //abaixo estamos tratando as mensagens a serem exibidas para o usuário, em casos de erro ou sucesso no upload
                  if ($error != 0) { //se não houver erro ao carregar a imagem
                    $msg[] = "<b>$name: </b>".$erro[$error];

                  } else if(!in_array($type, $permite)) {
                    $msg[] = "<b>$name: </b>ERRO: Tipo de arquivo não suportado. Escolha arquivo do tipo .jpg e .png.";

                  } else if ($size > $maxSize) {
                    $msg[] = "<b>$name: </b>ERRO: Tamanho do arquivo é maior que o permitido.";

                  } else {
                    //move o arquivo para a pasta definida
                    if (move_uploaded_file($tmp, $folder."/".$img)) {
                      //trecho para gravar a imagem na pasta e para gravar os dados na pasta da imagem no banco de dados
                    } else {
                      $msg[] = "<b>$name: </b> Desculpe! Ocorreu um erro ao fazer upload da imagem.";
                    }
                  }
                }

                //var_dump($msg); //para debugar e ver o conteúdo da variável $msg
                foreach ($msg as $mensagem) {
                  echo $mensagem."<br>";
                }
                
              } //fim else "algum arquivo foi enviado"

            } //fim empty
            
            $sql = 'UPDATE MembroEquipe 
                      SET nome = "' . $nome . '", email = "' . $email . '", descricao = "' . $descricao . '", cargo = "' . $cargo . '", img = "' . $img . '", Usuario_idUsuario_autor = ' . $autorId . ', dataAlteracao = "' . $datetimeAlt . '", Usuario_idUsuario_autorAprovacao = ' . $autorAprovacao . ', dataAprovacao = CURRENT_TIME() 
                      WHERE idMembroEquipe = ' . $id . ';';
                    
            if ($con->query($sql) === TRUE) {

              $sql = "UPDATE MembroEquipePendente 
                        SET aprovacao = 1 
                        WHERE idMembroEquipePendente = ".$_GET["id"];
          
              if ($con->query($sql) === TRUE) {
                echo "<script>alert('Atualização realizada com sucesso!');</script>";
                echo "<script>window.location = 'equipe.php';</script>";
              } else {
                echo "Erro: " . $sql . "<br>" . $con->error;
              }

            } else {
              echo "Erro: " . $sql . "<br>" . $con->error;
            }
            $con->close(); 

        } //fim se atualizar post
?>

    <!-- Page Content -->
    <div class="container"> <!--início container do post-->
          <!--início grid do post-->
          <div class="row">
            <div class="col-md-12"> 
              <!-- início do post -->
              <div class = "post">
                <h1>Editar Membro da Equipe</h1>
                <hr>
                <form class="form-horizontal" method="POST" action="editarMembroEquipePendente.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

                  <!--início do campo do formulário-->
                    <div class="form-group">
                    <label class="control-label col-sm-3" for="nome">Autor(a):</label>
                    <div class="col-sm-12">
                      <input readonly type="text" class="form-control" id="autor" name="autor" value="<?php echo $autor;?>" required>
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
                    <label class="control-label col-sm-12" for="nome">Nome: <span title="obrigatório">*</span> </label>
                    <div class="col-sm-12">
                      <input maxlength="200" type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required></input>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="cargo">Cargo: <span title="obrigatório">*</span> </label>
                    <div class="col-sm-12">
                      <input maxlength="200" type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $cargo; ?>" required></input>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="descricao">Descrição:</label>
                    <div class="col-sm-12">
                      <textarea maxlength="500" class="form-control" id="descricao" name="descricao"><?php echo $descricao; ?></textarea> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="email">E-mail:</label>
                    <div class="col-sm-12">
                      <input maxlength="200" type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"></input>
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="control-label col-sm-12" for="imgPerfil">Imagem de perfil:<br>
                    <img style="width: 350px;" src="upload/img-membro-equipe/<?php echo $img; ?>" alt=""></label>
                    <div class="col-sm-12">
                      <input type="file" class="form-control" id="imgPerfil" name="img[]">
                      <small><i>Tamanho recomendado: 500x300px</i></small>
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
    }
  }else {
    echo "<script>window.location = 'index.php';</script>";
  }
} else {
  echo "<script>window.location = 'index.php';</script>";
}
?>