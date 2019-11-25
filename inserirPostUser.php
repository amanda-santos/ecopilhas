<?php
  include("conexao.php"); //incluir arquivo com conexão ao banco de dados
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if ($_SESSION['tipo'] == 2){ 

      if (!isset($_GET['id'])) { //se não tiver nenhum id passado pela url deve-se redirecionar o usuário para a página inicial

        echo "<script>window.location = 'index.php';</script>";
        exit;

      } else {

        if (isset($_POST["cadastrar"])) {

          $idSecao = $_GET["id"];

          $titulo = addslashes($_POST["titulo"]);
          $conteudo = addslashes($_POST["conteudo"]);
          $autor = $_SESSION["id"];

          //recebe os valores enviados pelo formulário
          $file = $_FILES['img'];

          //permite debugar e ver o que foi enviado
          //var_dump($file);

          //conta quantas imagens foram enviadas
          $numFile = count(array_filter($file['name']));

          //define qual pasta a imagem será salva
          $folder = 'upload/img-post';;

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
            $img = "padrao.png";
            //include("conexao/conecta.php"); //incluir arquivo com conexão ao banco de dados

            $sqlPostPendenteSemImagem = 'INSERT INTO ecopilhas.PostPendente (idSecaoPosts, titulo, conteudo, img, autorAlteracao, dataAlteracao, aprovacao, cadastro) VALUES (' . $idSecao . ', "' . $titulo . '","' . $conteudo . '","' . $img . '",' . $autor . ', CURRENT_TIME(), 0, 0);';

            if ($con->query($sqlPostPendenteSemImagem) === TRUE){

              $sqlPostSemImagem = 'INSERT INTO  ecopilhas.Post (idSecaoPosts, titulo, conteudo, img, autorAlteracao, dataAlteracao, cadastro, dataPostagem) VALUES (' . $idSecao . ', "' . $titulo . '","' . $conteudo . '","' . $img . '",' . $autor . ', CURRENT_TIME(), 0, CURRENT_TIME());';

              if ($con->query($sqlPostSemImagem) === TRUE){
                echo "<script>alert('Cadastro realizado com sucesso! Por favor, aguarde a aprovação da diretoria.');</script>";
                echo "<script>window.location = 'postagens.php?id=" . $idSecao . "';</script>";
              }else{
                //mensagem exibida caso ocorra algum erro na execução do comando sql
                echo "<script>alert('Erro ao cadastrar postagem!');</script>";
                echo "Erro: ". $sqlPostSemImagem. "<br>" . $con->error;
              }

            }else{
              //mensagem exibida caso ocorra algum erro na execução do comando sql
              echo "<script>alert('Erro ao cadastrar postagem!');</script>";
              echo "Erro: ". $sqlPostPendenteSemImagem. "<br>" . $con->error;
            }

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

                  $sqlPostPendente = 'INSERT INTO ecopilhas.PostPendente (idSecaoPosts, titulo, conteudo, img, autorAlteracao, dataAlteracao, aprovacao, cadastro) VALUES (' . $idSecao . ', "' . $titulo . '","' . $conteudo . '","' . $img . '",' . $autor . ', CURRENT_TIME(), 0, 0);';

                  if ($con->query($sqlPostPendente) === TRUE){

                    $sqlPost = 'INSERT INTO ecopilhas.Post (idSecaoPosts, titulo, conteudo, img, autorAlteracao, dataAlteracao, cadastro, dataPostagem) VALUES (' . $idSecao . ', "' . $titulo . '","' . $conteudo . '","' . $img . '",' . $autor . ', CURRENT_TIME(), 0, CURRENT_TIME());';

                    if ($con->query($sqlPost) === TRUE){
                      echo "<script>alert('Cadastro realizado com sucesso! Por favor, aguarde a aprovação da diretoria.');</script>";
                      echo "<script>window.location = 'postagens.php?id=" . $idSecao . "';</script>";
                    }else{
                      //mensagem exibida caso ocorra algum erro na execução do comando sql
                      echo "<script>alert('Erro ao cadastrar postagem!');</script>";
                      echo "Erro: ". $sqlPost. "<br>" . $con->error;
                    }

                  }else{
                    //mensagem exibida caso ocorra algum erro na execução do comando sql
                    echo "<script>alert('Erro ao cadastrar postagem!');</script>";
                    echo "Erro: ". $sqlPostPendente. "<br>" . $con->error;
                  }

                  $con->close();

                } else {
                  $msg[] = "<b>$name: </b> Desculpe! Ocorreu um erro ao fazer upload da imagem.";
                }
              }
            }

            //var_dump($msg); //para debugar e ver o conteúdo da variável $msg
            foreach ($msg as $mensagem) {
              echo $mensagem."<br>";
            }
            
          }    
        } //fim se atualizar post
      }
    }else {
      echo "<script>window.location = 'index.php';</script>";
    }
  } else {
    echo "<script>window.location = 'index.php';</script>";
  }

?>