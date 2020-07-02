<?php
  include("include/header.php");

  if (isset($_SESSION["login"])) { //SE EXISTIR AUTENTICAÇÃO
    if (isset($_POST["cadastrar"])) {

      $titulo = addslashes($_POST["titulo"]);
      $legenda = addslashes($_POST["legenda"]);
      if (isset($_POST['header'])){
        $header = 1;
      }else{
        $header = 0;
      }
      $link = addslashes($_POST["link"]);

      //recebe os valores enviados pelo formulário
      $file = $_FILES['img'];

      //permite debugar e ver o que foi enviado
      //var_dump($file);

      //conta quantas imagens foram enviadas
      $numFile = count(array_filter($file['name']));

      //define qual pasta a imagem será salva
      $folder = 'upload/img-galeria';;

      //define os tipos suportados de arquivos enviados
      $permite = array("image/tif", "image/jpeg","image/png");
      $maxSize = 1024 * 1024 * 1024 * 5;

      //Mensagens
      $msg = array(); //cria um array vazio
      //cria um array e já atribui valores das mensagens a ele.
      $erro = array(
        1 =>"O arquivo é maior que o limite definido no max_filesize.",
        2 => "O aquivo ultrapassa o limite de tamanho permitido no MAX_FILE_SIZE.",
        3 => "O upload do arquivo foi feito parcialmente.",
        4 => "Não foi feito o upload do arquivo."
      );

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

            $sql = 'INSERT INTO Imagem (imagem, titulo, legenda, data, header, link) 
                    VALUES ("' . $img . '","' . $titulo . '","' . $legenda . '", CURRENT_TIME(), ' . $header . ', "' . $link . '");';
            
            if ($con->query($sql) === TRUE) {
              echo "<script>alert('Cadastro realizado com sucesso!');</script>";
              echo "<script>window.location = 'galeria.php';</script>";
            } else {
              echo "Erro: " . $sql . "<br>" . $con->error;
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
          
    } //fim se atualizar post
  }

?>